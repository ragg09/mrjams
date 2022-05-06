@extends('customerViews.layouts.customerlayout')
@section('title', 'MR. JAMS - About')
@section('specificStyle')

    <link rel="stylesheet" href="{{asset('./css/customer/about-mr.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/index_one.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/customer.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/profile1.css')}}">
@endsection
@section('content')
@include('customerViews.header.header1')

<section class="hero">
    <div class="background-image1"></div>
    <div class="hero-content-area1">
      <h1>Your Health is our Priority!</h1>
      <h3>Just a Reminder, It's Time For Your Appointment</h3>
      <a href="/public/download" class="btn">Download Now</a>
    </div>
</section>

 
<section class="about" style="font-family: 'Roboto', sans-serif;">
    <br>
    <h3 style="color: #116895; font-size: 30px;"><b>About MR. JAMS</b></h3>
    <br>
    {{-- <p class="subtitle">MISSION</p> --}}
    <p style="font-size: 15px;"> <b>MR. JAMS</b> is a web and mobile application that allows users to schedule appointments with clinics that have registered for the system. You may also find out which clinic is nearest to your present location by using this website. You will also get the information a user requires at that clinic, such as the clinic's address, phone number, services, packages, clinic schedules, doctors, clinic rate, and the clinic's distance from your current location. Clinics who registered in this web application will gain access to a management system that will allow them to keep track of their supplies, equipment, services, packages, reports, incoming appointments, doctor availability, patient records, and much more. To assist them in their regular tasks.</p>
    
    <br><br><br><br>
</section>
  

<div class="container" style="font-family: 'Roboto', sans-serif;">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-lg-6">
            <!-- Section Heading-->
            <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
              <h3 style="color: #116895; font-size: 30px;"><b>Our Creative Team</b></h3><br>
              {{-- <p style="font-size: 16px;"><b>Technological University of the Philippines - Taguig</b></p>
             
              <p style="font-size: 15px;"><b>Bachelor of Science in Information Technology - 4A</b></p>
              <p style="font-size: 15px;">Appointment and Management System for Dental and Medical Clinics with Location-Based Mapping </p> --}}
              <br>
              <div class="line"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Single Advisor-->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
              <!-- Team Thumb-->
              <div class="advisor_thumb"><img src="{{ asset('images/mrjams/gunayon.png') }}" alt=""  height="315">
                <!-- Social Info-->
                <div class="social-info"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a><a href="https://www.linkedin.com/login"><i class="fa fa-linkedin"></i></a></div>
              </div>
              <!-- Team Details-->
              <div class="single_advisor_details_info">
                <h6>Rene Angelo Gunayon</h6>
                <p class="designation">BSIT 4A | 2022</p>
              </div>
            </div>
          </div>
          <!-- Single Advisor-->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
              <!-- Team Thumb-->
              <div class="advisor_thumb"><img src="{{ asset('images/mrjams/manalo.png') }}" alt=""  height="315">
                <!-- Social Info-->
                <div class="social-info"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a><a href="https://www.linkedin.com/login"><i class="fa fa-linkedin"></i></a></div>
              </div>
              <!-- Team Details-->
              <div class="single_advisor_details_info">
                <h6>Julius Arnel Manalo</h6>
                <p class="designation">BSIT 4A | 2022</p>
              </div>
            </div>
          </div>
          <!-- Single Advisor-->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
              <!-- Team Thumb-->
              <div class="advisor_thumb"><img src="{{ asset('images/mrjams/dagoro.png') }}" alt=""  height="315">
                <!-- Social Info-->
                <div class="social-info"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a><a href="https://www.linkedin.com/login"><i class="fa fa-linkedin"></i></a></div>
              </div>
              <!-- Team Details-->
              <div class="single_advisor_details_info">
                <h6>Angela Dagoro</h6>
                <p class="designation">BSIT 4A | 2022</p>
              </div>
            </div>
          </div>
          <!-- Single Advisor-->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
              <!-- Team Thumb-->
              <div class="advisor_thumb"><img src="{{ asset('images/mrjams/dollente.png') }}" alt=""  height="315">
                <!-- Social Info-->
                <div class="social-info"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a><a href="https://www.linkedin.com/login"><i class="fa fa-linkedin"></i></a></div>
              </div>
              <!-- Team Details-->
              <div class="single_advisor_details_info">
                <h6>Michael John Dollente</h6>
                <p class="designation">BSIT 4A | 2022</p>
              </div>
            </div>
          </div>
        </div>
      </div>

@include('customerViews.footer.footer1') 
@endsection

  