<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MR. JAMS</title>
  <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">

  <link rel="stylesheet" href="{{asset('./css/customer/customer_role.css')}}">

  {{-- jquery 3.6.0 --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>



    <section>
        <div class="container" style="width: 60%;">
            <form action="#" class="login-form" id="main_form">
              @csrf
      
                <div class="row">
                    <div class="col-sm-6 login-sec">
                     
                      <h2>Welcome Back!</h2>

                      <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" class="center" width="100%" height="20%">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia dignissimos modi nostrum officia ullam eaque commodi. </p><br>  
                    
                        <a href="{{ route('role.register_customer') }}" class="btn btn-info" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">Sign Up as a Patient</a>
                        <br>
                        <p>OR</p>

                        <a href="{{ route('role.register_clinic') }}" class="btn btn-success" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">Sign Up as Clinic</a>

                    </div>
                   
                    <div class="col-sm-6">
                      <img src="{{ URL::asset('images/mrjams/medic.png') }}" class="imahe" width="100%" height="80%">
                    </div>	   
                  
                </div>

            </form>
      
        </div>

        <div style="text-align: center; padding-top:2%;" class="copy-text">Created with <i class="fa fa-heart"></i> by TUPT - BSIT 4A | 2018-2022</div>


    </section>

  
</body>

<script src="{{ URL::asset('js/registration/customer.js') }}">  
</script>
</html>