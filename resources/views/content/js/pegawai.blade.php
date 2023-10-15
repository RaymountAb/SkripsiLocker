<script>
    //const form = document.getElementById('formPegawai');
    // const form = document.getElementById('formeditPegawai');
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
            var pegawai_id = $(this).data('id');
            $.get("{{ route('pegawai.index') }}" + '/' + pegawai_id + '/edit', function(data) {
                $('#editBtn').val("edit pegawai");
                $('#modaleditPegawai').modal('show');
                $('#editpegawai_id').val(data.pegawai.id);
                $('#editpegawaidetail_id').val(data.pegawaidetail.id);
                $('#editusername').val(data.pegawai.username);
                $('#editnip').val(data.pegawai.nip);
                $('#editnama').val(data.pegawai.nama);

                var editjenis_kelamin = data.pegawaidetail.jenis_kelamin;
                if (editjenis_kelamin == '1') {
                    $('#editjenis_kelamin_true').prop('checked', true);
                } else {
                    $('#editjenis_kelamin_false').prop('checked', true);
                }

                $('#editno_hp').val(data.pegawaidetail.no_hp);
                $('#editalamat').val(data.pegawaidetail.alamat);
            });
        });

        // initialize btn save
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            var formData = new FormData($('#formPegawai')[0]);
            var pegawai_id = $('#pegawai_id').val();
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
        });

        $('#editBtn').click(function(e) {
            e.preventDefault();

            // Mengambil data dari elemen-elemen form
            var editusername = $('#editusername').val();
            var editnip = $('#editnip').val();
            var editnama = $('#editnama').val();
            var editjenis_kelamin = $('input[name="editjenis_kelamin"]:checked').val();
            var editno_hp = $('#editno_hp').val();
            var editalamat = $('#editalamat').val();
            var pegawai_id = $('#editpegawai_id').val();

            // Membuat objek JSON dari data
            var data = {
                editusername: editusername,
                editnip: editnip,
                editnama: editnama,
                editjenis_kelamin: editjenis_kelamin,
                editno_hp: editno_hp,
                editalamat: editalamat,
                //_token: $('meta[name="csrf-token"]').attr('content')
            };

            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                data: JSON.stringify(data),
                url: '/pegawai/' + pegawai_id,
                type: 'PUT',
                contentType: 'application/json', // Atur tipe konten menjadi JSON
                success: function(data) {
                    $('#formeditPegawai').trigger("reset");
                    $('#modaleditPegawai').modal('hide');
                    swal_success(data.message);
                    table.draw();
                },
                error: function(data) {
                    swal_error();
                    $('#editBtn').html('Save Changes');
                }
            });
        });






        $(function() {
            $('#myclose').click(function(e) {
                e.preventDefault();

                $('#modalPegawai').modal('hide')

            });
        });

        // initialize btn delete
        $('body').on('click', '.deletePegawai', function() {

            var pegawai_id = $(this).data("id");
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
                        url: "{{ route('pegawai.store') }}" + '/' +
                            pegawai_id,
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
