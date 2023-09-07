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
    <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card mb-3">
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="bar-chart" class="chart-canvas" height="170px"></canvas>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loker</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengguna</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aktivitas</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($locker1 as $item1)
                        <tr>
                          <td class="align-middle">
                            <div class="d-flex px-2">
                              <div>
                                <i class="ni ni-archive-2"></i>
                              </div>
                              <div class="my-auto">
                                <h6 class="mb-0 text-xs">{{ $item1->loker }}</h6>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item1->pegawai }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item1->date }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item1->time }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item1->activity }}</p>
                          </td>
                        </tr>
                        @endforeach
                        @foreach ($locker2 as $item2)
                        <tr>
                          <td class="align-middle">
                            <div class="d-flex px-2">
                              <div>
                                <i class="ni ni-archive-2"></i>
                              </div>
                              <div class="my-auto">
                                <h6 class="mb-0 text-xs">{{ $item2->loker }}</h6>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item2->pegawai }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item2->date }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item2->time }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item2->activity }}</p>
                          </td>
                        </tr>
                        @endforeach
                        @foreach ($locker3 as $item3)
                        <tr>
                          <td class="align-middle">
                            <div class="d-flex px-2">
                              <div>
                                <i class="ni ni-archive-2"></i>
                              </div>
                              <div class="my-auto">
                                <h6 class="mb-0 text-xs">{{ $item3->loker }}</h6>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item3->pegawai }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item3->date }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item3->time }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item3->activity }}</p>
                          </td>
                        </tr>
                        @endforeach
                        @foreach ($locker4 as $item4)
                        <tr>
                          <td class="align-middle">
                            <div class="d-flex px-2">
                              <div>
                                <i class="ni ni-archive-2"></i>
                              </div>
                              <div class="my-auto">
                                <h6 class="mb-0 text-xs">{{ $item4->loker }}</h6>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item4->pegawai }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item4->date }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item4->time }}</p>
                          </td>
                          <td class="align-middle">
                            <p class="text-xs font-weight-bold mb-0">{{ $item4->activity }}</p>
                          </td>
                        </tr>
                        @endforeach

                    </tbody>
                  </table>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('bar-chart').getContext('2d');
  var labels = {!! json_encode($labels) !!};
  var data = {!! json_encode($data) !!};

  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Penggunaan Terakhir(menit)',
        data: data,
        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang
        borderColor: 'rgba(75, 192, 192, 1)', // Warna border
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

@endsection
