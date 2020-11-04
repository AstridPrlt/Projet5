@extends('layouts.public')

@section('title')
    Accueil
@endsection

@section('public_content')

    <div class="w-100">
        <div class="d-sm-flex bg-dark">
            <div class="col-12 col-sm-7 col-md-5 bg-dark text-light align-self-center">
                <h2 class="text-uppercase pt-3">Un café pas comme les autres</h2>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur inventore nihil veniam a consequuntur, repellat expedita omnis explicabo nemo ducimus exercitationem assumenda aperiam alias libero delectus qui ullam ad obcaecati?</p>
                <div class="text-right">
                    <a href="details" class="text-light">Découvrir</a>
                    <svg width="1em" height="1em" style="font-size: 1.5rem;" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                </div>
            </div>
            <img class="col-12 col-sm-5 col-md-7 px-0" src="./../public/images/coffeeplace1.jpg" alt="Photo du café">
        </div>

        <div class="d-sm-flex flex-sm-row-reverse bg-light">
            <div class="col-12 col-sm-7 col-md-5 bg-light text-dark align-self-center">
                <h2 class="text-uppercase pt-3">Des évènements pour se développer</h2>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic voluptatem voluptatum, labore iusto consequuntur maxime ea officia totam veniam, harum inventore non repudiandae, ducimus aperiam quas magni provident omnis fugit!</p>
                <div class="text-right">
                    <a href="events">Participer</a>
                    <svg width="1em" height="1em" style="font-size: 1.5rem;" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                </div>
            </div>
            <img class="col-12 col-sm-5 col-md-7 px-0" src="./../public/images/events2.jpg" alt="Photo d'un évènement">
        </div>

        <div class="d-sm-flex bg-light">
            <div class="col-12 col-sm-7 col-md-5 bg-light text-dark align-self-center">
                <h2 class="text-uppercase pt-3">Une communauté pour grandir</h2>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic voluptatem voluptatum, labore iusto consequuntur maxime ea officia totam veniam, harum inventore non repudiandae, ducimus aperiam quas magni provident omnis fugit!</p>
                <div class="text-right">
                    <a href="coweerkers">Rejoindre</a>
                    <svg width="1em" height="1em" style="font-size: 1.5rem;" viewBox="0 0 16 16" class="bi bi-arrow-right m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                </div>
            </div>
            <img class="col-12 col-sm-5 col-md-7 px-0" src="./../public/images/community.jpg" alt="Photo de la communauté">
        </div>
    </div>

@endsection
