<script>
    const form = document.getElementById('formPegawai');
    
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    /*let validator = FormValidation.formValidation(
    form, {
        fields: {
            'nip': {
                validators: {
                    notEmpty: {
                        message: 'NIP tidak boleh kosong'
                    }
                }
            },
            'nama': {
                validators: {
                    notEmpty: {
                        message: 'Nama tidak boleh kosong'
                    }
                }
            },
            'password': {
                validators: {
                    notEmpty: {
                        message: 'Password tidak boleh kosong'
                    }
                }
            }
        },
    
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    });*/
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
                title: 'Something goes wrong !',
                showConfirmButton: true,
            })
        }
        // table serverside
        var table = $('#tableQrcode').DataTable({
            processing: false,
            serverSide: true,
            info: false,
            order: false,
            paging: false,
            //dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            ajax: "{{ route('qrcode.index') }}",
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
                        data: 'qrcode',
                        name: 'qrcode',
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
            $('#qrcode_id').val('');
            $('#formPegawai').trigger("reset");
            $('#modal-pegawai').modal('show');
        });
        // initialize btn edit
        /*$('body').on('click', '.editUnit', function() {
            $.LoadingOverlay("show");
            var unit_id = $(this).data('id');
            $.get("{{ route('pegawai.index') }}" + '/' + unit_id + '/edit', function(data) {
                $('#saveBtn').val("edit-unit");
                $('#modal-unit').modal('show');
                $('#unit_id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
            })
            $.LoadingOverlay("hide");
        });*/
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
                                $('#modal-pegawai').modal('hide');
                                swal_success(data.message);
                                table.draw();
    
                            },
                            error: function(data) {
                                swal_error();
                                $('#saveBtn').html('Save Changes');
                            }
                        });
            /*if (validator) {
                validator.validate().then(function(status) {
                    if (status == 'Valid') {
                        $.ajax({
                            data: formData,
                            url: "{{ route('pegawai.store') }}",
                            type: "POST",
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                $('#formPegawai').trigger("reset");
                                $('#modal-pegawai').modal('hide');
                                swal_success(data.message);
                                table.draw();
    
                            },
                            error: function(data) {
                                swal_error();
                                $('#saveBtn').html('Save Changes');
                            }
                        });
                    }
                });
            }*/
            //$.LoadingOverlay("hide");
        });
        
        $(function() {
            $('#myclose').click(function(e) {
                e.preventDefault();
    
                $('#modal-pegawai').modal('hide')
    
            });
        });
    
        // initialize btn delete
        /*$('body').on('click', '.deleteUnit', function() {
            var unit_id = $(this).data("id");
            var name = $(this).data("name");
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('pegawai.store') }}" + '/' + unit_id,
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
                    $.LoadingOverlay("hide");
                }
            })
        });*/
    
        // statusing
    
    
    });
</script>