<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : StaticController.php
 * History      : v001 0616 Choi
 *                v002 0719 Kim up
 *******************************************/

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
        ->select('point','username','userid','moffintype')
        ->whereNull('deleted_at')
        ->orderBy('point', 'desc')
        ->limit(10)
        ->get();

        $loginrank = DB::table('users')
        ->select('login_count','username','userid','moffintype')
        ->whereNull('deleted_at')
        ->orderBy('login_count', 'desc')
        ->limit(10)
        ->get();

        $itemdrawrank = DB::table('users')
        ->select('item_draw_count','username','userid','moffintype')
        ->whereNull('deleted_at')
        ->orderBy('item_draw_count', 'desc')
        ->limit(10)
        ->get();

        
        // v002 add start kim  add

        $query = DB::table('users')
        ->join('items','items.userid','=','users.userid')
        ->select('users.userid as userid','items.itemno as itemno','items.itemflg as itemflg')
        ->whereNull('users.deleted_at');

        $pointranker = $query->orderBy('users.point','desc')->get();
        $loginranker = $query->orderBy('users.login_count','desc')->get();
        $drawranker = $query->orderBy('users.item_draw_count','desc')->get();

        return view('rank')
        ->with('pointrank', $pointrank)->with('loginrank', $loginrank)->with('itemdrawrank', $itemdrawrank)
        ->with('pointranker', $pointranker)->with('loginranker', $loginranker)->with('drawranker', $drawranker);
        // v002 add end

    }

    

    // public function search(Request $req){

    //     $usersearch = DB::table('users') 
    // }
}
