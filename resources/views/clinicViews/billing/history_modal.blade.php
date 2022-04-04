<div class="modal fade" id="bill_history_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
            
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
    
            <div class="modal-header">
                {{-- <a  class="printPage" href="#">Print</a> --}}
                <h5 class="modal-title" id="exampleModalLongTitle"><span id="billing_history_name"></span> Billing History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_billing_history">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div id="bill_history">
                    {{-- <p>Price: 100 <br> Comment: First Payment <br> Date: October 16 1999</p> --}}
                    {{-- data came from js --}}
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="confirm_accept_btn_cancel">Close</button>
            </div>
        
        </div>
    </div>
</div>
    