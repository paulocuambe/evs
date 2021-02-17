<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return \redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        $data = array_merge($data, ['suspended' => false]);

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        } else {
            return back()->withInput(['username' => $data['username']])->withErrors([
                'auth_error' => 'Username e/ou senha incorrectos.'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
