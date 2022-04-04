<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>&nbsp;</title>

    <link rel="icon" href="{{ URL::asset('images/mrjams/mr-jams-logo.png') }}"/>

    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <style>
        body {
            width:230mm;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            <h1>{{ $clinic->name }}</h1>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-12 d-flex justify-content-center">
            <h6>{{ $clinic_address->address_line_1 }} {{ $clinic_address->address_line_2 }}</h6>
        </div>

        <div class="col-12 d-flex justify-content-center">
            <h6>{{ $clinic_address->city }}</h6>
        </div>
    </div>

    <h6 class="mx-5 mt-5">!!! This is a summary report of your clinic. Dated {{ date("F d Y") }}</h6>
    
    <div class="row w-50 mx-auto border mt-3"></div>

    <div class="row w-75 mx-auto mt-3">
        <div class="col">
            <h6 class="fw-bold">Accounting</h6>
            <div class="mx-5">
                <table class="">
                    <tbody>
                        <tr>
                            <td class="fw-bold">&#x2022;Total Paid:</td>
                            <td>&nbsp; &#8369;{{ number_format($total_paid, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">&#x2022;Expected Payment:</td>
                            <td>&nbsp; &#8369;{{ number_format($total_balance, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">&#x2022;Revenue (raw):</td>
                            <td>&nbsp; &#8369;{{ number_format($total_raw, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    

    <div class="row w-50 mx-auto border mt-3"></div>

    <div class="row w-75 mx-auto mt-3">
        <div class="col">
            <h6 class="fw-bold">Appointments</h6>
            <div class="mx-5">
                <table class="">
                    <tbody>

                        <tr>
                            <td class="fw-bold">&#x2022;Total:</td>
                            <td>&nbsp; {{ $total_appointments }}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">&#x2022;Accepted:</td>
                            <td>&nbsp; {{ $accepted }}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">&#x2022;Declined:</td>
                            <td>&nbsp; {{ $declined }}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">&#x2022;Done:</td>
                            <td>&nbsp; {{ $done }}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">&#x2022;Expires:</td>
                            <td>&nbsp; {{ $expired }}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">&#x2022;Pending:</td>
                            <td>&nbsp; {{ $peding }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <div class="row w-50 mx-auto border mt-3"></div>


    <div class="row">
        <div class="col mx-5">
            <div class="row w-100 mx-auto mt-3">
                <div class="col">
                    <h6 class="fw-bold">Top 5 Services (Highest to lowest)</h6>
                    <div class="mx-5">
                        <table class="">
                            <tbody>
                                @for ($x = 0; $x <= 4; $x++)
                                    
                                    <tr>
                                        <td class="fw-bold">{{ $x+1 }}</td>
                                        <td>&nbsp; {{ $top_services[$x]->name}}</td>
                                    </tr>
                                @endfor
                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>

        </div>


        <div class="col mx-5">
            <div class="row w-100 mx-auto mt-3">
                <div class="col">
                    <h6 class="fw-bold">Top 5 Packages (Highest to lowest)</h6>
                    <div class="mx-5">
                        <table class="">
                            <tbody>
                                @for ($x = 0; $x <= 4; $x++)
                                    
                                    <tr>
                                        <td class="fw-bold">{{ $x+1 }}</td>
                                        <td>&nbsp; {{ $top_packages[$x]->name}}</td>
                                    </tr>
                                @endfor
                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row w-50 mx-auto border mt-3"></div>

    <div class="row w-75 mx-auto mt-3">
        <div class="col">
            <h6 class="fw-bold">Most Used Consumable Materials</h6>
            <div class="mx-5">
                <table class="">
                    <tbody>
                        @for ($x = 0; $x <= 9; $x++)
                            @if (isset($top_consumable[$x+1]))
                            <tr>
                                <td class="fw-bold">{{ $x+1 }}</td>
                                <td>&nbsp; {{ $top_consumable[$x]->name}}</td>
                                {{-- <td>&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td>
                                @if (isset($material[$x+5]))
                                    <td class="fw-bold">{{ $x+6 }}</td>
                                    <td>&nbsp; {{ $material[$x+5]->name}}</td>
                                @endif --}}
                            </tr>
                            @endif  
                        @endfor
                        
                    </tbody>
                </table>
                
            </div>
            
        </div>
    </div>
    

    
</body>
</html>

<script src="{{ URL::asset('js/clinic/print/print.js') }}"></script>