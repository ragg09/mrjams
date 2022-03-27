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
  <link rel="stylesheet" href="{{asset('./css/customer/contact-about.css')}}">
  <link rel="stylesheet" href="{{asset('./css/customer/contact.css')}}">

</head>
<body>

        <header>
          <nav>
              <li><h2><img src="{{asset('images/mrjams/logowithname.PNG') }}" class="logotitle"></h2></li>
              <li><a href="/" style="text-decoration: none; color:black;">Home</a></li>
                                <li class="nav__item"><a href="{{route('customer.clinicList.index')}}" style="text-decoration: none; color:black;">Clinics</a></li>
              <li><a href="{{route('customer.about')}}" style="text-decoration: none; color:black;">About</a></li>
              <li><a href="{{route('customer.contact')}}" style="text-decoration: none; color:black;">Contact</a></li>
              <li><a href="{{route('customer.mail.index')}}" style="text-decoration: none; color:black;">Mail</a></li>
              <li><a href="/customer/customerinfo/{{Auth::user()->id}}" style="text-decoration: none; color:black;">Account</a></li>
              <li class="nav__item"><a href="{{route('customer.announcement.index')}}" style="text-decoration: none; color:black;"><i class="fa fa-bullhorn fa-lg " aria-hidden="true"></i></a></li>
              <!-- <li><a href="{{route('customer.customermap.index')}}">Appointment</a></li> -->
              <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                              </li>
              <!-- <img class="sticky" src="{{ Auth::user()->avatar }}" alt="sticky-div"> -->          
          </nav>
        </header>


  
        <main>
            @yield('content')
        </main>

      


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