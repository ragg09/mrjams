<div class="row justify-content-center" id="Details">
    <div class="col-lg-7 border">
    
        <div class="row mb-2">
            <div class="col">
                <h4>General Settings</h4>
            </div>
            <div class="col d-flex justify-content-end">
                <input type="checkbox" class="btn-check" id="edit_details" autocomplete="off">
                <label class="btn btn-outline-primary" for="edit_details" onclick="MapListner()" id="p1">Edit</label><br>
            </div>
        </div>
        <form action="/clinic/settings/{{ $general->id }}" method="POST" id="edit_detials_form">
            @csrf
            {{method_field('PUT')}}
            <input type="text" id="role" name="role" value="general" disabled hidden>
            <input type="text" id="lat" name="lat" value="{{ $general->latitude }}" disabled hidden>
            <input type="text" id="lon" name="lon" value="{{ $general->longitude }}" disabled hidden>
            

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="" placeholder="Clinic Name" id="name" name="name" value="{{ $general->name }}" disabled>
                <label for="floatingInput">Clinic Name</label>
                <span class="text-danger error-text name_error"></span>
            </div>

            <div class="row">
                <div class="col-lg-6 col-mt-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="Phone" name="phone" value="{{ $general->phone }}" disabled>
                        <label for="floatingInput">Phone</label>
                        <span class="text-danger error-text phone_error"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-mt-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="Telephone" name="telephone" value="{{ $general->telephone }}" disabled>
                        <label for="floatingInput">Telephone</label>
                        <span class="text-danger error-text telephone_error"></span>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="" placeholder="Address Line 1" name="address_line_1" value="{{ $general->address_line_1 }}" disabled>
                <label for="floatingInput">Address Line 1</label>
                <span class="text-danger error-text address_line_1_error"></span>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="" placeholder="Address Line 2" name="address_line_2" value="{{ $general->address_line_2 }}" disabled>
                <label for="floatingInput">Address Line 2</label>
                <span class="text-danger error-text address_line_2_error"></span>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="City" name="city" value="{{ $general->city }}" disabled>
                        <label for="floatingInput">City</label>
                        <span class="text-danger error-text city_error"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="Zip Code" name="zip_code" value="{{ $general->zip_code }}" disabled>
                        <label for="floatingInput">Zip Code</label>
                        <span class="text-danger error-text zip_code_error"></span>
                    </div>
                </div>
            </div>

            <div id="map" style="height: 400px"></div>

            <div class="row ">
                <div class="col d-flex justify-content-end"> 
                    <button type="submit"class="btn btn-primary" disabled>Update</button>                
                </div>
            </div>
            


        </form>

        
    </div>
</div>

<script src="{{ URL::asset('js/clinic/settings/details_map.js') }}"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places">
</script>

