@extends('adminViews.layouts.master')

@section('title', 'Title')


@section('extraStyle')
    
@endsection

{{-- {{ $clinicReg}}
{{ $clinicAdd}}
{{ $clinicType}} --}}

@section('content')
<header class="header header-sticky mb-4"> 
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
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
                    <label>Clinic Name</label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicReg->name}}" disabled><br>
                </div>
                <div class="col">
                    <label>Clinic Type</label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicType->type_of_clinic}}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Clinic Phone#</label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicReg->phone}}" disabled> <br>
                </div>
                <div class="col">
                    <label>Clinic Telephone#</label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicReg->telephone}}" disabled>
                </div>
            </div>
            {{-- <br>
            <hr>
            <br> --}}
            <div class="row">
                <div class="col">
                    <label>Clinic Address</label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicAdd->address_line_1}} , {{ $clinicAdd->address_line_2}}" disabled> <br> 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Clinic City & ZipCode</label>
                    <input class="form-control" id="sender" name="sender" type="text" value="{{ $clinicAdd->city}} , Zipcode: {{ $clinicAdd->zip_code}}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h3>DITO SA BABA YUNG MAP</h3>
                    <h3>message sa declined registrations!!!!</h3>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" id="acceptClinicReg" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Accept</button>
                    <a id="deleteClinicReg" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>Accept</a>
                </div>
            </div>
        </form>
    </div>
    
</div>


@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/clinicRegistration.js') }}"></script>

@endsection
