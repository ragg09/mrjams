@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/appoint-modal.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/rating-clinic-show.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/schedule.css')}}">
@endsection
@section('content')
@include('customerViews.header.header3')
    <section>

        <div class="container bootstrap snippets bootdey" style="margin-top: 20px;">
            <div class="row ng-scope">
                <div class="col-md-4">
                    
                        <div class="panel panel-default" style="padding: 10px;">
                            <div class="panel-body text-center">
                                <div class="pv-lg"><i class="fa fa-user-md fa-5x" aria-hidden="true" style="color: #6497B1; margin-bottom: 20px;"></i></div>
                                <h3 class="m0 text-bold" style="margin-top: -15px; font-size: 35px;"><b>{{$clinic_data->name}}</b></h3>
    
                                <span id=stars></span><br>
                                <span class="stars" value="{{$rate}}">
                                    
                                </span>
                                <b>Rating: {{number_format($rate,2)}}</b>
                                
                                <input type="hidden" name="rates" value="{{$rate}}">  
                            
                                <div class="mv-lg" style="margin-top: 15px; ">
                                    <p style="padding: 0px 10px 0px 10px;">Your Health is our Priority! Just a Reminder, It's Time For Your Appointment.</p>
    
                                </div>
                                
                            </div>
                        </div>
    
                         {{-- appointment --}}
                         <div class="panel panel-default hidden-xs hidden-sm" style="padding: 10px;">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                        
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#demo-modal" style="margin-bottom: 5px;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><b> : Get Appointment from this Clinic</b></button>
                                </div>
                            </div>
                            <div class="panel-body">
                               
                            </div>
                        </div>
                   

                   {{-- mapping --}}
                    <div class="panel panel-default hidden-xs hidden-sm" style="padding: 10px;">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                              
                                <div id="map" style="width:100%;height:457px;"></div>
                                {{-- <div id="msg"></div> --}}

                            </div>
                        </div>
                        <div class="panel-body">
                           
                        </div>
                    </div>

                    {{-- distance --}}
                    <div class="panel panel-default hidden-xs hidden-sm" style="padding: 10px;">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                            
                                <div id="msg"></div>

                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 20px;">
                            <div class="col-lg-12 m-15px-tb">
                                <input type="hidden" name="clinic_id" id="clinic_id" value="{{$clinic_data->id}}">  
                                <div class="resume-box">
                                    <ul>

                                        {{-- Clinic Information --}}
                                        <li>
                                            <div class="icon">
                                                <i class="fa fa-info fa-lg" aria-hidden="true"></i>
                                            </div>
                                            <h5 style="color: #6497B1; font-size:20px; font-weight: semibold;">Clinic Information</h5>

                                            <table class="table">
                                                <tbody>
                                                  <tr>
                                                    <th scope="row">Type:</th>
                                                    <td> {{$clinic_type->type_of_clinic}} Clinic</td>
                                                   
                                                  </tr>
                                                  <tr>
                                                    <th scope="row">Address: </th>
                                                    <td>{{$clinic_address->address_line_1}}, {{$clinic_address->address_line_2}}</td>
                                                   
                                                  </tr>
                                                  <tr>
                                                    <th scope="row">Phone: </th>
                                                    <td>{{$clinic_data->phone}}</td>
                                                  </tr>
                                                  <tr>
                                                    <th scope="row">Telephone: </th>
                                                    <td>{{$clinic_data->telephone}}</td>
                                                  </tr>
                                                </tbody>
                                            </table>

                                        </li>

                                        {{-- Clinic Services --}}
                                        <li>
                                            <div class="icon">
                                                <i class="fa fa-medkit fa-lg" aria-hidden="true"></i>
                                            </div>

                                            <h5 style="color: #6497B1; font-size:18px; font-weight: semibold;">Clinic Services:</h5>

                                            <table class="table">
                                                <tbody>
                                                    @foreach($services as $service)
                                                        <tr>
                                                            <th scope="row">- {{ $service->name }}</th>
                                                            <td> <b>Price:</b> {{ $service->min_price }} - {{ $service->max_price }}</td>
                                                        
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            
                                        </li>

                                        {{-- clinic Packages --}}
                                        <li>
                                            <div class="icon">
                                                <i class="fa fa-archive fa-lg" aria-hidden="true"></i>
                                            </div>
                                            <h5 style="color: #6497B1; font-size:18px; font-weight: semibold;">Clinic Packages:</h5>

                                            <table class="table">
                                                <tbody>
                                                    @foreach($packages as $package)

                                                        <tr>
                                                            <th scope="row">- {{ $package->name }}</th>
                                                            <td> <b>Price:</b> {{ $package->min_price }}</td>
                                                        
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                        </li>

                                        {{-- Clinic Doctors --}}
                                        <li>
                                            <div class="icon">
                                                <i class="fa fa-user-md fa-lg" aria-hidden="true"></i>
                                            </div>
                                            
                                            <h5 style="color: #6497B1; font-size:18px; font-weight: semibold;">Clinic Doctors:</h5>

                                            <table class="table">
                                                <tbody>
                                                    @foreach($doctor as $doctors)
                                                    <tr>
                                                        <th scope="row">- {{ $doctors->specialization }} : {{ $doctors->fullname }}</th>
                                                        {{-- <td scope="row">{{ $doctors->specialization }}</td> --}}
                                                        <td> <b>Time Availability :</b> {{  date("h:i A", strtotime($doctors->min_time)) }} - {{  date("h:i A", strtotime($doctors->max_time)) }}</td>
                                                        
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                     {{-- Clinic Schedule --}}
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 10px;">
                            
                            <div class="col-lg-12 m-15px-tb">
                                <div class="resume-box">
                                    <div class="container">
                                        <div class="m0 text-bold">
                                           
                                            <h5 class="m0 text-bold" style="color: #6497B1; font-size:20px; font-weight: semibold; margin-top: 5px;"> <i class="fa fa-calendar" aria-hidden="true" ></i> : {{$clinic_data->name}} Schedule</h5>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr class="">
                                                        {{-- <th class="text-uppercase">Time</th> --}}
                                                        <th class="text-uppercase" style="background-color: #D0E5FA">S</th>
                                                        <th class="text-uppercase" style="background-color: #AAE3A7">M</th>
                                                        <th class="text-uppercase" style="background-color: #F2F1D1">T</th>
                                                        <th class="text-uppercase" style="background-color: #F1C0A0">W</th>
                                                        <th class="text-uppercase" style="background-color: #86B6C9">Th</th>
                                                        <th class="text-uppercase" style="background-color: #FCFC99">F</th>
                                                        <th class="text-uppercase" style="background-color: #FFCED4">Sa</th>
                                                      
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    <tr>
                                                        <td>
                                                            <div class="margin-10px-top font-size14">{{  date("h:i A", strtotime($avail[0]->min)) }}-{{  date("h:i A", strtotime($avail[0]->max)) }}</div>
                                                            {{-- <div class="font-size13 text-muted">Status : {{$avail[0]->status}}</div> --}}
                                                            @if ($avail[0]->status == "on")
                                                                <div class="font-size13 text-muted"><b>Status: Open</b></div>
                                                            @else
                                                                <div class="font-size13 text-muted"><b>Status: Close</b></div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{-- <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Dance</span> --}}
                                                            <div class="margin-10px-top font-size14">{{  date("h:i A", strtotime($avail[1]->min)) }}-{{  date("h:i A", strtotime($avail[1]->max)) }}</div>
                                                            @if ($avail[1]->status == "on")
                                                                <div class="font-size13 text-muted"><b>Status: Open</b></div>
                                                            @else
                                                                <div class="font-size13 text-muted"><b>Status: Close</b></div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            
                                                            <div class="margin-10px-top font-size14">{{  date("h:i A", strtotime($avail[2]->min)) }}-{{  date("h:i A", strtotime($avail[2]->max)) }}</div>
                                                            @if ($avail[2]->status == "on")
                                                                <div class="font-size13 text-muted"><b>Status: Open</b></div>
                                                            @else
                                                                <div class="font-size13 text-muted"><b>Status: Close</b></div>
                                                            @endif
                                                           
                                                        </td>
                        
                                                        <td>
                                                        
                                                            <div class="margin-10px-top font-size14">{{  date("h:i A", strtotime($avail[3]->min)) }}-{{  date("h:i A", strtotime($avail[3]->max)) }}</div>
                                                            @if ($avail[3]->status == "on")
                                                                <div class="font-size13 text-muted"><b>Status: Open</b></div>
                                                            @else
                                                                <div class="font-size13 text-muted"><b>Status: Close</b></div>
                                                            @endif
                                                          
                                                        </td>
                                                        <td>
                                                           
                                                            <div class="margin-10px-top font-size14">{{  date("h:i A", strtotime($avail[4]->min)) }}-{{  date("h:i A", strtotime($avail[4]->max)) }}</div>
                                                            @if ($avail[4]->status == "on")
                                                                <div class="font-size13 text-muted"><b>Status: Open</b></div>
                                                            @else
                                                                <div class="font-size13 text-muted"><b>Status: Close</b></div>
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                           
                                                            <div class="margin-10px-top font-size14">{{  date("h:i A", strtotime($avail[5]->min)) }}-{{  date("h:i A", strtotime($avail[5]->max)) }}</div>
                                                            @if ($avail[5]->status == "on")
                                                                <div class="font-size13 text-muted"><b>Status: Open</b></div>
                                                            @else
                                                                <div class="font-size13 text-muted"><b>Status: Close</b></div>
                                                            @endif
                                                           
                                                        </td>
                                                        <td>
                                                            
                                                            <div class="margin-10px-top font-size14">{{  date("h:i A", strtotime($avail[6]->min)) }}-{{  date("h:i A", strtotime($avail[6]->max)) }}</div>
                                                            @if ($avail[6]->status == "on")
                                                                <div class="font-size13 text-muted"><b>Status: Open</b></div>
                                                            @else
                                                                <div class="font-size13 text-muted"><b>Status: Close</b></div>
                                                            @endif
                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
    
                                </div>
                            </div>
        
                        </div>
                    </div>

                </div>

                
            </div>
        </div>


        {{-- get appointment --}}
        <div class="modal fade" id="demo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false" >
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
            
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-user-md " aria-hidden="true" style="color: #6497B1;"></i> <b>{{$clinic_data->name}}</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            
                    <div class="modal-body">
                        {{-- main body --}}
                        <p><b>For whom is this appointment?</b></p>
                    </div>
            
                    <div class="modal-footer">
                        {{-- mga button --}}
                        <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='/customer/appointment/{{$clinic_data->id}}/edit';">Myself</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal" onclick="window.location.href='/customer/relativeappoint/{{$clinic_data->id}}/edit';">For my relative or friend</button>
    
                    </div>
            
                </div>
            </div>
        </div>

        

    </section>
@include('customerViews.footer.footer2')

@endsection
@section('jsScript')
    <script src="{{ URL::asset('js/customer/clinic_rate.js') }}"></script>
    
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places"></script>
    <script src="{{ URL::asset('js/customer/mail_map.js') }}"></script>
    <script src="{{ URL::asset('js/customer/notifications.js') }}"></script>
@endsection


