{{-- ----- INICIALIZAR YAJRA-DATATABLES ############################################################ --}}

<script>
    let user_table; // Declarar la variable en un ámbito más amplio
    let listaErrores = $("#lista-errores-users-edit");
    let alerta_edit_users = $("#alerta_edit_users");

    let listaErroresCreate = $("#lista-errores-users-create");
    let alerta_create_users = $("#alerta_create_users");

    function limpiarListaErrores() {
        listaErrores.empty();
        alerta_edit_users.hide();
    }

    function limpiarListaErroresCreate() {
        listaErroresCreate.empty();
        alerta_create_users.hide();
    }


    //CARGAR LOS ROLES DE ACCESO DEL SISTEMA
    function cargar_roles_de_acceso() {
        $.ajax({
            type: 'GET',
            url: '{{ route('admin.users.listar_roles') }}',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);

                var selectroles = $('#user_select_roles');
                selectroles.empty(); // Limpia cualquier opción previa
                response.forEach(function(rol) {
                    selectroles.append($('<option>', {
                        value: rol.name,
                        text: rol.name_detail
                    }));
                });
            },


            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    }

    function cargar_lista_users() {


        let lista_ajax = $('#users-table').DataTable({
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

            ajax: '{{ route('admin.users.listar_usuarios') }}',
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'lastname',
                    name: 'lastname'
                },
                {
                    data: 'n_document',
                    name: 'n_document'
                },
                {
                    data: 'document_type',
                    name: 'document_type'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'name_detail',
                    name: 'name_detail'
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
                    $('td:eq(5)', row).addClass('badge badge-success');
                } else if (data.status == 'inactivo') {
                    $('td:eq(5)', row).addClass('badge badge-secondary');
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

        user_table = cargar_lista_users();
    });





    // ############################################################ Funcion Ocultar modal de creacion
    function hideModal() {
        $("#user_sigla").val("");
        $("#user_name").val("");

        // Selecciona el botón por su id
        var close_create = $('#close_create');

        // Programáticamente dispara un evento de clic en el botón
        close_create.trigger('click');
    }

    // ############################################################ Funcion Ocultar modal de edicion
    function hideModalEdit() {
        $("#user_sigla").val("");
        $("#user_name").val("");

        // Selecciona el botón por su id
        var close_edit = $('#close_edit');

        // Programáticamente dispara un evento de clic en el botón
        close_edit.trigger('click');
    }


    // ############################################################ Funcion Para limpiar el campo de creacion del modal

    // $('#create_user_buttom_modal').click(function(e) {
    //     limpiarListaErroresCreate();
    //     cargar_roles_de_acceso();
    // });


    $('#create_user_buttom_modal').on('click', function(e) {
        limpiarListaErroresCreate();
        cargar_roles_de_acceso();
    });

    // ############################################################ Funcion Crear
    $('#form_create_user').on('submit', function(e) {

        limpiarListaErroresCreate();
        e.preventDefault();

        let formData = $(this).serialize();

        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '{{ route('admin.users.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);
                user_table.ajax.reload(); //recargar la tabla

                Swal.fire({
                    icon: "success",
                    title: "Éxito!",
                    text: 'Registro actualizado correctamente'
                });

                hideModal(); //ocultar modal de creacion
            },
            error: function(xhr) {

                console.log(xhr);


                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErroresCreate.append("<li>" + error + "</li>");
                    });
                    alerta_create_users.show(); // Mostrar la alerta
                }
            }
        });


    });


    // ############################################################ Funcion Editar

    $('body').on('click', '#bt_user_edit', function() {

        var id = $(this).data('id');
        limpiarListaErrores();

        //console.log(id);

        $.ajax({
            type: 'GET',
            url: '{{ url('admin/users', '') }}/' + id + '/edit',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)

                //console.log(response.siglas);
                //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION
                $("#user_title").html(response[0].name)
                $("#siglas_edit").val(response[0].siglas);
                $("#name_edit").val(response[0].name);
                $("#user_id").val(id);

            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    });




    // ############################################################ Funcion Actualizar
    //ajax para hacer la actualizacion enviado el formulario con los datos

    $('#form_edit_user').on('submit', function(e) {

        limpiarListaErrores();
        e.preventDefault();

        let formData = $(this).serialize();
        let id = $("#user_id").val();

        // console.log(formData);
        // console.log(id);

        $.ajax({
            type: 'PUT',
            url: '{{ url('admin/users', '') }}/' + id,
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

                user_table.ajax.reload(); //recargar la tabla

                hideModalEdit(); //ocultar modal de edicion
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErrores.append("<li>" + error + "</li>");
                    });
                    alerta_edit_users.show(); // Mostrar la alerta
                }

                //console.error(xhr.responseText);
            }
        });

    });


    // ############################################################ Funcion ACtivar Unidad Orgánica

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"

    $("body").on("click", "#user_activate", function() {

        var id = $(this).data('id');

        // Función para mostrar la ventana modal de confirmación

        // LOGICA DE ELIMINACION
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/users', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'El elemento ha sido activado.',
                    'success'
                );
                user_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }



        });

    });

    // ############################################################ Funcion Eliminar
    //ajax para desactivar las users

    $("body").on("click", "#user_delete", function() {


        var id = $(this).data('id');

        // Puedes realizar una solicitud AJAX para eliminar el registro o cualquier otra acción que necesites
        //e.preventDefault(); //NO ES NECESARIO ACTIVAR EL PREVENT DEFAULT CUANDO SE HACE UNA DESACTIVACION

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Si tu desactivas esta Unidad Orgánica, esta no podrá visualizarse en el menu de creacion de comprobantes",
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
                    url: '{{ url('admin/users', '') }}/' + id,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);
                        user_table.ajax.reload(); //recargar la tabla
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });

                Swal.fire({
                    title: "Desactivado",
                    text: "La unidad orgánica ha sido desactivada",
                    icon: "success"
                });
            }
        });

        // Si el usuario hace clic en "Cancelar", no hacemos nada
        // Aquí puedes agregar cualquier otra acción que desees realizar si el usuario cancela

    });


    // ############################################################ Funcion ACtivar Unidad Orgánica

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"
    $("body").on("click", "#user_activate", function() {
        var id = $(this).data('id');
        // LOGICA DE ACTIVACION
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/users', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'La Unidad ha sido activada',
                    'success'
                );
                user_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });
    });
</script>
