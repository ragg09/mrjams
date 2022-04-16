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

    {{-- font-awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js" integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            <h4 class="text-center" >Drop your Business Permit Here</h4>
            <h1 class="text-center"><a class="button" id="permit_btn" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-archive" aria-hidden="true"></i></a></h5>
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

<!-- Modal -->
{{-- I used Logscontroller > store for upload --}}
<form action="{{route('public.cloudinary.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload your business permit here</h5>
                </div>
    
                <div class="modal-body" id="permit_body">
                    <p>Please insert a valid business permit with a landscape format.</p>
    
                    <div class="mb-3">
                        {{-- <label for="permit" class="form-label" >Business Permit</label>
                        <input class="form-control" type="file" id="permit" name="permit"> --}}

                        @if ($clinic->permit != null)
                            <input type="text" name="def_permit_id" id="def_permit_id" value="{{ $clinic->permit_id }}" hidden>
                            <input type="text" name="def_permit" id="def_permit" value="{{ $clinic->permit_id }}" hidden>
                            

                            <div class="form-group mb-3">
                                <label for="permit" class="form-label" >Business Permit No.</label>
                                <input class="form-control" type="text" id="permit_id_update" name="permit_id" placeholder="Please Enter The Business Permit Number" value="">
                            </div>

                            <div class="form-group">
                                <label for="permit" class="form-label" >Change Business Permit</label>
                                <input class="form-control" type="file" id="permit_update" name="permit" accept="image/gif, image/jpeg">
                                <img class="w-100 mt-3" src="{{ $clinic->permit }}" alt="permit">
                            </div>
                            
                        @else

                            <div class="form-group mb-3">
                                <label for="permit" class="form-label" >Business Permit No.</label>
                                <input class="form-control" type="text" id="permit_id" name="permit_id" placeholder="Please Enter The Business Permit Number">
                            </div>

                            <div class="form-group">
                                <label for="permit" class="form-label" >Business Permit</label>
                                <input class="form-control" type="file" id="permit" name="permit" accept="image/gif, image/jpeg">
                            </div>
                            
                        @endif
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="permit_upload" disabled>Upload</button>
                </div>
            </div>
        </div>
    </div>

</form>

    
</body>

<script>
$(function(){

    if($("#def_permit_id").val() != ""){
        $("#permit_btn").on('click', function(e){    
            $("#permit_id_update").val($("#def_permit_id").val())
            $("#permit_update").val("") 
            $("#permit_upload").attr("disabled", true);
        });

    }
    

    $("#permit_id_update").on('keyup', function(e){
        if($("#permit_id_update").val() != "" && $("#permit_update").val() != ""){
            
            $("#permit_upload").attr("disabled", false);
        }else{
            $("#permit_upload").attr("disabled", true);
        }
        
    });

    $("#permit_update").on('change', function(e){
        if($("#permit_id_update").val() != "" && $("#permit_update").val() != ""){
            
            $("#permit_upload").attr("disabled", false);
        }else{
            $("#permit_upload").attr("disabled", true);
        }
        
    });

    $("#permit_id").on('keyup', function(e){
        if($("#permit_id").val() != "" && $("#permit").val() != ""){
            
            $("#permit_upload").attr("disabled", false);
        }else{
            $("#permit_upload").attr("disabled", true);
        }
        
    });

    $("#permit").on('change', function(e){
        if($("#permit_id").val() != "" && $("#permit").val() != ""){
            
            $("#permit_upload").attr("disabled", false);
        }else{
            $("#permit_upload").attr("disabled", true);
        }
        
    });

   


    


})
</script>
</html>