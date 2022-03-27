@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/announcement.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/announce.css')}}">

    <link rel="stylesheet" href="{{asset('./css/customer/rating.css')}}">
    
@endsection
@section('content')
@include('customerViews.header.header3')

<section>
    <div id="admin">

        <div class="container bootstrap snippets bootdey" style="margin-top: 20px;">
            <div class="row ng-scope" id="announce">
                <div class="col-md-4">
                    <div class="panel panel-default" style="padding: 10px;">
                        <div class="panel-body text-center">
                            <div class="pv-lg"><img class="center-block img-responsive img-thumbnail thumb96" src="/images/mrjams/mr-jams-logo.png" alt="Contact"></div>
                            <h3 class="m0 text-bold" style="margin-top: -15px;"><img src="/images/mrjams/nameSystem.png" alt="" width="150" height="85"></h3>
                            <div class="mv-lg" style="margin-top: -15px;">
                                <p>Hello, I'm a just a dummy contact in your contact list and this is my presentation text. Have fun!</p>
                                <p><b>Email: </b> mr.jams1822@gmail.com</p>
                                <p><b>Phone: </b> +63 1234567890</p>
                                <p><b>Telephone: </b> +63 1234567890</p>

                            </div>
                            {{-- <div class="text-center"><a class="btn btn-primary" href="">Send message</a></div> --}}
                        </div>
                    </div>

                    {{-- rating Admin --}}
                    <div class="panel panel-default hidden-xs hidden-sm" style="padding: 10px;">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                                {{-- <a href="#" data-toggle="modal" data-target="#rate-modal">
                                <i class="fa fa-star" aria-hidden="true"></i><b> : How would you rate our System?</b>
                                </a> --}}
                                <button class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#rate-modal"><i class="fa fa-star" aria-hidden="true"></i><b> : How would you rate our System?</b></button>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                        </div>
                    </div>


                    <form action="/customer/announcement" method="POST" id="contact_form">
                        @csrf
                        <div class="panel panel-default hidden-xs hidden-sm" style="padding: 15px;">
                            <div class="panel-heading">
                                <div class="panel-title text-center" style="margin-bottom: 5px;"><i class="fa fa-envelope" aria-hidden="true"></i><b> : Want to Know More?? Drop Us a Mail</b></div>
                            </div>
                            <div class="panel-body" style="border-top: 5px solid #B3CDE0;">
                                {{-- @foreach($customer as $customers) --}}
                                <div class="form-group" style="margin-top: 15px;">
                                    {{-- <label class="col-sm-2 control-label" for="inputContact1">Name</label> --}}
                                    <div class="col-sm-12">
                                        <input class="form-control" id="inputContact1" type="text" placeholder="Name: {{$customer->fname}} {{$customer->lname}}" readonly>
                                    </div>
                                </div>
    
                                <div class="form-group" style="margin-top: 8px;">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="inputContact1" type="text" placeholder="Email: {{Auth::user()->email}}" readonly>
                                    </div>
                                </div>
    
                                <div class="form-group" style="margin-top: 8px;">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="inputContact1" type="text" placeholder="Phone: {{$customer->phone}}" readonly>
                                    </div>
                                </div>
                                {{-- @endforeach --}}

                                <input type="text" name="users_id" value="{{Auth::user()->id}}" hidden>
    
                                <div class="form-group" style="margin: 8px 0px 8px 0px;">
                                    <div class="col-sm-12" id="admin-message">
                                        <textarea class="form-control" id="inputContact1" type="text" name="message"  id="message" placeholder="Message" ></textarea>
                                    </div>
                                </div>
    
                                <button type="submit" class="btn btn" style="background-color: #6497B1" aria-label="Submit">Submit</button>
                               
                            </div>
                        </div>
                    </form>
                   
                    
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 20px;">
                            <div class="h4 text-center text-danger" style="padding-bottom: 10px;"><b>Announcements: </b></div>
                                        
                                                        <div class="timeline">
                                                
                                                            <!-- Timeline header -->
                                                            @foreach($announceP as $patient)
                                                            <div class="timeline-entry">
                                                                <div class="timeline-stat">
                                                                    <div class="timeline-icon">
                                                                        <img src="/images/mrjams/mr-jams-logo.png" alt="admin">
                                                                    </div>
                                                                    <div class="timeline-time">{{  date("h:i A", strtotime($patient->created_at)) }}</div>
                                                                </div>
                                                                <div class="timeline-label">
                                                                    <h4 class="mar-no pad-btm"><a href="#" class="text-danger">MR. JAMS</a></h4>
                                                                    <p style="font-size: 13px;">{{ date("M j, Y", strtotime($patient->created_at))}}</p>
                                                                    <p>{{ $patient->message }}</p>
                                                                </div>
                                                            </div>
                                                            @endforeach
                

                                                        </div>
                                                  

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <form action="/customer/rate" method="POST" id="main_form">
            @csrf
            <div class="modal fade" id="rate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" width="200px" height="70px" style="margin: -15px;"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                
                        <div class="modal-body" style="align-items: left; justify-content: left;">

                            <div class="form-group">
                                <label for="area" style="margin-bottom: 5px;"><b>How can we improve?</b></label>
                                
        
                                <select class="form-select" aria-label="Default select example" id="area" name="area">
                                    <option selected>Choose an area</option>
                                    <option value="Appointment">Appointment</option>
                                    <option value="Billings">Billings</option>
                                    <option value="Calendar">Calendar</option>
                                    <option value="Dashboard">Dashboard</option>
                                    <option value="Emails">Emails</option>
                                    <option value="Logs">Logs</option>
                                    <option value="Mapping">Mapping</option>
                                    <option value="Material Inventory">Material Inventory</option>
                                    <option value="Packages">Packages</option>
                                    <option value="Services">Services</option>
                                    <option value="Settings">Settings</option>
                                    <option value="User Interface">User Interface</option>
                                    <option value="Others">Others</option>
                                </select>
        
                                <span class="text-danger error-text area_error"></span>
                            </div>
        
                            <div class="form-group mt-2">
                                <label for="text" style="margin-bottom: 5px;"><b>Details</b></label>
                                <textarea class="form-control w-100" id="text" style="min-height: 200px; max-height: 200px" placeholder="Please include as much information as possible . . ." name="message"></textarea>
                                <span class="text-danger error-text message_error"></span>
                            </div>


                            <div class="form-group mt-2">
                                <label for="text" style="margin-bottom: 5px;"><b>How would you rate our System?</b></label>
                                <input type="hidden" name="rater_id" value="{{Auth::user()->id}}">
                 
                                <div class="rating"> 
                                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
                                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                </div>

                                <div class="row">
                                    <div class="col d-flex justify-content-center">
                                        <span class="text-danger error-text rating_error"></span>
                                    </div>
                                </div>
            
                                <div>
                                    <p style="font-size: 14px; margin-top:5px;">Let us know if you have ideas that can help make our products better. 
                                        If you need help with solving a specific problem, please email us directly. 
                                    </p>
                                </div>
                            </div>

                            
                            
                            
                        </div>
                
                        <div class="modal-footer">
                            {{-- mga button --}}
                            <button type="submit" class="btn btn-warning" aria-label="Submit">Submit</button>
        
                        </div>

                    
                
                    </div>
                </div>
            </div>

        </form>

    </div>

               




       
</section>
@include('customerViews.footer.footer2')
@endsection
@section('jsScript')
    <script src="{{ URL::asset('js/customer/rating.js') }}"></script> 
    <script src="{{ URL::asset('js/customer/contact-Admin.js') }}"></script> 
@endsection