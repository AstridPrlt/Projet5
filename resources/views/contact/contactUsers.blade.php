@extends('layouts.public')

@section('title')
    Message
@endsection

@section('public_content')
    <div>
        <h3 class="text-center m-4">Envoyer un message à {{ $userToContact->name }}</h3>

        <form class="col-10 col-md-6 m-auto mb-5" method="post">
            @csrf

            @if (session('message'))
                <div class="mb-4" style="color: teal; font-size: 1.2rem;">{{ session('message')}}</div>
            @endif

            <input id="senderName" name="senderName" type="hidden" value="{{ $authUser->name }}">
            <input id="senderJob" name="senderJob" type="hidden" value="{{ $authUser->job }}">
            <input id="senderDescription" name="senderDescription" type="hidden" value="{{ $authUser->user_description }}">
            <input id="contactName" name="contactName" type="hidden" value="{{ $userToContact->name }}">

            <div class="form-group">
                <textarea class="form-control @error('message') is-invalid @enderror" rows="12" placeholder="Pour des raisons de confidentialité, nous ne communiquons pas votre adresse email aux autres coweerkers. Par conséquent, veillez à préciser vos coordonnées dans votre message afin de permettre à {{ $userToContact->name }} de vous répondre !" name="message" required>{{old('message')}}</textarea>
                @error('message')
                <div class="invalid-feedback">
                    {{ $errors->first('message') }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-perso w-100 rounded-pill mb-3">Envoyer</button>

        </form>
    </div>
@endsection
