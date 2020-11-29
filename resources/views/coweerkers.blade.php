@extends('layouts.public')

@section('title')
    La communauté
@endsection

@section('public_content')
    <div class="m-5">

        <p class="mb-4 text-center" style="font-size: 1.1rem">Vous êtes freelance et vous voulez proposer vos services ?<br/>
        Vous avez une super idée, et besoin de conseils ou de partenaires pour la développer ?<br/>
        Ou vous voulez simplement étoffer votre réseau ?<br/>
        <strong>Que vous soyez à la recherche de partenariats, de conseils, d'aide ou de "collègues", la communauté est là pour ça !</strong></p>

        @auth
            <div>
                <coweerkers-component :coweerkers="{{ $coweerkers }}" :auth-contacts="{{ $authContacts }}"></coweerkers-component>
            </div>
        @else
            <div class="mb-4 text-center">
                <img src="{{asset('images/team.jpg')}}" alt="Travail d'équipe" class="rounded-circle w-25" style="min-width: 150px; max-width: 200px;">
            </div>
            <div class="p-3 text-center" style="border: 2px solid lightgray; border-radius: 1.5rem">
                <h4 class="mb-4 mt-2">Comment ça marche ?</h4>

                <h5 class="m-auto rounded-circle text-light" style="width: 30px; height: 30px; line-height: inherit; background-color: #14a3a8">1</h5>
                <p class="mt-3">Vous vous <a href="{{ url('register')}}">inscrivez</a> sur le site, c'est gratuit et sans engagement</p>

                <h5 class="m-auto rounded-circle text-light" style="width: 30px; height: 30px; line-height: inherit; background-color: #14a3a8">2</h5>
                <p class="mt-3">Vous complétez votre profil.<br/>
                    Grâce à ça, les autres coweerkers vous connaitront mieux et sauront ce que vous cherchez et ce sur quoi vous pouvez les aider</p>

                <h5 class="m-auto rounded-circle text-light" style="width: 30px; height: 30px; line-height: inherit; background-color: #14a3a8">3</h5>
                <p class="mt-3">Vous avez accès à la liste des coweerkers.<br/>
                    Vous pouvez les ajouter à vos favoris et leur envoyer un message</p>

                <h5 class="m-auto rounded-circle text-light" style="width: 30px; height: 30px; line-height: inherit; background-color: #14a3a8">4</h5>
                <p class="mt-3">Et si vous ne voulez pas être contacté, que ce soit de façon temporaire ou permanente, pas de problème !<br/>
                    Le bouton "Cape d'invisibilité" dans votre profil vous permet de ne pas apparaître dans la liste, et vous revenez dans la communauté quand vous le souhaitez.</p>

                <a href="{{ url('register')}}" type="button" class="btn btn-perso">REJOIGNEZ-NOUS !</a>
            </div>

        @endauth

    </div>

@endsection
