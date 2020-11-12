@extends('layouts.public')

@section('title')
    Events
@endsection

@section('public_content')
    <h2 class="mt-4 text-center">Les évènements à venir...</h2>

    <events-component :events="{{ $events }}" :auth-events="{{ $authEvents }}"></events-component>

@endsection
