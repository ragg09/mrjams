@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Clinic')


@section('extraStyle')
    
@endsection


@section('content')

    {{-- {{$parasauser}} --}}

    <header class="header header-sticky mb-2 mt-5"> 
        <div class="container-fluid" >
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2" style="background-color: #B3CDE0">
                    <li class="breadcrumb-item" style="margin-left: 20px;">
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
            <button class="btn btn-info" style="width: 200px; margin-right: 5px"><a href="{{ route('admin.clinicTypes.create') }}" id="createClinicType" style="color: black">Create Clinic Type</a></button>
            <button class="btn btn-warning"  style="width: 200px"><a href="{{ route('admin.clinicReg.index') }}" style="color: black">Clinic Registration</a></button>
            {{-- <a href="{{ route('admin.reportClinic.index') }}" id="printClinicTable"  >Print Report</a> --}}
            {{-- @if ($clinic == 0 )
                <h3>NO DATA</h3>
            @else --}}
            
            {{-- @endif --}}
          

            <div class="table-responsive mt-2">
                <table class="table table-hover" id="clinicShow">
                    <thead  style="background-color: #B3CDE0">
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
                                <td><a href="/admin/clinic/{{$clinics['id']}}"><button class="btn btn-primary" style="margin-right: 5px;"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a><a href="/admin/clinic/{{$clinics['id']}}/edit" class="btn btn-warning" id="editUser" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
{{-- <div id="linechartUsers" style="width: 900px; height: 500px;"></div> --}}

@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/clinicDetails.js') }}"></script>
{{-- <script src="{{ URL::asset('js/admin/printReport.js') }}"></script> --}}

@endsection
