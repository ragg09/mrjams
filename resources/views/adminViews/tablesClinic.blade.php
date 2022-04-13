@extends('adminViews.layouts.master')

@section('title', 'Clinic')


@section('extraStyle')
    
@endsection


@section('content')

    {{-- {{$parasauser}} --}}

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
            <a href="{{ route('admin.clinicTypes.create') }}" id="createClinicType" >Create Clinic Type</a>
            <a href="{{ route('admin.clinicReg.index') }}">Clinic Registration</a>
            {{-- <a href="{{ route('admin.reportClinic.index') }}" id="printClinicTable"  >Print Report</a> --}}
            @if ($clinic == 0 )
                <h3>NO DATA</h3>
            @else
            <div class="table-responsive">
                <table class="table table-hover" id="clinicShow">
                    <thead class="bg-primary">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Clinic Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($clinic as $clinics)
                            <tr>
                                <td>{{$clinics['id']}}</td>
                                <td>{{$clinics['name']}}</td>
                                <td>{{$clinics['phone']}}</td>
                                <td>{{$clinics['telephone']}}</td>
                                <td><a href="/admin/clinic/{{$clinics['id']}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a><a href="/admin/clinic/{{$clinics['id']}}/edit" class="btn btn-warning" id="editUser" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
</div>
{{-- <div id="linechartUsers" style="width: 900px; height: 500px;"></div> --}}

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/clinicDetails.js') }}"></script>
{{-- <script src="{{ URL::asset('js/admin/printReport.js') }}"></script> --}}

@endsection
