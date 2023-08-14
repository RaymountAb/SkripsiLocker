@extends('layouts.main')

@section('container')
<nav aria-label="breadcrumb">
  <h4 class="font-weight-bolder mb-0">{{ $title }}</h4>
</nav>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body px-3 pt-4 pb-2">
              <div class="table-responsive p-0">
                <table id="tableLoker" class="table align-items-center mb-0" style="width:100%" >
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Locker</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Locker</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QR Code</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hapus Akses</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Tambah QR Code -->
<div class="modal fade" id="addQrCodeModal" tabindex="-1" role="dialog" aria-labelledby="addQrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQrCodeModalLabel">Tambah QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddQrCode" data-locker-id="">
                    @csrf
                    <div class="form-group">
                        <label for="employeeSelect">Pilih Pegawai:</label>
                        <select class="form-control" id="employeeSelect" name="employee_id"></select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

  @include('content.js.lockers')
@endsection
