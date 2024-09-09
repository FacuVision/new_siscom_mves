{{-- ----- INICIALIZAR YAJRA-DATATABLES ############################################################ --}}

<script>
    let provider_table; // Declarar la variable en un ámbito más amplio
    let listaErrores = $("#lista-errores-providers-edit");
    let alerta_edit_providers = $("#alerta_edit_providers");
    let listaErroresCreate = $("#lista-errores-providers-create");
    let alerta_create_providers = $("#alerta_create_providers");

    function limpiarListaErrores() {
        listaErrores.empty();
        alerta_edit_providers.hide();
    }
    function limpiarListaErroresCreate() {
        listaErroresCreate.empty();
        alerta_create_providers.hide();
    }
    function cargar_lista_providers() {
        let lista_ajax = $('#providers-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                "lengthMenu": "Mostrando _MENU_ registros por pagina",
                "zeroRecords": "No hay registros, lo sentimos",
                "info": "Mostrando _PAGE_ de _PAGES_",
                "infoEmpty": "No hay datos",
                "infoFiltered": "(Filtrado de _MAX_ registros)",
                "search": "Buscar:",
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            },
            ajax: '{{ route('admin.providers.listar_providers') }}',
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'bussiness_name',
                    name: 'bussiness_name'
                },

                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ],
            pageLength: 50, // Aquí defines la cantidad de registros por página que deseas mostrar por defecto
            createdRow: function(row, data, dataIndex) {
                // Añadir clase CSS a la columna 'status' según el valor
                if (data.status == 'activo') {
                    $('td:eq(2)', row).addClass('badge badge-success');
                } else if (data.status == 'inactivo') {
                    $('td:eq(2)', row).addClass('badge badge-secondary');
                }
            }
        });
        return lista_ajax;
    }

    // ############################################################ Funcion incial para cargar el datatable por primera vez
    $(document).ready(function() {
        //ESTE TOKEC CSRF LO SOLICITA LA LIBRERIA YAJRA PARA PODER HACER EL ENVIO DE LA
        //PETICION Y LA RECEPCION DE LA MISMA
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        provider_table = cargar_lista_providers()
    });

    // ############################################################ Funcion Ocultar modal de creacion
    function hideModal() {
        $("#bussiness_name").val("");
        // Selecciona el botón por su id
        var close_create = $('#close_create');
        // Programáticamente dispara un evento de clic en el botón
        close_create.trigger('click');
    }
    // ############################################################ Funcion Ocultar modal de edicion
    function hideModalEdit() {
        $("#bussiness_name").val("");
        // Selecciona el botón por su id
        var close_edit = $('#close_edit');
        // Programáticamente dispara un evento de clic en el botón
        close_edit.trigger('click');
    }
    // ############################################################ Funcion Para limpiar el campo de creacion del modal
    $('#create_provider_buttom_modal').click(function(e) {
        limpiarListaErroresCreate();
    });
    // ############################################################ Funcion Crear
    $('#form_create_provider').on('submit', function(e) {
        limpiarListaErroresCreate();
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.providers.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                //console.log(formData);
                // Manejar la respuesta del servidor (opcional)
                provider_table.ajax.reload(); //recargar la tabla
                Swal.fire({
                    icon: "success",
                    title: "Éxito!",
                    text: "El proveedor ha sido registrado correctamente"
                });
                hideModal(); //ocultar modal de creacion
            },
            error: function(xhr) {
                //console.log(xhr);
                // Manejar errores (opcional)
                if (xhr.status === 422) { // 422 es el codigo utilizado para errores de validacion
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErroresCreate.append("<li>" + error + "</li>");
                    });
                    alerta_create_providers.show(); // Mostrar la alerta
                }
            }
        });
    });
    // ############################################################ Funcion Editar
    $('body').on('click', '#bt_provider_edit', function() {
        var id = $(this).data('id');
        limpiarListaErrores();

        $.ajax({
            type: 'GET',
            url: '{{ url('admin/providers', '') }}/' + id + '/edit',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response.siglas);
                //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION

                $("#provider_title").html(response[0].bussiness_name)
                $("#bussiness_name_edit").val(response[0].bussiness_name);
                $("#provider_id").val(id);
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    });
    // ############################################################ Funcion Actualizar
    //ajax para hacer la actualizacion enviado el formulario con los datos
    $('#form_edit_provider').on('submit', function(e) {
        limpiarListaErrores();
        e.preventDefault();
        let formData = $(this).serialize();
        let id = $("#provider_id").val();
        // console.log(formData);
        // console.log(id);
        $.ajax({
            type: 'PUT',
            url: '{{ url('admin/providers', '') }}/' + id,
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);
                // Muestra Sweet Alert con el mensaje de respuesta
                Swal.fire({
                    icon: "success",
                    title: "Éxito!",
                    text: "Registro actualizado correctamente"
                });
                provider_table.ajax.reload(); //recargar la tabla
                hideModalEdit(); //ocultar modal de edicion
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                //console.log(xhr);

                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErrores.append("<li>" + error + "</li>");
                    });
                    alerta_edit_providers.show(); // Mostrar la alerta
                }
                //console.error(xhr.responseText);
            }
        });
    });
    // ############################################################ Funcion Eliminar
    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"
    $("body").on("click", "#provider_delete", function() {
        var id = $(this).data('id');
        // Función para mostrar la ventana modal de confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Estas por desactivar una unidad Orgánica (Esta ya no se verá en los graficos)",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                // Si el usuario hace clic en "Sí, eliminarlo"
                // LOGICA DE ACTIVACION
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('admin/providers', '') }}/' + id,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        provider_table.ajax.reload(); //recargar la tabla
                        //console.log(response);
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });
                Swal.fire({
                    title: 'Desactivado',
                    text: 'El elemento ha sido desactivado.',
                    icon: 'success'
                })
            }
        });
    });
    // ############################################################ Funcion ACtivar Unidad Orgánica
    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"
    $("body").on("click", "#provider_activate", function() {
        var id = $(this).data('id');
        // LOGICA DE ACTIVACION
        // console.log(id);
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/providers', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                provider_table.ajax.reload(); //recargar la tabla
                Swal.fire({
                    title: "Activado",
                    text: "El proveedor ha sido activado",
                    icon: "success"
                });
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    });
    // ############################################################ Funcion Eliminar (DESACTIVAR)
    //ajax para desactivar las providers

    $("body").on("click", "#provider_delete", function() {
        var id = $(this).data('id');
        // Puedes realizar una solicitud AJAX para eliminar el registro o cualquier otra acción que necesites
        //e.preventDefault(); //NO ES NECESARIO ACTIVAR EL PREVENT DEFAULT CUANDO SE HACE UNA DESACTIVACION
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Si tu desactivas este proveedor, este no podrá visualizarse en el menu de creacion de comprobantes",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, desactívalo"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario hace clic en "Aceptar", ejecutamos la lógica de eliminación aquí
                //console.log(id);
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('admin/providers', '') }}/' + id,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);
                        provider_table.ajax.reload(); //recargar la tabla
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });
                Swal.fire({
                    title: "Desactivado",
                    text: "el proveedor ha sido desactivado",
                    icon: "success"
                });
            }
        });
        // Si el usuario hace clic en "Cancelar", no hacemos nada
        // Aquí puedes agregar cualquier otra acción que desees realizar si el usuario cancela
    });
</script>
