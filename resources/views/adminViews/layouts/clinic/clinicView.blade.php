@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Clinic')


@section('extraStyle')
    <link rel="stylesheet" href="{{ asset('./css/admin/newUI.css') }}">
@endsection

{{-- {{$clinics}}
{{$clinicType}} --}}

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
                        <span>{{ $clinics->name }}</span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="header-divider"></div>
    </header>

    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-4">

                    <div class="card mb-1">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">

                                    <div class="media-body text-center">
                                        <i class="fa fa-user-md fa-6x mb-2" aria-hidden="true"></i>
                                        <h3 style="font-weight: bold">{{ $clinics->name }}</h3>

                                        <h5><b>{{ $clinicType->type_of_clinic }} Clinic</b></h5>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-1">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-users font-large-2 float-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3><b>{{ $appReceipt }}</b></h3>
                                        <span class="clinicdata">Total Appointments Made</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-1">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-star font-large-2 float-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3><b>{{ number_format($avgRatings, 1) }}</b></h3>
                                        <span class="clinicdata">Average Rating from Customer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-1">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-star font-large-2 float-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3><b>{{ number_format($avgRatingApp, 1) }}</b></h3>
                                        <span class="clinicdata">Average Rating to the System</span>
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
                                        <div id="appMonthClinic" style="width: 100%; height: 565px"></div>
                                        <h1 class="text-center" id="appMonthPatient_nodata" hidden>NO AVAILABLE DATA</h1>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



                <input type="text" id="clinicID" name="clinicID" value="{{ $clinics->id }}" hidden>
            </div>
        </div>
    </div>

    {{-- <div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-center">
                          <h3 style="font-weight: bold">{{ $clinics->name}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body text-center">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="fa fa-medkit font-large-1 float-right" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                          <h3>{{ $clinicType->type_of_clinic}} Clinic</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="fa fa-users font-large-2 float-right" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                          <h3>{{ $appReceipt}}</h3>
                          <span>Total Appointments Made</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="fa fa-star font-large-2 float-right" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                          <h3>{{number_format($avgRatings,1)}}</h3>
                          <span>Average Rating from Customer</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="fa fa-star font-large-2 float-right" aria-hidden="true"></i>
                        </div>
                        <div class="media-body text-right">
                          <h3>{{number_format($avgRatingApp,1)}}</h3>
                          <span>Average Rating to the System</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" id="clinicID" name="clinicID" value="{{$clinics->id}}" hidden>
            </div>
        </div>
        <div id="appMonthClinic" style="width: 100%; height: 500px"></div>
    </div>
</div> --}}

@endsection

@section('extraScript')

    <script src="{{ URL::asset('js/admin/clinicAppMonth.js') }}"></script>

@endsection
