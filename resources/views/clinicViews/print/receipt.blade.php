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
            width:210mm;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
            border: 1px solid black;
        }
    </style>
</head>
<body>
{{-- {{ $service_summary[0][0] }} --}}
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

    <table class="table table-borderless w-75 m-auto mt-1" >
        <tbody>
            <tr>
                <td>
                    <tr>
                        <td>Phone</td>
                        <td>: {{ $clinic->phone }}</td>
                        <td>Email</td>
                        <td>: {{ $user->email }}</td>
                    </tr>
                </td>
            </tr>

            <tr>
                <td>
                    <tr>
                        <td>Telephone</td>
                        <td>: {{ $clinic->telephone ?? "N/A" }}</td>
                        <td>Facebook</td>
                        <td>: {{ $clinic->facebook ?? "N/A" }}</td>
                    </tr>
                </td>
            </tr>
            
        </tbody>
    </table>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-auto">
            <h3>Receipt</h3>
        </div>
    </div>

    <div class="row w-75 mx-auto">
        <div class="col">
            <div class="row" >
                <div class="col-12 d-flex justify-content-start"><p>Name: {{ $customer->fname }} {{ $customer->lname }}</p></div>
                <div class="col-12 d-flex justify-content-start"><p>Contact: {{ $customer->phone }}</p></div>
                <div class="col-12 d-flex justify-content-start"><p>Email: {{ $customer_root->email }}</p></div>
            </div>
        </div>
        <div class="col ">
            <div class="row" >
                <div class="col-12 d-flex justify-content-end "><p>Date: {{ date("Y-m-d") }}</p></div>
                <div class="col-12 d-flex justify-content-end "><p>Reference: {{ $appointment->id }}</p></div>
                <div class="col-12 d-flex justify-content-end "><p>Receipt: {{ $ro->id }}</p></div>
            </div>
        </div>
    </div>

    <div class="row p-5">
        <div class="col border">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Service</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($service_summary as $row)
                            <tr>
                                <td><span class="mx-3"></span>{{ $row->name }}</td>
                                <td><span class="mx-3"></span>{{ $row->amount }}</td>
                            </tr>
                    @endforeach


                    <tr class="border-top">
                        <td class=" d-flex justify-content-end" colspan="2"><span class="mx-3"></span><h3>Total: {{ $bill->total_paid+$bill->balance }}</h3></td>
                    </tr>

                    <tr>
                        <td class=" d-flex justify-content-end" colspan="2"><span class="mx-3"></span><p>Paid: {{ $bill->total_paid }}</p></td>
                    </tr>

                    <tr>
                        <td class=" d-flex justify-content-end" colspan="2"><span class="mx-3"></span><p>Balance: {{ $bill->balance }}</p></td>
                    </tr>
                </tbody>
              </table>
        </div>
    </div>

</body>
</html>

<script src="{{ URL::asset('js/clinic/print/print.js') }}"></script>