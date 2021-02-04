<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionStatsController extends Controller
{
    private $searchFields = ['customer_id1', 'customer_id2', 'initial_date', 'final_date'];

    public function index(Request $request)
    {
        if ($request->anyFilled('initial_date', 'final_date')) {
            $stats =[];
            $inteval = [$request->input('initial_date'), $request->input('final_date')];
            $customers = [$request->input('customer_id1'), $request->input('customer_id2')];

            $stats["vodacom"] =[
                "pin" => Transaction::query()->pinVoucherStats("vodacom", $inteval, $customers)->sum('amount'),
                "pinless" => Transaction::query()->pinlessVoucherStats("vodacom", $inteval, $customers)->sum('amount')
            ];

            $stats["tmcel"] =[
                "pin" => Transaction::query()->pinVoucherStats("tmcel", $inteval, $customers)->sum('amount'),
                "pinless" => Transaction::query()->pinlessVoucherStats("tmcel", $inteval, $customers)->sum('amount')
            ];

            $stats["movitel"] =[
                "pin" => Transaction::query()->pinVoucherStats("movitel", $inteval, $customers)->sum('amount'),
                "pinless" => Transaction::query()->pinlessVoucherStats("movitel", $inteval, $customers)->sum('amount')
            ];

            $stats["credelec"] = Transaction::query()->credelecStats($inteval, $customers)->sum('amount');

            return view('stats/index')->with(['stats' => $stats]);
        } elseif ($request->hasAny($this->searchFields)) {
            return view('stats/index')->withErrors(['search_params' => 'The search params are empty.']);
        }
        return view('stats/index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
