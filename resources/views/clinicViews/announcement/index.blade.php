@extends('clinicViews.layouts.announcement')
@section('extraStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/announcement.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/announce.css')}}">

    <link rel="stylesheet" href="{{asset('./css/customer/rating.css')}}">
    
@endsection
@section('content')
<section>
    <div id="admin" class="mt-5">

        <div class="container bootstrap snippets bootdey" style="margin-top: 20px;">
            <div class="row ng-scope" id="announce">
                <div class="col-md-4">
                    <div class="panel panel-default" style="padding: 10px;">
                        <div class="panel-body text-center">
                            <div class="pv-lg" ><img style="background-color: inherit" class="center-block img-responsive img-thumbnail thumb96" src="/images/mrjams/mr-jams-logo.png" alt="Contact"></div>
                            <h3 class="m0 text-bold" style="margin-top: -15px;"><img src="/images/mrjams/nameSystem.png" alt="" width="150" height="85"></h3>
                            <div class="mv-lg" style="margin-top: -15px;">
                                <p>Appointment and Management System for Dental and Medical Clinics with Location-Based Mapping</p>
                                <p><b>Email: </b> mr.jams1822@gmail.com</p>
                                <p><b>Phone: </b> +63 1234567890</p>
                                <p><b>Telephone: </b> +63 1234567890</p>

                            </div>
                            
                        </div>
                    </div>

                    {{-- rating Admin --}}
                    <div class="panel panel-default hidden-xs hidden-sm" style="padding: 10px;">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                                <button class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#give_feedback" id="detail_modal"><i class="fa fa-star" aria-hidden="true"></i><b> : How would you rate our System?</b></button>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                        </div>
                    </div>
                   
                    
                </div>

                {{-- Announcement List --}}
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 20px;">
                            <div class="h4 text-center text-danger" style="padding-bottom: 10px;"><b>Announcements: </b></div>
                                        
                                                        <div class="timeline" style="background-color: inherit">
                                                
                                                            <!-- Timeline header -->
                                                            @foreach($announcemnet as $row)
                                                            <div class="timeline-entry">
                                                                <div class="timeline-stat" >
                                                                    <div class="timeline-icon" >
                                                                        <img src="/images/mrjams/mr-jams-logo.png" alt="admin">
                                                                    </div>
                                                                    <div class="timeline-time">{{  date("h:i A", strtotime($row->created_at)) }}</div>
                                                                </div>
                                                                <div class="timeline-label">
                                                                    <h4 class="mar-no pad-btm"><a href="#" class="text-danger">MR. JAMS</a></h4>
                                                                    <p style="font-size: 13px;">{{ date("M j, Y", strtotime($row->created_at))}}</p>
                                                                    <p>{{ $row->message }}</p>
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

    </div>

               




       
</section>

@endsection
@section('jsScript')
    <script src="{{ URL::asset('js/customer/rating.js') }}"></script> 
    <script src="{{ URL::asset('js/customer/contact-Admin.js') }}"></script> 
@endsection