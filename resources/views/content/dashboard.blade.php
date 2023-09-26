@extends('layouts.main')

@section('container')
    <nav aria-label="breadcrumb">
        <h2 class="font-weight-bolder mb-0">Dashboard</h2>
    </nav>
    <div class="container-fluid py-4 ">
        <div class="row">
            <div class="col-xl-4 col-sm-8 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Pegawai</p>
                                    <h5 class="font-weight-bolder text-center mt-2 mb-0">
                                        {{ $jmlhpegawai }} Orang
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
                                        {{ $jmlhkosong }} / {{ $jmlhlocker }} Loker
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
        <div class="row mt-4 ">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card mb-3">
                    <div class="card-header text-center">
                        <h5 class="card-title">Penggunaan Terakhir</h5>
                    </div>
                    <div class="card-body p-2">
                        <div class="chart">
                            <canvas id="bar-chart" class="chart-canvas" height="150px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card h-100 p-3">
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                        style="background-image: url('../assets/img/locker-image.jpg');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                            <h5 class="text-white font-weight-bolder mb-4 pt-2">E-Locker Pegawai</h5>
                            <p class="text-white">E-locker pegawai adalah sistem penyimpanan barang pribadi pegawai yang
                                menggunakan teknologi digital. Sistem ini memanfaatkan locker atau loker yang dilengkapi
                                dengan sistem kunci digital berupa QR code sebagai autentikasi pada loker. E-locker pegawai
                                dapat menjadi solusi yang tepat untuk meningkatkan keamanan dan kenyamanan karyawan dalam
                                menyimpan barang pribadi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
            <div class="col-lg-10 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title">Riwayat Terakhir</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loker</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengguna</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Waktu</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aktivitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locker1->concat($locker2)->concat($locker3)->concat($locker4) as $item)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex px-2">
                                                <div>
                                                    <i class="ni ni-archive-2"></i>
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">{{ $item->loker }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->pegawai }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->date }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->time }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @switch($item->activity)
                                                    @case(1)
                                                        Tambah Akses
                                                        @break
                                                    @case(2)
                                                        Titip Barang
                                                        @break
                                                    @case(3)
                                                        Akhiri Akses
                                                        @break
                                                    @default
                                                        Tindakan Tidak Dikenali
                                                @endswitch
                                            </p>
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
                    backgroundColor: 'rgba(75, 192, 192, 1)', // Warna latar belakang
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
