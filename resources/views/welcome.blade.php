@extends('layouts.public')

@section('title')
    Accueil
@endsection

@section('public_content')

    <div class="w-100">
        <div class="d-sm-flex bg-dark">
            <div class="col-12 col-sm-7 col-md-5 bg-dark text-light align-self-center">
                <h2 class="text-uppercase pt-3">Un café pas comme les autres</h2>
                <p class="text-justify welcome">Freelances, télétravailleurs, étudiants, vous cherchez un endroit pour travailler une heure, une journée, ou plus ? Un bureau avec une offre flexible, où tout est compris, où on vous accueille du lundi au samedi avec du super café et des snacks à volonté ? Alors ne cherchez plus : c'est au Cowee que ça se passe !</p>
                <div class="text-right">
                    <a href="details" class="text-light btn px-3 py-1 mb-3" style="border: 2px solid darkcyan; border-radius: 2rem">Découvrir
                        <svg width="1em" height="1em" style="font-size: 1.5rem;" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                    </a>
                </div>
            </div>
            <img class="col-12 col-sm-5 col-md-7 px-0" src="{{url('/images/coffeeplace.jpg')}}" alt="Photo du café" style="object-fit: cover;">
        </div>

        <div class="d-sm-flex flex-sm-row-reverse bg-light">
            <div class="col-12 col-sm-7 col-md-5 bg-light text-dark align-self-center">
                <h2 class="text-uppercase pt-3">Des évènements pour se développer</h2>
                <p class="text-justify welcome">Au Cowee, nous avons aussi à coeur de vous aider à évoluer au quotidien. C'est pour ça que nous vous organisons régulièrement des évènements : réseautez à nos soirées à thèmes, développez votre business et vos compétences à nos ateliers et détendez-vous au yoga, il y en a pour tous les goûts. Et c'est aussi l'occasion de rencontrer les autres coweerkers !</p>
                <div class="text-right">
                    <a href="events" class="btn px-3 py-1 mb-3" style="border: 2px solid darkcyan; border-radius: 2rem">Participer
                        <svg width="1em" height="1em" style="font-size: 1.5rem;" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                    </a>
                </div>
            </div>
            <img class="col-12 col-sm-5 col-md-7 px-0" src="{{url('/images/events.jpg')}}" alt="Photo d'un évènement" style="object-fit: cover;">
        </div>

        <div class="d-sm-flex bg-light">
            <div class="col-12 col-sm-7 col-md-5 bg-light text-dark align-self-center">
                <h2 class="text-uppercase pt-3">Une communauté pour grandir</h2>
                <p class="text-justify welcome">"Ensemble, on va plus loin", comme dit le proverbe. Au Cowee, nous en sommes convaincus. C'est pour ça que nous avons voulu créer la Communauté des Coweerkers, active et bienveillante, pour vous permettre d'échanger avec vos pairs, et peut-être aussi avec vos futurs associés, clients ou partenaires !</p>
                <div class="text-right">
                    <a href="coweerkers" class="btn px-3 py-1 mb-3" style="border: 2px solid darkcyan; border-radius: 2rem">Rejoindre
                        <svg width="1em" height="1em" style="font-size: 1.5rem;" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                    </a>
                </div>
            </div>
            <img class="col-12 col-sm-5 col-md-7 px-0" src="{{url('/images/community.jpg')}}" alt="Photo de la communauté" style="object-fit: cover;">
        </div>
    </div>

@endsection
