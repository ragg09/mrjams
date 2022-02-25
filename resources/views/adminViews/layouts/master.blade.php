
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <link href="{{ asset('css/admin/styles.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @yield('extraStyle')
</head>

<body>
    <div id="app">
        <div class="main-menu">
            <ul>
                <section class="home">
                    <li class="menu-item"><i class="fa fa-home"></i><a href="/admin">Dashboard</a></li>
                    <li class="menu-item"><i class="fa fa-bar-chart" aria-hidden="true"></i><a href="{{ route('admin.analytics.index') }}">Analytics</a></li>
                    {{-- <li class="menu-item"><i class="fa fa-bar-chart" aria-hidden="true"></i><a href="#">Analytics</a></li> --}}
                    {{-- <li class="menu-item"><i class="fa fa-paper-plane"></i><a href="{{ route('admin.tables.index') }}">Tables</a></li> --}}
                    <li class="menu-item"><i class="fa fa-paper-plane"></i><a>Tables</a>
                        <ul aria-labelledby="navbarDropdown" id="ulol">
                            <li id="tables_drpdwn"><a href="{{ route('admin.patient.index') }}">Patient</a></li>
                            <li id="tables_drpdwn"><a href="{{ route('admin.clinic.index') }}">Clinic</a></li>
                            {{-- <hr>
                            <li id="tables_drpdwn"><a href="#">Something else here</a></li> --}}
                        </ul>
                    </li>
                </section>
            </ul>
        </div>
       
    </div>
    

    <div class="container-fluid">
        
        <div class="row m-5">
            <div class="col-12">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }} nasa admin master layout to</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                @yield('content')
            </div>
        </div>
    </div>
    

</body>

@yield('extraScript')

</html>