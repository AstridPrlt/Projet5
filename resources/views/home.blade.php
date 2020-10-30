@extends('layouts.app')

@section('content')

<div class="mw-100 h-100 pt-5 pb-3">
    {{-- <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            {{ __('Bonjour ' . Auth::user()->name . ' !') }}
        </div>
    </div> --}}

    @if ( Auth::user()->admin == 1 )
        {{-- <div class="d-flex h-100 w-100">
            <div class="bg-white m-auto px-4 py-2 shadow" style="width:45%; height: 95%; border-radius: 3rem;">
                <h3 class="border-bottom">Créer un évènement</h3>
                <create-event-component></create-event-component>
            </div>
            <div class="w-50 h-100 d-flex flex-column">
                <div class="bg-white m-auto px-4 py-2 shadow" style="height: 45%; width: 90%; border-radius: 3rem;">
                    <h3 class="border-bottom">Les évènements à venir</h3>
                    <future-events-component></future-events-component>
                </div>
                <div class="bg-white m-auto px-4 py-2 shadow" style="height: 45%; width: 90%; border-radius: 3rem;">
                    <h3 class="border-bottom">Les évènements passés</h3>
                    <past-events-component></past-events-component>
                </div>
            </div>
        </div> --}}
        <div class="h-100 w-100">

            <button type="button" class="btn btn-perso w-75 mt-4 shadow" style="margin-left: 12.5%;" data-toggle="modal" data-target="#eventModal">
                Créer un nouvel évènement
            </button>
            <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="eventModalLabel">Nouvel évènement</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <create-event-component></create-event-component>
                    </div>
                  </div>
                </div>
              </div>

            <div class="card w-75 mx-auto mt-4 shadow" style="height: 35%">
                <h5 class="card-header">Les évènements à venir</h5>
                <div class="card-body overflow-auto">
                    <future-events-component></future-events-component>
                </div>
            </div>

            <div class="card w-75 mx-auto mt-4 shadow" style="height: 35%">
                <h5 class="card-header">Les évènements passés</h5>
                <div class="card-body overflow-auto">
                    <past-events-component></past-events-component>
                </div>
            </div>
        </div>

    @else

    <div class="bg-light rounded m-auto" style="width: 90%; height: 90%">
        <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-home" aria-selected="true">Mon profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-events-tab" data-toggle="pill" href="#pills-events" role="tab" aria-controls="pills-events" aria-selected="false">Mes évènements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="true">Mes contacts</a>
            </li>
        </ul>

        <div class="tab-content m-3" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <my-profile-component></my-profile-component>
            </div>
            <div class="tab-pane fade" id="pills-events" role="tabpanel" aria-labelledby="pills-events-tab">
                <my-events-component></my-events-component>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>
    </div>


        {{-- <div class="d-flex h-100 w-100">

            <div class="bg-white m-auto px-4 py-2 shadow" style="width:45%; height: 95%; border-radius: 3rem;">
                <h3 class="border-bottom">Mon profil</h3>
                <my-profile-component></my-profile-component>
            </div>

            <div class="w-50 h-100 d-flex flex-column">
                <div class="bg-white m-auto px-4 py-2 shadow" style="height: 45%; width: 90%; border-radius: 3rem;">
                    <h3 class="border-bottom">Mes évènements</h3>
                    <my-events-component></my-events-component>
                </div>

                <div class="bg-white m-auto px-4 py-2 shadow" style="height: 45%; width: 90%; border-radius: 3rem;">
                    <h3 class="border-bottom">Mes contacts</h3>
                </div>
            </div>

        </div> --}}

    @endif
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div> --}}
{{--
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bonjour ' . Auth::user()->name . ' !') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
