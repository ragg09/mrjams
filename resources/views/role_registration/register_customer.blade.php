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
<link rel="stylesheet" href="{{asset('./css/customer/customer_register.css')}}">
</head>
<body>



<section class="login-block">
    <div class="container">
      
  
	    <div class="row">
		    <div class="col-sm-4 login-sec">
		    
		      <form action="{{route('customer.customerregister.store')}}" method="POST" class="login-form" id="main_form">
          @csrf
          <h2>Register Now</h2>
            <div class="form-group">
              <label for="fname" class="text-uppercase">First Name</label>
              <input type="text" class="form-control" placeholder="" id="fname" name="fname">
              <span class="text-danger error-text fname_error"></span>
            </div>

            <div class="form-group">
              <label for="mname" class="text-uppercase">Middle Name</label>
              <input type="text" class="form-control" placeholder="" id="mname" name="mname">
              <span class="text-danger error-text mname_error"></span>
            </div>

            <div class="form-group">
              <label for="lname" class="text-uppercase">Last Name</label>
              <input type="text" class="form-control" placeholder="" id="lname" name="lname">
              <span class="text-danger error-text lname_error"></span>
            </div>

            <div class="form-group">
              <label for="gender" class="text-uppercase">Gender</label>
              <!-- <input type="text" class="form-control" placeholder="" id="gender" name="gender"> -->

                <div class="col-md-14">
                  <select class="form-control" id="gender" name="gender">
                    <option value="">Select Gender...</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
                <span class="text-danger error-text gender_error"></span>
            </div>

            <div class="form-group">
              <label for="age" class="text-uppercase">Age</label>
              <input type="text" class="form-control" placeholder="" id="age" name="age">
              <span class="text-danger error-text age_error"></span>
            </div>


            <input type="hidden" name="role" value="customer"> 

            <!-- <div class="form-group">
              <label for="address" class="text-uppercase">Address</label>
              <input type="text" class="form-control" placeholder="" id="address" name="address"> 
            </div> -->

            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                <small>Remember Me</small>
              </label>

            </div>

		    </div>

        <div class="col-sm-4 login-sec">
		      <!-- <h2 class="text-center">/h2> -->
		
            <div class="form-group" style="padding-top:91px;">
              <label for="fname" class="text-uppercase">Address Line 1</label>
              <input type="text" class="form-control" placeholder="" id="addline1" name="addline1">
              <span class="text-danger error-text addline1_error"></span>
            </div>

            <div class="form-group">
              <label for="mname" class="text-uppercase">Address Line 2</label>
              <input type="text" class="form-control" placeholder="" id="addline2" name="addline2">
              <span class="text-danger error-text addline2_error"></span>
            </div>

            <div class="form-group">
              <label for="lname" class="text-uppercase">City</label>
              <input type="text" class="form-control" placeholder="" id="city" name="city">
              <span class="text-danger error-text city_error"></span>
            </div>

            <div class="form-group">
              <label for="gender" class="text-uppercase">Zip Code</label>
              <input type="text" class="form-control" placeholder="" id="zip" name="zip">
              <span class="text-danger error-text zip_error"></span>
            </div>
  
            <div class="form-group">
              <label for="phone" class="text-uppercase">Phone</label>
              <input type="text" class="form-control" placeholder="" id="phone" name="phone"> 
              <span class="text-danger error-text phone_error"></span>
            </div>

  

              <button type="submit" class="btn btn-login float-right" id="register">Submit</button>
        
          </form>
		    </div>
        
		      <div class="col-sm-4 banner-sec"></div>	   
		    
		  </div>
	
    </div>

    <div style="padding-left:40%; padding-top:2%;" class="copy-text">Created with <i class="fa fa-heart"></i> by TUPT - BSIT 4A | 2018-2022</div>


    


</section>

  
</body>

<script src="{{ URL::asset('js/registration/customer.js') }}">  
</script>
</html>