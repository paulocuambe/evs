@extends('_layouts.dashboard')
@section('title')
    Utilizadores
@endsection

@section('main')
    <nav class="flex mb-8">
        <a href="{{ route('profile') }}" class="nav-tab {{ request()->routeIs('profile') ? 'active' : '' }}">Meu Perfil</a>

        @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
            <a href="{{ route('users') }}" class="nav-tab {{ request()->routeIs('users.*') || request()->routeIs('users') ? 'active' : '' }}">
                Utilizadores
            </a>
        @endif

        @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('organizations') }}" class="nav-tab {{ request()->routeIs('organizations') || request()->routeIs('organizations.*') ? 'active' : ''}}">Organizações</a>
        @endif
    </nav>
    <main>
        @yield('content')
    </main>
@endsection

