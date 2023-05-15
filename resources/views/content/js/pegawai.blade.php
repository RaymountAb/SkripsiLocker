<script>
    const form = document.getElementById('formPegawai');
    $('document').ready(function() {
        // success alert
        function swal_success(message) {
            Swal.fire({
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 2000
            })
        }
        // error alert
        function swal_error() {
            Swal.fire({
                icon: 'error',
                title: 'Ada yang salah !',
                showConfirmButton: true,
            })
        }
        // table serverside
        var table = $('#tablePegawaidetail').DataTable({
            processing: false,
            serverSide: true,
            ordering: false,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            language: {
                "lengthMenu": "Tampilkan _MENU_ baris",
                "info": "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(di-filter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "<<",
                    "last": ">>",
                    "next": "<",
                    "previous": ">"
                }
            },
            ajax: "{{ route('pegawai.index') }}",
            columns: [{ 
                data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'pegawai_nip',
                    name: 'pegawai_nip'
                },
                {
                    data: 'pegawai_nama',
                    name: 'pegawai_nama'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
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
        // initialize btn add
        $('#createNewPegawai').click(function() {
            $('#saveBtn').val("create pegawai");
            $('#pegawai_id').val('');
            $('#pegawaidetail_id').val('');
            $('#qrcode_id').val('');
            $('#formPegawai').trigger("reset");
            $('#modalPegawai').modal('show');
        });
        // initialize btn edit
        $('body').on('click', '.editPegawai', function() {
            //$.LoadingOverlay("show");
            var pegawaidetail_id = $(this).data('id');
            var pegawai_id = $(this).data('pegawai');
            $.get("{{ route('pegawai.index') }}" + '/' + pegawaidetail_id + '/edit', function(data) {
                $('#editBtn').val("edit-pegawai");
                $('#modaleditPegawai').modal('show');
                $('#pegawai_id').val(data.pegawai);
                $('#pegawaidetail_id').val(data.id);
                $('#nama').val(data.nama);

            })
            //$.LoadingOverlay("hide");
        });
        // initialize btn save
        $('#saveBtn').click(function(e) {
            //$.LoadingOverlay("show");
            e.preventDefault();
            var frm = $('#formPegawai');
            var formData = new FormData(frm[0]);
            $.ajax({
                            data: formData,
                            url: "{{ route('pegawai.store') }}",
                            type: "POST",
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                $('#formPegawai').trigger("reset");
                                $('#modalPegawai').modal('hide');
                                swal_success(data.message);
                                table.draw();
    
                            },
                            error: function(data) {
                                swal_error();
                                $('#saveBtn').html('Save Changes');
                            }
                        });
            //$.LoadingOverlay("hide");
        });

        $(function() {
            $('#myclose').click(function(e) {
                e.preventDefault();

                $('#modalPegawai').modal('hide')

            });
        });

        // initialize btn delete
        $('body').on('click', '.deletePegawai', function() {
           
            var pegawai_id = $(this).data("pegawai");
            var name = $(this).data("nama");

            Swal.fire({
                title: 'Apa Anda yakin?',
                text: "Anda tidak dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //$.LoadingOverlay("show");
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('pegawai.store') }}" + '/'
                         + pegawai_id,
                        success: function(data) {

                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            table.draw();
                        },
                        error: function(data) {
                            swal_error();
                        }
                    });
                    //$.LoadingOverlay("hide");
                }
            })
        });

        // statusing


    });
</script>
