@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/index_one.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/map.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/infowindow.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/customer.css')}}">
@endsection
@section('content')
@include('customerViews.header.header1')


      <section class="hero">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;	background-image: url(/images/mrjams/index_one.jpg); background-size: cover; z-index: -1; background-color: #80a3db;"></div>
          <div class="hero-content-area">
            <h1>Your Health is our Priority!</h1>
            <h3>Just a Reminder, It's Time For Your Appointment</h3>

            <a href="#map_locate" class="btn">Get Appointment</a>
          </div>
      </section>
      
      <section class="mapcontain">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="mapModal" hidden>
        </button>

       

        <div class="container" id="map_locate">

          <div class="form-floating mb-3" >
            <input class="form-control" type="text" id="searchInput" placeholder="" >
            <label for="floatingInput">Search landmark near to your location</label>
          </div>

          {{-- <select id="ClinicType" style="margin: 10px; background-color: #B3CDE0; padding:5px;">
            <option value="ClinicTypes">Clinic Types</option> 
            <option value="1">Dental</option> 
            <option value="2">Medical</option> 
          </select> --}}



          <div id="map"></div>
        </div>
          <br><br>
      </section>

      <section >

                <div class="container">
                  <div class="row align-items-center">
                      <div class="col-lg-6 mb-4 mb-lg-0">
                          <div class="mx-auto text-center">
                            <img src="/images/mrjams/steps1.png" alt="" width="100%" height="300px"/>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                            <br>
                            <p style="font-size: 30px;"><b>Guide for Making Appointments</b></p>
                            <p><b>Step 1: Navigate to the Mapping section and select the clinic where you'd want to schedule an appointment.</b> Customers can schedule an appointment in one of two ways: first, go to the maps and select a clinic, or second, go to the clinic tab and search for the clinic they wish to visit. There's also a category search to help you discover the clinic you're looking for more quickly. </p>
                                 
                                 
                          </div>
                      </div>
                  </div>
                </div>
          
                <div class="container">
                  <div class="row align-items-center">
                     

                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                          <br>
                          <br>
                          <!-- <h1>Column 1</h1> -->
                          <p><b>Step 2: When you click "View More," all of the clinic's information will show.</b> Then you will see the clinic's contact information, such as phone and fax numbers. There's also the clinic's address, as well as the clinic's packages and services. You can also make an appointment on this page if you see a package or service that you want at that clinic. </p>
                                 
                          </div>
                      </div>

                      <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="mx-auto text-center">
                          <img src="/images/mrjams/steps2.png" alt="" width="100%" height="300px"/>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="container">
                  <div class="row align-items-center">
                      <div class="col-lg-6 mb-4 mb-lg-0">
                          <div class="mx-auto text-center">
                            <img src="/images/mrjams/steps3.png" alt="" width="100%" height="300px"/>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                            <br>
                            <br>
                          <p><b>Step 3: After clicking "Get Appointment," you'll be asked if this appointment is for you or for someone else, such as a relative or friend. </b>It is important for the clinic you choose to know if this appointment is for you or not. Because the clinic requires the patient's details in order to schedule an appointment</p>
                                 
                                 
                          </div>
                      </div>
                  </div>
                </div>


                <div class="container" style="margin-bottom: 40px;">
                  <div class="row align-items-center">
                     

                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                            <br>
                            <br>
                            <p><b>Step 4: After you've answered the question, you'll be directed to the appointment page, where you may fill out the necessary details. </b>Personal information such as name, age, address, and other details must be filled in. There's also one for the service or package you choose. After you've completed all of the required fields, you can submit your request and wait for confirmation from the clinic of your choice.</p>
                                 
                          </div>
                      </div>

                      <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="mx-auto text-center">
                          <img src="/images/mrjams/steps4.png" alt="" width="100%" height="300px"/>
                        </div>
                    </div>
                  </div>
                </div>


    </section>

    <section class="packages">
      <ul class="grid">
        <li>
          <i class="fa fa-map-marker fa-4x"></i>
          <h4>Mapping</h4>
          <p>Mapping for nearby and available clinics.</p>
        <li>
          <i class="fa fa-medkit fa-4x"></i>
          <h4>Medical Services</h4>
          <p>list of services offered by a clinic.</p>
        </li>
        <li>
          <i class="fa fa-user-md fa-4x"></i>
          <h4>Find A Doctor</h4>
          <p>A doctor who specializes in the service you need.</p>
        </li>
        <li>
          <i class="fa fa-calendar fa-4x"></i>
          <h4>Request an Appoinment</h4>
          <p>You can schedule an appointment at any time and from any location.</p>
        </li>
      </ul>
      <br><br>
    </section>

@include('customerViews.footer.footer1')
{{-- 
<button onclick="getLocation()">Try It</button>

<p id="demo"></p>
<p id="demos"></p> --}}


@endsection
@section('jsScript')
  <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places"></script>
  <script src="{{ URL::asset('js/customer/map.js') }}"></script>

  {{-- <script>
    var x = document.getElementById("demo");
    var y = document.getElementById("demos");
    
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
        y.innerHTML = "Geolocation is not supported by this browsers.";
      }
    }
    
    function showPosition(position) {
      x.innerHTML = "Latitude: " + position.coords.latitude;
      y.innerHTML ="Longitude: " + position.coords.longitude;

    }
  </script> --}}

@endsection


  

  
 