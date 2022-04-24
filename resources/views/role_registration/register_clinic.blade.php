<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clinic Registration</title>

    <link rel="stylesheet" href="{{ URL::asset('css/registration/clinic.css') }}">

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    {{-- font-awesome 4.7 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>
<body>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="mapModal" hidden>
    </button>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen">

            <div class="modal-content">
                <div class="modal-header">
                    <h3>Please put <i class="fa fa-map-marker" aria-hidden="true" style="color:red"></i> to your location</h3>  
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                
                <div class="modal-body" id="map">
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  id="get_location_btn" disabled>Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row shadow-lg p-3 mb-5 rounded registration_div">
        <div class="col-5">
            
            <div class="">
                <img src="{{ URL::asset('images/mrjams/medic.png') }}" alt="clinic"> 
            </div>
        </div>

        <div class="col-7 bg-black p-2 bg-opacity-25" id="blur">

            <div class="row mt-2">
                <div class="col-12 w-75 mx-auto rounded" style="background: rgb(207, 0, 0)">
                    <div class=" mx-auto p-1">
                        <p class="text-white">
                            <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
                            Please be noted that MrJams is still in alpha testing, we appreciate every help from the users,
                            but be informed that in beta testing, we will require additional validations such as business permit
                            to maintain the integrity of our community. Thank you for your undestanding.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-white mt-2">
                
                <div class="row">
                    <div class="col d-flex justify-content-center"><h1>Register Clinic</h1></div>
                </div>
                
            </div>
            
            <form action="{{route('clinic.settings.store')}}" method="POST" id="main_form" enctype="multipart/form-data">
                @csrf
                <input type="text" id="latitude" name="latitude" value="" hidden>
                <input type="text" id="longitude" name="longitude" value="" hidden>
                <input type="text" name="role" value="clinic" hidden>
                <div id="form_form">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="Clinic Name" name="name">
                        <label for="floatingInput">Clinic Name</label>
                        <span class="text-warning error-text name_error"></span>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control " id="" placeholder="Phone Number" name="phone">
                                <label for="floatingInput">Phone Number</label>
                                <span class="text-warning error-text phone_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="" placeholder="Telephone (optional)" name="telephone">
                                <label for="floatingInput">Telephone (optional)</label>
                                <span class="text-warning error-text telephone_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" name="clinic_type_id">
                            <option value="" selected>Select Clinic Type</option>
                            @foreach ($types as $row)
                                <option value="{{$row->id}}">{{$row->type_of_clinic}}</option>
                            @endforeach
                        </select>
                        <span class="text-warning error-text clinic_type_id_error"></span>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" id="searchInput" placeholder="" >
                        <label for="floatingInput">Search landmark near to your clinic</label>
                    </div>

                    <div>

                        <div class="row">
                            <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="" placeholder="Address line 1" name="address_line_1">
                                        <label for="floatingInput">Address line 1</label>
                                        <span class="text-warning error-text address_line_1_error"></span>
                                    </div>
                            </div>
                            <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="" placeholder="Address line 2" name="address_line_2">
                                        <label for="floatingInput">Address line 2</label>
                                        <span class="text-warning error-text address_line_2_error"></span>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="" placeholder="City" name="city">
                                    <label for="floatingInput">City</label>
                                    <span class="text-warning error-text city_error"></span>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="" placeholder="Zipcode" name="zip_code">
                                    <label for="floatingInput">Zipcode</label>
                                    <span class="text-warning error-text zip_code_error"></span>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="permit" class="form-label h5 text-white">Business Permit</label>
                            <input class="form-control" type="file" id="permit" name="permit">
                            <span class="text-warning error-text permit_error"></span>
                        </div> --}}

                        <div class="row mt-2 mb-2" hidden id="put_location_first">
                            <div class="col-12 w-75 mx-auto rounded" style="background: rgb(207, 0, 0)">
                                <div class=" mx-auto p-1">
                                    <p class="text-white text-center">
                                        Search a land mark first and put pin on your location. Thank you.
                                    </p>
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="terms_conditions">
                                        <label class="form-check-label" for="terms_conditions">
                                          <a href="/public/terms_condition" target="_blank" class="text-white">Terms and Conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    {{-- <input type="submit" class="form-control btn btn-primary" placeholder="Register" name="Register"> --}}

                                    <button type="submit" class="form-control btn btn-primary" disabled id="register_btn">Register</button>

                                    <button type="submit" class="form-control btn btn-primary" disabled id="register_btn_waiting_response" hidden>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Waiting for response . . . 
                                    </button>
                                </div>
                            </div>

                            
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>

</body>




<script src="{{ URL::asset('js/registration/mapping.js') }}">  
</script>

<script src="{{ URL::asset('js/registration/clinic.js') }}">  
</script>

{{-- google map API --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places">
</script>

</html>