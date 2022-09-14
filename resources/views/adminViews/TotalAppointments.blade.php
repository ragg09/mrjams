@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Total Appointments')


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
                        <span>Dashboard</span>
                    </li>
                    <li class="breadcrumb-item active">
                        <span>Total Appointments</span>
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
                    <table class="table table-hover" id="totalAppointment">
                        <thead style="background-color: #B3CDE0">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="tcenter">First Name</th>
                                <th scope="col" class="tcenter">Last Name</th>
                                <th scope="col" class="tcenter">Clinic Name</th>
                                <th scope="col" class="tcenter">Date Created</th>
                                <th scope="col" class="tcenter">Appointment Date</th>
                                <th scope="col" class="tcenter">Time</th>
                                <th scope="col" class="tcenter">Status</th>
                            </tr>
                        </thead>
                        <tbody id="info">

                            @foreach ($appoints as $appointss)
                                <tr style="text-align: center;">
                                    <td>{{ $appointss->id }}</td>
                                    <td class="tcenter">{{ $appointss->Firstname }}</td>
                                    <td class="tcenter">{{ $appointss->Lastname }}</td>
                                    <td class="tcenter">{{ $appointss->ClinicName }}</td>
                                    <td class="tcenter">{{ $appointss->DateCreated }}</td>
                                    <td class="tcenter">{{ $appointss->AppointmentDate }}</td>
                                    <td class="tcenter">{{ $appointss->Time }}</td>
                                    {{-- <td  class="tcenter">{{$appointss->Status}}</td> --}}

                                    <td><button @if ($appointss->Status == 'done') class="btn btn-success" @endif
                                            @if ($appointss->Status == 'pending') class="btn btn-warning" @endif
                                            @if ($appointss->Status == 'declined') class="btn btn-danger" @endif
                                            @if ($appointss->Status == 'accepted') class="btn btn-primary" @endif
                                            @if ($appointss->Status == 'negotiating') class="btn btn-info" @endif
                                            @if ($appointss->Status == 'cancelled') class="btn btn-secondary" @endif
                                            @if ($appointss->Status == 'expired') class="btn btn-secondary" @endif
                                            @if ($appointss->Status == 'deleted') class="btn btn-danger" @endif>
                                            {{ $appointss->Status }}</button></td>



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

    <script src="{{ URL::asset('js/admin/totalAppointment.js') }}"></script>

@endsection
