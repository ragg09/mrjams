<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MR. JAMS</title>
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/customerlayout1.css')}}">
 

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


    @yield('specificStyle')
</head>

<body>
 
        <header class="site-header">
            <div class="wrapper site-header__wrapper">
                <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" class="logotitle" >
                <nav class="nav">
                    <button class="nav__toggle" aria-expanded="false" type="button">
                    </button>
                    <ul class="nav__wrapper">
                        <li class="nav__item"><a href="/" style="text-decoration: none; color:black;">Home</a></li>
                        <li class="nav__item"><a href="{{route('customer.clinicList.index')}}" style="text-decoration: none; color:black;">Clinics</a></li>
                        <li class="nav__item"><a href="{{route('customer.about')}}" style="text-decoration: none; color:black;">About</a></li>
                        <li class="nav__item"><a href="{{route('customer.contact')}}" style="text-decoration: none; color:black;">Contact</a></li>
                    
                        <!-- <li class="nav__item"><a href="#">Logout</a></li> -->
                        <li class="nav__item"><a href="{{route('customer.mail.index')}}" style="text-decoration: none; color:black;">Mail</a></li>
                        <li class="nav__item"><a href="/customer/customerinfo/{{Auth::user()->id}}" style="text-decoration: none; color:black;">Account</a></li>
                        <li class="nav__item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none; color:black;"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

    

        <main>
            @yield('content')
        </main>


</body>
    @yield('jsScript')

</html>