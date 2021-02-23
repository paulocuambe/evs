<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountsController extends Controller
{
    public function index()
    {
        $accounts = Account::query()->select(['id', 'status', 'account', 'apikey', 'descr', 'disabled_msg', 'creationDate'])->paginate();
        return view('accounts.index')->with(['accounts'=>$accounts]);
    }
}
