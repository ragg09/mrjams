@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/relativeAppoint-form.css')}}">
  
@endsection 
@section('content')
@include('customerViews.header.header3')

  <nav aria-label="breadcrumb" style="background-color: #f2f5f7; padding: 8px 15px 1px 20px; margin: 15px 50px 0px 50px; border-radius: 20px;">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/customer/appointment/{{$clinic_data->id}}">{{$clinic_data->name}}</a></li>
      <li class="breadcrumb-item active"  style="color: black">Relative</li>
      <li class="breadcrumb-item active" aria-current="page" style="color: black">Get Appointment</li>
      {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
    </ol>
  </nav>

    <section class="login-block">
      <div class="container">
	      <div class="row">
		      <div class="col-sm-4 login-sec">
		
		       
              <form action="{{route('customer.appointment.store')}}" method="POST" id="main_form">
                @csrf

                      <h2>Appointment</h2>
                      <h6>Personal Information of the Patient - Step 1</h6>

                      <input type="hidden" name="clinic_id"  id="clinic_id" value="{{$clinic_id}}">
                      <input type="hidden" name="appointment" value="relative">

                    {{-- @foreach($customer as $customers) --}}
                      <input type="hidden" name="user_as_customer_id" value="{{$customer->id}}"> 
                    {{-- @endforeach --}}

                    <div class="form-group">
                      <label for="fname" class="text-uppercase">First Name</label>
                      <input type="text" class="form-control" placeholder="" id="fname" name="fname" value="" >
                      <span class="text-danger error-text fname_error"></span>
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                      <label for="mname" class="text-uppercase">Middle Name</label>
                      <input type="text" class="form-control" placeholder="" id="mname" name="mname" value="">
                      <span class="text-danger error-text mname_error"></span>
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                      <label for="lname" class="text-uppercase">Last Name</label>
                      <input type="text" class="form-control" placeholder="" id="lname" name="lname" value="">
                      <span class="text-danger error-text lname_error"></span>
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                      <label for="gender" class="text-uppercase">Gender</label>
                        <div class="col-md-14">
                          <select class="form-control" id="gender" name="gender" value="">
                            <option value="">Select Gender...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>
                        <span class="text-danger error-text gender_error"></span>
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                      <label for="age" class="text-uppercase">Age</label>
                      <input type="text" class="form-control" placeholder="" id="age" name="age" value="">
                      <span class="text-danger error-text age_error"></span>
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                      <label for="phone" class="text-uppercase">Phone</label>
                      <input type="text" class="form-control" placeholder="" id="phone" name="phone" value=""> 
                      <span class="text-danger error-text phone_error"></span>
                    </div>
                
                    <div class="form-group"style="margin-top:10px;">
                      <label for="fname" class="text-uppercase">Address Line 1</label>
                      <input type="text" class="form-control" placeholder="" id="addline1" name="addline1" value="" >
                      <span class="text-danger error-text addline1_error"></span>
                    </div>

                    <div class="form-group" style="margin-top:10px;">
                      <label for="mname" class="text-uppercase">Address Line 2</label>
                      <input type="text" class="form-control" placeholder="" id="addline2" name="addline2" value="" >
                      <span class="text-danger error-text addline2_error"></span>
                    </div>

                </div>

                <div class="col-sm-4 login-sec">
                  <div class="form-group" style="padding-top:40px;">

                      <h6>Appointment Information - Step 2</h6>

                    
                      <div class="form-group" id="services_multi">
                        <label for="service" class="text-uppercase"><input id="CService" type="checkbox" name="cService"/>Service</label>
                          <div class="col-md-14">
                            <select class="form-control" id="service_multiple" name="service_multiple" style="width: 100%;" multiple disabled>

                            @foreach ($service as $services)
                              <option value="{{$services->id}}">{{$services->name}}</option>
                            @endforeach

                            </select>
                          </div>
                          <input type="text" class="form-control" id="service_ids" name="service_ids" hidden>
                      </div>


                    <div class="form-group" style="margin-top:13px;">
                        <label for="package" class="text-uppercase"><input id="CPackage" type="checkbox" name="cPackage"/>Package</label>
                          <div class="col-md-14">
                            <select class="form-control" id="package" name="package" disabled>
                            @foreach ($package as $packages)
                              <option value="{{$packages->id}}">{{$packages->name}}</option>
                            @endforeach
                            </select>
                          </div>
                        <span class="text-danger error-text gender_error"></span>
                    </div>
                  
                
                    <div class="form-group" style="margin-top:11px;">
                      <label for="date" class="text-uppercase">Date Today</label>
                      <br>
                      <input type="date" value="<?= date('Y-m-d') ?>" style="width:100%; margin-top:1px; height: 38px;  margin-bottom:8px;" id="date" name="date" readonly>
                    </div>

                    <label for="appointdate" class="text-uppercase">Appointment Date and Time</label>

                    <div class="form-group d-flex justify-content mt-1 mb-2" id="flatpickr" >
                      <input type="text" class="flatpickr flatpickr-input active" placeholder="Select Date and Time.." id="accept_modal_flatpicker" name="datetime" style="width: 100%">
                      
                    </div>

                    {{-- <div class="form-group">
                        <label for="appointdate" class="text-uppercase">Appointment Date</label>
                        <br>
                        <input id="today" type="date" style="width:100%; margin-top:1px; height: 38px;" id="appointdate" name="appointdate">
                  
                    </div>

                    <div class="form-group" style="margin-top:6px; margin-bottom:35px;">
                      <label for="lname" class="text-uppercase">Time</label>
                      <br>
                      <input type="time" id="time" name="time" style="width:100%; margin-top:1px; height: 38px;">
                    
                    </div> --}}
                
                    <button type="submit" class="btn btn-login float-right" id="appointment">Submit</button>
        
              </form>
		      </div>
        
		    </div>
        <div class="col-sm-4 banner-sec" ></div>	  
	
      </div>

    </section>
    @include('customerViews.footer.footer2')
@endsection
@section('jsScript')
    {{-- <script>document.getElementById('today').value = moment().format('YYYY-MM-DD');</script> --}}
    <script src="{{ URL::asset('js/customer/appointment.js') }}"></script> 
    <script src="{{ URL::asset('js/customer/dateTime.js') }}"></script>  
    {{-- <script>
      $("#service_multiple").select2({ 
                  dropdownParent: $('#services_multi'),
                  placeholder: "Select Services",
                  allowClear: true,
                  tags: true,
              });

              $("#service_multiple").change(function() {
                  var ids = [];
                  $('#service_multiple :selected').each(function(i, sel){ 
                      ids.push($(sel).val());
                  });
                  $("#service_ids").val(ids);
              });

    </script>
    <script> 
      var check = $("#CPackage");
      $("#CPackage").on('click',checkStatus);

      function checkStatus(){
          
      if(check.is(':checked'))
      {
          $("#package").prop('disabled', false);
      }
      else{
          $("#package").prop('disabled', true);
      }
          
      }

      // Service
      var checks = $("#CService");
      $("#CService").on('click',checkStatuss);

      function checkStatuss(){
          
      if(checks.is(':checked'))
      {
          $("#service_multiple").prop('disabled', false);
      }
      else{
          $("#service_multiple").prop('disabled', true);
      }
          
      }

    </script> --}}
@endsection


