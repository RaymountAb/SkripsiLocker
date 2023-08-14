<script>
    $('document').ready(function() {
        var table = $('#tableLoker').DataTable({
            processing: false,
            serverSide: true,
            //dom: 'Bfrtip',
            searching: false,
            info: false,
            order: false,
            paging: false,
            ajax: "{{ route('lockers.index') }}",
            columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name_loker',
                        name: 'name_loker'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'qrcode',
                        name: 'qrcode'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
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
