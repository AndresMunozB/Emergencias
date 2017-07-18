@extends('layouts.inicio')

@php ($pagina = 'quienes')

@section('title')
Inicio
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center" style="color: white">
            <h1>Nuestro equipo</h1>
            <h3>Diseño de bases de datos - Primer semestre 2017</h3>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img class="thumbnail-img image-responsive" src="{{ asset('images/alvarez.jpg') }}" alt="...">
                <div class="caption">
                    <h3>Mario Álvarez</h3>
                    <p>Full Stack Developer</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img class="thumbnail-img image-responsive" src="{{ asset('images/martinez.jpg') }}" alt="...">
                <div class="caption">
                    <h3>Juan Pablo Martínez</h3>
                    <p>Front-end Developer</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img class="thumbnail-img image-responsive" src="{{ asset('images/mellis.jpg') }}" alt="...">
                <div class="caption">
                    <h3>Diego Mellis</h3>
                    <p>Back-end Developer</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img class="thumbnail-img image-responsive" src="{{ asset('images/munoz.jpg') }}" alt="...">
                <div class="caption">
                    <h3>Andrés Muñoz</h3>
                    <p>Back-end Developer</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection