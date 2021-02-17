@extends('_layouts.dashboard')
@section('title')
    Utilizadores
@endsection

@section('main')
    <nav class="flex mb-8">
        <a href="" class="nav-tab {{ request()->routeIs('profile') ? 'active' : '' }}">Meu Perfil</a>

        <a href="" class="nav-tab">
            Utilizadores
        </a>

        @if(auth()->user()->isSuperAdmin())
            <a href="" class="nav-tab">Organizações</a>
        @endif
    </nav>
    <main>
        @yield('content')
    </main>
@endsection

