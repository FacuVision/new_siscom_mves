{{-- ----- INICIALIZAR YAJRA-DATATABLES ############################################################ --}}

<script>
    let contract_table; // Declarar la variable en un ámbito más amplio
    let listaErrores = $("#lista-errores-contracts-edit");
    let alerta_edit_contracts = $("#alerta_edit_contracts");

    let listaErroresCreate = $("#lista-errores-contracts-create");
    let alerta_create_contracts = $("#alerta_create_contracts");

    function limpiarListaErrores() {
        listaErrores.empty();
        alerta_edit_contracts.hide();
    }

    function limpiarListaErroresCreate() {
        listaErroresCreate.empty();
        alerta_create_contracts.hide();
    }

    function cargar_lista_contracts() {
        let lista_ajax = $('#contracts-table').DataTable({
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
            ajax: '{{ route('admin.contracts.listar_contracts') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
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

        contract_table = cargar_lista_contracts();

    });





    // ############################################################ Funcion Ocultar modal de creacion
    function hideModal() {
        $("#contract_sigla").val("");
        $("#contract_name").val("");

        // Selecciona el botón por su id
        var close_create = $('#close_create');

        // Programáticamente dispara un evento de clic en el botón
        close_create.trigger('click');
    }

    // ############################################################ Funcion Ocultar modal de edicion
    function hideModalEdit() {
        $("#contract_sigla").val("");
        $("#contract_name").val("");

        // Selecciona el botón por su id
        var close_edit = $('#close_edit');

        // Programáticamente dispara un evento de clic en el botón
        close_edit.trigger('click');
    }


    // ############################################################ Funcion Para limpiar el campo de creacion del modal

    $('#create_contract_buttom_modal').click(function(e) {
        limpiarListaErroresCreate();
    });


    // ############################################################ Funcion Crear
    $('#form_create_contract').on('submit', function(e) {

        limpiarListaErroresCreate();
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route('admin.contracts.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);
                contract_table.ajax.reload(); //recargar la tabla

                Swal.fire({
                    icon: "success",
                    title: "Éxito!",
                    text: response
                });

                hideModal(); //ocultar modal de creacion
            },
            error: function(xhr) {

                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErroresCreate.append("<li>" + error + "</li>");
                    });
                    alerta_create_contracts.show(); // Mostrar la alerta
                }
            }
        });


    });


    // ############################################################ Funcion Editar

    $('body').on('click', '#bt_contract_edit', function() {

        var id = $(this).data('id');
        limpiarListaErrores();

        //console.log(id);

        $.ajax({
            type: 'GET',
            url: '{{ url('admin/contract_types', '') }}/' + id + '/edit',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response.siglas);
                //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION
                $("#contract_title").html(response.name)
                $("#contract_name_edit").val(response.name);
                $("#contract_id").val(id);
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    });


    // ############################################################ Funcion Actualizar
    //ajax para hacer la actualizacion enviado el formulario con los datos

    $('#form_edit_contract').on('submit', function(e) {

        limpiarListaErrores();
        e.preventDefault();

        let formData = $(this).serialize();
        let id = $("#contract_id").val();

        // console.log(formData);
        // console.log(id);

        $.ajax({
            type: 'PUT',
            url: '{{ url('admin/contract_types', '') }}/' + id,
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

                contract_table.ajax.reload(); //recargar la tabla

                hideModalEdit(); //ocultar modal de edicion
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErrores.append("<li>" + error + "</li>");
                    });
                    alerta_edit_contracts.show(); // Mostrar la alerta
                }

                //console.error(xhr.responseText);
            }
        });

    });





    // ############################################################ Funcion Eliminar

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"

    $("body").on("click", "#contract_delete", function() {

        var id = $(this).data('id');

        // Función para mostrar la ventana modal de confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Estas por desactivar este tipo de contrato (Esta ya no se mostrará en la emision de comprobates)",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '3085d6',
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.isConfirmed) {
                // Si el usuario hace clic en "Sí, eliminarlo"

                // LOGICA DE ELIMINACION
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('admin/contract_types', '') }}/' + id,
                    success: function(response) {
                        console.log(response);
                        // Manejar la respuesta del servidor (opcional)
                        contract_table.ajax.reload(); //recargar la tabla
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }

                });

                Swal.fire({
                    icon: "success",
                    title: "Éxito!",
                    text: "Registro desactivado correctamente"
                });
            }

        });


    });


    // ############################################################ Funcion ACtivar Unidad Orgánica

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"

    $("body").on("click", "#contract_activate", function() {

        var id = $(this).data('id');

        // Función para mostrar la ventana modal de confirmación

        // LOGICA DE ELIMINACION
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/contract_types', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'El elemento ha sido activado.',
                    'success'
                );
                contract_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }



        });

    });

    // ############################################################ Funcion ACtivar Unidad Orgánica

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"
    $("body").on("click", "#contract_activate", function() {
        var id = $(this).data('id');
        // LOGICA DE ACTIVACION
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/contracts', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'La Unidad ha sido activada',
                    'success'
                );
                contract_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    });

</script>
