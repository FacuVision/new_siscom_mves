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
            ]
        });
    }
</script>

{{-- #################################################### --}}
