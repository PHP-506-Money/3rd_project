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
use Illuminate\Support\Facades\DB;

class NewGoalController extends Controller
{
    public function index()
    {   
        $id = auth()->user()->userid;
        $assets = Asset::where('userid', $id)->get();
        $goals = Goal::where('userid', $id)->orderby('endday','asc')->get();
        
        if($goals){
            return view('goal')->with('assets', $assets)->with('goals', $goals);    
        }
        
        return view('goal')->with('assets', $assets);
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

        $goal = new Goal;
        $goal->title = $req->title;
        $goal->amount = $req->amount;
        $goal->assetno = $req->asset;
        $goal->userid = $id;
        $goal->created_at = now();
        $goal->endday = now()->addDays($req->goal_days);
        $goal->save();

        return redirect('/goal')->with('success', 'Goal has been created successfully.');

    }


}
