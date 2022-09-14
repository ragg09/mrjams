@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Patient')


@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('./css/admin/newUI.css') }}">
@endsection


@section('content')

    {{-- {{$user}} --}}

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
                        <thead style="background-color: #B3CDE0">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Last Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patient as $patients)
                                <tr>
                                    <td>{{ $patients['id'] }}</td>
                                    <td>{{ $patients['fname'] }}</td>
                                    <td>{{ $patients['lname'] }}</td>
                                    <td>{{ $patients['phone'] }}</td>
                                    <td><a href="/admin/patient/{{ $patients['id'] }}" style="margin-right:5px;"><button
                                                class="btn btn-primary" id="viewPatient" style="color: black;"><i
                                                    class="fa fa-eye" aria-hidden="true"></i> <b>View</b></button></a><a
                                            href="/admin/patient/{{ $patients['id'] }}/edit" class="btn btn-warning"
                                            id="editUser" style="color: black;"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true" data-id="{{ $patients['id'] }}"></i> <b>Edit</b></a></td>
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
