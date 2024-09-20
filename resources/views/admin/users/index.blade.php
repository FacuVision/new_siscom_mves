@extends('adminlte::page')
@section('title', 'SISCOM 2.0')


@section('content_header')
    {{-- <h1>Gestion de Unidades Orgánicas</h1> --}}
    {{-- Importamos los css de los datatables --}}
    @include('admin.partials.css_datatables')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
     {{-- <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p> --}}
     <div class="card card-outline card-info">
        <div class="card-header text-center">
            <i class="fas fa-cubes"></i>
            <strong>
                GESTION DE USUARIOS
            </strong>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" id="create_user_buttom_modal" class="btn btn-success" data-toggle="modal" data-target="#md_create_user">
                    Registrar un usuario
                </button>
            </div>

            <table id="users-table" class="table-striped table-hover dt-responsive nowrap display compact" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tipo de documento</th>
                        <th>Número de documento</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Primero se definen los partials --}}
    @include('admin.users.componentes.modal_users_partials')
@stop

@section('css')

@stop

    @section('js')
        {{-- Segundo se definen las librerias --}}
        @include('admin.partials.js_datatables')
        {{-- Tercero se definen las funciones --}}
        @include('admin.users.componentes.js_users_partials')
        {{-- Modales --}}
        {{--
            md_create_user (creacion)
            md_edit_user (edicion)
        --}}
@stop
