<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <title>MR. JAMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('./css/customer/index_one.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/map.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/infowindow.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/customer.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('./css/customer/modal.css')}}"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>


        <header>
          <!-- <h2><img src="{{ URL::asset('images/mrjams/logowithname.png') }}" class="logotitle"></h2> -->

          <nav>
            <h2><img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" class="logotitle"></h2>

            <!-- <input type="text" name="user_as_customer_id" value="{{Auth::user()->id}}"> 
             -->
            <li><a href="/" style="text-decoration: none; color:black;">Home</a></li>
            <li><a href="{{route('customer.clinicList.index')}}" style="text-decoration: none; color:black;">Clinics</a></li>
            <li><a href="{{route('customer.about')}}" style="text-decoration: none; color:black;">About</a></li>
            <li><a href="{{route('customer.contact')}}" style="text-decoration: none; color:black;">Contact</a></li>
            <li><a href="{{route('customer.mail.index')}}" style="text-decoration: none; color:black;">Mail</a></li>
            <li><a href="/customer/customerinfo/{{Auth::user()->id}}" style="text-decoration: none; color:black;">Account</a></li>

            <!-- <li><select id="ClinicType" style="background-color: transparent; border: none; font-weight: bold;">
                                  <option value="">Account</option> 
                                  <option value="1">Dental</option> 
                                  <option value="2">Medical</option> 
            </select></li>  -->
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

    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7wni7IkDlhVh0eYj1v1A2S7UXFpqRGB4&callback=initMap"></script> --}}

    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places">
    </script>

    <script src="{{ URL::asset('js/customer/map.js') }}"></script>
    <!-- <script src="{{ URL::asset('js/customer/appointment.js') }}"></script> -->

</html>