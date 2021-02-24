<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Actions\TransactionStats;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class TransactionStatsController extends Controller
{
    private $searchFields = ['account', 'initial_date', 'final_date'];

    public function index(Request $request)
    {
        if (Auth::user()->isSuperAdmin()) {
            $accounts = Account::query()->select(['id', 'account'])->get();
        } else {
            $accounts = Account::query()->whereIn('id', Auth::user()->accounts->pluck('account_id'))->select(['id', 'account'])->get();
        }
        
        if ($request->filled('account')) {
            $stats = TransactionStats::handle($request);
            $stats["account"] = $accounts->firstWhere('id', $request->input('account'))->account;

            return view('stats/index')->with(['stats' => $stats, 'accounts' => $accounts]);
        } elseif ($request->hasAny($this->searchFields)) {
            return view('stats/index')->with(['accounts' => $accounts])->withErrors(['search_params' => 'O campo cliente deve ser preenchido.']);
        }

        return view('stats/index')->with(['accounts' => $accounts]);
    }
}
