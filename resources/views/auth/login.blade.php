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
<link rel="stylesheet" href="{{asset('./css/customer/customer_login.css')}}">
</head>
<body>



<section class="login-block">
    <div class="container">
      
  
	    <div class="row">
		    <div class="col-sm-6 login-sec">
		    
		<form action="{{ route('login') }}" method="POST" class="login-form" id="main_form">
          @csrf
          <h2>Welcome Back!</h2>
            <div class="form-group">
              <label for="fname" class="text-uppercase">Email</label>
              <input type="text" class="form-control" placeholder="" id="email" name="email">
              <span class="text-danger error-text fname_error"></span>
            </div>

            <div class="form-group">
              <label for="fname" class="text-uppercase">Password</label>
              <input type="text" class="form-control" placeholder="" id="password" name="password">
              <span class="text-danger error-text fname_error"></span>
            </div>


            <!-- <div class="form-group">
              <label for="gender" class="text-uppercase">Gender</label> -->
              <!-- <input type="text" class="form-control" placeholder="" id="gender" name="gender"> -->

                <!-- <div class="col-md-14">
                  <select class="form-control" id="gender" name="gender">
                    <option value="">Select Gender...</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
                <span class="text-danger error-text gender_error"></span>
            </div> -->


<!-- 
            <button type="submit" class="btn btn-login float-center" id="login" >Sign In</button> -->
            <a href="#" class="btn btn-primary btn-block">Sign In</a>
            <br>
            <p>OR</p>

            <a href="{{ route('login.google') }}" class="btn btn-success btn-block">Sign In with Google</a>

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