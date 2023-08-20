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
                <h5 class="modal-title" id="addQrCodeModalLabel">Tambah QR Code Pegawai</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="fv-row mb-5">
                    <label class="d-block fw-bold fs-6 mb-2 required">Pilih Pegawai</label>
                    <select name="qrcode" id="qrcode" class="form-select" data-control="select2"
                        data-dropdown-parent="#addQrCodeModal" data-placeholder="Pilih Company">
                        <option></option>
                        @foreach ($pegawai as $pegawai)
                        <option value="{{ $pegawai->id }}">
                            {{ $pegawai->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="myclose">Close</button>
                <button type="button" class="btn bg-gradient-primary" id="submitQrCode">Beri Akses</button>
              </div>
        </div>
    </div>
</div>

  @include('content.js.lockers')
@endsection
