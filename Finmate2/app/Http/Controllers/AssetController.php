<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : AssetController.php
 * History      : v001 0616 Noh new
 *******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AssetController extends Controller
{
    public function index($userid)
    {
        $assets = Asset::where('userid', $userid)->get();

        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $userid) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }

        return view('assets', ['assets'=>$assets]);
    }

    public function link()
    {
        return view('link');
    }

    public function store(Request $req)
    {
        $user = auth()->user();
        $checkCount = Asset::select('*')->where('userid', $user->userid)->count();
        if($checkCount > 0){
            return response()->json(['success' => false, 'successError' , 'error' => '이미 연동된 유저입니다.']);
        }
        if($user->userid == $req->input('id') && Hash::check($req->input('password'), $user->userpw ) && $user->username == $req->input('name') && $user->phone == $req->input('phone')){
        //더미 데이터 추가 
        $assetCount = Asset::count();
        $assetNames = ['토스뱅크', '신한은행', '현대카드', '대구은행', '카카오뱅크', '국민은행', '하나은행', '우리은행', '농협은행', '새마을금고', '기업은행'];
        // $randAsset = shuffle($assetNames);
        // for ($i=1; $i < 10 ; $i++) { 
        //     $pickAsset = array_shift($randAsset[$i]);
        // }
        $balanceMin = 100000;
        $balanceMax = 90000000;

            for ($i = $assetCount+1; $i <= $assetCount+10; $i++) {
                $asset = new Asset();
                $asset->assetno = $i;
                $asset->userid = $user->userid;
                $asset->assetname = array_shift($assetNames);
                $asset->balance = mt_rand($balanceMin, $balanceMax);
                $asset->save();
            }

            $assetNos = range($assetCount, $assetCount+9);
            $types = ['0', '1'];
            $payeeChars = ['0', '1', '2', '3', '4', '5', '6', '7', '8'];
            $amountMin = 1000;
            $amountMax = 900000;
            $catZeroName = ['배민', '요기요', '삼계탕', '피자', '햄버거'];
            $catOneName = ['이마트 트레이더스',  '편의점', '이마트', '홈플러스', '대백'];
            $catTwoName = ['PC방', '삼순이포차', '소주한잔'];
            $catThreeName = ['스파오', '탑텐', '에이블리','쿠팡', '신세계 백화점', '현대백화점'];
            $catFourName = ['물세', '월세', '전기비'];
            $catFiveName = ['곽병원', '한의원', '24시 헬스장'];
            $catSixName = ['지하철', '버스', '택시'];
            $catSevenName = ['휴대폰 소액 결제'];
            $catEightName = ['적금', '저금통 저축'];
            $catNineName = ['계좌입금', '용돈', '밥은 사먹으렴 ~아빠가', '보너스'];

            for ($i = 1; $i <= 364;
                $i++
            ) {
                $transaction = new Transaction();
                $transaction->assetno = $assetNos[array_rand($assetNos)];
                $transaction->type = $types[array_rand($types)];
                $randSec = rand(0, 8400);
                // $transaction->trantime = Carbon::now()->subYear()->addDays(rand(0, 365));
                $transaction->trantime = Carbon::now()->subDays(365 - $i)->addSeconds($randSec);
                $categories = $payeeChars[array_rand($payeeChars)];
                $transaction->amount = mt_rand($amountMin, $amountMax);
                
                if($transaction->type == '0'){
                    $transaction->char = '9';
                    $transaction->payee = $catNineName[array_rand($catNineName)];
                    $transaction->balance = $asset->balance + $transaction->amount;
                }else {
                    $transaction->char = $categories;
                    if ($categories == '0') {
                        $transaction->payee = $catZeroName[array_rand($catZeroName)];
                    } else if ($categories == '1') {
                        $transaction->payee = $catOneName[array_rand($catOneName)];
                    } else if ($categories == '2') {
                        $transaction->payee = $catTwoName[array_rand($catTwoName)];
                    } else if ($categories == '3') {
                        $transaction->payee = $catThreeName[array_rand($catThreeName)];
                    } else if ($categories == '4') {
                        $transaction->payee = $catFourName[array_rand($catFourName)];
                    } else if ($categories == '5') {
                        $transaction->payee = $catFiveName[array_rand($catFiveName)];
                    } else if ($categories == '6') {
                        $transaction->payee = $catSixName[array_rand($catSixName)];
                    } else if ($categories == '7') {
                        $transaction->payee = $catSevenName[array_rand($catSevenName)];
                    } else if ($categories == '8') {
                        $transaction->payee = $catEightName[array_rand($catEightName)];
                    }
                    $transaction->balance = $asset->balance - $transaction->amount;
                }
                $asset->where('assetno', $transaction->assetno)->update(['balance' => $transaction->balance]);
                $asset->save();
                $transaction->save();
            }
            return response()->json(['success' => true, 'success' => '연동에 성공했습니다.']);
            
        } else {
            if($user->userid !== $req->input('id')){
                return response()->json(['success' => false, 'error' => '아이디가 등록된 유저 아이디와 일치하지 않습니다.']);
            }else if(!Hash::check($req->input('password'), $user->userpw)){
                return response()->json(['success' => false, 'error' => '비밀번호가 등록된 유저 비밀번호와 일치하지 않습니다.']);
            }else if ($user->username !== $req->input('name')) {
                return response()->json(['success' => false, 'error' => '이름이 등록된 유저 이름과 일치하지 않습니다.']);
            }else if ($user->phone !== $req->input('phone')) {
                return response()->json(['success' => false, 'error' => '전화번호가 등록된 전화번호와 일치하지 않습니다.']);
            }else{
                return response()->json(['success' => false, 'error' => '연동에 실패했습니다. 사용자 정보를 다시 확인해 주세요.']);
            }
            
        }
    }
}
