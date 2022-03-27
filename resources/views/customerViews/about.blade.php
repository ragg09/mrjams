@extends('customerViews.layouts.customerlayout')
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
      <h3>Just a Remember, It's Time For Your Appointment</h3>
      <a href="#" class="btn">Download Now</a>
    </div>
  </section>

 
  <section class="about">
    <br><br>
    <h3 class="title">About MR. JAMS</h3>
    <hr>
    <p class="subtitle">MISSION</p>
    <p class="parag">Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
    <br><br>
    <p class="subtitle">VISION</p>
    <p class="parag">Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
    <br><br>
    <p class="subtitle">COMPANY PROFILE</p>
    <p class="parag">Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
    <br><br><br><br>
  </section>


  {{-- <section>

    <div class="container">
      <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
          <div class="card radius-15" style="margin-bottom: 40px;">
            <div class="card-body text-center">
              <div class="p-4 border radius-15">
                <img src="{{ asset('images/mrjams/gunayon.jpg') }}" width="120" height="120" class="rounded-circle shadow" alt="">
                <h5 class="mb-0 mt-5">Rene Angelo G. Gunayon</h5>
                <p class="mb-3">Web Developer</p>
             
              
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card radius-15">
            <div class="card-body text-center">
              <div class="p-4 border radius-15">
                <img src="{{ asset('images/mrjams/manalo.jpg') }}" width="120" height="120" class="rounded-circle shadow" alt="">
                <h5 class="mb-0 mt-5">Julius Arnel Manalo</h5>
                <p class="mb-3">UI Developer</p>
               
               
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card radius-15">
            <div class="card-body text-center">
              <div class="p-4 border radius-15">
                <img src="{{ asset('images/mrjams/dagoro.jpg') }}" width="120" height="120" class="rounded-circle shadow" alt="">
                <h5 class="mb-0 mt-5">Angela E. Dagoro</h5>
                <p class="mb-3">Graphic Designer</p>
                
               
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card radius-15">
            <div class="card-body text-center">
              <div class="p-4 border radius-15">
                <img src="{{ asset('images/mrjams/dollente.jpg') }}" width="120" height="120" class="rounded-circle shadow" alt="">
                <h5 class="mb-0 mt-5">Michael John M. Dollente</h5>
                <p class="mb-3">Android Developer</p>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section> --}}

  

<div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-lg-6">
            <!-- Section Heading-->
            <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
              <h3 style="color: #116895;"><b>Our Creative <span> Team</span></b></h3><br>
              <h5><b>Technological University of the Philippines - Taguig</b></h5>
              {{-- <p>Km. 14 East Service Road Western Bicutan, Taguig City 1630</p> --}}
              <h6><b>Bachelor of Science in Information Technology - 4A</b></h6>
              <h6>Appointment and Management System for Dental and Medical Clinics with Location-Based Mapping </h6>
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
                <p class="designation">Web Developer</p>
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
                <p class="designation">UI Developer</p>
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
                <p class="designation">Graphic Designer</p>
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
                <p class="designation">Android Developer</p>
              </div>
            </div>
          </div>
        </div>
      </div>

@include('customerViews.footer.footer1') 
@endsection

  