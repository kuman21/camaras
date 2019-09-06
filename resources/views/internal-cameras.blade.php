@extends('layouts.app')

@section('title', 'INTERNAS')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡BIEN HECHO!</strong> {{ strtoupper(session('success')) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
    @endif
    
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
                <div class="col text-center">
                    <a href="{{ route('showInternal') }}" class="btn btn-ciu btn-lg">INTERNAS</a>
                </div>
                <div class="col text-center">
                    <img src="{{ asset('images/ciu_logo.png') }}" alt="Logo CIU">
                </div>
                <div class="col text-center">
                    <a href="{{ route('showExternal') }}" class="btn btn-secondary btn-lg">EXTERNAS</a>
                </div>
            </div>

            <div class="card bg-ciu">
                <div class="row m-4">
                    @foreach ($cameras as $camera)
                        <div class="form-group col-4">
                            <a class="btn btn-ciu-light btn-block" href="{{ route('cameraDetail', ['id' => $camera->id]) }}">
                                <p>{{ $camera->description }}</p>
                                <img src="{{ asset($camera->image_path) }}" alt="{{ $camera->description }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
