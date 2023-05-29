@extends('layouts.main')

@section('container')
<nav aria-label="breadcrumb">
  <h4 class="font-weight-bolder mb-0">Manual Control</h4>
</nav>
<div class="container-fluid py-4">
    <div class="row ">
        <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-8">
                  <h5 class="font-weight-bolder mb-0">
                    Loker 1
                  </h5>
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                    <div class="form-check form-switch ps-0 ">
                      <input class="form-check-input mt-1 ms-auto " type="checkbox" name="lokercontrol1" id="lokercontrol1" onchange="changestatus1(this.checked)">
                      <label class="form-check-label" for="lokercontrol1"><span id="status1">OFF</span></label>
                    </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-8">
                  <h5 class="font-weight-bolder mb-0">
                    Loker 2
                  </h5>
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                  <div class="form-check form-switch ps-0 ">
                    <input class="form-check-input mt-1 ms-auto " type="checkbox" id="lokercontrol2" onchange="changestatus2(this.checked)">
                    <label class="form-check-label" for="lokercontrol2"><span id="status2">OFF</span></label>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-8">
                  <h5 class="font-weight-bolder mb-0">
                    Loker 3
                  </h5>
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                  <div class="form-check form-switch ps-0 ">
                    <input class="form-check-input mt-1 ms-auto " type="checkbox" id="lokercontrol3" onchange="changestatus3(this.checked)">
                    <label class="form-check-label" for="lokercontrol3"><span id="status3">OFF</span></label>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-8">
                  <h5 class="font-weight-bolder mb-0">
                    Loker 4
                  </h5>
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                  <div class="form-check form-switch ps-0 ">
                    <input class="form-check-input mt-1 ms-auto " type="checkbox" id="lokercontrol4" onchange="changestatus4(this.checked)">
                    <label class="form-check-label" for="lokercontrol4"><span id="status4">OFF</span></label>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

@include('content.js.controls')
@endsection