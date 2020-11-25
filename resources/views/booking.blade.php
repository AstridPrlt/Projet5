@extends('layouts.public')

@section('extra-script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('title')
    Inscription
@endsection

@section('public_content')

<booking-component :event-selected="{{ $eventSelected }}" :booked="{{ $booked }}"></booking-component>

@endsection


