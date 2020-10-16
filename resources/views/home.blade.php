@extends('layouts.app')

@section('content')

<div class="mw-100 h-100">
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

    <div class="d-flex h-100 w-100">
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
