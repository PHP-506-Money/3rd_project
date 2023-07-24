<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class SocialController extends Controller
{
     // 카카오 로그인
        public function redirectToKakao()
        {
            return Socialite::driver('kakao')->redirect();
        }
        // 카카오 콜백
        public function handleKakaoCallback()
        {
            $user = Socialite::driver('kakao')->user();

        
    
            $email = $user->getEmail();
            $userModel = User::where('useremail', $email)->first();
    
            // $kakaoId = $user->getId();
            $userid = 'wo13123';
            $username = "백백";
            $password = "password123!";
            $num = "01011112222";
            $mofintype = "1";

 
     //     $userModel = Users::where('user_email', $email)->first();
     //     // return var_dump($userModel);
 
     if (!$userModel) {
        //  사용자가 존재하지 않으면 새로운 사용자로 등록
         $userModel = new User();
         $userModel->userid = $userid;
         $userModel->useremail = $email;
         $userModel->username = $username;
         $userModel->userpw = Hash::make($password);
         $userModel->moffintype = $mofintype;
         $userModel->phone = $num;
         $userModel->save();
     }
 
     // 사용자를 로그인 처리
        Auth::login($userModel);
        
        if(Auth::check()){
            session(['userid' => $userid]);
            return redirect()->route('main');
        }
    
        //     // return view('kakaologin', compact('email'));
            return redirect()->route('main');
    }
}