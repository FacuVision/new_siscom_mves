@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gestion de Unidades Orgánicas</h1>
    {{-- Importamos los css de los datatables --}}
    @include('admin.partials.css_datatables')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p>
    <div class="card">
        <div class="card-header">
            <button type="button" id="create_area_buttom_modal" class="btn btn-success" data-toggle="modal" data-target="#md_create_area">
                Crear registro
            </button>
        </div>
        <div class="card-body">
            <table id="areas-table" class="table-striped dt-responsive nowrap display compact" style="width:100%">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Siglas</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Primero se definen los partials --}}
    @include('admin.areas.componentes.modal_areas_partials')
@stop

@section('css')

@stop

    @section('js')
        {{-- Segundo se definen las librerias --}}
        @include('admin.partials.js_datatables')
        {{-- Tercero se definen las funciones --}}
        @include('admin.areas.componentes.js_areas_partials')
        {{-- Modales --}}
        {{--
            md_create_area (creacion)
            md_edit_area (edicion)
        --}}
@stop
