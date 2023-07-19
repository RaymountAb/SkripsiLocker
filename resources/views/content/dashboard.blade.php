@extends('layouts.main')

@section('container')
<nav aria-label="breadcrumb">
  <h2 class="font-weight-bolder mb-0">Dashboard</h2>
</nav>
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-4 col-sm-8 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Pegawai</p>
                  <h5 class="font-weight-bolder text-center mt-2 mb-0">
                    {{$jmlhpegawai}} Orang
                  </h5>
                </div>
              </div>
              <div class="col-4 text-center">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-8 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Loker Kosong</p>
                  <h5 class="font-weight-bolder text-center mt-2 mb-0">
                    {{$jmlhkosong}} dari {{$jmlhlocker}} Loker
                  </h5>
                </div>
              </div>
              <div class="col-4 text-center">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-collection text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4 text-center">
      <label>Hasil Baca QR Code</label>
      <div class="mb-3 text-center">
        <input class="text-center" type="text" placeholder="QrCodeResult" aria-label="QrCodeResult" value="<?php echo $qrcodeResult; ?>" readonly>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="d-flex flex-column h-100">
                  <p class="mb-1 pt-2 text-bold">Built by developers</p>
                  <h5 class="font-weight-bolder">Soft UI Dashboard</h5>
                  <p class="mb-5">From colors, cards, typography to complex elements, you will find the full documentation.</p>
                  <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                    Read More
                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                <div class="bg-gradient-primary border-radius-lg h-100">
                  <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                  <div class="position-relative d-flex align-items-center justify-content-center h-100">
                    <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/illustrations/rocket-white.png" alt="rocket">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card h-100 p-3">
          <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
            <span class="mask bg-gradient-dark"></span>
            <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
              <h5 class="text-white font-weight-bolder mb-4 pt-2">Work with the rockets</h5>
              <p class="text-white">Wealth creation is an evolutionarily recent positive-sum game. It is all about who take the opportunity first.</p>
              <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                Read More
                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection