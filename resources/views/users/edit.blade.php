@extends('users._layout')
@section('page')
    Trocar Senha do utilizador
@endsection

@section('content')
    @if(isset($user))
        <div class="w-full md:max-w-lg ">
            <form method="post" action="{{ route('users.update', ['user_id' => $user->id]) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-2">
                    <div class="form-group">
                        <label class="label-base" for="name">Nome</label>
                        <input class="input-base" value="{{ $user->first_name }}" placeholder="Jorge" type="text" name="name" id="name" required>
                        @if(isset($errors) && $errors->has('name'))
                            <p class="form-input-error">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="label-base" for="surname">Apelido</label>
                        <input class="input-base" value="{{ $user->last_name }}" placeholder="Mondlane" type="text" name="surname" id="surname" required>
                        @if(isset($errors) && $errors->has('surname'))
                            <p class="form-input-error">{{ $errors->first('surname') }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="label-base" for="email">Email</label>
                    <input class="input-base" value="{{ $user->email }}" placeholder="email@has.com" type="email" name="email" id="email">
                    @if(isset($errors) && $errors->has('email'))
                        <p class="form-input-error">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="label-base" for="password">Senha</label>
                    <input class="input-base" placeholder="***********" type="password" name="password" id="password">
                    @if(isset($errors) && $errors->has('password'))
                        <p class="form-input-error">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="label-base" for="confirmPassword">Confirmar senha</label>
                    <input class="input-base" placeholder="***********" type="password" name="password_confirmation" id="confirmPassword">
                </div>

                @if(auth()->user()->isSuperAdmin())
                    <div class="grid grid-cols-2 gap-2">
                        <div class="form-group">
                            <label class="label-base" for="userRole">Previlégios</label>
                            <select name="role" class="input-base" id="userRole">
                                <option value="normal" {{ $user->isNormal() ? 'selected' : '' }}>Normal</option>
                                <option value="admin" {{ $user->isAdmin() ? 'selected' : '' }}>Admin</option>

                                @if(auth()->user()->isSysAdmin())
                                    <option value="super_admin" {{ $user->isSuperAdmin() ? 'selected' : '' }}>Super</option>
                                @endif
                            </select>
                        </div>
                    </div>
                @endif

                <div class="mt-4 flex justify-between items-end">
                    <button type="submit" class="w-24 btn-primary">Actualizar</button>
                    <a href="{{ redirect()->back()->getTargetUrl() }}" class="text-lg text-dashboard">Voltar</a>
                </div>
            </form>
        </div>
    @else
        <div class="mt-10 w-full border-2 border-gray-400 border-dashed p-4">
            <h2 class="text-red-700 text-center text-2xl">Utilizador inválido.</h2>
        </div>
    @endif
@endsection


