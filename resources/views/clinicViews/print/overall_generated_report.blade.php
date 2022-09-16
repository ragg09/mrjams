<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>&nbsp;</title>

    <link rel="icon" href="{{ URL::asset('images/mrjams/mr-jams-logo.png') }}" />

    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>
    <style>
        body {
            width: 210mm;
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


    @for ($x = 0; $x < count($selected_date); $x++)

        {{-- filtering date without data at all || APPOINMENT PALANG LAMAN NITO --}}
        @if (count($daily_report[$x][0]) > 0 ||
            count($daily_report[$x][1]) > 0 ||
            count($daily_report[$x][2]) > 0 ||
            count($daily_report[$x][3]) > 0 ||
            count($daily_report[$x][4]) > 0 ||
            count($daily_report[$x][5]) > 0 ||
            count($daily_report[$x][6]) > 0 ||
            count($daily_report[$x][7]) > 0 ||
            count($daily_report[$x][8]) > 0 ||
            count($daily_report[$x][9]) > 0 ||
            count($daily_report[$x][10]) > 0)

            <div class="row w-100 mx-auto border mt-3"></div>

            <div class="row d-flex justify-content-start mx-3 mt-5">
                <div class="col-auto">
                    <h6>{{ date('M d, Y', strtotime($selected_date[$x])) }}
                        ({{ date('l', strtotime($selected_date[$x])) }})
                        @if (isset($daily_report[$x][11]))
                            @foreach ($daily_report[$x][11] as $row)
                                | Total Revenue: &#8369;{{ number_format($row->revenue, 0) }}
                            @endforeach
                        @endif


                    </h6>
                </div>
            </div>


            @if (count($daily_report[$x][0]) > 0 ||
                count($daily_report[$x][1]) > 0 ||
                count($daily_report[$x][2]) > 0 ||
                count($daily_report[$x][3]) > 0 ||
                count($daily_report[$x][4]) > 0 ||
                count($daily_report[$x][5]) > 0 ||
                count($daily_report[$x][6]) > 0) {{-- APPOINTMENT TABLE --}}
                <div class="row w-75 mx-auto mt-3">


                    <div class="row d-flex justify-content-start mx-3 mt-3">
                        <div class="col-auto">
                            <h6 class="text-muted">Appointments</h6>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Receipt</th>
                                <th scope="col" class="text-center">Customer</th>
                                <th scope="col" class="text-center">Treatment</th>
                                <th scope="col" class="text-center">Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($daily_report[$x][0]) > 0)
                                {{-- done --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>D O N E </h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][0] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif



                            @if (count($daily_report[$x][3]) > 0)
                                {{-- accepted --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>A C C E P T E D</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][3] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif




                            @if (count($daily_report[$x][1]) > 0)
                                {{-- pending --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>P E N D I N G</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][1] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif



                            @if (count($daily_report[$x][2]) > 0)
                                {{-- declined --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>D E C L I N E D</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][2] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif



                            @if (count($daily_report[$x][4]) > 0)
                                {{-- nego --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>N E G O T I A T I N G</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][4] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif


                            @if (count($daily_report[$x][5]) > 0)
                                {{-- expired --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>E X P I R E D</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][5] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif


                            @if (count($daily_report[$x][6]) > 0)
                                {{-- cancelled --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>C A N C E L L E D</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][6] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif


                        </tbody>
                    </table>

                </div>
                <div class="row w-50 mx-auto border mt-3"></div>
            @endif

            @if (count($daily_report[$x][7]) > 0 || count($daily_report[$x][8]) > 0){{-- PAYMENT TABLE --}}
                <div class="row w-75 mx-auto mt-3">


                    <div class="row d-flex justify-content-start mx-3 mt-3">
                        <div class="col-auto">
                            <h6 class="text-muted">PAYMENTS</h6>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Receipt</th>
                                <th scope="col" class="text-center">Customer</th>
                                <th scope="col" class="text-center">Treatment</th>
                                <th scope="col" class="text-center">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($daily_report[$x][7]) > 0)
                                {{-- full paid --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>F U L L Y P A I D</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][7] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            @if (count($daily_report[$x][8]) > 0)
                                {{-- full paid --}}
                                <tr>
                                <tr class="table-light">
                                    <td class="align-middle text-center" colspan="4">
                                        <h6>W I T H B A L A N C E</h6>
                                    </td>
                                </tr>

                                </tr>

                                @foreach ($daily_report[$x][8] as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->receipt }}</td>
                                        <td class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ $row->treatment }}</td>
                                        <td class="text-center">{{ date('h:i A', strtotime($row->time)) }}</td>
                                    </tr>
                                @endforeach
                            @endif



                        </tbody>
                    </table>

                </div>

                <div class="row w-50 mx-auto border mt-3"></div>
            @endif

            @if (count($daily_report[$x][9]) > 0)
                {{-- MOST USED MATERIAL --}}
                <div class="row w-75 mx-auto mt-3">


                    <div class="row d-flex justify-content-start mx-3 mt-3">
                        <div class="col-auto">
                            <h6 class="text-muted">USED MATERIAL</h6>
                        </div>
                    </div>

                    @foreach ($daily_report[$x][9] as $row)
                        <div class="col-3">
                            <div class="p-1 d-flex justify-content-between">
                                {{ $row->name }} : <span class="align-self-end mx-3">{{ $row->count }}</span>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="row w-50 mx-auto border mt-3"></div>
            @endif

            @if (count($daily_report[$x][10]) > 0)
                {{-- MOST USED MATERIAL --}}
                <div class="row w-75 mx-auto mt-3">


                    <div class="row d-flex justify-content-start mx-3 mt-3">
                        <div class="col-auto">
                            <h6 class="text-muted">AVAILED SERVICES & PACKAGES</h6>
                        </div>
                    </div>

                    @foreach ($daily_report[$x][10] as $row)
                        <div class="col-4">
                            <div class="p-1 d-flex justify-content-between">
                                {{ $row->name }} : <span class="align-self-end mx-3">{{ $row->count }}</span>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="row w-50 mx-auto border mt-3"></div>
            @endif




        @endif


    @endfor


    @if (count($complete_consumable_data) > 0 ||
        count($complete_medicine_data) > 0 ||
        count($complete_medicine_data) > 0) {{-- MATERIAL TABLE --}}
        <div class="row w-100 mx-auto border mt-3"></div>
        <div class="row w-100 mx-auto mt-3 p-2">
            <div class="row d-flex justify-content-start mx-3 mt-3">
                <div class="col-auto">
                    <h6 class="text-muted">MATERIAL LIST</h6>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-center">Supplier</th>
                        <th scope="col" class="text-center">Acquired</th>
                        <th scope="col" class="text-center">Expiration</th>
                        <th scope="col" colspan="3">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($complete_consumable_data) > 0)
                        {{-- full paid --}}
                        <tr>
                        <tr class="table-light">
                            <td class="align-middle text-center" colspan="8">
                                <h6>C O N S U M A B L E</h6>
                            </td>
                        </tr>

                        </tr>

                        @foreach ($complete_consumable_data as $row)
                            <tr>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->quantity }}</td>
                                <td class="text-center">{{ $row->supplier }}</td>
                                <td class="text-center">{{ date('M d, Y', strtotime($row->acquired)) }}</td>
                                <td class="text-center">{{ date('M d, Y', strtotime($row->expiration)) }}</td>
                                <td class="text-center" colspan="3"></td>
                            </tr>
                        @endforeach


                    @endif

                    @if (count($complete_medicine_data) > 0)
                        {{-- full paid --}}
                        <tr>
                        <tr class="table-light">
                            <td class="align-middle text-center" colspan="8">
                                <h6>M E D I C I N E</h6>
                            </td>
                        </tr>

                        </tr>

                        @foreach ($complete_medicine_data as $row)
                            <tr>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->quantity }}</td>
                                <td class="text-center">{{ $row->supplier }}</td>
                                <td class="text-center">{{ date('M d, Y', strtotime($row->acquired)) }}</td>
                                <td class="text-center">{{ date('M d, Y', strtotime($row->expiration)) }}</td>
                                <td class="text-center" colspan="3"></td>
                            </tr>
                        @endforeach


                    @endif

                    @if (count($complete_equipment_data) > 0)
                        {{-- full paid --}}
                        <tr>
                        <tr class="table-light">
                            <td class="align-middle text-center" colspan="8">
                                <h6>E Q U I P M E N T</h6>
                            </td>
                        </tr>

                        </tr>

                        @foreach ($complete_equipment_data as $row)
                            <tr>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->quantity }}</td>
                                <td class="text-center">{{ $row->supplier }}</td>
                                <td class="text-center">{{ date('M d, Y', strtotime($row->acquired)) }}</td>
                                <td class="text-center">{{ date('M d, Y', strtotime($row->expiration)) }}</td>
                                <td class="text-center" colspan="3"></td>
                            </tr>
                        @endforeach


                    @endif


                </tbody>
            </table>

        </div>
    @endif

    @if (count($material_top_selected) > 0) {{-- USED MATERIALS SUMMARY --}}
        <div class="row w-100 mx-auto border mt-3"></div>

        <div class="row w-75 mx-auto mt-3">


            <div class="row d-flex justify-content-start mx-3 mt-3">
                <div class="col-auto">
                    <h6 class="text-muted">USED MATERIALS SUMMARY </h6>
                    <span class="text-muted" style="font-size: 12px;">from
                        {{ date('M d, Y', strtotime($two_dates[0])) }} to
                        {{ date('M d, Y', strtotime($two_dates[1])) }}</span>
                </div>
            </div>

            @foreach ($material_top_selected as $row)
                <div class="col-3">
                    <div class="p-1 d-flex justify-content-between">
                        {{ $row->name }} : <span class="align-self-end mx-3">{{ $row->count }}</span>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="row w-50 mx-auto border mt-3"></div>
    @endif

    @if (count($complete_services_data) > 0 || count($complete_packages_data) > 0) {{-- SERVICE & PACKAGE TABLE --}}
        <div class="row w-100 mx-auto border mt-3"></div>
        <div class="row w-100 mx-auto mt-3 p-2">
            <div class="row d-flex justify-content-start mx-3 mt-3">
                <div class="col-auto">
                    <h6 class="text-muted">Services and Packages List</h6>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($complete_services_data) > 0)
                        {{-- full paid --}}
                        <tr>
                        <tr class="table-light">
                            <td class="align-middle text-center" colspan="3">
                                <h6>S E R V I C E S</h6>
                            </td>
                        </tr>

                        </tr>

                        @foreach ($complete_services_data as $row)
                            <tr>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->description }}</td>
                                <td class="text-center">&#8369;{{ $row->min }} - &#8369;{{ $row->max }}</td>
                            </tr>
                        @endforeach


                    @endif


                    @if (count($complete_packages_data) > 0)
                        {{-- full paid --}}
                        <tr>
                        <tr class="table-light">
                            <td class="align-middle text-center" colspan="3">
                                <h6>P A C K A G E S</h6>
                            </td>
                        </tr>

                        </tr>

                        @foreach ($complete_packages_data as $row)
                            <tr>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->description }}</td>
                                <td class="text-center">&#8369;{{ $row->min }}</td>
                            </tr>
                        @endforeach


                    @endif




                </tbody>
            </table>

        </div>
    @endif




</body>

<script src="{{ URL::asset('js/clinic/print/print.js') }}"></script>

</html>
