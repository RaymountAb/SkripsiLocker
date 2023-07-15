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
              <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modalPegawai" id="addData" >
                Tambah Pegawai
              </button>
            </div>
            <div class="card-body px-3 pt-4 pb-2">
              <div class="table-responsive p-0">
                <table id="tablePegawaidetail" class="table align-items-center mb-0" style="width:100%" >
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID User</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIP</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No HP</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:200px;">Aksi</th>
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

  <!--Modal Tambah Pegawai-->
  <div class="modal fade" id="modalPegawai" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="PegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
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
                      <input type="text" name="nama" class="form-control" id="nama"
                          placeholder="Nama Pegawai">
                </div>
                <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2 required">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                <input type="hidden" name="pegawai_id" id="pegawai_id" value="">
                <div class="fv-row mb-3 row">
                  <label class="d-block fw-bold fs-6 mb-2 col-4 ">Jenis Kelamin</label>
                  <fieldset id="jenis_kelamin" class="row ms-1 col-6">
                      <div class="form-check col-4 form-check-custom form-check-solid">
                          <input class="form-check-input" type="radio" name="jenis_kelamin" 
                          id="jenis_kelamin_true"
                          value="1" />
                          <label class="form-check-label" for="jenis_kelamin_true">
                              Laki-laki
                          </label>
                      </div>
                      <div class="form-check col-4 form-check-custom form-check-solid">
                          <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_false"
                              value="0" />
                          <label class="form-check-label" for="jenis_kelamin_false">
                              Perempuan
                          </label>
                      </div>
                  </fieldset>
              </div>
                <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2">No HP</label>
                      <input type="text" name="no_hp" class="form-control" id="no_hp"
                          placeholder="No hp">
                </div>
                <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat"
                            placeholder="Alamat Tempat Tinggal">
                </div>
            </div>
            <input type="hidden" name="pegawaidetail_id" id="pegawaidetail_id" value="">
            <input type="hidden" name="qrcode_id" id="qrcode_id" value="">
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="myclose">Close</button>
          <button type="button" class="btn bg-gradient-primary" id="saveBtn">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!--Modal edit Pegawai-->
  <div class="modal fade" id="modaleditPegawai" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="EditPegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formeditPegawai" name="formeditPegawai" class="form" action="#" autocomplete="off">
            <div class="form-group">
                <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2 required">NIP</label>
                    <input type="text" name="nip" class="form-control" id="editnip"
                        placeholder="NIP Pegawai">
                </div>
                <div class="fv-row mb-3">
                  <label class="d-block fw-bold fs-6 mb-2 required">Nama</label>
                      <input type="text" name="nama" class="form-control" id="editnama"
                          placeholder="Nama Pegawai">
                </div>
                <input type="hidden" name="pegawai_id" id="editpegawai_id" value="">
                <div class="fv-row mb-3 row">
                  <label class="d-block fw-bold fs-6 mb-2 col-4 ">Jenis Kelamin</label>
                  <fieldset id="jenis_kelamin" class="row ms-1 col-6">
                      <div class="form-check col-4 form-check-custom form-check-solid">
                          <input class="form-check-input" type="radio" name="editjenis_kelamin" 
                          id="editjenis_kelamin_true"
                          value="1" />
                          <label class="form-check-label" for="jenis_kelamin_true">
                              Laki-laki
                          </label>
                      </div>
                      <div class="form-check col-4 form-check-custom form-check-solid">
                          <input class="form-check-input" type="radio" name="editjenis_kelamin" id="jenis_kelamin_false"
                              value="0" />
                          <label class="form-check-label" for="editjenis_kelamin_false">
                              Perempuan
                          </label>
                      </div>
                  </fieldset>
              </div>
                <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2">No HP</label>
                      <input type="text" name="no_hp" class="form-control" id="editno_hp"
                          placeholder="No hp">
                </div>
                <div class="fv-row mb-3">
                <label class="d-block fw-bold fs-6 mb-2">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="editalamat"
                            placeholder="Alamat Tempat Tinggal">
                </div>
            </div>
            <input type="hidden" name="pegawaidetail_id" id="editpegawaidetail_id" value="">
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="myclose">Close</button>
          <button type="button" class="btn bg-gradient-primary" id="editBtn">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  @include('content.js.pegawai')
@endsection