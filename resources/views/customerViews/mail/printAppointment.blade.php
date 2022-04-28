<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <title>MR. JAMS - Appointment Print</title>

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
            padding: 10px;
        }
        .logotitle {
            display: block;
            margin-left: 0px;
            /* margin-right: auto; */
            width: 160px;
            height: 80px;
        }
        h6{
            text-align: center;
        }
        h5{
            text-align: center;
            font-weight: bold;
        }
    </style>

</head>
<body>

    <input type="hidden" name="clinic_id" id="clinic_id" value="{{$clinic_info->id}}">

    <div class="container">
        <div class="row">
            <div class="col-3"><img src="{{asset('images/mrjams/logowithname.PNG') }}" class="logotitle"></div>
            <div class="col-8 mt-3">
                <h6>APPOINTMENT AND MANAGEMENT SYSTEM FOR DENTAL AND MEDICAL CLINICS WITH LOCATION-BASED MAPPING</h6>
            </div>
          </div>

          <h5>Appointment Details</h5>

        <div class="row mt-5">
            <div class="col mr-2">
                <p style="font-size: 18px; border-bottom-style: outset; border-bottom-color: #6497B1; border-bottom-width: 2px;"><b>Clinic Information:</b></p>
              <div class="row">
                    <div class="col-4" style="font-weight: bold">
                        <p>Clinic Name:</p>
                        <p>Address:</p>
                        <p>Phone:</p>
                    </div>
                    <div class="col" style="text-align: left">
                        <p>{{$clinic_info->name}}</p>
                        <p>{{$clinic_address->address_line_1}}, {{$clinic_address->address_line_2}}</p>
                        <p>{{$clinic_info->phone}}</p>
                    </div>
              </div>
            </div>
            <div class="col">
                <p style="font-size: 18px; border-bottom-style: outset; border-bottom-color: #6497B1; border-bottom-width: 2px;"><b>Appointment Information:</b></p>
                <div class="row">
                      <div class="col-6" style="font-weight: bold">
                            <p>Customer Name:</p>
                          <p>Date Created:</p>
                          <p>Appointment Date:</p>
                          <p>Time:</p>
                          <p>Appointment Status:</p>
                      </div>
                      <div class="col" style="text-align: left">
                          <p>{{$name[0]}}</p>
                          <p>{{ date("M j, Y", strtotime($appointment_data->created_at))}}</p>
                          <p>{{ date("M j, Y", strtotime($appointment_data->appointed_at))}}</p>
                          <p>{{  date("h:i A", strtotime($appointment_data->time)) }}</p>
                          <p>{{$status->status}}</p>
                      </div>
                </div>
            </div>
        </div>

        

    </div>

    {{-- <table class="table">
        <tbody>
          <tr>
            <th scope="row">Date Created: </th>
            <td> {{ date("M j, Y", strtotime($appointment_data->created_at))}}</td>
           
          </tr>
          <tr>
            <th scope="row">Appointment Date: </th>
            <td>{{ date("M j, Y", strtotime($appointment_data->appointed_at))}}</td>
           
          </tr>
          <tr>
            <th scope="row">Time: </th>
            <td>{{  date("h:i A", strtotime($appointment_data->time)) }}</td>
          </tr>
          <tr>
            <th scope="row">Appointment Status: </th>
            <td><i class="fa fa-star text-{{$status->remark}}" aria-hidden="true"></i> {{$status->status}}</td>
          </tr>
          <tr>
            <th scope="row">Customer Name:  </th>
            <td>{{$name[0]}}</td>
          </tr>
        </tbody>
    </table> --}}

    
</body>
<script src="{{ URL::asset('js/customer/print.js') }}"></script> 
</html>