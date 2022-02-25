@extends('layouts.customerlayout1')
@section('content')


 
    <div id="content">
            <div class="input-group mb-3" style="width: 70%; margin-left: 15%; margin-right: 15%; margin-top: 2%;">

                <!-- <form id="search_clinic"> -->
                    <input id="search" type="text" class="form-control" placeholder="Search Clinic Name" aria-label="Search Clinic Name" aria-describedby="basic-addon2">
                <!-- </form> -->
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Search</span>
                    </div>

                    <select id="ClinicType" style="margin-left: 10px; background-color: #B3CDE0; padding:5px;">
                            <option value="ClinicTypes">Clinic Types</option> 
                            <option value="1">Dental</option> 
                            <option value="2">Medical</option> 
					</select>

                
                 
            </div>
                

            
        
            <div id="info">
            </div>
</div>

@endsection
@section('jsScript')
    <script src="{{ URL::asset('js/customer/clinicList.js') }}"></script>
@endsection