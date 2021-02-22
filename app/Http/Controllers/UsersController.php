<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = [];
        if (Auth::user()->isSysAdmin()) {
            $users = User::sysAdmin(false)->with('organization')->paginate();
        } elseif (Auth::user()->isSuperAdmin()) {
            $users = User::superAdmin(false)->with('organization')->paginate();
        } elseif (Auth::user()->isAdmin()) {
            $users = Auth::user()->subusers()->with('organization')->paginate();
        }

        return view('users.index')->with([
            'users' => $users
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $data = [];
        if ($user->isSuperAdmin()) {
            $data['organizations'] = Organization::query()->select(['id', 'name'])->get();
        }

        return view('users.create')->with($data);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($request->input('password'));
        $data['name'] .= ' ' . $data['surname'];
        unset($data['surname']);

        $authUser = Auth::user();
        if ($authUser->isAdmin()) {
            $data['parent_id'] = Auth::id();

            if ($authUser->organization->id) {
                $data['organization_id'] = $authUser->organization->id;
            }
        }

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
                'organizations' => Organization::query()->select(['id', 'name'])->get()
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

        $authUser = Auth::user();
        if ($authUser->isAdmin()) {
            if ($authUser->organization->id) {
                $data['organization_id'] = $authUser->organization->id;
            }
        }

        
        $user = User::query()->findOrFail($user_id);

        if ($user->update($data)) {
            return redirect()->route('users');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($user_id)
    {
        User::query()->findOrFail($user_id)->delete();
        return redirect()->back();
    }
}
