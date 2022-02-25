<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <title>MR. JAMS</title>


  <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Raleway" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('./css/customer/index_one.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>



  <!-- Forked from a template on Tutorialzine: https://tutorialzine.com/2016/06/freebie-landing-page-template-with-flexbox -->
  <header>
    <h2><img src="{{ URL::asset('images/mrjams/logowithname.png') }}" class="logotitle"></h2>

    <nav>
      <li><a href="/" style="text-decoration: none; color:black;">Home</a></li>
       <!-- <li><a href="{{route('customer.customermap.index')}}">Map</a></li> -->
      <li><a href="{{route('customer.about')}}" style="text-decoration: none; color:black;">About</a></li>
      <li><a href="{{route('customer.contact')}}" style="text-decoration: none; color:black;">Contact</a></li>

      @if (Route::has('login'))
        @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
        @else
            <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none; color:black;">Login</a></li>

            {{-- @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif --}}
        @endauth
    @endif

                      
     
   
  </nav>
  </header>

  


 

  
  <section class="hero">
    <div class="background-image"></div>
    <div class="hero-content-area">
      <h1>Your Health is our Priority!</h1>
      <h3>Just a Reminder, It's Time For Your Appointment</h3>

      <a href="#appoint" class="btn">Get Appointment</a>
    </div>
  </section>

  <section >
            <div style="width:1100px;padding-bottom:50px;">
              <div class="row">
              <div class="col" style="background-color:transparent;">
                    <img src="/images/mrjams/steps1.png" alt="" width="100%" height="300px"/>
                    <!-- <p>hello</p> -->
                  </div>
                  <div class="col" style="background-color:transparent;">
                  <br></br>
                  <center><h2><b>Guide for Making Appointments</b></h2></center>
                  <br></br>
                  <p><b>Step 1: Navigate to the Mapping section and select the clinic where you'd want to schedule an appointment.</b> Customers can schedule an appointment in one of two ways: first, go to the maps and select a clinic, or second, go to the clinic tab and search for the clinic they wish to visit. There's also a category search to help you discover the clinic you're looking for more quickly. </p>
              </div>
              </div>
          </div>

          <div style="width:1100px;padding-bottom:50px;">
                <div class="row">
                <div class="col" style="background-color:transparent;">
                <br></br>
                <!-- <h1>Column 1</h1> -->
                <p><b>Step 2: When you click "View More," all of the clinic's information will show.</b> Then you will see the clinic's contact information, such as phone and fax numbers. There's also the clinic's address, as well as the clinic's packages and services. You can also make an appointment on this page if you see a package or service that you want at that clinic. </p>


                </div>
                <div class="col" style="background-color:transparent;">
                  <img src="/images/mrjams/steps2.png" alt="" width="100%" height="300px"/>
                </div>
                </div>
          </div>

          <div style="width:1100px;padding-bottom:50px;">
              <div class="row">
              <div class="col" style="background-color:transparent;">
                <img src="/images/mrjams/steps3.png" alt="" width="100%" height="300px"/>
              </div>
              <div class="col" style="background-color:transparent;">
                <br></br>
              <p><b>Step 3: After clicking "Get Appointment," you'll be asked if this appointment is for you or for someone else, such as a relative or friend. </b>It is important for the clinic you choose to know if this appointment is for you or not. Because the clinic requires the patient's details in order to schedule an appointment</p>


              </div>
              </div>
          </div>

          <div style="width:1100px;padding-bottom:50px;">
                <div class="row">
                
                <div class="col" style="background-color:transparent;">
         
                <br></br>
                <p><b>Step 4: After you've answered the question, you'll be directed to the appointment page, where you may fill out the necessary details. </b>Personal information such as name, age, address, and other details must be filled in. There's also one for the service or package you choose. After you've completed all of the required fields, you can submit your request and wait for confirmation from the clinic of your choice.</p>


                </div>
                <div class="col" style="background-color:transparent;">
                  <img src="/images/mrjams/steps4.png" alt="" width="100%" height="300px"/>
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
  </section>

  
  <footer>
    <p>MR. JAMS</p>
    <p>Created with <i class="fa fa-heart"></i> by TUPT - BSIT 4A | 2018-2022</p>
    <ul>
      <li><a href="#"><i class="fa fa-twitter-square fa-2x"></i></a></li>
      <li><a href="#"><i class="fa fa-facebook-square fa-2x"></i></a></li>
      <li><a href="#"><i class="fa fa-snapchat-square fa-2x"></i></a></li>
    </ul>
  </footer>
    
</body>
</html>