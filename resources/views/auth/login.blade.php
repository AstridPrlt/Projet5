@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 15%;">
    <div class="row justify-content-center">
        <div class="col-md-8 m-auto">
            <div class="card">
                <div class="card-header">{{ __('Connexion') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Rester connecté') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="w-100 mb-2 text-center">
                                <button type="submit" class="btn text-light" style="background-color: steelblue;">
                                    {{ __('Connexion') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié') }}
                                    </a>
                                @endif
                            </div>

                            <div class="w-75 mx-auto my-3 position-relative" style="border-top: 1px solid lightgrey;">
                                <p class="px-2 bg-white position-absolute" style="top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">OU</p>
                            </div>

                            <div class="w-100 text-center">
                                <a href="login/github" class="btn w-auto text-light m-2 rounded-pill" style="background-color: steelblue;">
                                    <img src="{{url('/images/logo-github.png')}}" style="width: 40px;" alt="Connexion avec Github">
                                    {{ __('Connexion avec GitHub') }}
                                </a>
                                <a href="login/google" class="btn w-auto text-light rounded-pill" style="background-color: steelblue;">
                                    <img src="{{url('/images/logo-google.png')}}" style="width: 40px;" alt="Connexion avec Google">
                                    {{ __('Connexion avec Google') }}
                                </a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
