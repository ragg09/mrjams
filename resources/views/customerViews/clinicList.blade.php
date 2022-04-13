@extends('customerViews.layouts.customerlayout')
@section('content')
@include('customerViews.header.header2')

 
    <div id="content">
            <div class="input-group mb-3" style="width: 70%; margin-left: 15%; margin-right: 15%; margin-top: 2%;">

                    {{-- search --}}
                    <input id="search" type="text" class="form-control" placeholder="Search Clinic Name" aria-label="Search Clinic Name" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search fa-lg" aria-hidden="true" style="padding: 4px;"></i></span>
                    </div>

                    {{-- dropdown filter --}}
                    <select id="ClinicType" style="margin-left: 10px; background-color: #B3CDE0; padding:5px; border-radius: 3px">
                            <option value="ClinicTypes">Clinic Types</option> 
                            <option value="1">Dental</option> 
                            <option value="2">Medical</option> 
					</select>
                 
            </div>
                
            {{-- clinic List --}}
            <div id="info">
            </div>


</div>
@include('customerViews.footer.footer2')
@endsection
@section('jsScript')
    <script src="{{ URL::asset('js/customer/clinicList.js') }}"></script>
@endsection