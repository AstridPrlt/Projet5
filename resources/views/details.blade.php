@extends('layouts.public')

@section('title')
    Le lieu
@endsection

@section('public_content')

<div class="w-75 m-auto pt-3">
    <p>Au Cowee, nous avons préparé tout ce qu'il faut pour vous permettre de travailler l'esprit tranquille</p>

    <div class="d-md-flex">
        <div>
            <h5 class="font-weight-bold text-uppercase text-center">Le top des équipements</h5>
            <p class="text-center">Connexion wifi ultra-rapide, imprimante, scanner, câbles, etc. Oui, nous avons tout !</p>
        </div>
        <div>
            <h5 class="font-weight-bold text-uppercase text-center">Boissons et snacks à volonté</h5>
            <p class="text-center">Des boissons chaudes et froides, des cafés préparés par un barrista, et des snacks pour les petits creux.</p>
        </div>
        <div>
            <h5 class="font-weight-bold text-uppercase text-center">Une totale flexibilité</h5>
            <p class="text-center">Pour une heure, une journée ou un mois, vous êtes toujours bienvenu !</p>
        </div>
    </div>
</div>

<div>
    <div class="w-75 m-auto py-5">
        <h3>NOS TARIFS</h3>

        <div class="card-group">
            <div class="card">
                <div class="card-header text-uppercase">à l'heure</div>
                <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-uppercase">à la journée</div>
            <div class="card-body">
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            </div>
            </div>
            <div class="card">
                <div class="card-header text-uppercase">au mois</div>
            <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to</p>
            </div>
            </div>
        </div>
    </div>

</div>

@endsection
