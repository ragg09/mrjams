@extends('customerViews.layouts.customerlayout1')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/setAppoint-form.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection 
@section('content')
    <section class="login-block">
        <div class="container">
	          <div class="row">

               

		                <div class="col-sm-4 login-sec">
                      <form action="{{route('customer.appointment.store')}}" method="POST" id="main_form">
                              @csrf
      
                              <h2>Appointment</h2>
                              <h6>Personal Information - Step 1</h6>

                              <input type="hidden" name="clinic_id" value="{{$clinic_id}}">
                              <input type="hidden" name="appointment" value="myself">

                                    @foreach($customer as $customers)

                                          <input type="hidden" name="user_as_customer_id" value="{{$customers->id}}"> 

                                          <div class="form-group">
                                            <label for="fname" class="text-uppercase">First Name</label>
                                            <input type="text" class="form-control" placeholder="" id="fname" name="fname" value="{{$customers->fname}}" readonly>
                                            <span class="text-danger error-text fname_error"></span>
                                          </div>

                                          <div class="form-group">
                                            <label for="mname" class="text-uppercase">Middle Name</label>
                                            <input type="text" class="form-control" placeholder="" id="mname" name="mname" value="{{$customers->mname}}" readonly>
                                            <span class="text-danger error-text mname_error"></span>
                                          </div>

                                          <div class="form-group">
                                            <label for="lname" class="text-uppercase">Last Name</label>
                                            <input type="text" class="form-control" placeholder="" id="lname" name="lname" value="{{$customers->lname}}" readonly>
                                            <span class="text-danger error-text lname_error"></span>
                                          </div>

                                          <div class="form-group">
                                            <label for="gender" class="text-uppercase">Gender</label>
                                            <input type="text" class="form-control" placeholder="" id="gender" name="gender" value="{{$customers->gender}}" readonly>
                                              <span class="text-danger error-text gender_error"></span>
                                          </div>

                                          <div class="form-group">
                                            <label for="age" class="text-uppercase">Age</label>
                                            <input type="text" class="form-control" placeholder="" id="age" name="age" value="{{$customers->age}}" readonly>
                                            <span class="text-danger error-text age_error"></span>
                                          </div>

                                          <div class="form-group">
                                            <label for="phone" class="text-uppercase">Phone</label>
                                            <input type="text" class="form-control" placeholder="" id="phone" name="phone" value="{{$customers->phone}}" readonly > 
                                            <span class="text-danger error-text phone_error"></span>
                                          </div>

                                    @endforeach


                                    @foreach($customer_add as $customer_adds)

                                          <div class="form-group">
                                            <label for="fname" class="text-uppercase">Address Line 1</label>
                                            <input type="text" class="form-control" placeholder="" id="addline1" name="addline1" value="{{$customer_adds->address_line_1}}" readonly>
                                            <span class="text-danger error-text addline1_error"></span>
                                          </div>

                                          <div class="form-group">
                                            <label for="mname" class="text-uppercase">Address Line 2</label>
                                            <input type="text" class="form-control" placeholder="" id="addline2" name="addline2" value="{{$customer_adds->address_line_2}}" readonly>
                                            <span class="text-danger error-text addline2_error"></span>
                                          </div>
                        
                                    @endforeach

                                </div>

                                <div class="col-sm-4 login-sec">
                                
                                    <div class="form-group" style="padding-top:40px;">
                                    <h6>Appointment Information - Step 2</h6>

                                    <div class="form-group">
                                      <label for="service" class="text-uppercase">Service</label>
                                        <div class="col-md-14">
                                          <select class="form-control" id="service" name="service">
                                          @foreach ($service as $services)
                                            <option value="{{$services->id}}" id="service">{{$services->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <span class="text-danger error-text gender_error"></span>
                                    </div>


                                    <div class="form-group">
                                      <label for="package" class="text-uppercase">Package</label>
                                        <div class="col-md-14">
                                          <select class="form-control" id="package" name="package">
                                            @foreach ($package as $packages)
                                              <option value="{{$packages->id}}">{{$packages->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <span class="text-danger error-text gender_error"></span>
                                    </div>
                                  
                                    <div>
                                      <label for="date" class="text-uppercase">Date Today</label>
                                      <br>
                                      <input type="date" value="<?= date('Y-m-d') ?>" style="width:347px; margin-top:1px; height: 38px;  margin-bottom:15px;" id="date" name="date">
                                    </div>

                                    <div class="form-group">
                                      <label for="appointdate" class="text-uppercase">Appointment Date</label>
                                      <br>
                                      <input id="today" type="date" style="width:347px; margin-top:1px; height: 38px;" id="appointdate" name="appointdate">
                                    
                                    </div>

                                    <div class="form-group">
                                      <label for="lname" class="text-uppercase">Time</label>
                                      <br>
                                      <input type="time" id="time" name="time" style="width:347px; margin-top:1px; height: 38px;">
                                      
                                    </div>

                                    <button type="submit" class="btn btn-login float-right" id="appointment">Submit</button>
            
                      </form>
		                </div>
              
        
		      
		    
		        </div>
            <div class="col-sm-4 banner-sec" ></div>	  
	
        </div>
    </section>
@endsection
@section('jsScript')
    <script>document.getElementById('today').value = moment().format('YYYY-MM-DD');</script>
    <script src="{{ URL::asset('js/customer/appointment.js') }}"></script>  
@endsection




