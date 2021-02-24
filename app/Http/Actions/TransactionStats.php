<?php

namespace App\Http\Actions;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionStats
{
    public static function handle(Request $request)
    {
        $stats =[];

        $inteval = [$request->input('initial_date'), $request->input('final_date')];
        $customers = intval($request->input('account'));

        $pin = Transaction::query()->pinVoucherStats("vodacom", $inteval, $customers);
        $pinless = Transaction::query()->pinlessVoucherStats("vodacom", $inteval, $customers);

        $stats["vodacom"] =[
            "pin" => ["qtty"=> $pin->count(), "amount"=> $pin->sum('amount')],
            "pinless" => ["qtty"=> $pinless->count(), "amount"=> $pinless->sum('amount')]
        ];

        $pin = Transaction::query()->pinVoucherStats("tmcel", $inteval, $customers);
        $pinless = Transaction::query()->pinlessVoucherStats("tmcel", $inteval, $customers);

        $stats["tmcel"] =[
            "pin" => ["qtty"=> $pin->count(), "amount"=> $pin->sum('amount')],
            "pinless" => ["qtty"=> $pinless->count(), "amount"=> $pinless->sum('amount')]
        ];

        $pin = Transaction::query()->pinVoucherStats("movitel", $inteval, $customers);
        $pinless = Transaction::query()->pinlessVoucherStats("movitel", $inteval, $customers);
        
        $stats["movitel"] =[
            "pin" => ["qtty"=> $pin->count(), "amount"=> $pin->sum('amount')],
            "pinless" => ["qtty"=> $pinless->count(), "amount"=> $pinless->sum('amount')]
        ];

        $credelec = Transaction::query()->credelecStats($inteval, $customers);
        $stats["credelec"] = ["qtty"=>$credelec->count(),"amount"=>$credelec->sum('amount')];

        return $stats;
    }
}
