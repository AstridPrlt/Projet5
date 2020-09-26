@extends('layouts.public')

@section('title')
    Accueil
@endsection

@section('public_content')

    <div class="container-fluid vw-100" style="margin-top: 80px;">
        <div class="row bg-dark">
            <div class="col-5 bg-dark text-light align-self-center">
                <h2 class="text-uppercase">Un café pas comme les autres</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur inventore nihil veniam a consequuntur, repellat expedita omnis explicabo nemo ducimus exercitationem assumenda aperiam alias libero delectus qui ullam ad obcaecati?</p>
            </div>
            <img class="col-7 px-0" src="./../public/images/coffeeplace1.jpg" alt="">
        </div>

        <div class="row bg-light">
            <img class="col-7 px-0" src="./../public/images/events2.jpg" alt="">
            <div class="col-5 bg-light text-dark align-self-center">
                <h2 class="text-uppercase">Des évènements pour se développer</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic voluptatem voluptatum, labore iusto consequuntur maxime ea officia totam veniam, harum inventore non repudiandae, ducimus aperiam quas magni provident omnis fugit!</p>
            </div>
        </div>

        <div class="row bg-light">
            <div class="col-5 bg-light text-dark align-self-center">
                <h2 class="text-uppercase">Une communauté pour grandir</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic voluptatem voluptatum, labore iusto consequuntur maxime ea officia totam veniam, harum inventore non repudiandae, ducimus aperiam quas magni provident omnis fugit!</p>
            </div>
            <img class="col-7 px-0" src="./../public/images/community.jpg" alt="">
        </div>
    </div>

@endsection
