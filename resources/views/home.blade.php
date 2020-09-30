@extends('layouts.app')

@section('content')
<div class="container" style="height: 80vh;">
    <div class="row justify-content-center h-100">
        <div class="col-md-10">
            <div class="card h-100">
                {{-- <div class="card-header"> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tableau de bord</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profil</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="events-tab" data-toggle="tab" href="#events" role="tab" aria-controls="events" aria-selected="false">Mes évènements</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">Ma communauté</a>
                        </li>
                      </ul>
                {{-- </div> --}}

                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            {{ __('Bonjour ' . Auth::user()->name . ' !') }}
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Voici mon profil</div>

                        <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="contact-tab">Voici mes évènements</div>

                        <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="contact-tab">Voici mes amis</div>
                      </div>

            </div>
        </div>
    </div>
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
