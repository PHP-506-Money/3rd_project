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

        $pointranker = DB::select( " 
        SELECT us.userid as userid , it.itemno as itemno , it.itemflg as itemflg
        FROM users us INNER JOIN items it ON us.userid = it.userid
        WHERE us.deleted_at IS NULL 
        AND us.userid IN (
            SELECT userid
            FROM (
                SELECT userid, RANK() OVER (ORDER BY point DESC) AS point_RANK
                FROM users
            ) ranked_users
            WHERE point_RANK <= 3
        )
        ORDER by us.point desc " );

        $loginranker = DB::select(" 
        SELECT us.userid as userid , it.itemno as itemno , it.itemflg as itemflg
        FROM users us INNER JOIN items it ON us.userid = it.userid
        WHERE us.deleted_at IS NULL 
        AND us.userid IN (
            SELECT userid
            FROM (
                SELECT userid, RANK() OVER (ORDER BY login_count DESC) AS point_RANK
                FROM users
            ) ranked_users
            WHERE point_RANK <= 3
        )
        ORDER by us.login_count desc
        ");

        $drawranker = DB::select(" 
        SELECT us.userid as userid , it.itemno as itemno , it.itemflg as itemflg
        FROM users us INNER JOIN items it ON us.userid = it.userid
        WHERE us.deleted_at IS NULL 
        AND us.userid IN (
            SELECT userid
            FROM (
                SELECT userid, RANK() OVER (ORDER BY item_draw_count DESC) AS point_RANK
                FROM users
            ) ranked_users
            WHERE point_RANK <= 3
        )
        ORDER by us.item_draw_count desc
        ");
        
        return view('rank')
        ->with('pointrank', $pointrank)->with('loginrank', $loginrank)->with('itemdrawrank', $itemdrawrank)
        ->with('pointranker', $pointranker)->with('loginranker', $loginranker)->with('drawranker', $drawranker);
        // v002 add end

    }

    

    // public function search(Request $req){

    //     $usersearch = DB::table('users') 
    // }
}
