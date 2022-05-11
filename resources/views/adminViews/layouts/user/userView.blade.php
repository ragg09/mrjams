@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Patient')


@section('extraStyle')


<link href="{{ asset('css/admin/userView.css') }}" rel="stylesheet">
    
@endsection

@section('content')
<header class="header header-sticky mb-2 mt-5"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2"  style="background-color: #B3CDE0">
              <li class="breadcrumb-item"  style="margin-left: 20px;">
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
        <div class="row">
              <div class="col-4"> 

                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">
                        <div class="media d-flex">
                         
                          <div class="media-body text-center">
                            <i class="fa fa-user fa-6x mb-2" aria-hidden="true"></i> 
                            <h3 style="font-weight: bold">{{ $patient->fname}} {{ $patient->lname}}</h3>

                            <h5>{{ $patientAdd->address_line_1}} {{ $patientAdd->address_line_2}}, {{ $patientAdd->city}}</h5>

                          </div>

                        

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-content">
                      <div class="card-body text-center">
                        <div class="media d-flex">
                          <div class="align-self-center">
                            <i class="fa fa-calendar fa-2x float-left" aria-hidden="true"></i>
                          </div>
                          <div class="media-body text-right">
                            <h4>Total Appointments: {{ $appReceipt}}</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-content">
                      <div class="card-body text-center">
                        <div class="media d-flex">
                          <div class="align-self-center">
                            <i class="fa fa-star fa-2x float-left" aria-hidden="true"></i>
                          </div>
                          <div class="media-body text-right">
                            <h4>Average Rating: {{number_format($avgRatingApps,1)}}</h4>
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
                          {{-- <div class="align-self-center">
                            <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                          </div> --}}
                          <div class="media-body text-right">
                            <div id="appMonthPatient" style="width: 100%; height: 500px">
                              <h1 class="text-center" id="appMonthPatient_nodata">NO AVAILABLE DATA</h1>
                            </div>
                          </div>
                        </div>

                        
                      </div>
                    </div>
                  </div>
              </div>

       
     
            <input type="text" id="patientID" value="{{$patient->id}}" hidden>
        </div>
      </div>
</div>
  

@endsection

@section('extraScript')

{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> --}}
<script src="{{ URL::asset('js/admin/patientAppMonth.js') }}"></script>

@endsection
