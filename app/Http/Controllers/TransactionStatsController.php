<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Actions\TransactionStats;

class TransactionStatsController extends Controller
{
    private $searchFields = ['customer_id1', 'customer_id2', 'initial_date', 'final_date'];

    public function index(Request $request)
    {
        if ($request->anyFilled('initial_date', 'final_date')) {
            $stats = TransactionStats::handle($request);
            return view('stats/index')->with(['stats' => $stats]);
        } elseif ($request->hasAny($this->searchFields)) {
            return view('stats/index')->withErrors(['search_params' => 'The search params are empty.']);
        }
        
        return view('stats/index');
    }
}
