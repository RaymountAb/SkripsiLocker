@extends('layouts.main')

@section('container')
<nav aria-label="breadcrumb">
  <h4 class="font-weight-bolder mb-0">Manual Control</h4>
</nav>
<div class="container-fluid py-4">
    <div class="row ">
      @foreach ($lockers as $locker)
        <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-8">
                  <h5 class="font-weight-bolder mb-0">
                    {{ $locker->name_loker }}
                  </h5>
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                  <div class="form-check form-switch ps-0 ">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" name="status" id="status{{ $locker->id }}" data-id="{{ $locker->id }}" data-status="{{ $locker->status ? '1' : '0' }}" {{ $locker->status ? 'checked' : '' }}>
                    <label class="form-check-label" for="status{{ $locker->id }}">{{ $locker->status ? 'ON' : 'OFF' }}</label>
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
        @endforeach
      </div>
</div>

@include('content.js.controls')
@endsection