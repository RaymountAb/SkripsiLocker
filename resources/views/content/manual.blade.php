@extends('layouts.main')

@section('container')
<nav aria-label="breadcrumb">
  <h4 class="font-weight-bolder mb-0">Control Manual</h4>
</nav>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table  class="table align-items-center mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Locker</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($lockers as $locker)
                            <tr>
                                <td>{{ $locker->id }}</td>
                                <td>{{ $locker->name_loker }}</td>
                                <td>
                                    <input class="form-check-input mt-1 ms-auto" type="checkbox" name="status" id="status{{ $locker->id }}" data-id="{{ $locker->id }}" {{ $locker->status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status{{ $locker->id }}">{{ $locker->status ? 'ON' : 'OFF' }}</label>
                                    {{--<button class="toggle-button" data-id="{{ $locker->id }}" data-status="{{ $locker->status ? '1' : '0' }}">
                                        {{ $locker->status ? 'ON' : 'OFF' }}
                                    </button>--}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <script>
    $(document).ready(function() {
        $(".toggle-button").click(function() {
            var id = $(this).data("id");
            var status = $(this).data("status");

            // Send the status update to the ESP32 using AJAX
            $.ajax({
                url: "/manual/" + id,
                type: "PUT",
                data: {
                    status: status == "1" ? 0 : 1
                },
                success: function(response) {
                    // Update the button text and data-status attribute
                    var button = $(".toggle-button[data-id='" + id + "']");
                    button.data("status", response.status ? '1' : '0');
                    button.text(response.status ? 'ON' : 'OFF');
                },
                error: function() {
                    alert("Error updating status");
                }
            });
        });
    });
</script>
  @include('content.js.lockers')
@endsection
