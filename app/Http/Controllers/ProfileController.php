<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view("users.profile")->with([
            'user' => User::query()->findOrFail(Auth::id())
        ]);
    }

    public function disable($user_id)
    {
        $user = User::query()->findOrFail($user_id);

        if ($user->disable()) {
            return redirect()->route('users');
        } else {
            return redirect()->back();
        }
    }

    public function enable($user_id)
    {
        $user = User::query()->findOrFail($user_id);

        if ($user->enable()) {
            return redirect()->route('users');
        } else {
            return redirect()->back();
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::query()->find(Auth::id())->update([
            'password' => bcrypt($request->input('password'))
        ]);

        if ($user) {
            return redirect()->back()->with(['success_message' => 'Password updated.']);
        } else {
            return redirect()->back()->withInput();
        }
    }
}
