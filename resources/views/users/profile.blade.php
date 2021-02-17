@extends('users._layout')
@section('page')
    Perfil
@endsection

@section('content')
    <div class="w-full lg:flex lg:flex-wrap lg:justify-between gap-10">
        <table class="w-full lg:w-3/6 table-auto">
            <tbody>
            <tr>
                <td class="border-2 border-gray-400 px-4 py-2 font-bold">Nome</td>
                <td class="border-2 border-gray-400 px-4 py-2">{{ auth()->user()->name }}</td>
            </tr>

            <tr>
                <td class="border-2 border-gray-400 px-4 py-2 font-bold">Username</td>
                <td class="border-2 border-gray-400 px-4 py-2">{{ auth()->user()->username }}</td>
            </tr>

            <tr>
                <td class="border-2 border-gray-400 px-4 py-2 font-bold">Email</td>
                <td class="border-2 border-gray-400 px-4 py-2">{{ auth()->user()->email }}</td>
            </tr>

            <tr>
                <td class="border-2 border-gray-400 px-4 py-2 font-bold">Previlégios</td>
                <td class="border-2 border-gray-400 px-4 py-2">{{ auth()->user()->role }}</td>
            </tr>

            <tr>
                <td class="border-2 border-gray-400 px-4 py-2 font-bold">Última Actualização</td>
                <td class="border-2 border-gray-400 px-4 py-2">
                    {{ auth()->user()->updated_at }}
                </td>
            </tr>

            <tr>
                <td class="border-2 border-gray-400 px-4 py-2 font-bold">Data de criação</td>
                <td class="border-2 border-gray-400 px-4 py-2">
                    {{ auth()->user()->created_at }}
                </td>
            </tr>
            </tbody>
        </table>

        <div class="w-full lg:w-2/6 mt-8 lg:mt-0">
            <h2 class="text-2xl mb-2 leading-none">Actualizar a Senha</h2>
            <hr class="mb-4">

            <form method="post" action="{{route('profile.password-reset')}}" class="grid row-gap-4">
                @csrf
                @method('PUT')

                @if(session("success_message"))
                    <p class="success-message mb-2">{{ session("success_message") }}</p>
                @elseif (session("password_notice"))
                    <p class="bg-orange-200 text-orange-700 success-message mb-2">{{ session("password_notice") }}</p>
                @endif

                <div class="form-group">
                    <label class="label-base" for="oldPassword">Senha Actual</label>
                    <input class="input-base" placeholder="***********" type="password" name="old_password" id="oldPassword" required>
                    @if(isset($errors) && $errors->has('old_password'))
                        <p class="form-input-error">{{ $errors->first('old_password') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="label-base" for="password">Nova Senha</label>
                    <input class="input-base" placeholder="***********" type="password" name="password" id="password" required>
                    @if(isset($errors) && $errors->has('password'))
                        <p class="form-input-error">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="label-base" for="confirmPassword">Confirmar Senha</label>
                    <input class="input-base" placeholder="***********" type="password" name="password_confirmation" id="confirmPassword" required>
                </div>

                <div class="w-24">
                    <button type="submit" class="btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

