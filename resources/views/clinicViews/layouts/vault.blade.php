<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title')</title>

    <link rel="icon" href="{{ URL::asset('images/mrjams/mr-jams-logo.png') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/master.css') }}">

    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- datatable --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">



    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>


    {{-- fullcalendar --}}
    <link href='{{ URL::asset('js/clinic/fullcalendar/lib/main.css') }}' rel='stylesheet' />
    <script src='{{ URL::asset('js/clinic/fullcalendar/lib/main.js') }}'></script>

    {{-- js moment --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>


    {{-- jquery growl plugin --}}
    <script src="{{ URL::asset('js/clinic/growl.js') }}"></script>

    {{-- bootstrap-input-spinner plugin --}}
    <script src="{{ URL::asset('js/clinic/input-spinner.js') }}"></script>

    {{-- jquery selec2 plugin --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- js flatpickr plugin || for time and date pciker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- theme --}}
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">


    {{-- font-awesome --}}
    {{-- from lags --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js"
        integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Google Chart API --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    {{-- star-rating --}}
    <script src="{{ URL::asset('js/clinic/jquery.star-rating-svg.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/star-rating-svg.css') }}">


    @yield('extraStyle')
</head>

<body>
    <div class="header">

        {{-- <a href="" class="btn btn-secondary" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a> --}}

        <a href="/">
            <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" id="logo" />
        </a>


        <div class="header_menu">

            <ul class="nav justify-content-end">
                <li class="nav-item " id="">
                    <h5 class="mt-2 mx-2" id="clinic_name"></h5>
                </li>

                <li class="nav-item">
                    <div class="dropdown">

                        <button class="btn btn-secondary" type="button" id="DropdownSettings" data-bs-toggle="dropdown"
                            aria-expanded="false" style="border-radius: 100%">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="DropdownSettings" style="min-width: 280px">

                            <li>
                                <a class="dropdown-item" href="/">
                                    <i class="fa fa-bullhorn mx-2" aria-hidden="true"></i>
                                    Clinic Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket mx-2"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>


        </div>
    </div>

    <div class="w-75 m-auto" style="padding-top: 80px;">
        <div class="border">
            @yield('content')
        </div>
    </div>



    {{-- footer --}}
    <div class="" style="position:fixed; bottom: 0px; left: 10px; z-index: 100;">
        <img class="" src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" alt="MrJams"
            style="width: 100px">
        <p class="text-center fw-bold" style="font-size: 12px; margin-top: -10px;">Copyright &copy; MR-JAMS.com</p>
        <ul id="footer_clickables">
            <li><a href="/public/about" target="_blank" class="fw-bold">About</a></li>
            <li>|</li>
            <li><a href="/public/terms_condition" target="_blank" class="fw-bold">Terms</a></li>
            <li>|</li>
            <li><a href="https://www.youtube.com/watch?v=rDk5ee6qYV0&ab_channel=MRJAMS" target="_blank"
                    class="fw-bold">Getting Started</a></li>
        </ul>

    </div>

</body>


<script src="{{ URL::asset('js/clinic/menu_toggle.js') }}"></script>

<script>
    $(function() {
        $("[data-bs-toggle=tooltip").tooltip();
    })
</script>
@yield('js_script')

</html>
