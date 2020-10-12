@extends('layouts.public')

@section('title')
    Inscription
@endsection

@section('public_content')

<booking-component :event-selected="{{ $eventSelected }}" :booked="{{ $booked }}"></booking-component>

@endsection
