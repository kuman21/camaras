@extends('layouts.app')

@section('title', 'INICIO DE SESIÓN')

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
                <div class="col text-center">
                    <img src="{{ asset('images/ciu_logo.png') }}" alt="Logo CIU">
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card bg-login">
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-center">
                                    <img src="{{ asset('images/user_bnc.png') }}" alt="Logo usuario">
                                </div>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="text-white">USUARIO</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="INTRODUCIR USUARIO" required utocomplete="email" autofocus>
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ strtoupper($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-white">CONTRASEÑA</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"  name="password" placeholder="INTRODUCIR CONTRASEÑA" required autocomplete="current-password">
                                
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ strtoupper($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-ciu-dark">INICIAR SESIÓN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
@endsection
