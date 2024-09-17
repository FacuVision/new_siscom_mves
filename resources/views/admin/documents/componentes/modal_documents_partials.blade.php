<form id="form_create_document">
    <div class="modal fade" id="md_create_document" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
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
                    <div class="alert alert-danger" id="alerta_create_documents" style="display: none;">
                        <ul class="m-0" id="lista-errores-documents-create"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}
                    <div class="form-group">

                        <div class="mb-3">
                            <label for="document_name" class="form-label">Nombre del tipo de documento</label>
                            <input autocomplete="off" type="text" class="form-control" name="name" id="document_name"
                                placeholder="Ingresa el Nombre del tipo de documento" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_create"
                        data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Registrar" id="bt_create_document" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>


{{-- MODAL DE EDICION --}}

<form id="form_edit_document">

    {{-- Hidden que almacena el id para hacer la edicion de la unidad orgánica --}}
    <input type="hidden" name="document_id" id="document_id">


    <div class="modal fade" id="md_edit_document" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar <span id="document_title" style="font-weight: bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_edit_documents" style="display: none;">
                        <ul class="m-0" id="lista-errores-documents-edit"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del tipo de documento</label>
                            <input autocomplete="off" type="text" class="form-control" name="name"
                                id="name_edit" placeholder="Nombre del tipo de documento" />
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_edit"
                        data-dismiss="modal">Cerrar</button>

                    <input type="submit" value="Actualizar" id="bt_edit_document" class="btn btn-primary">


                </div>
            </div>
        </div>
    </div>
</form>
