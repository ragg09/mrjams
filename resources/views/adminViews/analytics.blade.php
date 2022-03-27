@extends('adminViews.layouts.master')

@section('title', 'Analytics')


@section('extraStyle')
    
@endsection


@section('content')
<header class="header header-sticky mb-4"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Analytics</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
        <div class="row">
          <div class="col ">
          {{-- class="col-sm-6 col-lg-3 --}}
              <div class="card mb-4 text-white bg-primary pb-3 align-items-center">
                  <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                      <div class="fs-4 fw-semibold">
                          Registered Users
                          <div id="linechartCustomer" style="width: 550px; height: 500px;"></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col">
              <div class="card mb-4 text-white bg-primary pb-3 align-items-center">
                  <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                      <div class="fs-4 fw-semibold">
                          Registered Clinics
                          <div id="linechartClinic" style="width: 550px; height: 500px;"></div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="card mb-4 align-items-center">
            <div class="card-body ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0"> Users</h4>
                </div>
                <div class="c-chart-wrapper">
                    <div id="linechartUsers"  style="width: 900px; height: 500px;"></div>
                </div>
            </div>
        </div>
        <div class="card mb-4 align-items-center">
            <div class="card-body ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0"> Appointments</h4>
                </div>
                <div class="c-chart-wrapper">
                    <div id="appPerMonth"  style="width: 900px; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div id="linechartUsers" style="width: 900px; height: 500px;"></div> --}}

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script>

@endsection
