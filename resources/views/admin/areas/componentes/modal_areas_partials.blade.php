<!-- Modal -->
{{-- {!! Form::open(['class' => 'form-horizontal', 'id' => 'form_ajax']) !!} --}}

<form action="" method="post">
    <div class="modal fade" id="md_create_area" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar una Unidad Orgánica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">

                        <div class="mb-3">
                            <label for="area_name" class="form-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="area_name"
                                placeholder="Nombre de la Unidad Orgánica"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="sigla" class="form-label">Siglas</label>
                            <input
                                type="text"
                                class="form-control"
                                name="sigla"
                                id="area_sigla"
                                placeholder="Siglas de la Unidad Orgánica"
                            />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_create"
                        data-dismiss="modal">Cerrar</button>
                    <button
                        id="bt_create_area"
                        type="submit"
                        class="btn btn-primary"
                    >
                        Registrar
                    </button>

                </div>
            </div>
        </div>
    </div>
</form>
