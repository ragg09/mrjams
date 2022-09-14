@extends('adminViews.layouts.master')

@section('title', 'Registration')


@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('./css/admin/newUI.css') }}">
@endsection

{{-- {{$clinicReg}} --}}

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
                </ol>
            </nav>
        </div>
        <div class="header-divider"></div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                {{-- <a href="{{ route('admin.clinicTypes.create') }}" id="createClinicType" >Create Clinic Type</a>
            <a href="{{ route('admin.clinicReg.index') }}">Clinic Registration</a> --}}
                <div class="table-responsive">
                    <table class="table table-hover" id="clinicShow">
                        <thead style="background-color: #B3CDE0">
                            <tr>
                                {{-- <th scope="col">Id</th> --}}
                                <th scope="col">Clinic Email</th>
                                {{-- <th scope="col">Phone</th>
                        <th scope="col">Telephone</th> --}}
                                {{-- <th scope="col"> </th> --}}
                                <th scope="col">Action</th>
                                <th scope="col"> </th>
                                {{-- <th scope="col">   </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinicReg as $clinicRegs)
                                <tr>
                                    {{-- <td>{{$clinicRegs['id']}}</td> --}}
                                    <td>{{ $clinicRegs['email'] }}</td>
                                    {{-- <td>{{$clinics['phone']}}</td>
                                <td>{{$clinics['telephone']}}</td> --}}
                                    <td><a href="/admin/clinicReg/{{ $clinicRegs['id'] }}"><button class="btn btn-primary"
                                                style="color: black;"><i class="fa fa-eye" aria-hidden="true"></i>
                                                <b>View</b></button></a></td>
                                    {{-- <td><a href="/admin/clinicReg/{{$clinicRegs['id']}}/edit" class="btn btn-primary" id="AcceptClinicReg" data-id="{{$clinicRegs['id']}}" data-bs-target="#accept_modal_clinic" data-bs-toggle="modal"><i class="fa fa-check-square-o" aria-hidden="true"></i> Accept</a></td>
                                <td><a href="#"><button class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i> Decline</button></a></td> --}}
                                    {{-- <td><a href="/admin/clinic/{{$clinicRegs['id']}}"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Decline</button></a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extraScript')

    {{-- <script src="{{ URL::asset('js/admin/clinigRegistration.js') }}"></script> --}}

@endsection
