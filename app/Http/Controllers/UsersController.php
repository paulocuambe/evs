<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Users\StoreUserRequest;

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
}
