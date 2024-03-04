@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1>Gestion de Unidades Orgánicas</h1>
    @include('admin.partials.css_datatables')

@stop

@section('content')


    <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p>


    <div class="card">

        <div class="card-header">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#md_create_area">
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('css')
@stop

@section('js')

    @include('admin.partials.js_datatables')

    @include('admin.areas.componentes.js_areas_partials')


    @include('admin.areas.componentes.modal_areas_partials')

        {{-- Modales --}}
        {{--
            md_create_area (creacion)
            md_edit_area (edicion)
        --}}




@stop
