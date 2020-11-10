@extends('layouts.public')

@section('title')
    La communauté
@endsection

@section('public_content')
    <div class="m-5">

        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis autem, minima voluptates voluptas, expedita consectetur vel quia cupiditate porro aut facere provident dignissimos. Rerum repellendus voluptatum ex! A, numquam perspiciatis.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, quas temporibus, magni unde reprehenderit rem excepturi totam in odit nemo perferendis, tempore itaque molestias mollitia maiores nulla necessitatibus fugit? Nam.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ullam libero porro rem? Quae, nihil! Excepturi dolorem mollitia vel, modi at quo voluptatibus pariatur dolorum incidunt nisi tempore obcaecati consectetur?</p>

        <div>
            <users-list-component :list-of-users="{{ $listOfUsers }}"></users-list-component>
        </div>
    </div>

@endsection
