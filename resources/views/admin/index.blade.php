@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1 class="mb-2">Menú Principal</h1>
    <p>Bienvenido al Panel de Control de Siscom</p>
@stop
@section('content')

    <div class="card">
        <div class="card-body">
            <div>
                <div class="row">

                    <div class="col">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Unidades Orgánicas</h3>
                                <p>10 registros</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cubes"></i>
                            </div>
                            <a href="{{ route('admin.areas.index') }}" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>Proveedores</h3>
                                <p>150 registros</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Usuarios</h3>
                                <p>03 registros</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>Tipos de Contrato</h3>
                                <p>100 registros</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-solid fa-briefcase"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>Historial</h3>
                                <p>136 registros</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-regular fa-address-book"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3>Comprobantes de pago</h3>
                                <p>70 registros</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-solid fa-clipboard"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </div>




@stop
@section('css')
@stop
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
