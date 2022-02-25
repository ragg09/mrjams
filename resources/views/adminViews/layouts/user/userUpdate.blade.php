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

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <form>
                    <div class="mb-3">
                      <label class="form-label">First Name</label>
                      <input type="text" class="form-control" id="userName" value="{{$patient->fname}}">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Middle Name</label>
                      <input type="text" class="form-control" id="mname" value="{{$patient->mname}}">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Last Name</label>
                      <input type="text" class="form-control" id="lname" value="{{$patient->lname}}">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Age</label>
                      <input type="text" class="form-control" id="userTelephone" value="{{$patient->age}}">
                    </div>
                    <select class="form-select" aria-label="Default select example">
                      <option selected value="{{$patient->gender}}">{{$patient->gender}}</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                    <div class="mb-3">
                        <label class="form-label">Cellphone Number</label>
                        <input type="text" class="form-control" id="userTelephone" value="{{$patient->phone}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
      </div>
  </div>

  {{-- <div class="modal" id="editModalUser" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg" >
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-prod">Update Prod</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="updateformprod" method="#" action="#" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT">

          <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"  >
            @if($errors->has('name'))
         <small>{{ $errors->first('name') }}</small>
         @endif
          </div>
          <div class="form-group"> 
            <label for="email" class="control-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" >
             @if($errors->has('email'))
         <small>{{ $errors->first('email') }}</small>
         @endif
          </div>
          <div class="form-group"> 
            <label for="website" class="control-label">Website</label>
            <input type="text" class="form-control" id="website" name="website" >
             @if($errors->has('website'))
         <small>{{ $errors->first('website') }}</small>
         @endif
          </div> 
        </div>
        </form> 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="updatebtnprod" type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</div>
</div>
</div> --}}

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/patientDetails.js') }}"></script>

@endsection
