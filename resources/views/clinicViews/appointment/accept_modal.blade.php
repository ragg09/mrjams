<form action="" method="POST" id="accept_appointment_form">
    @csrf
    {{method_field('PUT')}}

    <div class="modal fade" id="accept_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Appointment </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div wire:loading>Loading . . .</div>
                    <span class="text-danger error-text datetime_error"></span>

                    <div class="form-group">
                        <label for="personel">Select Specialist</label>
                        <select class="form-control" id="personel" name="personel" style="width: 100%;">
                            <option value="0">Please Select Doctor || BABAGUHIN PA</option>
                            <option value="1">Doctor 1</option>
                            <option value="2">Doctor 2</option>
                            <option value="3">Doctor 3</option>
                       </select>  
                        <span class="text-danger error-text personel_error"></span>
                    </div>

                    <div class="form-group d-flex justify-content-center mt-2" id="flatpickr">
                        <input type="text" class="" id="accept_modal_flatpicker" name="datetime" hidden>
                    </div>

                    <div id="customer_email" >
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"class="btn btn-success">Confirm</button>
                </div>
    
            </div>
        </div>
    </div>

</form>