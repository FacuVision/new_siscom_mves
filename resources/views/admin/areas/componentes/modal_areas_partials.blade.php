{{-- MODAL DE CREACION --}}

<form id="form_create_area">
    <div class="modal fade" id="md_create_area" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar una Unidad Orgánica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_create_areas" style="display: none;">
                        <ul class="m-0" id="lista-errores-areas-create"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}
                    <div class="form-group">

                        <div class="mb-3">
                            <label for="area_name" class="form-label">Nombre</label>
                            <input autocomplete="off" type="text" class="form-control" name="name" id="area_name"
                                placeholder="Nombre de la Unidad Orgánica" />
                        </div>
                        <div class="mb-3">
                            <label for="sigla" class="form-label">Siglas</label>
                            <input autocomplete="off" type="text" class="form-control" name="sigla" id="area_sigla"
                                placeholder="Siglas de la Unidad Orgánica" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_create"
                        data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Registrar" id="bt_create_area" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>


{{-- MODAL DE EDICION --}}

<form id="form_edit_area">

    {{-- Hidden que almacena el id para hacer la edicion de la unidad orgánica --}}
    <input type="hidden" name="area_id" id="area_id">


    <div class="modal fade" id="md_edit_area" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar <span id="area_title" style="font-weight: bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_edit_areas" style="display: none;">
                        <ul class="m-0" id="lista-errores-areas-edit"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="area_name" class="form-label">Nombre</label>
                            <input autocomplete="off" type="text" class="form-control" name="name"
                            id="name_edit" placeholder="Nombre de la Unidad Orgánica" />
                        </div>
                        <div class="mb-3">
                            <label for="sigla" class="form-label">Siglas</label>
                            <input autocomplete="off" type="text" class="form-control" name="siglas_edit"
                                id="siglas_edit" placeholder="Siglas de la Unidad Orgánica" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_edit"
                        data-dismiss="modal">Cerrar</button>

                    <input type="submit" value="Actualizar" id="bt_edit_area" class="btn btn-primary">


                </div>
            </div>
        </div>
    </div>
</form>
