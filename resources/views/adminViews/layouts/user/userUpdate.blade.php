@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Patient - Edit')


@section('extraStyle')
    <link href="{{ asset('css/admin/userView.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('./css/admin/newUI.css') }}">
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
                        <span>Patient</span>
                    </li>
                    <li class="breadcrumb-item active">
                        <span>{{ $patient->fname }}</span>
                    </li>
                    <li class="breadcrumb-item active">
                        <span>Edit</span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="header-divider"></div>
    </header>

    {{-- <div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <form action="/admin/patient/{{$patient->id}}" method="POST">
                  @csrf
                  {{method_field('PUT')}}

                    <input type="text" class="form-control" id="userID" name="userID" value="{{$patient->id}}" hidden>
                    <div class="mb-2">
                      <label class="form-label">First Name</label>
                      <input type="text" class="form-control" id="userName" name="userName" value="{{$patient->fname}}">
                    </div>
                    <div class="mb-2">
                      <label class="form-label">Middle Name</label>
                      <input type="text" class="form-control" id="mname" name="mname" value="{{$patient->mname}}">
                    </div>
                    <div class="mb-2">
                      <label class="form-label">Last Name</label>
                      <input type="text" class="form-control" id="lname" name="lname" value="{{$patient->lname}}">
                    </div>
                    <div class="mb-2">
                      <label class="form-label">Age</label>
                      <input type="text" class="form-control" id="userTelephone" name="age" value="{{$patient->age}}">
                    </div>
                    <div class="mb-2">
                      <label class="form-label">Gender</label>
                      <select class="form-select" aria-label="Default select example" name="userGender">
                        <option selected name="userGender" value="{{$patient->gender}}">{{$patient->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Cellphone Number</label>
                        <input type="text" class="form-control" id="userTelephone" name="phone" value="{{$patient->phone}}">
                    </div>
                    <button type="submit" id="updatePatient" class="btn btn-primary">Submit</button>
                </form>
            </div>
      </div>
  </div>
</div> --}}

    <div class="body flex-grow-1 px-3" id="UpdateUser">
        <div class="container-lg">
            <div class="row">
                <div class="col-4">

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-center">
                                        <i class="fa fa-user fa-6x mb-2" aria-hidden="true"></i>
                                        <h3 style="font-weight: bold">{{ $patient->fname }} {{ $patient->lname }}</h3>
                                        <h5><b>Role: Customer</b></h5>
                                        {{-- <h5>{{ $patientAdd->address_line_1}} {{ $patientAdd->address_line_2}}, {{ $patientAdd->city}}</h5> --}}
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
                                        <form action="/admin/patient/{{ $patient->id }}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <input type="text" class="form-control" id="userID" name="userID"
                                                value="{{ $patient->id }}" hidden>
                                            <div class="mb-2">
                                                <label class="form-label" style="float: left; font-weight: bold">First
                                                    Name</label>
                                                <input type="text" class="form-control" id="userName" name="userName"
                                                    value="{{ $patient->fname }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label" style="float: left; font-weight: bold">Middle
                                                    Name</label>
                                                <input type="text" class="form-control" id="mname" name="mname"
                                                    value="{{ $patient->mname }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label" style="float: left; font-weight: bold">Last
                                                    Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname"
                                                    value="{{ $patient->lname }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label" style="float: left; font-weight: bold">Age</label>
                                                <input type="text" class="form-control" id="userTelephone" name="age"
                                                    value="{{ $patient->age }}" pattern="[0-9]+" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label"
                                                    style="float: left; font-weight: bold">Gender</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="userGender">
                                                    <option selected name="userGender" value="{{ $patient->gender }}">
                                                        {{ $patient->gender }}</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label" style="float: left; font-weight: bold">Cellphone
                                                    Number</label>
                                                <input type="text" class="form-control" id="userTelephone" name="phone"
                                                    value="{{ $patient->phone }}" pattern="[0-9]+" required>
                                            </div>
                                            <button type="submit" id="updatePatient"
                                                class="btn btn-primary"><b>Submit</b></button>


                                        </form>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



                <input type="text" id="patientID" value="{{ $patient->id }}" hidden>
            </div>
        </div>
    </div>




@endsection

@section('extraScript')

    <script src="{{ URL::asset('js/admin/patientDetails.js') }}"></script>

@endsection
