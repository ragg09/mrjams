@extends('layouts.customerlayout1')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/appoint-modal.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/rating.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('content')
    <section>
        <div class="card-container">
            <div class="row">
                <div class="col">
                    <div class="card-body">
                        <span class="card-author subtle"><strong>{{$clinic_type[0]->type_of_clinic}} Clinic</strong></span>
                        <span class="card-author subtle"><strong>Phone: </strong>{{$clinic_data[0]->phone}}</span>
                        <span class="card-author subtle"><strong> Telephone: </strong>{{$clinic_data[0]->telephone}}</span>
                        <h2 class="card-title">{{$clinic_data[0]->name}}</h2>
                        <input type="hidden" name="clinic_id" value="{{$clinic_data[0]->id}}">  
                        <!-- <span class="card-description subtle">These last few weeks I have been working hard on a new brunch recipe for you all.These last few weeks I have been working hard on a new brunch recipe for you all.</span> -->
                        <!-- <span class="card-author subtle"><strong>Address: </strong>{{$clinic_address[0]->address_line_1}}, {{$clinic_address[0]->address_line_2}}</span> -->
                        <span class="card-author subtle"><strong>Services:</strong></span>
                @foreach($services as $service)
                        <span class="card-author subtle">{{ $service->name }}</span>
                @endforeach
                        <span class="card-author subtle"><strong>Packages:</strong></span>
                @foreach($packages as $package)
                        <span class="card-author subtle">{{ $package->name }}</span>
                @endforeach
                        <br>
                        <!-- <div class="card-read"><a href="#demo-modal">Get Appointment</a></div> -->
                        <!-- <span class="card-tag card-circle subtle">C</span> -->
                    </div>
                </div>

                <div class="col text-center">
                    <img src="/images/mrjams/clinic-info.png" alt="" width="350px" height="350px" style="margin-top:40px;"/>

                    <span class="card-author subtle"><strong>Address: </strong>{{$clinic_address[0]->address_line_1}}, {{$clinic_address[0]->address_line_2}}</span>
                    <button class="btn btn-info" data-toggle="modal" data-target="#demo-modal" style="margin-top: 15px;">Get Appointment</button>
                    <button class="btn btn-light" data-toggle="modal" data-target="#rate-modal" style="margin-top: 15px;">Rate</button>
                </div>
                
            </div>
        </div>
             
            
         <!--Info Modal-->
            <div id="demo-modal" class="modal modal-message modal-info fade" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <!-- <div class="modal-title">Alert</div> -->
                        <center><h2><img src="{{ URL::asset('images/mrjams/logowithname.png') }}" width="220px" height="90px" class="center"></h2></center>

                        <div class="modal-body">For whom is this appointment?</div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='/customer/appointment/{{$clinic_data[0]->id}}/edit';">Myself</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='/customer/relativeappoint/{{$clinic_data[0]->id}}/edit';">For my relative or friend</button>
                        </div>
                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div>
        <!--End Info Modal--> 

         <!--Rate Modal-->
         <div id="rate-modal" class="modal modal-message modal-info fade" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <!-- <div class="modal-title">Alert</div> -->
                        <center><h2><img src="{{ URL::asset('images/mrjams/logowithname.png') }}" width="220px" height="90px" class="center"></h2></center>

                        <div class="modal-body">
                            <strong>Enjoying This Clinic?</strong>
                            <br>
                            Tap a star to rate it.
                        </div>
                        <!-- <h1>Star rating </h1> -->
                            <div class="rating"> 
                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
                                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                            </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='';" style="margin: 0 auto;">Submit</button>
                            <!-- <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='/customer/rate/{{$clinic_data[0]->id}}';" style="margin: 0 auto;">Submit</button> -->

                        </div>
                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div>
        <!--End Info Modal--> 

    </section>

@endsection

