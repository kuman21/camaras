<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CÁMARAS - @yield('title', 'Titulo de la pagina')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/ciu_logo.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container container-ciu w-50 shadow">
        <nav class="navbar navbar-expand-md navbar-light bg-transparent">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ strtoupper(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#addCamerasModalCenter">
                                        AGREGAR CÁMARAS
                                    </button>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        CERRAR SESIÓN
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (count(Auth::user()->unreadNotifications) === 0)
                                        NOTIFICACIONES
                                    @else
                                        NOTIFICACIONES <span class="badge badge-danger">{{ count(Auth::user()->unreadNotifications) }}</span>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-header text-center">
                                        {{ count(Auth::user()->unreadNotifications) }} NOTIFICACIONES SIN LEER
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    @foreach (Auth::user()->unreadNotifications as $notification) 
                                            <a class="dropdown-item text-success" href="{{ route('cameraDetail', ['id' => $notification->data['camera_id'], 'notification_id' => $notification->id]) }}">
                                                Acción: {{ $notification->data['detail'] }}
                                            </a>
                                    @endforeach

                                    @foreach (Auth::user()->notifications as $notification) 
                                        <a class="dropdown-item" href="{{ route('cameraDetail', ['id' => $notification->data['camera_id'], 'notification_id' => $notification->id]) }}">
                                            Acción: {{ $notification->data['detail'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCamerasModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-ciu">
                    <h5 class="modal-title text-white" id="ModalCenterTitle">AGREGAR CÁMARAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('saveCamera') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description">DESCRIPCIÓN</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="DESCRIPCIÓN DE LA CÁMARA" required>
                        </div>

                        <div class="form-group">
                            <label for="type">TIPO DE CÁMARA</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="I">INTERNA</option>
                                <option value="E">EXTERNA</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                        <button type="submit" class="btn btn-ciu">GUARDAR</button>
                    </div>
                </form>
          </div>
        </div>
    </div>
</body>
</html>
