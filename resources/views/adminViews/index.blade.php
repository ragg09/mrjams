@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Home')


@section('extraStyle')
    
@endsection


@section('content')
{{-- {{$regUser}} --}}

@if ($status == 0)
    <h1>Error</h1>
    
@else
    
<header class="header header-sticky mb-2 mt-5" id="header_id"> 
    <div class="container-fluid" >
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2" style="background-color: #B3CDE0">
                <li class="breadcrumb-item" style="margin-left: 20px;">
                    <span>Home</span>
                </li>
                <li class="breadcrumb-item active">
                    <span>Dashboard</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3" id="content_body">
    <div class="container-lg">
        {{-- <a href="{{ route('admin.reportDashboard.index') }}" >Print Report</a>
        <a href="#" onclick="window.print()" >Print </a> --}}
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            {{-- <i class="icon-user success font-large-2 float-right"></i> --}}
                            <i class="fa fa-user fa-4x" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                          <h3>{{$regUser}}</h3>
                          <span>Registered Users</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            {{-- <i class="bi bi-hospital success font-large-2 float-left"></i> --}}
                            <i class="fa fa-user-md fa-4x" aria-hidden="true"></i>
                        </div><i class=""></i>
                        <div class="media-body text-right">
                          <h3>{{$regClinic}}</h3>
                          <span>Registered Clinics</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            {{-- <i class="icon-pencil primary font-large-2 mr-2"></i> --}}
                            <i class="fa fa-calendar fa-4x" aria-hidden="true"></i>
                        </div><i class=""></i>
                        <div class="media-body text-right">
                          <h3>{{$appointment}}</h3>
                          <span>Total Appointments</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            {{-- <i class="icon-pencil primary font-large-2 mr-2"></i> --}}
                            <i class="fa fa-star fa-4x" aria-hidden="true"></i>
                        </div><i class=""></i>
                        <div class="media-body text-right">
                          <h3>{{number_format($rating,1)}}</h3>
                          <span>App Rating</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
    </div>
</div>
<div class="container-lg">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-margin">
                <div class="card-header no-border">
                    <h5 class="card-title">Last Registered Users</h5>
                </div>
                {{-- <div class="card-body pt-0">
                    <div class="widget-49">
                        <div class="widget-49-title-wrapper">
                            <div class="widget-49-date-primary">
                                <span class="widget-49-date-day">{{$latestCustomer[0]->id}}</span>
                                <span class="widget-49-date-month">ID</span>
                            </div>
                            <div class="widget-49-meeting-info">
                                <span class="widget-60-pro-title">{{$latestCustomer[0]->lname}}, {{$latestCustomer[0]->fname}}</span>
                            </div>
                        </div>
                        <ol class="widget-49-meeting-points">
                            <li class="widget-49-meeting-item"><span>{{$latestCustomer[1]->lname}}, {{$latestCustomer[1]->fname}}</span></li>
                            <li class="widget-49-meeting-item"><span>{{$latestCustomer[2]->lname}}, {{$latestCustomer[2]->fname}}</span></li>
                            <li class="widget-49-meeting-item"><span>{{$latestCustomer[3]->lname}}, {{$latestCustomer[3]->fname}}</span></li>
                        </ol>
                        <div class="widget-49-meeting-action">
                            <a href="{{ route('admin.patient.index') }}" class="btn btn-sm btn-flash-border-primary">View All</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-margin">
                <div class="card-header no-border">
                    <h5 class="card-title">Last Registered Clinics</h5>
                </div>
                {{-- <div class="card-body pt-0">
                    <div class="widget-49">
                        <div class="widget-49-title-wrapper">
                            <div class="widget-49-date-warning">
                                <span class="widget-49-date-day">{{$latestClinic[0]->id}}</span>
                                <span class="widget-49-date-month">ID</span>
                            </div>
                            <div class="widget-49-meeting-info">
                                <span class="widget-49-pro-title">{{$latestClinic[0]->name}}</span>
                            </div>
                        </div>
                        <ol class="widget-49-meeting-points">
                            <li class="widget-49-meeting-item"><span>{{$latestClinic[1]->name}}</span></li>
                            <li class="widget-49-meeting-item"><span>{{$latestClinic[2]->name}}</span></li>
                            <li class="widget-49-meeting-item"><span>{{$latestClinic[3]->name}}</span></li>
                        </ol>
                        <div class="widget-49-meeting-action">
                            <a href="{{ route('admin.clinic.index') }}" class="btn btn-sm btn-flash-border-warning">View All</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        {{-- <div class="col-lg-4">
            <div class="card card-margin">
                <div class="card-header no-border">
                    <h5 class="card-title">MOM</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="widget-49">
                        <div class="widget-49-title-wrapper">
                            <div class="widget-49-date-success">
                                <span class="widget-49-date-day">22</span>
                                <span class="widget-49-date-month">apr</span>
                            </div>
                            <div class="widget-49-meeting-info">
                                <span class="widget-49-pro-title">PRO-027865 Opera module</span>
                                <span class="widget-49-meeting-time">12:00 to 13.30 Hrs</span>
                            </div>
                        </div>
                        <ol class="widget-49-meeting-points">
                            <li class="widget-49-meeting-item"><span>Scope is revised and updated</span></li>
                            <li class="widget-49-meeting-item"><span>Time-line has been changed</span></li>
                            <li class="widget-49-meeting-item"><span>Received approval to start wire-frame</span></li>
                        </ol>
                        <div class="widget-49-meeting-action">
                            <a href="#" class="btn btn-sm btn-flash-border-success">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-margin" style="overflow: hidden;">
                <div class="card-header no-border">
                    <h5 class="card-title">Top Rated Clinics</h5>
                </div>
                <div class="card-body pt-0">
                    <div id="columnchart_values" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-margin" style="overflow: hidden;">
                <div class="card-header no-border">
                    <h5 class="card-title">Top Clinics</h5>
                </div>
                <div class="card-body pt-0">
                    <div id="topClinicsApp" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-margin" style="overflow: hidden;">
                <div class="card-header no-border">
                    <h5 class="card-title">Top Patient</h5>
                </div>
                <div class="card-body pt-0">
                    <div id="TopCustomerApp" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card card-margin">
                <div class="card-header no-border">
                    <h5 class="card-title">Registration per Month</h5>
                </div>
                <div class="card-body pt-0">
                    <button type="button" class="btn btn-primary">All</button>
                    <button type="button" class="btn btn-primary">Patient</button>
                    <button type="button" class="btn btn-primary">Clinic</button>
                    <div id="regPerMonth" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- galing analytics page --}}
    <div class="row">
        <div class="col " >
        {{-- class="col-sm-6 col-lg-3 --}}
            <div class="card mb-4 text-black pb-3 align-items-center" style="overflow: hidden;background-color: #B3CDE0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div class="fs-4 fw-semibold">
                        <h5 class="card-title"><b>Registered Customers</b></h5>
                        <div id="linechartCustomer" style="width: 550px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 text-black pb-3 align-items-center" style="overflow: hidden; background-color: #B3CDE0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div class="fs-4 fw-semibold">
                        <h5 class="card-title" ><b>Registered Clinics</b></h5>
                        <div id="linechartClinic" style="width: 550px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 text-black pb-3 align-items-center" style="overflow: hidden; background-color: #B3CDE0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div class="fs-4 fw-semibold">
                        <h5 class="card-title" ><b>Over All Registered Users</b></h5>
                        <div id="linechartUsers"  style="width: 550px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card mb-4 align-items-center">
            <div class="card-body ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0"> Users</h4>
                </div>
                <div class="c-chart-wrapper">
                    <div id="linechartUsers"  style="width: 550px; height: 500px;"></div>
                </div>
            </div>
        </div> --}}
        <div class="col">
            <div class="card mb-4 text-black pb-3 align-items-center" style="overflow: hidden; background-color: #B3CDE0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div class="fs-4 fw-semibold">
                        <h5 class="card-title"><b>Over All Appointments</b></h5>
                        <div id="appPerMonth"  style="width: 550px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card mb-4 align-items-center">
            <div class="card-body ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0"> Appointments</h4>
                </div>
                <div class="c-chart-wrapper">
                    <div id="appPerMonth"  style="width: 550px; height: 500px;"></div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endif



@endsection

@section('extraScript')
    
<script src="{{ URL::asset('js/admin/dashboard.js') }}"></script>

{{-- all user , user , clinic analytics --}}
<script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script>

@endsection