@extends('layouts.app')

@section('content')

<div class="mw-100 h-100 pt-5 pb-3">

    @if ( Auth::user()->admin == 1 )

        <div class="bg-light rounded m-auto" style="width: 90%; height: 90%; min-height: 500px">
            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-events-tab" data-toggle="pill" href="#pills-events" role="tab" aria-controls="pills-events" aria-selected="true">Les évènements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-users-tab" data-toggle="pill" href="#pills-users" role="tab" aria-controls="pills-users" aria-selected="true">Les coweerkers</a>
                </li>
            </ul>

            <div class="tab-content m-3 pb-2" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-events" role="tabpanel" aria-labelledby="pills-events-tab">
                    <div class="card mx-auto mt-4 shadow" style="height: 35%; min-height: 250px;">
                        <h5 class="card-header text-uppercase text-center text-light" style="background-color: teal;">Les évènements à venir</h5>
                        <div class="card-body overflow-auto">
                            <future-events-component></future-events-component>
                        </div>
                    </div>

                    <div class="card mx-auto mt-4 shadow" style="height: 35%; min-height: 200px;">
                        <h5 class="card-header text-uppercase text-center text-light" style="background-color: teal;">Les évènements passés</h5>
                        <div class="card-body overflow-auto">
                            <past-events-component></past-events-component>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab">
                    <list-users-component></list-users-component>
                </div>
            </div>
        </div>

    @else

        <div class="bg-light rounded m-auto position-relative" style="width: 90%; height: 90%">
            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Mon profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-events-tab" data-toggle="pill" href="#pills-events" role="tab" aria-controls="pills-events" aria-selected="false">Mes évènements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="true">Mes contacts</a>
                </li>
            </ul>

            <div class="tab-content m-3 pb-2" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <my-profile-component></my-profile-component>
                </div>
                <div class="tab-pane fade" id="pills-events" role="tabpanel" aria-labelledby="pills-events-tab">
                    <my-events-component></my-events-component>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <my-contacts-component></my-contacts-component>
                </div>
            </div>
        </div>

    @endif
</div>

@endsection
