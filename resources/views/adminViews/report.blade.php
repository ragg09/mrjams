<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        *{
            /* margin:0; */
            /* padding: 20px; */
            /* background: white; */
        }
        .wrap{
            width:1200px;             
            margin:auto;
            background:#ddd;
            
        }
        .header{
            height:150px;
            background:#333;
            
        }
        .nav{
            height:50px;
            background:white;
            
        }
        .container{
            background:lightgray;
            padding: 20px;
        }
        .clear{
            clear:both;    
        }
        .footer{
            height:80px;
            background:red;
            padding: 20px;
        }
        #tableContainer{
            padding-top: 20px;
        }
        </style>
    <title>Hello, world!</title>

  </head>
  <body>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <title>my webpage</title>
    
    <head>
    <body onload="window.print()">
        <div class="wrap">
            <div class="header"></div>
            <div class="nav" onclick="window.print()">PRINT</div>
            <div class="container">
                <div class="body flex-grow-1 px-3" id="tableContainer">
                    <div class="container-lg">
                        <div class="row">
                            {{-- <a href="{{ route('admin.clinicTypes.create') }}" id="createClinicType" >Create Clinic Type</a>
                            <a href="{{ route('admin.report.index') }}" id="printClinicTable"  >Print Report</a> --}}
                            <div class="table-responsive">
                                <table class="table table-hover" id="clinicShow">
                                    <thead class="bg-primary">
                                      <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Clinic Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Telephone</th>
                                        {{-- <th scope="col"> </th>
                                        <th scope="col">Action</th>
                                        <th scope="col"> </th> --}}
                                        {{-- <th scope="col">   </th> --}}
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clinic as $clinics)
                                            <tr>
                                                <td>{{$clinics['id']}}</td>
                                                <td>{{$clinics['name']}}</td>
                                                <td>{{$clinics['phone']}}</td>
                                                <td>{{$clinics['telephone']}}</td>
                                                {{-- <td><a href="/admin/clinic/{{$clinics['id']}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a></td> --}}
                                                {{-- <td><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</button></td> --}}
                                                {{-- <td><a href="/admin/clinic/{{$clinics['id']}}/edit" class="btn btn-warning" id="editUser" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td> --}}
                                                {{-- <td><a class="btn btn-danger" id="dltbtnClinic" data-id="{{$clinics['id']}}" data-bs-target="#delete_modal_clinic" data-bs-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">MR JAMS SHIT</div>
        </div>
    </div>
    </body>
    </html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- <script src="{{ URL::asset('js/admin/printReport.js') }}"></script> --}}
  </body>
</html>