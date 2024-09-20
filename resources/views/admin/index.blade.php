@extends('adminlte::page')
@section('title', 'SISCOM 2.0')
@section('content_header')
    <h1 class="mb-2">Menú Principal</h1>
    <p>Bienvenido al Panel de Control de Siscom</p>
@stop
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                <div class="col">
                    <a href="{{ route('admin.users.index') }}">

                        <div class="info-box bg-info shadow-on-hover">
                            <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Usuarios</span>
                                <span class="info-box-number">{{ $conteo['unidades'] }} registros</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.areas.index') }}">
                        <div class="info-box bg-primary shadow-on-hover">
                            <span class="info-box-icon">
                                <i class="fas fa-cubes"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Unidades Orgánicas</span>
                                <span class="info-box-number">{{ $conteo['unidades'] }} registros</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.providers.index') }}">
                        <div class="info-box bg-olive shadow-on-hover ">
                            <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Proveedores</span>
                                <span class="info-box-number">{{ $conteo['proveedores'] }} registros</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('admin.contracts.index') }}">
                        <div class="info-box bg-purple shadow-on-hover">
                            <span class="info-box-icon"><i class="fas fa-university"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tipos de Contrato</span>
                                <span class="info-box-number">{{ $conteo['contratos'] }} registros</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.documents.index') }}">
                        <div class="info-box bg-maroon shadow-on-hover">
                            <span class="info-box-icon"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tipos de Documentos</span>
                                <span class="info-box-number">{{ $conteo['tipos_documentos'] }} registros </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <div class="info-box bg-gray shadow-on-hover ">
                        <span class="info-box-icon"><i class="fas fa-regular fa-address-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Historial</span>
                            <span class="info-box-number">10 registros</span>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="info-box bg-yellow shadow-on-hover ">
                        <span class="info-box-icon"><i class="fas fa-solid fa-clipboard"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Comprobantes de pago</span>
                            <span class="info-box-number">10 registros</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('css')

    @include('admin.partials.css_index')
@stop
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
