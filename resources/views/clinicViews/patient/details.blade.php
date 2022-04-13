@extends('clinicViews.layouts.master')
@section('title', 'Patient')
@section('extraStyle')
    <style>
        ul.timeline {
    list-style-type: none;
    position: relative;
    width: 80%;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    
}

ul.timeline > #upcoming:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #e82222;
    left: 20px;
    width: 20px;
    height: 20px;
    
}

ul.timeline > #done:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #00ff00;
    left: 20px;
    width: 20px;
    height: 20px;
    
}
    </style>
@endsection

@section('content')

    <div class="row mx-auto">
        <div class="col-sm-12 col-md-5 col-lg-5 p-3">
            <div class=" p-2 bg-white rounded overflow-hidden">
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        <img class="rounded-circle" src="https://lh3.googleusercontent.com/a/AATXAJz4KZfgPNyrWa6RNfmKYprDlN3aC_P0S6gRll4s=s96-c" alt="♥" style="width: 100px; ">
                    </div>
                    
                    <div class="col-12 d-flex justify-content-center mt-2">
                        <h2>{{ $customer->fname . " " . $customer->lname }}</h2>
                    </div>

                    <div class="col-12 d-flex justify-content-center">
                        <h6 class="text-muted">{{ $root_customer->email }}</h6>
                    </div>

                    <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="row">
                            <div class="col text-center" style="-right: 1px solid grey;">
                                <h3 style="margin-top: 10px;">{{ count($done_app) }}</h3>
                                <p class="text-muted" style="margin-top: -10px; font-size: 12px;">done</p>
                            </div>
                            <div class="col text-center">
                                <h3 style="margin-top: 10px;">{{ count($upcoming_app) }}</h3>
                                <p class="text-muted" style="margin-top: -10px; font-size: 12px;">upcoming</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-center mt-2 mb-4">
                        <a class="btn btn-primary"  id="send_email_btn"
                        data-name="{{ $customer->fname . " " . $customer->lname }}"  
                        data-email="{{ $root_customer->email }}"  
                        data-bs-target="#send_email_modal" 
                        data-bs-toggle="modal" role="button" style="width: 200px">Send Email</a>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-7 col-lg-7 p-3  d-flex align">
            <div class=" p-2 bg-white rounded h-100 w-100 d-inline-block ">
                <div class="row mt-md-5 mt-lg-5">
                    <div class="col p-4 text-center">
                        <p class="text-muted">Gender</p>
                        <h6 style="margin-top: -10px;">{{ $customer->gender }}</h6>
                    </div>
                    <div class="col p-4 text-center">
                        <p class="text-muted">Age</p>
                        <h6 style="margin-top: -10px;">{{ $customer->age }}</h6>
                    </div>
                    <div class="col p-4 text-center">
                        <p class="text-muted">Phone</p>
                        <h6 style="margin-top: -10px;">{{ $customer->phone }}</h6>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col p-4 text-center">
                        <p class="text-muted">Address</p>
                        <h6 style="margin-top: -10px;">{{ $address->address_line_1 }}</h6>
                        <h6 style="margin-top: -10px;">{{ $address->address_line_2 }}</h6>
                    </div>
                    <div class="col p-4 text-center">
                        <p class="text-muted">City</p>
                        <h6 style="margin-top: -10px;"><h6 style="margin-top: -10px;">{{ $address->city }}</h6></h6>
                    </div>
                    <div class="col p-4 text-center">
                        <p class="text-muted">Zipcode</p>
                        <h6 style="margin-top: -10px;"><h6 style="margin-top: -10px;">{{ $address->zip_code }}</h6></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mx-auto" style="">
        <div class="col p-3">
            <div class=" p-2 bg-white rounded overflow-hidden">
                <h4 class="mx-5 text-muted">Patient Record</h4>
                <ul class="timeline mx-auto">
                    

                    @if (count($upcoming_app_complete) > 0)
                        <li id="upcoming">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col">Upcoming</div>
                                <div class="col"></div>
                            </div>
                        </li>
                        @foreach ($upcoming_app_complete as $row)
                            <li>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted" style="font-size: 14px;">Date</p>
                                        <h6 style="margin-top: -15px;">{{  date('M d, Y', strtotime($row->date))}}</h6>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted" style="font-size: 14px;">Specialist</p>
                                        <h6 style="margin-top: -15px;">{{ $row->specialist }}</h6>
                                        
                                    </div>
                                    <div class="col">
                                        <p class="text-muted" style="font-size: 14px;">Treatment</p>
                                        <h6 style="margin-top: -15px;">{{ $row->treatment }}</h6>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif

                    @if (count($done_app_complete) > 0)
                        <li id="done">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col">Done</div>
                                <div class="col"></div>
                            </div>
                        </li>
                        @foreach ($done_app_complete as $row)
                            <li>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted" style="font-size: 14px;">Date</p>
                                        <h6 style="margin-top: -15px;">{{  date('M d, Y', strtotime($row->date))}}</h6>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted" style="font-size: 14px;">Specialist</p>
                                        <h6 style="margin-top: -15px;">{{ $row->specialist }}</h6>
                                        
                                    </div>
                                    <div class="col">
                                        <p class="text-muted" style="font-size: 14px;">Treatment</p>
                                        <h6 style="margin-top: -15px;">{{ $row->treatment }}</h6>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                    
                </ul>
            </div>
        </div>
    </div>

    @include('clinicViews.patient.send_email')
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/patient/patient.js') }}"></script>
@endsection

   