<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MR. JAMS</title>
  <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="{{asset('./css/customer/customer_role.css')}}">
</head>
<body>



<section class="login-block">
    <div class="container">
      
  
	    <div class="row">
		    <div class="col-sm-6 login-sec">
		    
		<form action="#" class="login-form" id="main_form">
          @csrf
          <br><br>
          <h2>Welcome Back!</h2>
            <br>
            <a href="{{ route('role.register_customer') }}" class="btn btn-primary btn-block">Sign Up as a Patient</a>
            <br>
            <p>OR</p>

            <a href="{{ route('role.register_clinic') }}" class="btn btn-success btn-block">Sign Up as Clinic</a>

		    </div>
            </form>
    
        
		      <div class="col-sm-6 banner-sec"></div>	   
		    
		  </div>
	
    </div>

    <div style="padding-left:40%; padding-top:2%;" class="copy-text">Created with <i class="fa fa-heart"></i> by TUPT - BSIT 4A | 2018-2022</div>


    


</section>

  
</body>

<script src="{{ URL::asset('js/registration/customer.js') }}">  
</script>
</html>