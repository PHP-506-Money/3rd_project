<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : TransactionController.php
 * History      : v001 0620 Noh new
 *******************************************/
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index($userid)
    {
        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $userid) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }

        User::where('userid', $userid)
        ->increment('history_check_count', 1);

        $category =  DB::table('categories')->select('*')->orderBy('no','asc')->get()->toArray();

        $transactions = Transaction::join('assets', 'transactions.assetno', '=', 'assets.assetno')
            ->join('categories', 'transactions.char', '=', 'categories.no')
            ->select('transactions.*' , 'assets.assetname', 'categories.name')
            ->where('assets.userid', $userid)
            ->orderBy('trantime', 'desc') // 거래일시를 기준으로 내림차순 정렬
            ->get();

        // 월별 총 수입 및 지출 계산
        $monthly_income = [];
        $monthly_expense = [];

        foreach ($transactions as $transaction) {
            $date = date('Y-m', strtotime($transaction->trantime));
            if ($transaction->type == 0) {
                $monthly_income[$date] = ($monthly_income[$date] ?? 0) + $transaction->amount;
            } else {
                $monthly_expense[$date] = ($monthly_expense[$date] ?? 0) + $transaction->amount;
            }
        }

        return view('transactions', [
            'transactions' => $transactions,
            'monthly_income' => $monthly_income,
            'monthly_expense' => $monthly_expense,
            'category' => $category
        ]);
    }
    public function search(Request $req, $userid)
    {   
        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $userid) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }

        User::where('userid', $userid)
        ->increment('history_check_count', 1);

        $category =  DB::table('categories')->select('*')->orderBy('no','asc')->get()->toArray();

        $transactions = Transaction::join('assets', 'transactions.assetno', '=', 'assets.assetno')
            ->join('categories', 'transactions.char', '=', 'categories.no')
            ->select('transactions.*' , 'assets.assetname', 'categories.name')
            ->where('assets.userid', $userid)
            ->orderBy('trantime', 'desc') // 거래일시를 기준으로 내림차순 정렬
            ->get();

        // 월별 총 수입 및 지출 계산
        $monthly_income = [];
        $monthly_expense = [];

        foreach ($transactions as $transaction) {
            $date = date('Y-m', strtotime($transaction->trantime));
            if ($transaction->type == 0) {
                $monthly_income[$date] = ($monthly_income[$date] ?? 0) + $transaction->amount;
            } else {
                $monthly_expense[$date] = ($monthly_expense[$date] ?? 0) + $transaction->amount;
            }
        }

        $data = DB::table('transactions')
        ->join('assets', 'transactions.assetno', '=', 'assets.assetno')
        ->join('categories', 'transactions.char', '=', 'categories.no')
        ->select('transactions.*', 'assets.assetname', 'categories.name')
        ->where('assets.userid', $userid)
        ->when($req->input('search_asset') != 99, function ($query) use ($req) {
            $query->where('assetname', $req->input('search_asset'));
        })
        ->when($req->input('search_tran') != 99, function ($query) use ($req) {
            $query->where('transactions.TYPE', $req->input('search_tran'));
        })
        ->whereBetween('transactions.trantime', [$req->input('startdate'), $req->input('enddate')])
        ->when($req->input('search_category') != 99, 
        function ($query) use ($req) 
        {
            $query->where('categories.no', $req->input('search_category'));
        })
        ->orderBy('transactions.trantime', 'desc')
        ->get();

        return view('transactions', [
            'transactions' => $transactions,
            'monthly_income' => $monthly_income,
            'monthly_expense' => $monthly_expense,
            'category' => $category
        ])->with('data', $data);
    }
}


