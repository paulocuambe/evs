@extends('users._layout')
@section('page')
    Accountss do utilizador
@endsection

@section('content')
    @if(isset($user))
        <div class="w-full md:w-1/2">
            <form action="{{route('users.accounts.add', ['user_id' => $user->id])}}" class="grid grid-cols-3 gap-2" method="post">
                @csrf
                <div>
                    <label class="label-base" for="user">Utilizador</label><br>
                    <select class="input-base mr-2" disabled name="user">
                        <option value="">{{ $user->name }}</option>
                    </select>
                </div>

                <div>
                    <label class="label-base" for="user">Accounts</label><br>
                    <select class="input-base" name="account_id">
                        @if(isset($accounts) & count($accounts) > 0)
                            @foreach($accounts as $accounts)
                                <option value="{{ $accounts->id }}">{{ $accounts->account }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="self-end w-32">
                    <button class="btn-primary" type="submit">Dar acesso</button>
                </div>
            </form>
        </div>

        @if(count($user->accounts) > 0)
            <div class="mt-8 w-full md:w-1/2">
                <table class="w-full table-auto">
                    <thead class="text-left bg-gray-300">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">account_id</th>
                        <th class="border px-4 py-2">Account Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->accounts as $account)
                        @php
                            $account_obj = $account_obj->select(['account'])->find($account->account_id)
                        @endphp
                        <tr>
                            <td class="border px-4 py-2">{{ $account->id }}</td>
                            <td class="border px-4 py-2">{{ $account->account_id }}</td>
                            <td class="border px-4 py-2">{{ $account_obj->account }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="mt-10 w-full border-2 border-gray-400 border-dashed p-4">
                <h2 class="text-gray-600 text-center text-2xl">Ainda não foram atribuídos accountss para este usuário.</h2>
            </div>
        @endif
    @else
        <div class="mt-10 w-full border-2 border-gray-400 border-dashed p-4">
            <h2 class="text-red-700 text-center text-2xl">Utilizador inválido.</h2>
        </div>
    @endif
@endsection
