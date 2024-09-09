<form id="form_create_provider">
    <div class="modal fade" id="md_create_provider" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar una Nuevo Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_create_providers" style="display: none;">
                        <ul class="m-0" id="lista-errores-providers-create"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}
                    <div class="form-group">

                        <div class="mb-3">
                            <label for="bussiness_name" class="form-label">Nombre o Razon Social</label>
                            <input autocomplete="off" type="text" class="form-control" name="bussiness_name" id="bussiness_name"
                                placeholder="Ingresa el nombre o razon social" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_create"
                        data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Registrar" id="bt_create_provider" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>


{{-- MODAL DE EDICION --}}

<form id="form_edit_provider">

    {{-- Hidden que almacena el id para hacer la edicion de la unidad orgánica --}}
    <input type="hidden" name="provider_id" id="provider_id">


    <div class="modal fade" id="md_edit_provider" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar <span id="provider_title" style="font-weight: bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_edit_providers" style="display: none;">
                        <ul class="m-0" id="lista-errores-providers-edit"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="bussiness_name" class="form-label">Nombre o Razon Social</label>
                            <input autocomplete="off" type="text" class="form-control" name="bussiness_name"
                                id="bussiness_name_edit" placeholder="Nombre o Razon Social" />
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_edit"
                        data-dismiss="modal">Cerrar</button>

                    <input type="submit" value="Actualizar" id="bt_edit_provider" class="btn btn-primary">


                </div>
            </div>
        </div>
    </div>
</form>
