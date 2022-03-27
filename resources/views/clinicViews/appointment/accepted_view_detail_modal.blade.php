<form action="" method="POST" id="done_appointment_form">
    @csrf
    {{method_field('PUT')}}

    <div class="modal fade" id="accepted_view_detail_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
        
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer & Patient Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
        
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_accepted_details" hidden> 
                            <span class="sr-only">Loading...</span>
                          </div>
                    </div>

                    {{-- <input type="text" class="form-control" id="ro_id_done" name="ro_id_done"> --}}
                        <div class="row" id="accepted_detail_modal_body">
                            {{-- data came from js --}}
                        </div>

                </div>
        
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    {{-- <button type="submit" class="btn btn-primary">Proceed to billing</button> --}}
                    {{-- clinic/billing/{billing}   --}}
                    <a href="" class="btn btn-outline-primary" id="proceed_billing">
                        Proceed to billing
                    </a>
                </div>
        
            </div>
        </div>
    </div>

</form>
