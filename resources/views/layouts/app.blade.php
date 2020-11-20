<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">


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

        <nav class="navbar navbar-expand-lg px-3 pt-2 fixed-top navbar-light bg-white shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="./../public/images/logo2.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse h-100 pt-lg-0 bg-white" id="navbarSupportedContent">
                    <div class="d-flex w-100 h-100">
                        <ul class="navbar-nav w-100 h-100 pb-2 align-items-center flex-column flex-lg-row justify-content-end">
                            <div class="d-flex h-100 align-items-center flex-column flex-lg-row">
                                <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'details' ? 'active-page' : '' }}">
                                    <a href="details" class="text-uppercase mx-3 my-2">Le lieu</a>
                                </div>
                                <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'events' ? 'active-page' : '' }}">
                                    <a href="events" class="text-uppercase mx-3 my-2">Les évènements</a>
                                </div>
                                <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'coweerkers' ? 'active-page' : '' }}">
                                    <a href="coweerkers" class="text-uppercase mx-3 my-2">Les coweerkers</a>
                                </div>

                                <!-- Right Side Of Navbar -->
                                <div>
                                    <!-- Authentication Links -->
                                    @guest
                                        <a class="btn btn-outline-perso" href="{{ route('login') }}">Connexion</a>
                                    @if (Route::has('register'))
                                            <a class="btn-perso btn" href="{{ route('register') }}">Inscription</a>
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
            </div>
        </nav>

        <main style="min-height: 100vh; padding-top: 72px; background: center bottom no-repeat url({{url('/images/background.png')}}); background-size: cover;">
            @yield('content')
        </main>

    </div>

    <!--cookies consent-->
    @include('cookieConsent::index')

</body>
</html>
