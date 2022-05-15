<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <title>MR. JAMS</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- {{-- bootstrap 5.1.1 --}} -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
 


  <link rel="stylesheet" href="{{asset('./css/customer/index_one_public.css')}}">

</head>
<body>

  <header>
    <h2><img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" class="logotitle"></h2>

    <nav>
      <li><a href="/" style="text-decoration: none; color:black;">Home</a></li>
  
      <li><a href="/public/about" style="text-decoration: none; color:black;">About</a></li>
      

      @if (Route::has('login'))
        @auth
       
          @if (Auth::user()->role == "clinic")
            <a href="{{ url('/clinic') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
          @endif
          @if (Auth::user()->role == "customer")
            <a href="{{ url('/customer') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
          @endif
            
        @else
            <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none; color:black;">Login</a></li>
        @endauth
    @endif

                      
     
   
  </nav>
  </header>

  


 

  
  <section class="hero">
    <div class="background-image" style="background-image: url(/images/mrjams/index_one.jpg); background-size: cover;"></div>
    <div class="hero-content-area">
      <h1>Your Health is our Priority!</h1>
      <h3>Just a Reminder, It's Time For Your Appointment</h3>

      <a href="{{ route('login') }}" class="btn">Get Appointment</a>
    </div>
  </section>
{{-- 
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


</section> --}}

<div class="hero-content-area" style="padding:50px; background-color:#f9fcfe">

  <h2>How can I sign up to access this system as a registered user?</h2>
  <br>

  <div class="card-deck">
    <div class="card">
      <img class="card-img-top" src="/images/mrjams/prod1a.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><i class="fa fa-google" aria-hidden="true" style="margin-right:10px; color: #6497B1"></i>Login with Google</h5>
        <p class="card-text">To be a registered user of this system, we will use a Google account in this web application.</p>
        {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" src="/images/mrjams/prod2a.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><i class="fa fa-user" aria-hidden="true" style="margin-right:10px; color: #6497B1"></i>Choose your Role</h5>
        <p class="card-text">After you've signed in with Google, the system will ask if you want to register as a customer/patient or as a clinic. This is due to the fact that customer features differ from clinic features.</p>
        {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" src="/images/mrjams/prod3a.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><i class="fa fa-user-plus" aria-hidden="true" style="margin-right:10px; color: #6497B1"></i>Register</h5>
        <p class="card-text">After choosing a role, the user must fill out the required information for that role, such as name, address, phone number, and other details.</p>
        {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
      </div>
    </div>
  </div>
</div>

  
 
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
      <i class="fa fa-compass fa-4x"></i>
      <h4><b>Direction</b></h4>
          <p style="font-size: 15px;">Directions to your preferred clinic.</p>
    </li>
    <li>
      <i class="fa fa-calendar fa-4x"></i>
      <h4><b>Request an Appoinment</b></h4>
      <p style="font-size: 15px;">You can schedule an appointment at any time and from any location.</p>
    </li>
  </ul>
  <br><br>
</section>

  
  <footer>
    <p><b>Appointment and Management System for Dental and Medical Clinics with Location-Based Mapping </b></p>
    <p><b>TUPT - BSIT 4A | 2018-2022</b></p>
    <ul>
      <li><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter-square fa-2x text-black"></i></a></li>
      <li><a href="https://www.facebook.com/"><i class="fa fa-facebook-square fa-2x text-black"></i></a></li>
      <li><a href="https://www.google.com/"><i class="fa fa-google-plus-square fa-2x text-black"></i></a></li>
    </ul>
  </footer>
    
</body>
</html>