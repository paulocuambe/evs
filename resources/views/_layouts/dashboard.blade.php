<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>@yield('title', 'Dashboard') | {{ config('app.name') }}</title>

    @yield('styles')

</head>
<body>
<div id="dashboard" class="bg-gray-100 font-lato text-gray-900 tracking-wide">
    <aside id="sidebar" class="hidden w-full md:block min-h-screen h-screen overflow-y-auto font-semibold text-white bg-gray-800">
        <header class="flex items-center h-12">
            <img class="ml-3 p-3 pl-0" src="{{ asset('img/inove-branco-horizontal.png') }}"
                 alt="InoveIT Logo Horizontal">
        </header>

        <div class="my-8">
            <ul id="navbar">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <img src="{{ asset('img/icon/dashboard.png') }}" alt="Dashboard Icon">
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('transactions') }}" class="">
                        <img src="{{ asset('img/icon/transaction.png') }}" alt="inbox Icon">
                        <span>Transações</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('stats') }}">
                        <img src="{{ asset('img/icon/stats.png') }}" alt="Stats Icon">
                        <span>Digest</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') || request()->routeIs('users') || request()->routeIs('users.*') || request()->routeIs('organizations') || request()->routeIs('organizations.*') ? 'active' : '' }}">
                        <img src="{{ asset('img/icon/group.png') }}" alt="Settings Icon">
                        <span>Perfil</span>
                    </a>
                </li>

                @if(auth()->user()->isSuperAdmin())
                    <li>
                        <a href="{{ route('accounts') }}"
                            class="{{ request()->routeIs('accounts')? 'active' : '' }}">
                            <img src="{{ asset('img/icon/discover.png') }}" alt="Discover Icon">
                            <span>Clientes</span>
                        </a>
                    </li>
                @endif
            </ul>

            <footer class="mb-8 px-4 py-2 flex items-center">
                <img class="mr-4" style="width: 20px" src="{{ asset('img/icon/logout.png') }}" alt="Miscellaneous Icon">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="hover:underline">Logout</button>
                </form>
            </footer>
        </div>
    </aside>

    <header id="header" class="z-30 flex items-center shadow">
        <div class="flex justify-between items-center container mx-auto px-6">
            <h3 class="text-xl text-green-700">
                @yield('page', 'Home')
            </h3>
            <div class="flex items-center">
                <h4 class="mr-4 text-green-700 font-semibold">pcuambe</h4>
            </div>
        </div>
    </header>

    <main id="main" class="container mx-auto p-6 overflow-y-auto">
        <div id="app" class="mb-40">
            @yield('main')
        </div>
    </main>
</div>
@yield('scripts')
</body>
</html>
