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

    <div class="row w-75 mx-auto mt-3">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit</th>
                <th scope="col" colspan="3">Remarks</th>

              </tr>
            </thead>
            <tbody>
                <tr>
                    <tr class="table-warning">
                        <td class="align-middle text-center" colspan="6">
                            <h6>C o n s u m a b l e s</h6>
                        </td>
                    </tr>

                </tr>

                @foreach ($all_consumable as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->unit }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach

                <tr>
                    <tr class="table-warning">
                        <td class="align-middle text-center" colspan="6" >
                            <h6>E q u i p m e n t s</h6>
                        </td>
                    </tr>

                </tr>

                @foreach ($all_equipment as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->unit }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach

                <tr>
                    <tr class="table-warning">
                        <td class="align-middle text-center" colspan="6" >
                            <h6>M e d i c i n e</h6>
                        </td>
                    </tr>

                </tr>

                @foreach ($all_medicine as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->unit }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
              
              
            </tbody>
        </table>
    </div>
    
</body>
</html>

<script src="{{ URL::asset('js/clinic/print/print.js') }}"></script>