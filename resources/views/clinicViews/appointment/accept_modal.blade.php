<form action="" method="POST" id="accept_appointment_form">
    @csrf
    {{method_field('PUT')}}
    
    <div class="modal fade" id="accept_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                   
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Appointment </h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
    
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_accept">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <div class="form-group">
                        

                        <div id="specialist_div">
                            {{-- <label for="personel">Select Specialist</label> --}}
                            {{-- <select class="form-control" id="specialist" name="specialist" style="width: 100%;">
                                <option value="0">Please Select Doctor || BABAGUHIN PA</option>
                                <option value="1">Doctor 1</option>
                                <option value="2">Doctor 2</option>
                                <option value="3">Doctor 3</option>
                           </select>   --}}
                            <span class="text-danger error-text specialist_error"></span>
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-center mt-2" id="flatpickr">
                        <input type="text" class="" id="accept_modal_flatpicker" name="datetime" hidden>
                    </div>

                    <div id="customer_email" >
                    </div>

                    <span class="text-danger error-text datetime_error fw-bold mt-3"></span>
                    
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#accepted_view_calendar_up" id="calendar_btn" hidden>
                            <i class="fa fa-calendar mx-2" aria-hidden="true"> Your Calendar</i>
                        </button>
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="confirm_accept_btn_cancel">Cancel</button>
                    <button type="submit"class="btn btn-success" id="confirm_accept_btn_confirm">Confirm</button>
                    
                    <button class="btn btn-success" type="button" id="response_waiting_accepting_appointment" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
    
            </div>
        </div>
    </div>

</form>

