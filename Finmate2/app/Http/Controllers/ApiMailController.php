<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ApiMailController extends Controller
{
    public function emailChk($email) {
        if (!$email || trim($email) === '') {
            $arr['errorcode'] = "E02";
            $arr['msg'] = "! 유효하지 않은 이메일입니다.";
            return response()->json($arr, Response::HTTP_BAD_REQUEST);
        }

        $user=DB::table('users')->where('useremail',$email)->first();
        // user가 없을 경우 성공
        $arr['errorcode']="0";
        $arr['msg']="✓ 사용가능한 이메일 입니다.";
        // 유저가 있을 경우
        if($user){
            $arr['errorcode']="E01";
            $arr['msg'] = "! 이미 가입된 이메일 입니다.";
        }
        return response()->json($arr, Response::HTTP_OK);
    }
}
