<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;


class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with([
            'users' => User::paginate()
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($request->input('password'));
        $data['name'] .= ' ' . $data['surname'];
        unset($data['surname']);

        $user = User::query()->create($data);

        if (!is_null($user)) {
            return redirect()->back()->with(['success_message' => 'Utilizador adicionado com sucesso.']);
        } else {
            return redirect()->back()->with(['error_message' => 'Ocorreu algum erro ao criar o perfil desse usuário.']);
        }
    }


    public function edit($user_id)
    {
        if (Auth::user()->isSuperAdmin()) {
            $user = User::query()->findOrFail($user_id);

            return view('users.edit')->with([
                'user' => $user,
            ]);
        } else {
            $user = Auth::user()->subusers()->findOrFail($user_id);

            return view('users.edit')->with(['user' => $user]);
        }
    }

    public function update(UpdateUserRequest $request, $user_id)
    {
        $data = $request->validated();

        $data['name'] .= ' ' . $data['surname'];
        unset($data['surname']);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($request->input('password'));
        } else {
            unset($data['password']);
        }
        
        $user = User::query()->findOrFail($user_id);

        if ($user->update($data)) {
            return redirect()->route('users');
        } else {
            return redirect()->back();
        }
    }
}
