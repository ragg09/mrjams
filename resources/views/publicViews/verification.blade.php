<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clinic Verification</title>
    <link rel="icon" href="{{ URL::asset('images/mrjams/mr-jams-logo.png') }}"/>

    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <style>
        body {
            height: 100vh;
            padding: 0;
            overflow: hidden;
            background: linear-gradient(#DBE9F5, #AFC6D9, #83A3BE);
        }

        #main_content{
            width: 800px;
            position: absolute;
            left: 50%;
            top: 45%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);

            border-width: 3px;
            border-style: solid;
            border-image: 
                linear-gradient(
                to bottom, 
                rgba(0, 17, 255, 0.753), 
                rgba(0, 0, 0, 0)
                ) 1 100%;
        }

        #logo{
            width: 500px;
        }
    </style>
</head>
<body>

<div class="row" id="main_content">
    <div class="col-12 d-flex justify-content-center">
        <h1>Welcome to</h1>
    </div>
    <div class="col-12 d-flex justify-content-center">
        <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" id="logo"/>
    </div>

    <div class="col-12 p-5">
        <div class="rounded">
            <h2 class="text-center">We are now processing your registration.</h2>
            <h4 class="text-center" >Please wait until verification is complete. We will let you know once your clinic is ready to use. Thank you for your understanding.</h4>
        </div>
    </div>

    <div class="col-12 p-3">
        <div class="rounded">
            <h4 class="text-center" >Want to know more?</h4>
            <h5 class="text-center" ><a href="https://youtu.be/Y2zPYCNREBE" target="_blank">Click here.</a></h5>
        </div>
    </div>

    <div class="col-12 d-flex justify-content-center mt-5">
        <div class="rounded">
            <a class="btn btn-primary btn-lg" role="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="width: 300px;">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            </form>
        </div>
    </div>
</div>

{{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa-solid fa-right-from-bracket mx-2"></i>
    {{ __('Logout') }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form> --}}
    
</body>
</html>