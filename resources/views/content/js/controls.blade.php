<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('input[type="checkbox"]').on('change', function() {
      var lockerId = $(this).data('id');
      var lockerStatus = $(this).prop('checked') ? 1 : 0;

      var checkbox = $('#status' + lockerId);
      checkbox.data('status', lockerStatus ? '1' : '0');
      checkbox.next('label').text(lockerStatus ? 'ON' : 'OFF');
      // Mengirim permintaan Ajax ke server untuk memperbarui status locker
      $.ajax({
        url: 'controls/' + lockerId,
        type: 'POST',
        data: {
          _method: 'PUT',
          status: lockerStatus
        },
        success: function(response) {
          console.log('Berhasil mengubah data pada server');
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
    });
        
    });
</script>