@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Clinic - Edit')


@section('extraStyle')
    
@endsection


@section('content')
<header class="header header-sticky mb-2 mt-5"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2" style="background-color: #B3CDE0">
            <li class="breadcrumb-item" style="margin-left: 20px;">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Clinic</span>
              </li>
              <li class="breadcrumb-item active">
                <span>{{$clinic->name}}</span>
            </li>
            <li class="breadcrumb-item active">
                <span>Edit</span>
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
             <div class="col-4"> 
  
                 <div class="card">
                   <div class="card-content">
                     <div class="card-body">
                       <div class="media d-flex">
                        
                         <div class="media-body text-center">
                           <i class="fa fa-user-md fa-6x mb-2" aria-hidden="true"></i> 
                           <h3 style="font-weight: bold">{{$clinic->name}}</h3>
                          <h5>Role: Clinic</h5>
                           
  
                         </div>
  
                       
  
                       </div>
                     </div>
                   </div>
                 </div>
  
  
             </div>
  
             <div class="col"> 
                 <div class="card">
                   <div class="card-content">
                     <div class="card-body text-left">
                       <div class="media d-flex">
                         {{-- <div class="align-self-center">
                           <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                         </div> --}}
                         <div class="media-body text-right">
                        
                         </div>
                       </div>
                        <form action="/admin/clinic/{{$clinic->id}}" method="POST">
                            @csrf
                            {{method_field('PUT')}}
                            <input type="text" class="form-control" id="clinicID" name="clinicID"value="{{$clinic->id}}" hidden>
                            <div class="mb-2">
                            <label class="form-label"><b>Clinic Name</b></label>
                            <input type="text" class="form-control" id="clinicname" name="clinicname" value="{{$clinic->name}}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label"><b>Cellphone Number</b></label>
                                <input type="text" class="form-control" id="clinicphone" name="clinicphone" value="{{$clinic->phone}}" pattern="[0-9]+">
                            </div>
                            <div class="mb-2">
                                <label class="form-label"><b>Telephone Number</b></label>
                                <input type="text" class="form-control" id="clinictelephone" name="clinictelephone" value="{{$clinic->telephone}}" pattern="[0-9]+">
                            </div>
                            <button type="submit" id="updateClinic" class="btn btn-primary">Submit</button>
                        </form>
                       
                     </div>
                   </div>
                 </div>
             </div>
  
       </div>
     </div>
  </div>
{{-- 
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <form action="/admin/clinic/{{$clinic->id}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                      <input type="text" class="form-control" id="clinicID" name="clinicID"value="{{$clinic->id}}" hidden>
                    <div class="mb-2">
                      <label class="form-label"><b>Clinic Name</b></label>
                      <input type="text" class="form-control" id="clinicname" name="clinicname" value="{{$clinic->name}}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label"><b>Cellphone Number</b></label>
                        <input type="text" class="form-control" id="clinicphone" name="clinicphone" value="{{$clinic->phone}}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label"><b>Telephone Number</b></label>
                        <input type="text" class="form-control" id="clinictelephone" name="clinictelephone" value="{{$clinic->telephone}}">
                    </div>
                    <button type="submit" id="updateClinic" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/patientDetails.js') }}"></script>

@endsection
