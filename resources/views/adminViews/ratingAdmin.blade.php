@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - App Rating')


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
                        <span>App Rating</span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="header-divider"></div>
    </header>
    {{-- <div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
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
                                        <td>{{$appointss->id}}</td>
                                        <td  class="tcenter">{{$appointss->Firstname}}</td>
                                        <td  class="tcenter">{{$appointss->Lastname}}</td>
                                        <td  class="tcenter">{{$appointss->ClinicName}}</td>
                                        <td  class="tcenter">{{$appointss->DateCreated}}</td>
                                        <td  class="tcenter">{{$appointss->AppointmentDate}}</td>
                                        <td  class="tcenter">{{$appointss->Time}}</td>

                                        <td><button
                                            @if ($appointss->Status == 'done')
                                                class="btn btn-success"
                                            @endif
                                            @if ($appointss->Status == 'pending')
                                                class="btn btn-warning"
                                            @endif
                                            @if ($appointss->Status == 'declined')
                                                class="btn btn-danger"
                                            @endif
                                            @if ($appointss->Status == 'accepted')
                                                class="btn btn-primary"
                                            @endif
                                            @if ($appointss->Status == 'negotiating')
                                                class="btn btn-info"
                                            @endif
                                            @if ($appointss->Status == 'cancelled')
                                                class="btn btn-secondary"
                                            @endif
                                            @if ($appointss->Status == 'expired')
                                                class="btn btn-secondary"
                                            @endif
                                            @if ($appointss->Status == 'deleted')
                                                class="btn btn-danger"
                                            @endif
                                        >
                                        {{$appointss->Status}}</button></td>



                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div> --}}
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-4">

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">

                                    <div class="media-body text-center">
                                        <img src="{{ asset('images/mrjams/RatingLogo.PNG') }}" class="ratingAdminlogo">
                                        <h5>Appointment and Management System for Dental and Medical Clinics with
                                            Location-Based Mapping</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-star fa-2x float-left" style="color: #ffb703;"
                                            aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h4><b>Total App Rating:</b> {{ number_format($totalRating, 1) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-star fa-2x float-left" style="color: #118ab2;"
                                            aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h4><b>Customers Rating:</b> 12</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-star fa-2x float-left" style="color: #06d6a0;"
                                            aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h4><b>Clinics Rating:</b> 12</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                {{-- {{ $rating}} --}}
                <div class="col">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="media-body text-right">
                                        <h4 style="text-align: left; font-weight: bold;">Rating</h4>
                                        <table class="table table-hover" id="appRatingCustomer">
                                            <thead style="background-color: #B3CDE0">
                                                <tr>
                                                    <th scope="col" class="tcenter">ID</th>
                                                    <th scope="col" class="tcenter">Name</th>
                                                    <th scope="col" class="tcenter">Comment</th>
                                                    <th scope="col" class="tcenter">Rating</th>
                                                    <th scope="col" class="tcenter">Role</th>
                                                </tr>
                                            </thead>
                                            <tbody id="info">
                                                @foreach ($allRating as $row)
                                                    <tr style="text-align: center;">
                                                        {{-- <td class="tcenter">Sample</td>
                                                    <td class="tcenter">Sample</td>
                                                    <td class="tcenter">Sample</td>
                                                    <td class="tcenter">5</td>
                                                    <td class="tcenter">Sample</td> --}}

                                                        <td class="tcenter">{{ $row->id }}</td>
                                                        <td class="tcenter">{{ $row->name }}</td>
                                                        <td class="tcenter">{{ $row->comment ?? 'No comment' }}</td>
                                                        <td class="tcenter">{{ $row->rating }}</td>
                                                        <td class="tcenter">{{ $row->role }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="media-body text-right">
                                        <h4 style="text-align: left; font-weight: bold;">Clinic Rating Rating</h4>
                                        <table class="table table-hover" id="appRatingCustomer">
                                            <thead style="background-color: #B3CDE0">
                                                <tr>
                                                    <th scope="col" class="tcenter">ID</th>
                                                    <th scope="col" class="tcenter">Name</th>
                                                    <th scope="col" class="tcenter">Comment</th>
                                                    <th scope="col" class="tcenter">Rating</th>
                                                </tr>
                                            </thead>
                                            <tbody id="info">

                                                <tr style="text-align: center;">
                                                    <td class="tcenter">Sample</td>
                                                    <td class="tcenter">Sample</td>
                                                    <td class="tcenter">Sample</td>
                                                    <td class="tcenter">5</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>






                {{-- <input type="text" id="patientID" value="{{$patient->id}}" hidden> --}}
            </div>
        </div>
    </div>

    {{-- <div id="linechartUsers" style="width: 900px; height: 500px;"></div> --}}
    @include('adminViews.layouts.user.userDelete')

@endsection

@section('extraScript')

    <script src="{{ URL::asset('js/admin/ratingAdmin.js') }}"></script>

@endsection
