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
              <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal-pegawai" id="addData" >
                Tambah Pegawai
              </button>
            </div>
            <div class="card-body px-3 pt-3 pb-3">
              <div class="table-responsive p-0">
                <table id="tableQrcode" class="table align-items-center mb-0" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QRCode</th>
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

  @include('content.js.qrcode')


  <!-- Modal-->
<div class="modal fade" id="modal-pegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPegawaiLabel">Modal Pegawai</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPegawai" name="formPegawai" class="form" action="#" autocomplete="off">
          <div class="form-group">
              <div class="fv-row mb-3">
              <label class="d-block fw-bold fs-6 mb-2 required">NIP</label>
                  <input type="text" name="nip" class="form-control" id="nip"
                      placeholder="NIP Pegawai">
              </div>
              <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2 required">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Pegawai">
              </div>
              <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2 required">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              </div>
              <input type="hidden" name="pegawai_id" id="pegawai_id" value="">
              <input type="hidden" name="qrcode_id" id="qrcode_id" value="">
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="myclose">Close</button>
        <button type="button" class="btn bg-gradient-primary" id="saveBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection