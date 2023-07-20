<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : MofinController.php
 * History      : v001 0615 Choi
 *                v002 0714 Sin new
 *******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class MofinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $id) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }
        //유저의 포인트를 조회
        $result  = DB::table('users')
        ->where('userid', $id)
        ->first();

        //유저가 가진 아이템을 조회
        // $item_name = DB::table('iteminfos AS info')
        // ->select('info.itemname')
        // ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        // ->where('tem.userid', $id)
        // ->orderBy('info.itemno', 'ASC')
        // ->pluck('itemname')//아이템 이름반환(컬렉션 객체)
        // ->toArray();// 컬렉션 객체를 다시 배열로 바꿔줌

        $itemname = DB::table('iteminfos')
            ->join('items', 'iteminfos.itemno', '=', 'items.itemno')
            ->where('items.userid', $id)
            ->get();

        // $itemonly = array_unique($item_name);// 유저가 가진 아이템이 중복값이 많아서 출력할때 중복값 제거하기위해서 unique써서 $itemonly에 담아줌
        return view('mofin')->with('data',$result)->with('itemname', $itemname);

    }

    public function point($id)
    {
        // 유저의 포인트 조회
        $result  = DB::table('users')
        ->where('userid', $id)
        ->first();

        $itemname = DB::table('iteminfos')
        ->join('items', 'iteminfos.itemno', '=', 'items.itemno')
        ->where('items.userid', $id)
        ->get();


        //포인트가 100미만일경우
        if($result->point < 100 ){

            $pt1 = '포인트가부족합니다!';
            // session()->flash('pt1', $pt1);

            // $item_name = DB::table('iteminfos AS info')
            // ->select('info.itemname')
            // ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            // ->where('tem.userid', $id)
            // ->orderBy('info.itemno', 'ASC')
            // ->pluck('itemname')
            // ->toArray();
            
            // $itemonly = array_unique($item_name);
            return view('mofin')->with('data', $result)->with('itemname', $itemname)->with('pt1', $pt1);
        }
        //포인트가 100 이상일경우
        else{
        // 1~199 사이의 랜덤숫자를 $randompoint 에 담아줌
        $randompoint = rand(1, 199);
        // 회원의 포인트에서 100을 뺀 후 $randompoint 를 더해서 $newpoint에 담아줌
        $newPoint = $result->point - 100 + $randompoint;
        
        //$newpoint 를 회원의 point 에 대입
        DB::table('users')
            ->where('userid', $id)
            ->update(['point' =>$newPoint, 'point_draw_count' => $result->point_draw_count + 1]);

            $pt1 = $randompoint . "포인트가 당첨되셨습니다";
        
        // 일회성으로 세션에 $randompoint 를 담아줌
        // session()->flash('pt1', $randompoint);

            // $item_name = DB::table('iteminfos AS info')
            // ->select('info.itemname')
            // ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            // ->where('tem.userid', $id)
            // ->orderBy('info.itemno', 'ASC')
            // ->pluck('itemname')
            // ->toArray();
        
            // $itemonly = array_unique($item_name);
            // return view('mofin')->with('data', $result)->with('itemname', $itemname);
        }

        return view('mofin')->with('data', $result)->with('itemname', $itemname)->with('pt1', $pt1);

    }

    public function item($id)
    {
        $result  = DB::table('users')
        ->where('userid', $id)
        ->first();

        $itemname = DB::table('iteminfos')
            ->join('items', 'iteminfos.itemno', '=', 'items.itemno')
            ->where('items.userid', $id)
            ->get();

        //포인트가 500 이상일때
        if($result->point >= 500)
        {
        $newPoint = $result->point -= 500;
        //회원포인트에서 500을빼서 newpoint 에 담고 회원포인트에 대입해줌
        DB::table('users')
        ->where('userid', $id)
        ->update(['point' =>$newPoint, 'item_draw_count' => $result->item_draw_count + 1]);

        $randomitem = rand(1,13); // 랜덤으로 아이템번호 1~12

        $data['userno'] = $result->userno;
        $data['userid'] = $id;
        $data['itemno'] = $randomitem;

        // v002 del
        // DB::table('items')->insert($data); // 당첨된 아이템번호로 items 테이블에 추가

        // v002 add start
        // 아이템번호와 일치하는 아이템이 이미 있는지 확인
        $existingItem = DB::table('items')
        ->where('userid', $id)
        ->where('itemno', $randomitem)
        ->first();
        
        if ($existingItem) {
            // 이미 해당 아이템이 있으면 itemcount를 증가시킴
            DB::table('items')
                ->where('userno', $existingItem->userno)
                ->where('itemno', $randomitem)
                ->increment('itemcount');
        } else {
            // 해당 아이템이 없으면 아이템을 추가
            DB::table('items')->insert($data);
        }
        // v002 add end

        $pt1 =  DB::table('iteminfos')->where('itemno', $randomitem)->value('itemname');//당첨된 아이템 번호를 기준으로 iteminfos 테이블에서 아이템명 가지고오기
        $pt1 = '축하합니다. '.$pt1.' 아이템 당첨';

        // session()->flash('pt1', $pt1); // $pt 를 세션에 일회성으로 담아줌

            // $item_name = DB::table('iteminfos AS info')
            // ->select('info.itemname')
            // ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            // ->where('tem.userid', $id)
            // ->orderBy('info.itemno', 'ASC')
            // ->pluck('itemname')
            // ->toArray();

            // $itemonly = array_unique($item_name);

            

        // return view('mofin')->with('data', $result)->with('itemname', $itemname);

        }
        //포인트가 500 미만일경우
        else
        {
            $pt1 = '포인트가부족합니다!';
            session()->flash('pt1', $pt1);

            // $item_name = DB::table('iteminfos AS info')
            // ->select('info.itemname')
            // ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            // ->where('tem.userid', $id)
            // ->orderBy('info.itemno', 'ASC')
            // ->pluck('itemname')
            // ->toArray();
            
            // $itemonly = array_unique($item_name);       
            // return view('mofin')->with('data', $result)->with('itemname', $itemname);
        }
        return view('mofin')->with('data', $result)->with('itemname', $itemname)->with('pt1', $pt1);
    }
    
    public function search(Request $req, $id){
        $result = DB::table('users')->select('userid')->where('userid',$req->search_name)->first();

        if(empty($result)){
            $errmsg = "존재하지 않는 아이디입니다";
            session()->flash('errmsg', $errmsg);
            // return redirect('rank',['userid' => $id])->with('errmsg',$errmsg);
            return redirect()->route('rank.index', ['userid' => $id]);
        }
        else{
            return redirect('users/profile/'.$req->search_name);
        }

    }
}
