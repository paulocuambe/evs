<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Login - {{ config('app.name') }}</title>
    <style>
        body > div {
            width: 450px;
        }
    </style>
</head>
<body>
<div class="h-screen w-full bg-gray-100 flex justify-center items-center">
    <main>
        <header class="flex justify-center">
            <img src="{{ asset('img/inove-horizontal.png') }}" alt="InoveIT Horizontal Logo">
        </header>

        <main class="mt-4 bg-white shadow p-4">
            @if(isset($errors) && $errors->has('auth_error'))
                <p class="error-message mb-2">{{ $errors->first('auth_error') }}</p>
            @endif

            @if(session("password_reset"))
                <p class="success-message mb-2">{{ session("password_reset") }}</p>
            @endif

            <form method="post" action="{{ route('authenticate') }}">
                @csrf
                <div class="form-group">
                    <label class="label-base" for="username">Username</label>
                    <input class="input-base" value="{{ request()->old('username') }}"
                           type="text"
                           name="username" id="username" required>
                    @if(isset($errors) && $errors->has('username'))
                        <p class="form-input-error">{{ $errors->first('username') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="label-base" for="password">Password</label>
                    <input class="input-base" type="password" name="password" id="password" required>
                    @if(isset($errors) && $errors->has('password'))
                        <p class="form-input-error">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <button type="submit" class="mt-4 btn-primary">Login</button>
            </form>
            <div>
                <h3 class="mt-1"><a href="" class="text-blue-500 text-sm underline">Clique aqui para recuperar a Senha.</a></h3>
            </div>
            <footer class="mt-4 text-gray-500">&copy; {{ config('app.foot_note') }}</footer>
        </main>
    </main>
</div>

</body>
</html>
