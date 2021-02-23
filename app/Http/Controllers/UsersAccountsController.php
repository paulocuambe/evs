<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Models\UserAccount;

class UsersAccountsController extends Controller
{
    public function index(Request $request, $user_id)
    {
        $user = User::with('accounts')->findOrFail($user_id);
        $data = [
            "user" => $user,
            "accounts" => Account::query()
                            ->select(['id', 'account'])
                            ->whereNotIn('id', $user->accounts->pluck('account_id'))
                            ->get(),
            "account_obj" => Account::query(),
        ];

        return view('users.accounts.index')->with($data);
    }

    public function store(Request $request, $user_id)
    {
        $user = User::select(["id"])->findOrFail($user_id);
        $account = Account::select(["id", "account"])->findOrFail($request->input('account_id'));

        $user->accounts()->create(['account_id' => $account->id]);
        return redirect()->back();
    }
}
