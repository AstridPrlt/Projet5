<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Le Cowee - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app" class="100vw">
            <nav class="navbar px-3 fixed-top navbar-light bg-white shadow" style="height: 80px;">
                <a href="/Projet5/public/"><img src="./../public/images/logo2.png" alt=""></a>

                <div class="d-flex h-100 align-items-center">
                    <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'details' ? 'active-page' : '' }}"><a href="details" class="text-uppercase mx-3">Le lieu</a></div>
                    <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'events' ? 'active-page' : '' }}"><a href="events" class="text-uppercase mx-3">Les évènements</a></div>
                    <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'coweerkers' ? 'active-page' : '' }}"><a href="coweerkers" class="text-uppercase mx-3">Les coweerkers</a></div>
                </div>

                <div>
                    @if (Route::has('login'))

                            @auth
                                <a href="{{ url('/home') }}" class="btn-perso btn">Mon espace</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-perso" role="button">Connexion</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-perso btn" role="button">Inscription</a>
                                @endif
                            @endauth
                    @endif
                </div>
            </nav>

        <div style="padding-top: 80px;">
        @yield('public_content')
        </div>

        </div>
    </body>
</html>
