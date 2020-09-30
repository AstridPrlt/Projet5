@extends('layouts.public')

@section('title')
    Events
@endsection

@section('public_content')
    <h2 class="mt-4 text-center">Les évènements à venir...</h2>
    <div class="d-flex">
        @foreach ($events as $event)
            <div class="card" style="width: 22%; margin: 1.5%;">
                <img src="./../public/images/events/{{ $event->event_picture }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title font-weight-bold">{{ $event->title }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><x-ri-calendar-check-fill style="width: 20px;"/>Le {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</li>
                <li class="list-group-item"><x-ri-time-fill style="width: 20px;"/>De {{ \Carbon\Carbon::parse($event->begin_time)->translatedFormat('H\hi') }} à {{ \Carbon\Carbon::parse($event->end_time)->translatedFormat('H\hi') }}</li>
                <li class="list-group-item"><x-ri-money-euro-circle-fill style="width: 20px;"/>{{ $event->price }} €</li>
                </ul>
                <div class="card-body">
                <button type="button" class="btn btn-perso2" data-toggle="modal" data-target="#eventModal{{ $event->id }}">Détails</button>
                <button type="button" class="btn btn-perso" data-toggle="modal" data-target="#eventModal{{ $event->id }}">Je m'inscris !</button>
                </div>
            </div>

            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{ $event->title }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">{{ $event->event_description }}</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      <button type="button" class="btn btn-perso">Je m'inscris !</button>
                    </div>
                  </div>
                </div>
              </div>

        @endforeach
    </div>

@endsection
