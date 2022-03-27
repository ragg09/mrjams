@extends('adminViews.layouts.master')

@section('title', 'Clinic')


@section('extraStyle')
    
@endsection

{{$avgRatingApp}}

@section('content')
<header class="header header-sticky mb-4"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Clinic</span>
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
                    <h3>{{ $clinics->id}}</h3> <br>
                    <h3>Clinic Name: {{ $clinics->name}}</h3> <br>
                    <h3>Cellphone #: {{ $clinics->phone}}</h3> <br>
                    <h3>Telephone #: {{ $clinics->telephone}}</h3>
                    <h3>Total Appointments Made: {{ $appReceipt}}</h3>
                    <h3>Average Rating:(rating to ng customer sa clinic 2decimal) {{number_format($avgRatings,1)}}</h3> <br>
                    <h3>Average Rating:(rating to ng clinic sa system) {{number_format($avgRatingApp,1)}}</h3> <br>
                    <input type="text" id="clinicID" value="{{$clinics->id}}">
                {{-- @endforeach  --}}
                    {{-- <p>{{ $customer->id}}</p> <br>
                    <p>{{ $customer->name}}</p> <br> --}}
                    {{-- <p>{{ $clinic->phone}}</p> <br>
                    <p>{{ $clinic->telephone}}</p> --}}
            </div>
      </div>
      <div id="appMonthClinic" style="width: 900px; height: 500px"></div>
  </div>
</div>

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/clinicAppMonth.js') }}"></script>
{{-- <script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script> --}}

@endsection
