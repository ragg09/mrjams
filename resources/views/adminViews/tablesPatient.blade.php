@extends('adminViews.layouts.master')

@section('title', 'Patient')


@section('extraStyle')
    
@endsection


@section('content')

    {{-- {{$user}} --}}

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
            {{-- <button onclick="makePDF()">Print Report</button> --}}
                <div class="table-responsive" id="capture">
                    <table class="table table-hover" id="patientShow">
                        <thead class="bg-primary">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Customer Last Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($patient as $patients)
                                <tr>
                                    <td>{{$patients['id']}}</td>
                                    <td>{{$patients['fname']}}</td>
                                    <td>{{$patients['lname']}}</td>
                                    <td>{{$patients['phone']}}</td>
                                    <td><a href="/admin/patient/{{$patients['id']}}"><button class="btn btn-primary" id="viewPatient"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a><a href="/admin/patient/{{$patients['id']}}/edit" class="btn btn-warning" id="editUser" ><i class="fa fa-pencil-square-o" aria-hidden="true" data-id="{{$patients['id']}}"></i> Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>

{{-- <div id="linechartUsers" style="width: 900px; height: 500px;"></div> --}}
@include('adminViews.layouts.user.userDelete')

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/patientDetails.js') }}"></script>

@endsection
