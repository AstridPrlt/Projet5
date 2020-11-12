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

        <div class="appVue d-flex flex-column justify-content-between min-vh-100">
            <nav id="mainNav" class="navbar navbar-expand-lg px-3 fixed-top navbar-light bg-white shadow" style="height: 80px;">
                {{-- <div class="container"> --}}
                    <a href="{{ url('/') }}"><img src="http://localhost/Projet5/public/images/logo2.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse h-100 pt-4 pt-lg-0 bg-white" id="navbarSupportedContent">
                        <div class="d-flex w-100 h-100">
                        <ul class="navbar-nav w-100 h-100 align-items-center flex-column flex-lg-row justify-content-end">
                            <div class="d-flex h-100 align-items-center mr-3 flex-column flex-lg-row">
                                <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'details' ? 'active-page' : '' }}">
                                    <a href="details" class="text-uppercase mx-3">Le lieu</a>
                                </div>
                                <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'events' ? 'active-page' : '' }}">
                                    <a href={{url('events')}} class="text-uppercase mx-3">Les évènements</a>
                                </div>
                                <div class="nav-hover d-flex h-100 align-items-center {{ Request::path() === 'coweerkers' ? 'active-page' : '' }}">
                                    <a href={{url('coweerkers')}} class="text-uppercase mx-3">Les coweerkers</a></div>
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
                {{-- </div> --}}
            </nav>


            <div style="padding-top: 80px;">
                    @yield('public_content')
            </div>

            <footer class="w-100">
                <div class="d-flex text-light pt-4" style="background: linear-gradient(darkgray 10%, #4e545a); box-shadow: 0px -8px 10px 0px lightgrey;">
                    <div class="col-6 text-center">
                        <p class="pb-3">Lun - Sam : 9h - 21h<br>Dim : fermé</p>
                        <p>Le Cowee<br>10, rue de la fausse adresse<br>75022 Paris</p>
                        <p>Tèl : +33 1 00 00 00 00</p>
                    </div>
                    <div class="col-6 align-center" style="border-left: 1px solid white;">
                        <a href="#" class="d-block mb-1 text-light">Tarifs</a>
                        <a href="contact" class="d-block mb-1 text-light">Nous contacter</a>
                        <a href="#" class="d-block mb-1 text-light">Mentions légales</a>
                        <a href="#" class="d-block mb-1 text-light">Conditions générales d'utilisation</a>
                        <a href="#" class="d-block mb-1 text-light">Politique de Protection des données personnelles</a>
                        <a href="#" class="d-block mb-1 text-light">Sitemap</a>
                    </div>
                </div>

                <div class="w-100 bg-dark"><p class="mb-0 w-100 text-center text-light">Ne cherchez pas ce café ! Ce site est fictif et créé dans le cadre d'une formation</p></div>
            </footer>
        </div>
    </body>
</html>
