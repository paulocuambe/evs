<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;

class UsersAccountsController extends Controller
{
    public function index(Request $request, $user_id)
    {
        $data = [
            "user" => User::findOrFail($user_id),
            "accounts" => Account::query()
                            ->select(['id', 'status', 'account', 'apikey', 'descr', 'disabled_msg', 'creationDate'])
                            ->get()
        ];

        return view('users.accounts.index')->with($data);
    }
}
