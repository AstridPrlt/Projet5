@extends('layouts.public')

@section('title')
    Le lieu
@endsection

@section('public_content')

<div class="w-75 m-auto pt-3">

    <p class="mt-3">Situé au coeur de Paris, le Cowee est un coworking coffee. Vous venez avec votre ordinateur portable pour travailler, sans réservation, et nous on s'occupe du reste !</p>

    <p>Nous avons préparé tout ce qu'il faut pour vous permettre de travailler l'esprit tranquille :</p>

    <div class="d-md-flex">

        <div class="col-12 col-md-4 mx-auto">
            <div class="mb-3">
                <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-wifi" style="width: 100%" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.385 6.115a.485.485 0 0 0-.048-.736A12.443 12.443 0 0 0 8 3 12.44 12.44 0 0 0 .663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c2.507 0 4.827.802 6.717 2.164.204.148.489.13.668-.049z"/>
                    <path d="M13.229 8.271c.216-.216.194-.578-.063-.745A9.456 9.456 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.577 1.336c.205.132.48.108.652-.065zm-2.183 2.183c.226-.226.185-.605-.1-.75A6.472 6.472 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.408.19.611.09A5.478 5.478 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.611-.091l.015-.015zM9.06 12.44c.196-.196.198-.52-.04-.66A1.99 1.99 0 0 0 8 11.5a1.99 1.99 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .708 0l.707-.707z"/>
                </svg>
            </div>
            <h5 class="font-weight-bold text-uppercase text-center">Le top des équipements</h5>
            <p class="text-justify">Connexion wifi ultra-rapide, imprimante, scanner, câbles, etc. Oui, nous avons tout !</p>
        </div>
        <div class="col-12 col-md-4 mx-auto">
            <div class="mb-3">
                <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-cup-fill" style="width: 100%" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 2a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v1h.5A1.5 1.5 0 0 1 16 4.5v7a1.5 1.5 0 0 1-1.5 1.5h-.55a2.5 2.5 0 0 1-2.45 2h-8A2.5 2.5 0 0 1 1 12.5V2zm13 10h.5a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.5-.5H14v8z"/>
                </svg>
            </div>
            <h5 class="font-weight-bold text-uppercase text-center">Boissons et snacks à volonté</h5>
            <p class="text-justify">Des boissons chaudes et froides, des cafés préparés par notre barrista hors-pair, et des snacks pour les petits creux.</p>
        </div>
        <div class="col-12 col-md-4 mx-auto">
            <div class="mb-3">
                <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-clock-history" style="width: 100%" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                    <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </div>
            <h5 class="font-weight-bold text-uppercase text-center">Une totale flexibilité</h5>
            <p class="text-justify">Pour une heure, une journée ou un mois, vous êtes toujours bienvenu !</p>
        </div>
    </div>
</div>

<div>
    <div class="w-75 m-auto py-5">
        <h3>NOS TARIFS</h3>

        <div class="card-group text-center">
            <div class="card">
                <div class="card-header text-uppercase">à l'heure</div>
                <div class="card-body">
                    <p class="card-text">5 €</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-uppercase">à la journée</div>
            <div class="card-body">
                <p class="card-text">25 €</p>
            </div>
            </div>
            <div class="card">
                <div class="card-header text-uppercase">au mois</div>
            <div class="card-body">
                <p class="card-text">280 €</p>
            </div>
            </div>
        </div>
    </div>

</div>

<div class="w-75 m-auto">
    <p>Nous organisons aussi régulièrement des <a href="events" style="color: teal">évènements et des ateliers</a> pour vous aider à développer vos compétences, votre réseau, ou tout simplement pour se détendre. Sans parler de la super <a href="coweerkers" style="color: teal">communauté des coweerkers</a> !</p>

    <p class="text-center font-weight-bold mb-4" style="font-size: 1.5rem">Venez coweerker avec nous !</p>
</div>

@endsection
