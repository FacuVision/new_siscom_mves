{{-- ----- INICIALIZAR YAJRA-DATATABLES ############################################################ --}}

<script>
    let area_table; // Declarar la variable en un ámbito más amplio
    let listaErrores = $("#lista-errores-areas-edit");
    let alerta_edit_areas = $("#alerta_edit_areas");

    function limpiarListaErrores() {
        listaErrores.empty();
        alerta_edit_areas.hide();
    }

    function cargar_lista_areas() {
        let lista_ajax = $('#areas-table').DataTable({
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
            ajax: '{{ route('admin.areas.listar_areas') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'siglas',
                    name: 'siglas'
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
                    $('td:eq(3)', row).addClass('badge badge-success');
                } else if (data.status == 'inactivo') {
                    $('td:eq(3)', row).addClass('badge badge-secondary');
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

        area_table = cargar_lista_areas()
    });





    // ############################################################ Funcion Ocultar modal de creacion
    function hideModal() {
        $("#area_sigla").val("");
        $("#area_name").val("");

        // Selecciona el botón por su id
        var close_create = $('#close_create');

        // Programáticamente dispara un evento de clic en el botón
        close_create.trigger('click');
    }

    // ############################################################ Funcion Ocultar modal de edicion
    function hideModalEdit() {
        $("#area_sigla").val("");
        $("#area_name").val("");

        // Selecciona el botón por su id
        var close_edit = $('#close_edit');

        // Programáticamente dispara un evento de clic en el botón
        close_edit.trigger('click');
    }



    // ############################################################ Funcion Crear
    $('#form_create_area').on('submit', function(e) {

        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route('admin.areas.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);
                area_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });

        hideModal(); //ocultar modal de creacion
    });


    // ############################################################ Funcion Editar

    $('body').on('click', '#bt_area_edit', function() {

        var id = $(this).data('id');
        limpiarListaErrores();

        //console.log(id);

        $.ajax({
            type: 'GET',
            url: '{{ url('admin/areas', '') }}/' + id + '/edit',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)

                //console.log(response.siglas);
                //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION
                $("#area_title").html(response[0].name)
                $("#siglas_edit").val(response[0].siglas);
                $("#name_edit").val(response[0].name);
                $("#area_id").val(id);

            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    });




    // ############################################################ Funcion Actualizar
    //ajax para hacer la actualizacion enviado el formulario con los datos

    $('#form_edit_area').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let id = $("#area_id").val();

        // console.log(formData);
        // console.log(id);

        $.ajax({
            type: 'PUT',
            url: '{{ url('admin/areas', '') }}/' + id,
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);

                // Muestra Sweet Alert con el mensaje de respuesta

                Swal.fire({
                    type: "success",
                    title: "Éxito!",
                    text: response
                });

                area_table.ajax.reload(); //recargar la tabla

                limpiarListaErrores();
                hideModalEdit(); //ocultar modal de edicion
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErrores.append("<li>" + error + "</li>");
                    });
                    alerta_edit_areas.show(); // Mostrar la alerta
                }

                //console.error(xhr.responseText);
            }
        });

    });





    // ############################################################ Funcion Eliminar

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"

    $("body").on("click", "#area_delete", function() {

        var id = $(this).data('id');

        // Función para mostrar la ventana modal de confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Estas por desactivar una unidad Orgánica (Esta ya no se verá en los graficos)",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.value) {
                // Si el usuario hace clic en "Sí, eliminarlo"

                // LOGICA DE ELIMINACION
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('admin/areas', '') }}/' + id,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        area_table.ajax.reload(); //recargar la tabla
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }

                });

                Swal.fire(
                    'Desactivado',
                    'El elemento ha sido desactivado.',
                    'success'
                )
            }

        });


    });


    // ############################################################ Funcion ACtivar Unidad Orgánica

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"

    $("body").on("click", "#area_activate", function() {

        var id = $(this).data('id');

        // Función para mostrar la ventana modal de confirmación

        // LOGICA DE ELIMINACION
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/areas', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'El elemento ha sido activado.',
                    'success'
                );
                area_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }



        });

    });
</script>
