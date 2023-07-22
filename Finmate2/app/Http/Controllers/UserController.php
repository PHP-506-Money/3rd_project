<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : UserController.php
 * History      : v001 0615 EY.Sin
 *                v002 0714 EY.Sin new
 *******************************************/

namespace App\Http\Controllers;

use App\Mail\Findpw;
use App\Mail\SendEmail;
use App\Models\Achievement;
use App\Models\AchieveUser;
use App\Models\EmailVerify;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function login() {
        return view('login');
    }

    function loginpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'id'    => 'regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만
            ,'password'  => 'regex:/^(?=.*[a-zA-Z])(?=.*[~!@#$%^&*+])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
        ]);

        // 유저정보 습득
        $user = User::where('userid', $req->id)->first();
        if(!$user || !(Hash::check($req->password, $user->userpw))) {
            $error = '<div class="error">! 아이디와 비밀번호를 다시 확인해주세요.</div>';
            return redirect()->back()->with('error', $error);
        }

        // 유저 인증작업
        Auth::login($user); // 테스트시 비활성화 하고 테스트하면 됨.
        if(Auth::check()) {
            session($user->only('id')); // 세션에 인증된 회원 pk 등록
            return redirect()->intended(url('/'));
        } else {
            $error = '인증작업 에러';
            return redirect()->back()->with('error', $error);
        }
    }

    function registration() {
        return view('registration');
    }

    function registrationpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'name'          => 'regex:/^[a-zA-Z가-힣]{2,20}$/u' // regex:정규식. 한글, 영어만 글자 수 2~20. /u는 이모지 걸러줌
            ,'id'           => 'unique:users,userid|regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만. DB users 테이블의 userid가 있는지 여부 체크
            ,'password'     => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~!@#$%^&*+])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
            ,'email'        => 'email:rfc,dns,filter|unique:users,useremail' // 이메일 유효성체크
            ,'phone'        => 'regex:/^01[016789]-[^0][0-9]{3,4}-[0-9]{4}$/' // 휴대폰번호 유효성체크
            ,'moffintype'   => 'required' // 모핀이 체크여부 확인
        ]);

        // $data['name'] = $req->input('name'); // 밑의 방법과 동일함.
        $data['username'] = $req->name;
        $data['userid'] = $req->id;
        $data['userpw'] = Hash::make($req->password);
        $data['useremail'] = $req->email;
        $data['phone'] = $req->phone;
        $data['moffintype'] = $req->moffintype;
        

        $user = User::create($data); // insert. create ORM 모델
        if(!$user) {
            $error = '<div class="error">! 시스템 에러가 발생하여, 회원가입에 실패했습니다.<br>잠시 후에 다시 회원가입을 시도해 주십시오.</div>';
        return redirect()
            ->route('users.registration')
            ->with('error', $error);
        }

        // v002 add start KIM 이메일인증 
        // $verifyCode = Str::random(5);
        $verifyCode = mt_rand(100000, 999999);
        $expire_at = now()->addMinute(5);

        $emailVerify['userid'] = $user->userid;
        $emailVerify['useremail'] = $user->useremail;
        $emailVerify['token'] = $verifyCode;
        $emailVerify['expire_at'] = $expire_at;

        $verify = EmailVerify::create($emailVerify);

        Mail::to($req->email)->send(new SendEmail($user,$verify));

        // 회원가입 완료 로그인 페이지로 이동
        // $success = '<div class="success">✓ Success!<br>회원가입을 완료 했습니다.<br>가입하신 아이디와 비밀번호로 로그인 해주십시오.</div>';
        $success = '<div class="success">✓ Success!<br>회원가입을 완료 했습니다.<br>이메일을 인증해주세요./div>';
        return redirect()
            // ->route('users.login')
            ->route('users.verify')
            ->with('success', $success)
            ->with('user',$user);

        // v002 end
    }

    function emailverify() {
        return view('emailverify');
    }

    function chkverify(Request $req) {
        $req->validate([
            'code'          => 'required'
        ]);

        $verify = EmailVerify::where('token',$req->code)->first();

        // var_dump($verify);

        if(!$verify) {
            $error = '<div class="error">! 인증코드가 일치하지 않습니다.</div>';
            return redirect()->back()->with('error', $error);
        }
        
        $now = now();
        $expire_at = $verify->expire_at;
        
        if($now > $expire_at) {
            $error = '<div class="error">! 인증 코드가 만료했습니다.</div>';
            // Mail::to($req->email)->send(new SendEmail($user,$verify));
            return redirect()->back()->with('error', $error)->with('');
        }

        $verify->email_verified = '1';
        $verify->save();

        $success = '<div class="success">✓ Success!<br>회원가입을 완료 했습니다.<br>가입하신 아이디와 비밀번호로 로그인 해주십시오.</div>';

        return redirect()
        ->route('users.login')
        ->with('success', $success);
    }

    // 로그아웃
    function logout() {
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('users.login');
    }
    
    function findid() {
        return view('findid');
    }
    
    function findidpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'name'          => 'regex:/^[a-zA-Z가-힣]{2,20}$/' // regex:정규식. 한글, 영어만 글자 수 2~20
            ,'email'        => 'email:rfc,dns,filter' // 이메일 유효성체크
        ]);

        // 폼 데이터에서 이름, 이메일 주소 추출
        $name = $req->input('name');
        $email = $req->input('email');
        
        // 데이터베이스에서 이메일에 해당하는 사용자 조회
        $user = User::where('username', $name)
        ->where('useremail', $email)
        ->first();
        
        // 일치하는 사용자가 없을 때 => foundid 뷰페이지에서 체크
        // if(!$user) {
            //     $error = '<div class="error">! 사용자 정보가 일치하지 않습니다.</div>';
            //     return redirect()->route('users.login')->with('error', $error);
            // }
        return view('foundid', ['user'=>$user]);
    }

    function findpw() {
        return view('findpw');
    }
    
    function findpwpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'id'           => 'regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만. 
            ,'email'        => 'email:rfc,dns,filter' // 이메일 유효성체크
        ]);

        // 폼 데이터에서 이름, 이메일 주소 추출
        $id = $req->input('id');
        $email = $req->input('email');
        
        // 데이터베이스에서 이메일에 해당하는 사용자 조회
        $user = DB::table('users')
        ->where('userid', $id)
        ->where('useremail', $email)
        ->first();
        
        // 일치하는 사용자가 없을 때
        if(!$user) {
            $error = '<div class="error">! 사용자 정보가 일치하지 않습니다.</div>';
            return redirect()->route('users.findpw')->with('error', $error);
        }
        
        // v002 add start kim email add
        $token = Str::random(20);
        $expire_at = now()->addMinute(5);
        
        $EmailVerify=new EmailVerify();
        $EmailVerify->userid=$req->id;
        $EmailVerify->userid=$req->email;
        $EmailVerify->token=$token;
        $EmailVerify->expire_at=$expire_at;
        $EmailVerify->save();
        
        Mail::to($req->email)->send(new Findpw($user,$EmailVerify));
        // v002 end
        
        $userid = $user->userid;
        Session::put(['userid' => $userid], true);
        // return redirect()->route('users.updatepw');
        
        // v002 update start
        return redirect()->back()->with('error',"이메일을 통해 비밀번호 변경을 완료해주세요.");
        // v002 end
    }

        // v002 add start
        function pwexpiration($data){
            $verify = EmailVerify::where('token',$data)->first();

            Log::debug('data',[$verify]);
            
        $now = now();
        $expire_at = $verify->expire_at;
        
        if($now > $expire_at) {
            return view('findpw')->with('error',"만료된 링크입니다. 다시 비밀번호 찾기를 시도해 주세요.");
        }
        
        return view('updatepw')->with('data',$verify);
    }
    
    // v002 add end 
    
    function updatepwpost(Request $req) {
        // Log::debug('유효성체크');
        // 유효성 체크
        $req->validate([
            'password' => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~!@#$%^&*+)(?=.*[0-9]).{8,12}$/'
        ]);
        
        $userid = Session::get('userid');;
        $user = User::where('userid', $userid)->first();
        
        // 사용자 인증 여부 확인
        if (!$user) {
            // 사용자가 인증되지 않은 경우, 로그인 페이지로 이동 또는 예외 처리
            $error = '<div class="error">! 가입되어 있지 않은 사용자입니다.</div>';
            return redirect()->route('users.login')->with('error', $error);
        }
        
        // 비밀번호 변경을 요청한 사용자와 현재 인증된 사용자가 일치하는지 확인
        // if ($user->userid != $req->id) {
            // 다른 사용자의 비밀번호 변경을 시도한 경우, 예외 처리 또는 적절한 경고 메시지 출력
            //     $error = '<div class="error">! 권한이 없습니다.</div>';
            //     return redirect()->route('users.login')->with('error', $error);
            // }
            
            $data = ['userpw' => Hash::make($req->password)];
        $user->update($data);
        
        // 비밀번호 변경 완료. 로그인 페이지로 이동
        $success = '<div class="success">✓ Success!<br>비밀번호 변경을 완료 했습니다.<br>변경한 비밀번호로 로그인 해주십시오.</div>';
        return redirect()
        ->route('users.login')
        ->with('success', $success);
    }
    
    function profile($id) {
        // $id = auth()->user()->userid; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $userid = auth()->user()->userid;
        $result = User::select(['username', 'moffintype', 'moffinname'])
        ->where('userid', $id)
        ->get();
        
        // v002 del start
        // $item_name = DB::table('iteminfos AS info')
        // ->select('info.itemname')
        // ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        // ->where('tem.userid', $id)
        // ->orderBy('info.itemno', 'ASC')
        // ->pluck('itemname')//아이템 이름반환(컬렉션 객체)
        // ->toArray();// 컬렉션 객체를 다시 배열로 바꿔줌
        
        // $itemonly = array_unique($item_name);// 유저가 가진 아이템이 중복값이 많아서 출력할때 중복값 제거하기위해서 unique써서 $itemonly에 담아줌
        // v002 del end        
        
        // v002 add start
        $items = DB::table('items')
        ->select('itemno', 'itemflg')
        ->where('userid', $id)
        ->orderBy('itemno', 'ASC')
        ->get() // 쿼리 결과를 가져옴
        ->toArray();// 컬렉션 객체를 다시 배열로 바꿔줌
        // v002 add end
        
        return view('profile')->with('data', $result)->with('items', $items)->with('id', $id)->with('userid', $userid);
    }
    
    // v002 add start
    function itemflg(Request $req)
    {
        $userid = auth()->user()->userid;
        
        // DB에서 총 아이템 컬럼 개수 카운트
        $itemCnt = DB::table('iteminfos')->count();
        
        // 1~itemCnt까지 itemflg를 업데이트
        for ($i = 1; $i <= $itemCnt; $i++) {
            DB::table('items')->where('userid', $userid)->where('itemno', $req->{"itemno$i"})->update(['itemflg' => $req->{"itemflg$i"}]);
        }
        
        return redirect()->route('users.profile', ['userid' => $userid]);
    }
    // v002 add end
    
    function mofinname() {
        $id = auth()->user()->userid; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $result = User::select(['username', 'moffintype', 'moffinname'])
        ->where('userid', $id)
        ->get();
        
        // v002 add start
        $items = DB::table('items')
        ->select('itemno', 'itemflg')
        ->where('userid', $id)
        ->orderBy('itemno', 'ASC')
        ->get() // 쿼리 결과를 가져옴
        ->toArray();// 컬렉션 객체를 다시 배열로 바꿔줌
        // v002 add end
        
        return view('mofinname')->with('data', $result)->with('items', $items);
    }

    function mofinnamepost(Request $req) {
        $id = auth()->user()->userid;
        
        // 유효성 검사 방법 1
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'moffinname'  => 'regex:/^[a-zA-Z가-힣]{1,20}$/' // regex:정규식. 한글, 영어만 글자 수 1~20
        ]);
        
        $result = User::where('userid', $id)->first();
        if (!$result) {
            // 사용자를 찾지 못한 경우에 대한 처리
            return redirect()->back()->withErrors(['message' => '사용자를 찾을 수 없습니다.']);
        }    
        
        $result->moffinname = $req->moffinname;
        $result->save();
        
        $success = '<div class="success">✓ Success!<br>모핀이명 변경을 완료 하였습니다.</div>';
        return redirect()
        ->route('users.profile', ['userid' => $id])
        ->with('success', $success);
    }
    
    function modify() {
        $id = auth()->user()->userid; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $result = User::select(['username', 'userid', 'userpw', 'useremail', 'phone'])
        ->where('userid', $id)
        ->get();
        return view('modify')->with('data', $result);
    }
    
    function modifypost(Request $req) {
        $id = auth()->user()->userid;
        
        // 유효성 검사 방법 1
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'name'          => 'regex:/^[a-zA-Z가-힣]{2,20}$/' // regex:정규식. 한글, 영어만 글자 수 2~20
            ,'id'           => 'regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만.
            ,'password'     => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~!@#$%^&*+])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
            ,'email'        => 'email:rfc,dns,filter' // 이메일 유효성체크
            ,'phone'        => 'regex:/^01[016789]-[^0][0-9]{3,4}-[0-9]{4}$/' // 휴대폰번호 유효성체크
        ]);
        
        $result = User::where('userid', $id)->first();
        if (!$result) {
            // 사용자를 찾지 못한 경우에 대한 처리
            return redirect()->back()->withErrors(['message' => '사용자를 찾을 수 없습니다.']);
        }    
        
        $data['userpw'] = Hash::make($req->password);
        $data['useremail'] = $req->email;
        $data['phone'] = $req->phone;
        
        $result->update($data);
        
        // 회원정보 변경 완료. 수정 페이지 리다이렉트
        $success = '<div class="success">✓ Success!<br>회원정보 변경을 완료 하였습니다.</div>';
        return redirect()
        ->route('users.modify')
        ->with('success', $success);
    }
    
    // 회원탈퇴 기능: softdeletes();를 사용하여 migration을 하였으므로, 로그인시 자동으로 탈퇴한 회원은 로그인 불가능하게 막아줌.
    function withdraw() {
        try {
            // $id = auth()->user()->userid;
            $user = Auth::user();
            $user->delete(); // 회원 탈퇴
            Session::flush();
            Auth::logout();
            
            return redirect()->route('users.login');
        } catch (ModelNotFoundException $e) {
            // 모델을 찾을 수 없는 경우 처리
            return back()->with('error', '회원을 찾을 수 없습니다.');
        } catch (QueryException $e) {
            // 쿼리 실행 중 오류가 발생한 경우 처리
            return back()->with('error', '회원탈퇴 중 오류가 발생했습니다.');
        }
    }
}

    