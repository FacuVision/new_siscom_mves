{{-- ----- INICIALIZAR YAJRA-DATATABLES ########################### --}}

<script>
    let area_table; // Declarar la variable en un ámbito más amplio

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

        });

        return lista_ajax;
    }


    // ########################## Funcion inciial para cargar el datatable por primera vez
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





    // ########################## Funcion Ocultar modal de creacion
    function hideModal() {
        $("#area_sigla").val("");
        $("#area_name").val("");

        // Selecciona el botón por su id
        var close_create = $('#close_create');

        // Programáticamente dispara un evento de clic en el botón
        close_create.trigger('click');
    }



    // ########################## Funcion Crear
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





    // ########################## Funcion Editar

    $('body').on('click', '#bt_area_edit', function() {

        var id = $(this).data('id');

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
</script>
