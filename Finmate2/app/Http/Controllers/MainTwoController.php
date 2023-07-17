<?php

/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : MainTwoController.php
 * History      : v002 0710 Noh new
 *******************************************/

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MainTwoController extends Controller
{

    function main2()
    {

        $userid = Auth::user()->userid;

        // db table budgets에서 userid의 해당하는 첫번째레코드에서 지정 예산금액을 가져온다.
        $monthBudget = DB::table('budgets')->where('userid', $userid)->value('budgetprice');

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
            ->join('transactions', 'assets.assetno', '=', 'transactions.assetno')
            ->where('assets.userid', $userid)
            ->where('transactions.type', '1');

        // 한달동안 지출한 금액의 합계
        $sumAmount = $query->whereMonth('transactions.trantime', $currentMonth)
            ->whereYear('transactions.trantime', $currentYear)
            ->sum('transactions.amount');

        // 이번주 동안 지출한 금액의 합계
        $sumWeekAmount = $query->whereBetween('transactions.trantime', [$startDate, $endDate])
            ->sum('transactions.amount');

        $sumDayAmount = $query->where('transactions.trantime', $today)
            ->sum('transactions.amount');


        // 지출하지 않은 월별 예산과 일일 예산 계산
        $leftMonthlyBudget = $monthBudget - $sumAmount;
        $weekBudget = $leftMonthlyBudget / $daysInMonth * $daysInWeek;
        $remainingDaysInWeek = $today->diffInDays($endDate) + 1;
        $leftBudget = $weekBudget - $sumWeekAmount;
        $dailyBudget = $leftBudget / $remainingDaysInWeek;
        $pointrank = DB::table('users')
            ->select('point', 'username', 'userid')
            ->whereNull('deleted_at')
            ->orderBy('point', 'desc')
            ->limit(1)
            ->get();

        $loginrank = DB::table('users')
            ->select('login_count', 'username', 'userid')
            ->whereNull('deleted_at')
            ->orderBy('login_count', 'desc')
            ->limit(1)
            ->get();

        $itemdrawrank = DB::table('users')
            ->select('item_draw_count', 'username', 'userid')
            ->whereNull('deleted_at')
            ->orderBy('item_draw_count', 'desc')
            ->limit(1)
            ->get();

        $goals = Goal::select('goals.*', 'assets.assetname', 'assets.balance')
        ->join('assets', 'assets.assetno', '=', 'goals.assetno')
        ->where('goals.userid', $userid)
        ->where('goals.iscom', 0)
        ->orderBy('goals.endday', 'asc')
        ->limit(1)
            ->get();

        //예산이 없는 경우
        if (empty($monthBudget)) {
            $arrResult = [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'currentMonth' => $currentMonth,
                'weekBudget' => 0,
                'leftBudget' => 0,
                'dailyBudget' => 0,
                'sumDayAmount' => 0
            ];

            $monthBudget = 0;
            $sumAmount = 0;
            $sumWeekAmount = 0;
        }else{
            $arrResult = [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'currentMonth' => $currentMonth,
                'weekBudget' => $weekBudget,
                'leftBudget' => $leftBudget,
                'dailyBudget' => $dailyBudget,
                'sumDayAmount' => $sumDayAmount
            ];
        }

        return view('main2')
            ->with('all', $monthBudget)
            ->with('sumamount', $sumAmount)
            ->with('sumweek', $sumWeekAmount)
            ->with('data', $arrResult)
            ->with('pointrank', $pointrank)
            ->with('loginrank', $loginrank)
            ->with('itemdrawrank', $itemdrawrank)
            ->with('goals', $goals);
            
    }






}
