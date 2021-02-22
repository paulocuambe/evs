@extends('users._layout')
@section('page')
    Organizações
@endsection

@section('content')
    <div>
        <div>
            @if(isset($errors))
                @if($errors->has('name'))
                    <p class="form-input-error">{{ $errors->first('name') }}</p>
                @endif
                @if($errors->has('description'))
                    <p class="form-input-error">{{ $errors->first('description') }}</p>
                @endif
            @else
                @if(session("message"))
                    <p class="success-message mb-2">{{ session("message") }}</p>
                @elseif(session("error"))
                    <p class="error-message mb-2">{{ session("error") }}</p>
                @endif
            @endif
        </div>

        <form action="{{ route('organizations.store') }}" method="post" class="mb-4 grid gap-2 md:grid-cols-3 lg:grid-cols-4">
            @csrf
            <div class="mb-0 form-group">
                <label class="label-base" for="name">Nome</label>
                <input class="input-base" value="{{ request()->old('name') }}" type="text" name="name" placeholder="Hotel Tuhiru" id="name">
            </div>

            <div class="mb-0 form-group">
                <label class="label-base" for="description">Descrição</label>
                <textarea class="input-base" placeholder="Hotel Muriati" cols="30" rows="1" name="description" id="description">{{ request()->old('description') }}</textarea>
            </div>

            <button class="w-32 self-end btn-primary">Adicionar</button>
        </form>
    </div>

    @if(isset($orgs) & count($orgs) > 0)
        <table class="w-full table-auto">
            <thead class="text-left bg-gray-300">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Organização</th>
                <th class="border px-4 py-2">Descrição</th>
                <th class="border px-4 py-2">Adicionado em</th>
                <th class="border px-4 py-2">Última actualização</th>
                <th class="border px-4 py-2">Acções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orgs as $org)
                <tr>
                    <td class="border px-4 py-2">{{ $org->id }}</td>
                    <td class="border px-4 py-2">{{ $org->name }}</td>
                    <td class="border px-4 py-2">{{ $org->description }}</td>
                    <td class="border px-4 py-2">{{ $org->created_at }}</td>
                    <td class="border px-4 py-2">{{ $org->updated_at }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex flex-wrap justify-between">
                            <form method="GET" action="{{ route('organizations.edit', ['id'=> $org->id]) }}">
                                <button class="text-blue-600 underline">
                                    <img class="w-4" src="{{ asset('img/icon/edit.png') }}" alt="Edit">
                                </button>
                            </form>

                            <form method="post" action="{{ route('organizations.destroy', ['id'=> $org->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-blue-600 underline">
                                    <img class="w-4" src="{{ asset('img/icon/delete.png') }}" alt="Delete">
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="mt-10 w-full border-2 border-gray-400 border-dashed p-4">
            <h2 class="text-gray-600 text-center text-2xl">Sem organizações a listar.</h2>
        </div>
    @endif
@endsection

