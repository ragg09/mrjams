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
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                {{-- @php 
                dd($clinic);
                @endphp --}}
                {{-- @foreach($clinic as $clinics) --}}
                    {{-- <p>{{ $clinic->id}}</p> <br>
                    <p>{{ $clinic->name}}</p> <br>
                    <p>{{ $clinic->phone}}</p> <br>
                    <p>{{ $clinic->telephone}}</p> --}}
                {{-- @endforeach  --}}
                    <h3>{{ $patient->id}}</h3> <br>
                    <h3>Patient Name: {{ $patient->fname}}</h3> <br>
                    <h3>Patient Last Name: {{ $patient->lname}}</h3> <br>
                    <h3>Cellphone #: {{ $patient->phone}}</h3> <br>
                    <h3>Total appointments made: {{ $appReceipt}}</h3> <br>
                    <h3>Average Rating for the system: {{number_format($avgRatingApps,1)}}</h3> <br>
                    <input type="text" id="patientID" value="{{$patient->id}}">
            </div>
      </div>
      <div id="appMonthPatient" style="width: 900px; height: 500px"></div>
</div>


@endsection

@section('extraScript')

{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> --}}
<script src="{{ URL::asset('js/admin/patientAppMonth.js') }}"></script>

@endsection
