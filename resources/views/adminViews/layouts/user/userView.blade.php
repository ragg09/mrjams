@extends('adminViews.layouts.master')

@section('title', 'Clinic')


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
                  <span>Patient</span>
              </li>
              <li class="breadcrumb-item active">
                <span>{{ $patient->fname}}</span>
            </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        {{-- <a onclick="window.print()" >Print Report</a> --}}
        <div class="row">
            <div class="col"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        {{-- <div class="align-self-center">
                            <i class="fa fa-user font-large-2 float-right" aria-hidden="true"></i>
                        </div> --}}
                        <div class="media-body text-center">
                          <h3 style="font-weight: bold">{{ $patient->fname}} {{ $patient->lname}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-4"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body text-center">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="fa fa-medkit font-large-1 float-right" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                          <h3>Total Appointments: {{ $appReceipt}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        <div class="row" style="max-width: 100%">
            <div class="col"> 
                <div class="card">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                        <div class="media-body text-center">
                            <h3>{{ $patientAdd->address_line_1}},{{ $patientAdd->city}},{{ $patientAdd->address_line_2}}</h3>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body text-center">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="fa fa-medkit font-large-2 float-right" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                          <h3>Average Rating for the system: {{number_format($avgRatingApps,1)}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col"> 
                <div class="card">
                  <div class="card-content">
                    <div class="card-body text-center">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="fa fa-medkit font-large-2 float-right" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                            <h3>Cellphone #: {{ $patient->phone}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
      </div>
      <div class="row">
        <div class="col">
            <input type="text" id="patientID" value="{{$patient->id}}" hidden>
        </div>
    </div>
      <div id="appMonthPatient" style="width: 100%; height: 500px"></div>
</div>


@endsection

@section('extraScript')

{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> --}}
<script src="{{ URL::asset('js/admin/patientAppMonth.js') }}"></script>

@endsection
