{{-- ----- INICIALIZAR YAJRA-DATATABLES ########################### --}}

<script>
    //SE CREA UNA FUNCION QUE EJECUTE AL INICIAR EL INDEX. LA FUNCION SE DESARROLLA MAS ABAJO
    $(document).ready(function() {
        cargar_lista_areas()
    });



    function cargar_lista_areas() {
        $('#areas-table').DataTable({
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
    }
</script>

{{-- #################################################### --}}



{{-- ############ CREACION DE UNIDADES ORGÁNICAS (STORE) --}}

<script>
    $('#form_ajax').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route('admin.categories.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                console.log(response);
                table.ajax.reload(); //recargar la tabla

            },
            error: function(xhr) {
                // Manejar errores (opcional)
                console.error(xhr.responseText);
            }
        });

        hideModal(); //ocultar modal de creacion
    });
</script>

{{-- ######################## --}}
