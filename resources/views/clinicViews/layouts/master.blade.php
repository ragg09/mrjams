<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    
    <link rel="icon" href="{{ URL::asset('images/mrjams/mr-jams-logo.png') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/master.css') }}">

    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    
    {{-- fullcalendar --}}
    <link href='{{ URL::asset('js/clinic/fullcalendar/lib/main.css') }}' rel='stylesheet' />
    <script src='{{ URL::asset('js/clinic/fullcalendar/lib/main.js') }}'></script>

    {{-- js moment --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>


    {{-- jquery growl plugin --}}
    <script src="{{ URL::asset('js/clinic/growl.js') }}"></script>

    {{-- jquery selec2 plugin --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- js flatpickr plugin || for time and date pciker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
       {{-- theme --}}
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css"> 
 

    {{-- font-awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('extraStyle')

    <style>
        #loading-screen-bg{
            position: absolute;
            width: 100%;
            height: 100%;
            background: black;
            z-index: 50 !important;
            opacity: 0.7;
            visibility: hidden;
        }

        #loading-screen{
            padding: 20px;
            margin: 0px;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div id="loading-screen-bg">
        <div class="" id="loading-screen">
            <h4>Your patience is appreciated</h4>
            <p>aayusin pa </p>
            <img class="" src="{{ URL::asset('images/mrjams/Spinner-1.6s-204px.gif') }}" alt="">
        </div>
    </div>
    
    <div class="header">

        {{-- <a href="" class="btn btn-secondary" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a> --}}

        <a href="/">
            <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" id="logo"/>
        </a>


        <div class="header_menu">
            <div class="dropdown">

                <button class="btn btn-secondary" type="button" id="DropdownSettings" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 100%">
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="DropdownSettings">
                    <li class="dropdown-item">{{Auth::user()->email}}</li>
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <div id="wrapper">
            {{-- sidebar --}}
            @include('clinicViews.layouts.sidebar')
            {{-- sidebar end --}}
    
            {{-- main content --}}
            <div id="content-wrapper">
                <div class="container-fluid">
                    <div class="row p-2" >
                        {{-- Use col-lg-# --}}
                        @yield('content')
                    </div>
                </div>
            </div>
            {{-- main content end--}}
        </div>
    </div>
    
</body>
<script src="{{ URL::asset('js/clinic/menu_toggle.js') }}"></script>
@yield('js_script')
</html>