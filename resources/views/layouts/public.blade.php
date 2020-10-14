<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Le Cowee</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>

        <div class="appVue">
            <nav class="navbar navbar-expand-lg px-3 fixed-top navbar-light bg-white shadow" style="height: 80px;">
                {{-- <router-link to='/'><img src="./../public/images/logo2.png" alt=""></router-link> --}}
                <a href="{{ url('/') }}"><img src="http://localhost/Projet5/public/images/logo2.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

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
                                <a href={{url('events')}} class="text-uppercase mx-3">Les évènements</a>
                            </div>
                            <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'coweerkers' ? 'active-page' : '' }}">
                                {{-- <router-link to='/coweerkers' class="text-uppercase mx-3">Les coweerkers</router-link> --}}
                                <a href="coweerkers" class="text-uppercase mx-3">Les coweerkers</a></div>
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
                    </ul>
                    </div>
                </div>
            </nav>


            <div style="padding-top: 80px;">
                {{-- <router-view> --}}
                    @yield('public_content')
                {{-- </router-view> --}}
            </div>

        </div>
    </body>
</html>
