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
                  <span>Clinic</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>

{{-- {{$clinic}} --}}
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <form action="/admin/clinic/{{$clinic->id}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="mb-3">
                        <label class="form-label">Clinic Name</label>
                        <input type="text" class="form-control" id="clinicID" name="clinicID"value="{{$clinic->id}}" hidden>
                      </div>
                    <div class="mb-3">
                      <label class="form-label">Clinic Name</label>
                      <input type="text" class="form-control" id="clinicname" name="clinicname" value="{{$clinic->name}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cellphone Number</label>
                        <input type="text" class="form-control" id="clinicphone" name="clinicphone" value="{{$clinic->phone}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telephone Number</label>
                        <input type="text" class="form-control" id="clinictelephone" name="clinictelephone" value="{{$clinic->telephone}}">
                    </div>
                    <button type="submit" id="updateClinic" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/patientDetails.js') }}"></script>

@endsection
