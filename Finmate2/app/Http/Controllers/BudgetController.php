<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : BudgetController.php
 * History      : v001 0615 Kim new
 *              : v002 0710 Noh update
 *******************************************/
namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BudgetController extends Controller
{
    function budget($userid) {

        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $userid) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }
        
        // db table budgets에서 userid의 해당하는 첫번째레코드에서 지정 예산금액을 가져온다.
        $monthBudget = DB::table('budgets')->where('userid', $userid)->value('budgetprice');
        
        // 예산이 비어있어있는지 확인하고 에러메시지와 함께 설정페이지로 간다.(예산이 없을때 empty로 반환)
        if(empty($monthBudget)) {
            return redirect('/budgetset')->with('error', "예산을 설정해주세요!");
        }

        // 날짜계산
        $today = Carbon::now();

        // 현재년도와 현재 달을 구한다.
        $currentYear = date('Y');
        $currentMonth = date('m');

        // 이번주 시작과 끝
        $startDate = $today->copy()->startOfWeek();
        $endDate = $today->copy()->endOfWeek();


        // 이번 달의 총 일수
        $daysInMonth = $today->daysInMonth;

        // 이번 주의 일수
        $daysInWeek = $startDate->diffInDays($endDate) + 1;

        $query = DB::table('assets')
        ->join('transactions','assets.assetno','=','transactions.assetno')
        ->where('assets.userid',$userid)
        ->where('transactions.type','1');
        
        // 한달동안 지출한 금액의 합계
        $sumAmount = $query->whereMonth('transactions.trantime',$currentMonth)
        ->whereYear('transactions.trantime',$currentYear)
        ->sum('transactions.amount');

        // 이번주 동안 지출한 금액의 합계
        $sumWeekAmount =$query->whereBetween('transactions.trantime',[$startDate, $endDate])
        ->sum('transactions.amount');
        

        // 지출하지 않은 월별 예산과 일일 예산 계산
        $leftMonthlyBudget = $monthBudget - $sumAmount;
        $weekBudget = $leftMonthlyBudget / $daysInMonth * $daysInWeek;
        $remainingDaysInWeek = $today->diffInDays($endDate) + 1;
        $leftBudget = $weekBudget - $sumWeekAmount;
        $dailyBudget = $leftBudget / $remainingDaysInWeek;

        $arrResult = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentMonth' => $currentMonth,
            'weekBudget' => $weekBudget,
            'leftBudget' => $leftBudget,
            'dailyBudget' => $dailyBudget
        ];

        return view('budget')
        ->with('all',$monthBudget)
        ->with('sumamount',$sumAmount)
        ->with('sumweek',$sumWeekAmount)
        ->with('data',$arrResult);
    }

    // 예산 설정 페이지로
    function budgetset() {
        $user = auth()->user()->userid;
        
        // Budget 모델의 find() 메서드를 사용하여 budgets 테이블에서 예산 레코드를 가져온다 해당하는 아이디의 예산 레코드가 없을 시 null을 반환한다.
        $existingBudget = Budget::find($user);

        return view('budgetsetting', compact('existingBudget'));
    }

    function setting(Request $req) {
        $user = auth()->user()->userid;

        $req->validate([
            'budgetprice' => 'required|integer|between:100000,100000000'
        ]);

        // 현재 date를 가져온다.
        $date = Carbon::now();

        DB::insert('insert into budgets (userid,budgetprice,created_at,updated_at) values (?,?,?,?)', [$user,$req->budgetprice, $date, $date]);

        return redirect('/budget/'.$user);
    }

    function edit(Request $req) {
        $user = auth()->user()->userid;

        $req->validate([
            'budgetprice' => 'required|integer|between:100000,100000000'
        ]);

        $date = Carbon::now();

        $budget = budget::find($user);
        $budget->budgetprice = $req->budgetprice;
        $budget->created_at = $date;
        $budget->updated_at = $date;
        $budget->save();

        return redirect('/budget/'.$user);
    } 
}