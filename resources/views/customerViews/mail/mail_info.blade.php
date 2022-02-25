@extends('layouts.customerlayout1')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/mail-info-content.css')}}">
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
                        <span class="card-author subtle"><strong>Date Created:  </strong>{{$appointment_data->created_at}}</span>
                        <span class="card-author subtle"><strong>Date Appointment:  </strong> {{$appointment_data->appointed_at}}</span>
                        <span class="card-author subtle"><strong>Time:  </strong>{{$appointment_data->time}}</span>
                        <h2 class="card-title">{{$clinic_info->name}}</h2>
                        <span class="card-author subtle"><strong>Phone & Telephone:  </strong>{{$clinic_info->phone}} <strong>&</strong> {{$clinic_info->telephone}}</span>
                        
                        <span class="card-author subtle"><strong>Address: </strong>{{$clinic_address->address_line_1}}, {{$clinic_address->address_line_2}}</span>
                        <span class="card-author subtle"><strong>Appointment Status: </strong>{{$status->status}}</span>
                        <span class="card-author subtle"><strong>Services: </strong>{{$service->name}}</span>
                        <span class="card-author subtle"><strong>Packages: </strong>{{$package->name}}</span>
                        <br>
                        <!-- <div class="card-read"><a href="#demo-modal">Get Appointment</a></div> -->
                        <!-- <span class="card-tag card-circle subtle">C</span> -->
                    </div>
                </div>

                <div class="col text-center">
                    <img src="/images/mrjams/appoint-info.png" alt="" width="320px" height="400px" style="padding-top: 80px;"/>
                </div>
                
            </div>
            
     
        </div>
    </section>
@endsection