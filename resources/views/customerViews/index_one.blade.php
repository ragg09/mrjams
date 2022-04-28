@extends('customerViews.layouts.customerlayout')
@section('title', 'MR. JAMS - Home')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/index_one.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/map.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/infowindow.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/customer.css')}}">
  
@endsection
@section('content')
@include('customerViews.header.header1')


      {{-- <div class="alert alert-success" style="position: fixed; margin-left:20px; margin-top:500px; z-index: 5">
        <strong class="default"><i class="fa fa-map-marker" aria-hidden="true"></i>  Please allow the browser's location</strong> to utilize Google Maps more effectively.
        <button type="button" class="btn btn-transparent close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}

      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; margin-left:20px; margin-top:500px; z-index: 5;">
        <i class="fa fa-map-marker" aria-hidden="true" style="margin-right:5px;"></i><strong>Please allow the browser's location</strong> to utilize Google Maps more effectively.
        <button type="button" class="btn btn-transparent close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <section class="hero">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;	background-image: url(/images/mrjams/index_one.jpg); background-size: cover; z-index: -1; background-color: #80a3db;"></div>
          <div class="hero-content-area">
            <h1>Your Health is our Priority!</h1>
            <h3>Just a Reminder, It's Time For Your Appointment</h3>

            <a href="#map_locate" class="btn">Get Appointment</a>
          </div>

          
        </div>

       

      </section>

    
      
      <section class="mapcontain" style="background-color: #eff3f9">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="mapModal" hidden></button>

            <div class="container" id="map_locate">

              {{-- search landmark --}}
              <div class="form-floating mb-3" >
                <input class="form-control" type="text" id="searchInput" placeholder="" >
                <label for="floatingInput">Search landmark near to your location</label>
              </div>

              {{-- map --}}
              <div id="map"></div>

            </div>
              <br><br>
      </section>

      {{-- Guides in making appointment --}}
      <section style="font-family: 'Roboto', sans-serif;">

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
                            <p style="font-size: 15px;"><b>Step 1: Navigate to the Mapping section and select the clinic where you'd want to schedule an appointment.</b> Customers can schedule an appointment in one of two ways: first, go to the maps and select a clinic, or second, go to the clinic tab and search for the clinic they wish to visit. There's also a category search to help you discover the clinic you're looking for more quickly. </p>
                                 
                                 
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
                          <p style="font-size: 15px;"><b>Step 2: When you click "View More," all of the clinic's information will show.</b> Then you will see the clinic's contact information, such as phone and fax numbers. There's also the clinic's address, as well as the clinic's packages and services. You can also make an appointment on this page if you see a package or service that you want at that clinic. </p>
                                 
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
                          <p style="font-size: 15px;"><b>Step 3: After clicking "Get Appointment," you'll be asked if this appointment is for you or for someone else, such as a relative or friend. </b>It is important for the clinic you choose to know if this appointment is for you or not. Because the clinic requires the patient's details in order to schedule an appointment</p>
                                 
                                 
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
                            <p style="font-size: 15px;"><b>Step 4: After you've answered the question, you'll be directed to the appointment page, where you may fill out the necessary details. </b>Personal information such as name, age, address, and other details must be filled in. There's also one for the service or package you choose. After you've completed all of the required fields, you can submit your request and wait for confirmation from the clinic of your choice.</p>
                                 
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

    {{-- Features of MR. JAMS --}}
    <section class="packages">
      <ul class="grid">
        <li>
          <i class="fa fa-map-marker fa-4x"></i>
          <h4><b>Mapping</b></h4>
          <p style="font-size: 15px;">Mapping for nearby and available clinics.</p>
        <li>
          <i class="fa fa-medkit fa-4x"></i>
          <h4><b>Medical Services</b></h4>
          <p style="font-size: 15px;">list of services offered by a clinic.</p>
        </li>
        <li>
          <i class="fa fa-user-md fa-4x"></i>
          <h4><b>Find A Doctor</b></h4>
          <p style="font-size: 15px;">A doctor who specializes in the service you need.</p>
        </li>
        <li>
          <i class="fa fa-calendar fa-4x"></i>
          <h4><b>Request an Appoinment</b></h4>
          <p style="font-size: 15px;">You can schedule an appointment at any time and from any location.</p>
        </li>
      </ul>
      <br><br>
    </section>

  @include('customerViews.footer.footer1')
@endsection
@section('jsScript')
  <script src="{{ URL::asset('js/customer/map.js') }}"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places"></script>
  {{-- <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places"></script> --}}
    {{-- <script>
      // $('.alert').alert()
      $(".alert").alert('close')
    </script> --}}
@endsection


  

  
 