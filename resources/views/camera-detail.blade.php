@extends('layouts.app')

@section('title', 'DETALLE CÁMARA')

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
                <div class="col text-left">
                    @if ($camera->type === 'I')
                        <a href="{{ route('showInternal') }}" class="btn btn-ciu btn-lg">REGRESAR</a>
                    @else
                        <a href="{{ route('showExternal') }}" class="btn btn-ciu btn-lg">REGRESAR</a>
                    @endif
                </div>
                <div class="col text-center">
                    <img src="{{ asset('images/ciu_logo.png') }}" alt="Logo CIU">
                </div>
                <div class="col"></div>
            </div>

            <h3>{{ ($camera->type === 'I') ? $camera->description.' - INTERNA' : $camera->description.' - EXTERNA' }}</h3>
            <hr>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-ciu active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">INCIDENCIAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-ciu" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">MANTENIMIENTOS PREVENTIVOS</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="mb-4"></div>
                    <table class="table table-striped">
                        @if (count($incidents) > 0)
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">DETALLE</th>
                                    <th scope="col">ACCIONES</th>
                                </tr>
                            </thead>
                        @else
                            <p>Aun no se han agregado incidencias.</p>
                        @endif
                        <tbody>
                            @foreach ($incidents as $index => $incident)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ date('m/d/Y', strtotime($incident->date)) }}</td>
                                    <td>{{ strtoupper($incident->detail) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('destroyIncident', ['id' => $incident->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <button type="button" class="btn-ciu" data-toggle="modal" data-target="#addIncidentsModalCenter">AGREGAR INCIDENCIA</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mb-4"></div>
                    <table class="table table-striped">
                        @if (count($maintenances) > 0)
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">DETALLE</th>
                                    <th scope="col">APLICADO</th>
                                    <th scope="col">ACCIONES</th>
                                </tr>
                            </thead>
                        @else
                            <p>Aun no se han agregado mantenimientos.</p>
                        @endif
                        <tbody>
                            @foreach ($maintenances as $index => $maintenance)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ date('m/d/Y', strtotime($maintenance->date)) }}</td>
                                    <td>{{ strtoupper($maintenance->detail) }}</td>
                                    <td>
                                        @if ($maintenance->applied)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input check-maintenance" applied="false" maintenanceId="{{ $maintenance->id }}" id="customCheck1" checked>
                                                <label class="custom-control-label" for="customCheck1"></label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input check-maintenance" applied="true" maintenanceId="{{ $maintenance->id }}" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1"></label>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('destroyMaintenance', ['id' => $maintenance->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <button type="button" class="btn-ciu" data-toggle="modal" data-target="#addMaintenanceModalCenter">AGREGAR MANTENIMIENTO</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Incidencias -->
    <div class="modal fade" id="addIncidentsModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCenterTitle">AGREGAR INCIDENCIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('saveIncident') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">FECHA</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="detail">DETALLE</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="DETALLE DE LA INCIDENCIA" required>
                        </div>

                        <input type="hidden" name="camera_id" value="{{ $camera->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                        <button type="submit" class="btn btn-ciu">GUARDAR</button>
                    </div>
                </form>
          </div>
        </div>
    </div>

    <!-- Modal mantenimientos -->
    <div class="modal fade" id="addMaintenanceModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCenterTitle">AGREGAR MANTENIMIENTO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('saveMaintenance') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">FECHA</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="detail">DETALLE</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="DETALLE DEL MANTENIMIENTO" required>
                        </div>

                        <input type="hidden" name="camera_id" value="{{ $camera->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                        <button type="submit" class="btn btn-ciu">GUARDAR</button>
                    </div>
                </form>
          </div>
        </div>
    </div>
@endsection