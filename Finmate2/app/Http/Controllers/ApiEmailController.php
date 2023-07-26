<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\EmailVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ApiEmailController extends Controller
{
    function verifyemail($email) {
        $user = DB::table('users')->where('useremail',$email)->first();

        if(!$user) {
            $arr['errorcode']="0";
            $arr['msg']="인증번호가 발송되었습니다.";
            $this->sentemail($email);
        }
        else {
            $arr['errorcode']="E01";
            $arr['msg'] = "이미 사용중인 이메일 입니다.";
        }
        return response()->json($arr,Response::HTTP_OK);
    }
    
    function sentemail($email){
        
        $verifyCode = mt_rand(100000, 999999);
        $expire_at = now()->addMinute(3);

        $emailVerify['useremail'] = $email;
        $emailVerify['token'] = $verifyCode;
        $emailVerify['expire_at'] = $expire_at;

        $resentemail = EmailVerify::create($emailVerify);

        Mail::to($email)->send(new SendEmail($resentemail));
    }

    function codechk(Request $req) {
        $now = Carbon::now();

        $chk = DB::table('emailverifies')
        ->where('useremail',$req->email)
        ->where('token',$req->codechk)
        ->where('expire_at','>',$now)
        ->first();
        
        if($chk) {
            $arr['errorcode']="0";
            $arr['msg']=" 인증번호 맞음";
            
            $user=User::where('useremail',$req->email);

            $user->email_verified = '1';

        }
        else {
            $arr['errorcode']="E01";
            $arr['msg'] = "인증번호를 다시한번 확인해 주세요.";
        }
        return response()->json($arr,Response::HTTP_OK);
    }
}
