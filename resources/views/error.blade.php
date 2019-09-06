@extends('layouts.app')

@section('title', 'ERROR 404')

@section('content')    
    <div class="card-ciu bg-transparent">
        <div class="card-body bg-ciu-light">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <h4 class="text-center text-ciu">SISTEMA DE VIDEO VIGILANCIA</h4>
                </div>
                <div class="col"></div>
            </div>
            
            <div class="row">
                <div class="col"></div>
                <div class="col text-center">
                    <img src="{{ asset('images/ciu_logo.png') }}" alt="Logo CIU">
                </div>
                <div class="col"></div>
            </div>

            <div class="card bg-ciu">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h1 class="text-ciu-yellow fs-100 text-center">404</h1>
                        </div>
                        <div class="col-8">
                            <h3 class="text-white">¡UY! PÁGINA NO ENCONTRADA.</h3>
                            <p class="text-white">
                                NO PUDIMOS ENCONTRAR LA PÁGINA QUE ESTABAS BUSCANDO. MIENTRAS TANTO, PUEDES REGRESAR AL <a class="text-ciu-yellow" href="{{ route('showInternal') }}">INICIO</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection