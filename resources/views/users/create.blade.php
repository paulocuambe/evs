@extends('users._layout')
@section('page')
    Registar utilizador
@endsection

@section('content')
    <div class="w-full md:max-w-lg ">
        @if(session("success_message"))
            <p class="success-message mb-2">{{ session("success_message") }}</p>
        @elseif(session("error_message"))
            <p class="error-message mb-2">{{ session("error_message") }}</p>
        @endif

        <form method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-2">
                <div class="form-group">
                    <label class="label-base" for="name">Nome</label>
                    <input class="input-base" value="{{ request()->old('name') }}" placeholder="Jorge" type="text" name="name" id="name" required>
                    @if(isset($errors) && $errors->has('name'))
                        <p class="form-input-error">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="label-base" for="surname">Apelido</label>
                    <input class="input-base" value="{{ request()->old('surname') }}" placeholder="Mondlane" type="text" name="surname" id="surname" required>
                    @if(isset($errors) && $errors->has('surname'))
                        <p class="form-input-error">{{ $errors->first('surname') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="label-base" for="username">Username</label>
                <input class="input-base" value="{{ request()->old('username') }}" placeholder="username" type="text" name="username" id="username" required>
                @if(isset($errors) && $errors->has('username'))
                    <p class="form-input-error">{{ $errors->first('username') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label class="label-base" for="email">Email</label>
                <input class="input-base" value="{{ request()->old('email') }}" placeholder="email@has.com" type="email" name="email" id="email">
                @if(isset($errors) && $errors->has('email'))
                    <p class="form-input-error">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label class="label-base" for="password">Senha</label>
                <input class="input-base" placeholder="***********" type="password" name="password" id="password" required>
                @if(isset($errors) && $errors->has('password'))
                    <p class="form-input-error">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label class="label-base" for="confirmPassword">Confirmar senha</label>
                <input class="input-base" placeholder="***********" type="password" name="password_confirmation" id="confirmPassword" required>
            </div>

                <div class="grid grid-cols-2 gap-2">
                    {{-- <div class="form-group">
                        <label class="label-base" for="userOrg">Organização</label>
                        <select name="organization_id" class="input-base" id="userOrg">
                            <option value>---------------</option>
                            <option value="1">MEREC</option>
                            <option value="2">EDM</option>
                        </select>
                        @if(isset($errors) && $errors->has('organization_id'))
                            <p class="form-input-error">{{ $errors->first('organization_id') }}</p>
                        @endif
                    </div> --}}

                    @if(auth()->user()->isSuperAdmin())
                        <div class="form-group">
                            <label class="label-base" for="userRole">Previlégios</label>
                            <select name="role" class="input-base" id="userRole">
                                <option value="normal" selected>Normal</option>
                                <option value="admin">Admin</option>
                                @if(auth()->user()->isSysAdmin())
                                    <option value="super_admin">Super</option>
                                @endif
                            </select>
                        </div>
                    @endif
                </div>

            <div class="mt-4 flex justify-between items-end">
                <button type="submit" class="w-32 btn-primary">Criar usuário</button>
                <a href="{{ redirect()->back()->getTargetUrl() }}" class="text-lg text-dashboard">Voltar</a>
            </div>
        </form>
    </div>
@endsection
