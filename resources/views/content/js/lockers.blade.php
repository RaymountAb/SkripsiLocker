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

        // delete Akses
        $('body').on('click', '.deleteLocker', function () {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Ini akan menghapus data akses locker ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('lockers.deleteAkses', ':id') }}".replace(':id', id),
                        type: "PATCH", // Use PATCH request for updating
                        data: {
                            _token: '{{ csrf_token() }}' // Add CSRF token if not already included
                        },
                        success: function (data) {
                            table.draw();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Akses Berhasil dihapus!'
                            })
                        },
                        error: function (data) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi Kesalahan!'
                            })
                        }
                    })
                }
            })
        })
    });
</script>
