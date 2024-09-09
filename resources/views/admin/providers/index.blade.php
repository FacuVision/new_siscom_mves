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
    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <i class="fas fa-shopping-cart"></i>

            <strong>
                GESTION DE PROVEEDORES
            </strong>
        </div>
        <div class="card-body">

            <div class="mb-3">
                <button type="button" id="create_provider_buttom_modal" class="btn btn-success" data-toggle="modal" data-target="#md_create_provider">
                    Crear registro
                </button>
            </div>

            <table id="providers-table" class="table-striped table-hover dt-responsive nowrap display compact" style="width:100%">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Proveedor</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Primero se definen los partials --}}
    @include('admin.providers.componentes.modal_providers_partials')
@stop

    @section('css')

    @stop

    @section('js')
            {{-- Segundo se definen las librerias --}}
            @include('admin.partials.js_datatables')
            {{-- Tercero se definen las funciones --}}
            @include('admin.providers.componentes.js_providers_partials')
            {{-- Modales --}}
            {{--
                md_create_area (creacion)
                md_edit_area (edicion)
            --}}
    @stop