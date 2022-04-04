@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/setAppoint-form.css')}}">


@endsection 
@section('content')
@include('customerViews.header.header3')

 
    <nav aria-label="breadcrumb" style="background-color: #f2f5f7; padding: 8px 15px 1px 20px; margin: 15px 50px 0px 50px; border-radius: 20px;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/customer/appointment/{{$clinic_data->id}}">{{$clinic_data->name}}</a></li>
        <li class="breadcrumb-item active"  style="color: black">Myself</li>
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
                              <h6>Personal Information - Step 1</h6>

                              <input type="hidden" name="clinic_id" value="{{$clinic_id}}" id="clinic_id">
                              <input type="hidden" name="appointment" value="myself">

                                    {{-- @foreach($customer as $customers) --}}

                                          <input type="hidden" name="user_as_customer_id" value="{{$customer->id}}"> 

                                          <div class="form-group">
                                            <label for="fname" class="text-uppercase">First Name</label>
                                            <input type="text" class="form-control" placeholder="" id="fname" name="fname" value="{{$customer->fname}}" readonly>
                                            <span class="text-danger error-text fname_error"></span>
                                          </div>

                                          <div class="form-group" style="margin-top:10px;">
                                            <label for="mname" class="text-uppercase">Middle Name</label>
                                            <input type="text" class="form-control" placeholder="" id="mname" name="mname" value="{{$customer->mname}}" readonly>
                                            <span class="text-danger error-text mname_error"></span>
                                          </div>

                                          <div class="form-group" style="margin-top:10px;">
                                            <label for="lname" class="text-uppercase">Last Name</label>
                                            <input type="text" class="form-control" placeholder="" id="lname" name="lname" value="{{$customer->lname}}" readonly>
                                            <span class="text-danger error-text lname_error"></span>
                                          </div>

                                          <div class="form-group" style="margin-top:10px;">
                                            <label for="gender" class="text-uppercase">Gender</label>
                                            <input type="text" class="form-control" placeholder="" id="gender" name="gender" value="{{$customer->gender}}" readonly>
                                              <span class="text-danger error-text gender_error"></span>
                                          </div>

                                          <div class="form-group" style="margin-top:10px;">
                                            <label for="age" class="text-uppercase">Age</label>
                                            <input type="text" class="form-control" placeholder="" id="age" name="age" value="{{$customer->age}}" readonly>
                                            <span class="text-danger error-text age_error"></span>
                                          </div>

                                          <div class="form-group" style="margin-top:10px;">
                                            <label for="phone" class="text-uppercase">Phone</label>
                                            <input type="text" class="form-control" placeholder="" id="phone" name="phone" value="{{$customer->phone}}" readonly > 
                                            <span class="text-danger error-text phone_error"></span>
                                          </div>

                                    {{-- @endforeach --}}


                                    {{-- @foreach($customer_add as $customer_adds) --}}

                                          <div class="form-group" style="margin-top:10px;">
                                            <label for="fname" class="text-uppercase">Address Line 1</label>
                                            <input type="text" class="form-control" placeholder="" id="addline1" name="addline1" value="{{$customer_add->address_line_1}}" readonly>
                                            <span class="text-danger error-text addline1_error"></span>
                                          </div>

                                          <div class="form-group" style="margin-top:10px;">
                                            <label for="mname" class="text-uppercase">Address Line 2</label>
                                            <input type="text" class="form-control" placeholder="" id="addline2" name="addline2" value="{{$customer_add->address_line_2}}" readonly>
                                            <span class="text-danger error-text addline2_error"></span>
                                          </div>
                        
                                    {{-- @endforeach --}}

                                </div>

                                <div class="col-sm-4 login-sec">
                                
                                    <div class="form-group" style="padding-top:40px;">
                                    <h6>Appointment Information - Step 2</h6>

                                    <div class="form-group" id="services_multi">
                                      
                                      <label for="service" class="text-uppercase"><input id="CService" type="checkbox" name="cService"/> Service</label>
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
                                      <label for="package" class="text-uppercase"><input id="CPackage" type="checkbox" name="cPackage"/> Package</label>
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

                                    {{-- <div class="form-group" >
                                      <label for="appointdate" class="text-uppercase">Appointment Date</label>
                                      <br>
                                      <input id="today" type="date" style="width:100%; margin-top:1px; height: 38px;" id="appointdate" name="appointdate">
                                       --}}
                                      
                                      {{-- <input class="flatpickr flatpickr-input active" type="text" placeholder="Select Date.." data-id="minTime" readonly="readonly"> --}}
                                      
                                    {{-- </div> --}}

                                    <label for="appointdate" class="text-uppercase">Appointment Date and Time</label>

                                    <div class="form-group d-flex justify-content mt-1 mb-2" id="flatpickr" >
                                      <input type="text" class="flatpickr flatpickr-input active" placeholder="Select Date and Time.." id="accept_modal_flatpicker" name="datetime" style="width: 100%">
                                      
                                    </div>

                                    {{-- <div class="form-group" style="margin-top:6px; margin-bottom:35px;">
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
   
    
   
@endsection




