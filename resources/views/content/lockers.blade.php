@extends('layouts.main')

@section('container')
<nav aria-label="breadcrumb">
  <h4 class="font-weight-bolder mb-0">{{ $title }}</h4>
</nav>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="tableLoker" class="table align-items-center mb-0" style="width:100%" >
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Locker</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Locker</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QR Code</th>
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


  @include('content.js.lockers')
@endsection
