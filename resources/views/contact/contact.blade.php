@extends('layouts.public')

@section('title')
    Contact
@endsection

@section('public_content')
    <h2 class="text-center m-4">Contactez-nous</h2>
    <form class="col-10 col-md-6 m-auto mb-5" method="post" action="contact">
        @csrf

        @if (session('message'))
            <div class="mb-4" style="color: teal; font-size: 1.2rem;">{{ session('message')}}</div>
        @endif

        <div class="form-group">
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Votre prénom" name="prenom" value="{{ old('prenom')}}" required>
            @error('prenom')
                <div class="invalid-feedback">
                    {{ $errors->first('prenom') }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Votre nom" name="nom" value="{{ old('nom')}}" required>
            @error('nom')
            <div class="invalid-feedback">
                {{ $errors->first('nom') }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Votre adresse e-mail" name="email" value="{{ old('email')}}" required>
            @error('email')
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <textarea class="form-control @error('message') is-invalid @enderror" rows="3" placeholder="Votre message" name="message" required>{{old('message')}}</textarea>
            @error('message')
            <div class="invalid-feedback">
                {{ $errors->first('message') }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-perso w-100 rounded-pill mb-3">Envoyer</button>
        <small class="text-justify">En cliquant sur Envoyer, j'accepte que les informations saisies dans ce formulaire soient traitées et utilisées pour permettre de me recontacter.</small>
    </form>
@endsection
