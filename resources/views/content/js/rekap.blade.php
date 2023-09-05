<script>
    $('document').ready(function() {
        var table = $('#tableRekap').DataTable({
            processing: false,
            serverSide: true,
            ordering: false,
            //dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10', '25', '50', 'Semua']
            ],
            language: {
                "lengthMenu": "Tampilkan _MENU_ Data",
                "info": "Tampil _START_ sampai _END_ dari total _TOTAL_ data",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(di-filter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": ">>",
                    "last": "<<",
                    "next": ">",
                    "previous": "<"
                }
            },
            ajax: "{{ route('activity.index') }}",
            columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pegawai',
                        name: 'pegawai'
                    },
                    {
                        data: 'loker',
                        name: 'loker'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'}
                ]
            });

        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

    });
</script>
