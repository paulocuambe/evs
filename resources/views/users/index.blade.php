@extends('users._layout')
@section('page')
    Gerir utilizadores
@endsection

@section('content')
    <main>

        <div class="mb-4">
            <a href="{{ route('users.create') }}" class="w-32 btn-primary">+ Adicionar</a>
        </div>

        @if(isset($users) && count($users))
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="text-left bg-gray-300">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nome</th>
                        <th class="border px-4 py-2">Username</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Previlégios</th>
                        <th class="border px-4 py-2">Estado</th>
                        <th class="w-32 border px-4 py-2">Accões</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->username }}</td>
                            <td class="border px-4 py-2">{{ $user->email ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $user->role }}</td>
                            <td class="border px-4 py-2">
                                @if($user->suspended)
                                    <span class="bg-red-600 text-xs text-white p-1 rounded">Suspenso</span>
                                @else
                                    <span class="bg-green-600 text-xs text-white p-1 rounded">Activo</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex justify-between flex-wrap">
                                    <a title="Actualizar informações" class="text-blue-600 underline" href="{{ route('users.edit', ['user_id'=> $user->id]) }}">
                                        <img class="w-4" src="{{ asset('img/icon/edit.png') }}" alt="Edit">
                                    </a>

                                    @if($user->suspended)
                                    {{-- {{ route('users.enable', ['user_id'=> $user->id]) }} --}}
                                        <form action="" method="post">
                                            @csrf
                                            <button title="Activar Utilizador" class="text-green-600 underline">
                                                <img class="w-4" src="{{ asset('img/icon/checked.png') }}" alt="Activate">
                                            </button>
                                        </form>
                                    {{-- {{ route('users.suspend', ['user_id'=> $user->id]) }} --}}
                                        <form action="" method="post">
                                            @csrf
                                            <button title="Suspender Utilizador" class="text-red-600 underline">
                                                <img class="w-4" src="{{ asset('img/icon/cancel.png') }}" alt="Supend">
                                            </button>
                                        </form>

                                        {{-- {{ route('users.destroy', ['user_id'=> $user->id]) }} --}}
                                        <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Eliminar Utilizador" class="text-red-600 underline">
                                                <img class="w-4" src="{{ asset('img/icon/delete.png') }}" alt="Supend">
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $users->links() }}
            </div>
        @else
            <div class="mt-10 w-full border-2 border-gray-400 border-dashed p-4">
                <h2 class="text-gray-600 text-center text-2xl">Sem usuários a listar.</h2>
            </div>
        @endif
    </main>
@endsection

