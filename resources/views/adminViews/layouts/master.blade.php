
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <title>@yield('title')</title>


    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <link href="{{ asset('css/admin/styles.css') }}" rel="stylesheet">

    
    {{-- jquery growl plugin --}}
    <script src="{{ URL::asset('js/customer/growl.js') }}"></script>

    {{-- datatable --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
  

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">

    {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">


    @yield('extraStyle')
</head>

<body>
    <div id="app" >
        {{-- <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" text-dark href="#">
                MR.JAMS
              </a>
            </div>
        </nav> --}}
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6497B1; position:fixed; width: 100%; margin-top:-30px; z-index: 5"  >
            <a class="navbar-brand" href="/admin">
              <img src="{{asset('images/mrjams/logowithname-admin.png') }}" class="logotitle">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"></a>
                </li>
              </ul>


                <a class="navbar-brand" onclick="window.print()">
                  <i class="fa fa-print fa-lg" aria-hidden="true" style="color: black;"></i>
                </a> 

                <a href="#" >
                  <img src="{{Auth::user()->avatar}}" alt="admin" class="rounded-circle p-1 " width="65" style="margin-right: 5px;">
                </a>

                <a class="navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out fa-lg" aria-hidden="true" style="margin-right: 3px; color: black"></i>
                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>

            </div>
          </nav>
        <div class="main-menu">
            <ul id="main_ul">
                <section class="home"> 
                    <li class="menu-item"><i class="fa fa-home" style="margin-right: 5px;"></i><a href="/admin" style="color:white" id="a_tag"><b>Dashboard</b></a></li>
                    {{-- <li class="menu-item"><i class="fa fa-bar-chart" aria-hidden="true"></i><a href="{{ route('admin.analytics.index') }}">Analytics</a></li> --}}
                    <li class="menu-item"><i class="fa fa-table" aria-hidden="true" style="margin-right: 5px;"></i><a id="a_tag"><b>Tables</b></a>
                        <ul aria-labelledby="navbarDropdown" id="ulol">
                            <li id="tables_drpdwn"> <i class="fa fa-user" aria-hidden="true" id="i_tag"></i><a href="{{ route('admin.patient.index') }}" style="color:white" id="a_tag">Patient</a></li>
                            <li id="tables_drpdwn"><i class="fa fa-user-md" aria-hidden="true"  id="i_tag"></i><a href="{{ route('admin.clinic.index') }}" style="color:white" id="a_tag">Clinic</a></li>
                            {{-- <hr>
                            <li id="tables_drpdwn"><a href="#">Something else here</a></li> --}}
                        </ul>
                    </li>
                    <li class="menu-item"><i class="fa fa-bullhorn" aria-hidden="true" style="margin-right: 5px;"></i><a href="{{ route('admin.message.index') }}" style="color:white" id="a_tag"><b>Announcements</b></a></li>
                    <li class="menu-item"><i class="fa fa-code" aria-hidden="true" style="margin-right: 5px;"></i><a href="{{ route('admin.adminQuery.index') }}" style="color:white" id="a_tag"><b>Query</b></a></li>
                </section>
            </ul>
        </div>
       
    </div>

    <div class="container-fluid">
        <div class="row m-2">
            <div class="col-12">
              {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket mx-2"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            </form>
             --}}
                @yield('content')
            </div>
        </div>
    </div>
    
    <footer>
      <p class="text-center" style="margin-top: 20px;">Copyright &copy; MR-JAMS.com</p>
    </footer>

</body>

{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{{-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>


{{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}



@yield('extraScript')



</html>