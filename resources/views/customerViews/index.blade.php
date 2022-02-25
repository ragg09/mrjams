<!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>

<pre>
    <h1>
        INDEX DASHBOARD HOME LANDING PAGE OF CUSTOMER/PATIENT
        ITO LANDING PAGE MO AFTER LOGIN
        SA SUBFOLDER MO PWEDE KA RIN GUMAWA NG SARILI MONG LAYOUT PARA MAY KANYA KANYA TAYONG LAYOUT
        views: customerViews
        controller: Customer
        web route: line 87
    </h1>
    
</pre> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. JAMS</title>

    <!-- <script src="{{ asset('./public/css/homepage/customer.css') }}">  </script> -->
    <link rel="stylesheet" href="{{asset('./css/customer/customer.css')}}">

</head>
<body>


<link rel="stylesheet" href="https://necolas.github.io/normalize.css/3.0.2/normalize.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,latin-ext">

<!-- navbar -->
<nav class="navbar">
  
  <div class="container">
    <img class="logo_pic" src="/images/mrjams/mr-jams-logo.png" />
    <h1 class="logo"><a href="#">MR. JAMS</a></h1>

      <ul class="nav nav-right">
        <li><a href="customer">Home</a></li>
        <li><a href="customer/customermap">Map</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
        <!-- <li><a href="#"uth::user()->name><img class="logo_pic" src="{{ Auth::user()->avatar }}" alt=""></a></li> -->
      </ul>
 
  </div><!--/.container-->
  
</nav><!--/.navbar-->

<div class="container">
  <h1>Simple Navbar</h1>
  <p>This is simple navbar somehow inspired Material Design, pure CSS.</p>
</div><!--/.container-->

</body>
</html>