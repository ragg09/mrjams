@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/mail-info-content.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/rating.css')}}">
@endsection
@section('content')     
@include('customerViews.header.header3')
    <section>


        <div class="container bootstrap snippets bootdey" style="margin-top: 20px;">
            <div class="row ng-scope" id="appoint_info">
                <div class="col-md-4">

                    <input type="hidden" name="clinic_id" id="clinic_id" value="{{$clinic_info->id}}">

                    <div class="panel panel-default" style="padding: 30px;">
                        <div class="panel-body text-center">
                            <div class="pv-lg"><i class="fa fa-calendar fa-5x" aria-hidden="true" style="color: #6497B1; margin-bottom: 25px;"></i></div>
                            <h3 class="m0 text-bold" style="margin-top: -15px;"><b>{{$clinic_info->name}}</b></h3>
                            <div class="mv-lg" style="margin-top: 15px;">
                                <p style="padding: 0px 10px 0px 10px;">Your Health is our Priority! Just a Reminder, It's Time For Your Appointment.</p>
                                {{-- <p><b>Email: </b> mr.jams1822@gmail.com</p>
                                <p><b>Phone: </b> +63 1234567890</p>
                                <p><b>Telephone: </b> +63 1234567890</p> --}}

                            </div>
                            
                        </div>
                    </div>

                    {{-- rating --}}
                    <div class="panel panel-default hidden-xs hidden-sm" style="padding: 10px;">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#rate-modal"><i class="fa fa-star" aria-hidden="true"></i><b> : How would you rate our Clinic?</b></button>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                        </div>
                    </div>

                    <div class="panel panel-default hidden-xs hidden-sm" style="padding: 10px;">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                              
                                <div id="map" style="width:100%;height:250px;"></div>
                                {{-- <div id="msg"></div> --}}

                            </div>
                        </div>
                        <div class="panel-body">
                           
                        </div>
                    </div>

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


                        <div class="resume-box">
                            <ul>
                                
                                <li>
                                    
                                    <div class="icon">
                                        <i class="fa fa-calendar-check-o fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <h5 style="color: #6497B1; font-size:20px;"><b>Appointment Information:</b></h5> 
                                        </div>
                                            
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-light" ><i class="fa fa-download fa-lg" aria-hidden="true" onclick="printPage()"></i></button>
                                        </div>
                                    </div>
                                   
                                    <table class="table">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Date Created: </th>
                                            <td> {{ date("M j, Y", strtotime($appointment_data->created_at))}}</td>
                                           
                                          </tr>
                                          <tr>
                                            <th scope="row">Appointment Date: </th>
                                            <td>{{ date("M j, Y", strtotime($appointment_data->appointed_at))}}</td>
                                           
                                          </tr>
                                          <tr>
                                            <th scope="row">Time: </th>
                                            <td>{{  date("h:i A", strtotime($appointment_data->time)) }}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Appointment Status: </th>
                                            <td><i class="fa fa-star text-{{$status->remark}}" aria-hidden="true"></i> {{$status->status}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Customer Name:  </th>
                                            <td>{{$name[0]}}</td>
                                          </tr>
                                        </tbody>
                                    </table>

                                  

                                    {{-- <p>Date Created: {{ date("M j, Y", strtotime($appointment_data->created_at))}}</p>
                                    <p>Appointment Date: {{ date("M j, Y", strtotime($appointment_data->appointed_at))}}</p>
                                    <p>Time: {{  date("h:i A", strtotime($appointment_data->time)) }}</p>
                                    <p>Appointment Status: <i class="fa fa-star text-{{$status->remark}}" aria-hidden="true"></i> {{$status->status}}</p>
                                    <p>Customer Name:  {{$name[0]}}</p> --}}
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-user-md fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <h5 style="color: #6497B1; font-size:18px;"><b>Clinic Information:</b></h5>
                                    <table class="table">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Address:  </th>
                                            <td> {{$clinic_address->address_line_1}}, {{$clinic_address->address_line_2}}</td>
                                           
                                          </tr>
                                          <tr>
                                            <th scope="row">Phone:</th>
                                            <td>{{$clinic_info->phone}}</td>
                                           
                                          </tr>
                                          <tr>
                                            <th scope="row">Telephone: </th>
                                            <td>{{$clinic_info->telephone}}</td>
                                          </tr>
                                        </tbody>
                                    </table>

                                    {{-- <p>Address: {{$clinic_address->address_line_1}}, {{$clinic_address->address_line_2}}</p>
                                    <p>Phone: {{$clinic_info->phone}}</p>
                                    <p>Telephone: {{$clinic_info->telephone}}</p> --}}
                                    
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-archive fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <h5 style="color: #6497B1; font-size:18px;"><b>Packages and Services:</b></h5>

                                  
                                    

                                    <table class="table">
                                        <tbody>
                                            @if(isset($services_all))
                                                <tr>
                                                    <th scope="row">Services : </th>
                                                    @foreach ($services_all as $services)
                                                        <td> - {{$services->name}}</td>
                                                    @endforeach
                                                </tr>
                                            @endif

                                            @if(isset($package))
                                            <tr>
                                                <th scope="row">Package : </th>
                                                <td> - {{$package->name}}</td>
                                               
                                            </tr>
                                          
                                           
                                            @endif


                                        </tbody>
                                    </table>

                                   
                                             {{-- @if(isset($services_all))
                                                <p><b>Services : </b></p>
                                                @foreach ($services_all as $services)
                                                    <p>- {{$services->name}}</p>
                                                @endforeach
                                            @endif --}}
                                    
                                        
                                   


                                </li>
                            </ul>
                        </div>
                    </div>
                    
               
            
        

                        </div>
                    </div>
                </div>
            </div>
        </div>


          {{-- modal rating --}}
        <form action="/customer/appointment" method="POST" id="main_form">
            @csrf
            <div class="modal fade" id="rate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false" style="text-align: center">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-user-md " aria-hidden="true" style="color: #6497B1;"></i> <b>{{$clinic_info->name}}</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                
                        <div class="modal-body" style="align-items: center; justify-content: center;">
                            <p><b>Enjoying This Clinic? </b></p>
                            <p>Tap a star to rate it. </p>
                            
                                    <input type="hidden" name="rater_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="ratee_id" value="{{$clinic_info->id}}">
                                    <div class="rating"> 
                                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
                                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
                                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
                                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                    </div>
                            
                        </div>
                
                        <div class="modal-footer">
                            {{-- mga button --}}
                            <button type="submit" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Submit">Submit</button>
        
                        </div>

                    
                
                    </div>
                </div>
            </div>

        </form>

        

        
       
            
    </section>
@include('customerViews.footer.footer2')
@endsection
@section('jsScript')
   
    <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places"></script>
    <script src="{{ URL::asset('js/customer/mail_map.js') }}"></script>

    <script src="{{ URL::asset('js/customer/clinic_rating.js') }}"></script> 
    {{-- <script src="{{ URL::asset('js/customer/print.js') }}"></script> --}}
    <script>
        function printPage(){
            window.print();
        }
    </script>
@endsection
