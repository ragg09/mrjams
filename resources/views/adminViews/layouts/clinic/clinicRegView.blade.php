@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Clinic Registration')


@section('extraStyle')
    
@endsection

{{-- {{ $clinicReg}}
{{ $clinicAdd}}
{{ $clinicType}} --}}

@section('content')
<header class="header header-sticky mb-2 mt-5"> 
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2" style="background-color: #B3CDE0">
                <li class="breadcrumb-item" style="margin-left: 20px;">
                    <span>Home</span>
                </li>
                <li class="breadcrumb-item active">
                    <span>Clinic Registration</span>
                </li>
                <li class="breadcrumb-item active">
                    <span>{{ $clinicReg->name}}</span>
                </li>
            </ol>
        </nav>
    </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <form action="/admin/clinicReg/{{$clinicReg->id}}" method="POST">
            @csrf
            {{method_field('PUT')}}
            <div class="row">
                
                <div class="col">
                        {{-- <h3>{{ $clinicReg->id}}</h3> <br> --}}
                        <input id="clinicRegID" value="{{ $clinicReg->id}}" hidden>
                    <label><b>Clinic Name</b></label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicReg->name}}" disabled><br>
                </div>
                <div class="col">
                    <label><b>Clinic Type</b></label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicType->type_of_clinic}}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label><b>Clinic Phone#</b></label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicReg->phone}}" disabled> <br>
                </div>
                <div class="col">
                    <label><b>Clinic Telephone#</b></label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicReg->telephone}}" disabled>
                </div>
            </div>
            {{-- <br>
            <hr>
            <br> --}}
            <div class="row">
                <div class="col">
                    <label><b>Clinic Address</b></label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicAdd->address_line_1}} , {{ $clinicAdd->address_line_2}}" disabled> <br> 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label><b>Clinic City & ZipCode</b></label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicAdd->city}} , Zipcode: {{ $clinicAdd->zip_code}}" disabled>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    {{-- <h3>DITO SA BABA YUNG MAP</h3> --}}
                    {{-- {{ $clinicAdd }} --}}
                    <input type="text" id="latitude" name="latitude" value="{{ $clinicAdd->latitude }}" hidden>
                    <input type="text" id="longitude" name="longitude" value="{{ $clinicAdd->longitude }}" hidden>

                    <div id="maps" class="w-100" style="height: 600px;"></div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if ($clinicReg->permit != null)  
                        <label for="permit_id" class="form-label" ><h3>Business Permit</h3></label>
                        <input class="form-control" id="permit_id" name="permit_id" type="text" value="{{ $clinicReg->permit_id}}" disabled>
                        <img class="w-100" src="{{ $clinicReg->permit }}" alt="permit">
                    @else
                        <label for="permit" class="form-label" style="color: red">No Business Permit Submitted</label>
                    @endif
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" id="acceptClinicReg" class="btn btn-primary" style="font-weight: bold"><i class="fa fa-check" aria-hidden="true" style="margin-right: 5px;"></i>Accept</button>
                    <a id="deleteClinicReg" class="btn btn-danger" style="font-weight: bold"><i class="fa fa-times" aria-hidden="true" style="margin-right: 5px;"></i>Decline</a>
                </div>
            </div>
        </form>

        
    </div>

    
    
</div>


@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/clinicRegistration.js') }}"></script>


<script>
    
    let map, marker, autocomplete;
    var latitude = document.getElementById("latitude").value;    
    var longitude = document.getElementById("longitude").value;
    var myLatLng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
    
    
        
    function initMap() {
        map = new google.maps.Map(document.getElementById("maps"), {
            center: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
            zoom: 19,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });

        marker = new google.maps.Marker({
        position: myLatLng,
        map,
        title: "My Clinic",
      });
        
    }
          
</script>
    

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places"></script>


@endsection
