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
        <div id="app">
            <nav class="navbar fixed-top navbar-light bg-white shadow" style="height: 80px;">
                <a href="/Projet5/public/"><img src="./../public/images/logo2.png" alt=""></a>

                <div class="flex">
                    <a href="details" class="text-muted text-uppercase mx-3">Le lieu</a>
                    <a href="events" class="text-muted text-uppercase mx-3">Les évènements</a>
                    <a href="coweerkers" class="text-muted text-uppercase mx-3">Les coweerkers</a>
                </div>

                <div>
                    @if (Route::has('login'))

                            @auth
                                <a href="{{ url('/home') }}">Mon espace</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary" role="button">Connexion</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary" role="button">Inscription</a>
                                @endif
                            @endauth
                    @endif
                </div>
            </nav>

        @yield('public_content')

        </div>
    </body>
</html>