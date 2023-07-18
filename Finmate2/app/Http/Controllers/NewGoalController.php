<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : NewGoalController.php
 * History      : v002 0714 Noh new
 *******************************************/
namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Goal;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Support\Facades\DB;

class NewGoalController extends Controller
{
    public function index()
    {
        $id = auth()->user()->userid;
        $assets = Asset::where('userid', $id)->get();


        // Update goals
        Goal::query()
        ->join('assets', 'assets.assetno', '=', 'goals.assetno')
        ->where('goals.userid', $id)
        ->where('goals.iscom', 0)
        ->whereColumn('assets.balance', '>=', 'goals.amount')
        ->update([
            'goals.completed_at' => now(),
            'goals.iscom' => 1
        ]);

        Goal::query()
        ->join('assets', 'assets.assetno', '=', 'goals.assetno')
        ->where('goals.userid', $id)
        ->where('goals.iscom', 0)
        ->where('goals.endday', '<', now())
        ->whereColumn('assets.balance', '<', 'goals.amount')
        ->update([
            'goals.completed_at' => now(),
            'goals.iscom' => 2
        ]);

        $goals = Goal::select('goals.*', 'assets.assetname', 'assets.balance')
        ->join('assets', 'assets.assetno', '=', 'goals.assetno')
        ->where('goals.userid', $id)
        ->where('goals.iscom', 0)
        ->orderBy('goals.endday', 'asc')
        ->get();

        //달성
        $goalsCom = Goal::select('goals.*', 'assets.assetname', 'assets.balance')
        ->join('assets', 'assets.assetno', '=', 'goals.assetno')
        ->where('goals.userid', $id)
        ->where('goals.iscom', 1)
        ->orderBy('goals.endday', 'asc')
        ->get();

        if($goalsCom){
            DB::table('achieve_users')
            ->join('goals', 'goals.userid', '=', 'achieve_users.userid')
            ->where('goals.iscom', 1)
            ->update(['achieve_users.completed_at' => now()]);
        }

        //실패
        $goalsFail = Goal::select('goals.*', 'assets.assetname', 'assets.balance')
        ->join('assets', 'assets.assetno', '=', 'goals.assetno')
        ->where('goals.userid', $id)
        ->where('goals.iscom', 2)
        ->orderBy('goals.endday', 'asc')
        ->get();

        return view('goal')
        ->with('assets', $assets)
        ->with('goals', $goals)
        ->with('goalsCom', $goalsCom)
        ->with('goalsFail', $goalsFail);
    }

    public function post(Request $req)
    {
        $id = auth()->user()->userid;

        $req->validate([
            'title' => 'required',
            'amount' => 'required|integer|min:100000|max:10000000000',
            'asset' => 'required',
            'goal_days' => 'required|integer|min:1'
        ]);

        //|unique:goals,assetno

        $goal = new Goal;
        $goal->title = $req->title;
        $goal->amount = $req->amount;
        $goal->assetno = $req->asset;
        $goal->userid = $id;
        $goal->created_at = now();
        $goal->endday = now()->addDays($req->goal_days);
        $goal->save();

        return redirect()->route('goal.post');
    }

    public function put(Request $req)
    {
        // $id = auth()->user()->userid;

        $req->validate([
            'set_title' => 'required',
            'set_amount' => 'required|integer|min:100000|max:10000000000',
            'set_goal_days' => 'required|integer|min:1'
        ]);

        DB::table('goals')
        ->where('goalno', $req->set_goal_id)
        ->update([
                'title' => $req->set_title 
                , 'amount' => $req->set_amount
                , 'updated_at' => now()
                , 'endday' => now()->addDays($req->set_goal_days)
                ]);

        return redirect()->route('goal.put');
    }

    public function delete(Request $req)
    {
        // $date = Carbon::now();
        DB::table('goals')
        ->where('goalno' , $req->del_goal_id )
        ->update(['updated_at' => now(), 'deleted_at' => now()]);

        return redirect()->route('goal.delete');
    }


}
