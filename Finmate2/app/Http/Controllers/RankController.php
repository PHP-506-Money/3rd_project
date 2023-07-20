<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class RankController extends Controller
{
    public function index($id)
    {
        
        $pointrank = DB::table('users')
        ->select('point','username','userid')
        ->whereNull('deleted_at')
        ->orderBy('point', 'desc')
        ->limit(10)
        ->get();

        $loginrank = DB::table('users')
        ->select('login_count','username','userid')
        ->whereNull('deleted_at')
        ->orderBy('login_count', 'desc')
        ->limit(10)
        ->get();

        $itemdrawrank = DB::table('users')
        ->select('item_draw_count','username','userid')
        ->whereNull('deleted_at')
        ->orderBy('item_draw_count', 'desc')
        ->limit(10)
        ->get();

        $id = auth()->user()->userid;
        $result = User::select(['username', 'moffintype', 'moffinname'])
        ->where('userid', $id)
        ->get();

        $items = DB::table('items')
        ->select('itemno', 'itemflg')
        ->where('userid', $id)
        ->orderBy('itemno', 'ASC')
        ->get() // 쿼리 결과를 가져옴
        ->toArray();

        // dump($usermoffin);

        return view('rank')->with('data', $result)->with('items', $items)->with('pointrank', $pointrank)->with('loginrank', $loginrank)->with('itemdrawrank', $itemdrawrank);

    }

    

    // public function search(Request $req){

    //     $usersearch = DB::table('users') 
    // }
}
