<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="appVue">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav mr-auto"></ul></div></div></nav> --}}

        <nav class="navbar navbar-expand-lg px-3 fixed-top navbar-light bg-white shadow" style="height: 80px;">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="./../public/images/logo2.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse h-100 pt-4 pt-lg-0 bg-white" id="navbarSupportedContent">
                <div class="d-flex w-100 h-100">
                    <ul class="navbar-nav w-100 h-100 align-items-center flex-column flex-lg-row justify-content-end">
                        <div class="d-flex h-100 align-items-center mr-3 flex-column flex-lg-row">
                            <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'details' ? 'active-page' : '' }}">
                                {{-- <router-link to='/details' class="text-uppercase mx-3">Le lieu</router-link> --}}
                                <a href="details" class="text-uppercase mx-3">Le lieu</a>
                            </div>
                            <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'events' ? 'active-page' : '' }}">
                                {{-- <router-link to='/events' class="text-uppercase mx-3">Les évènements</router-link> --}}
                                <a href="events" class="text-uppercase mx-3">Les évènements</a>
                            </div>
                            <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'coweerkers' ? 'active-page' : '' }}">
                                {{-- <router-link to='/coweerkers' class="text-uppercase mx-3">Les coweerkers</router-link> --}}
                                <a href="coweerkers" class="text-uppercase mx-3">Les coweerkers</a>
                            </div>

                            <!-- Right Side Of Navbar -->
                            {{-- <ul class="navbar-nav ml-auto"> --}}
                            <div>
                                <!-- Authentication Links -->
                                @guest
                                    {{-- <li class="nav-item"> --}}
                                    <a class="btn btn-outline-perso" href="{{ route('login') }}">Connexion</a>
                                    {{-- </li> --}}
                                @if (Route::has('register'))
                                    {{-- <li class="nav-item"> --}}
                                        <a class="btn-perso btn" href="{{ route('register') }}">Inscription</a>
                                    {{-- </li> --}}
                                @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}</a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                        </div>
                                    </li>
                                @endguest
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <main style="padding-top: 80px;">
            @yield('content')
        </main>
    </div>
</body>
</html>
