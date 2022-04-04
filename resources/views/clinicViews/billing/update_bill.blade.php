<form action="" method="POST" id="update_main_form">
    @csrf
    {{method_field('PUT')}}

    <div class="modal fade" id="update_bill_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
            
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
        
                <div class="modal-header">
                    {{-- <a  class="printPage" href="#">Print</a> --}}
                    <h5 class="modal-title" id="exampleModalLongTitle">Update <span id="update_billing_name">Name's</span> Bill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
        
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_billing_update">
                            <span class="sr-only">Loading...</span>
                          </div>
                    </div>

                    <div class="row" id="update_bill_body">
                        <div class="form-group">
                            <label for="name">Total Bill</label>
                            <input type="text" class="form-control" id="edit_total" name="edit_total" placeholder="Total Bill" disabled>
                            <input type="text" class="form-control" id="edit_total2" name="edit_total" placeholder="Total Bill" hidden>
                        </div>

                        <div class="form-group">
                            <label for="name">Balance</label>
                            <input type="text" class="form-control" id="edit_balance" name="edit_balance" placeholder="Balance" disabled>
                            <input type="text" class="form-control" id="edit_balance2" name="edit_balance" placeholder="Balance" hidden>
                        </div>

                        <div class="form-group">
                            <label for="name">Please Enter Amount</label>
                            <input type="text" class="form-control" id="payment_update" name="payment_update" placeholder="Amount to pay">
                            <span class="text-danger error-text payment_update_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="name">Comment</label>
                            <input type="text" class="form-control" id="payment_comment" name="payment_comment" placeholder="Optional . . .">
                            <span class="text-danger error-text payment_comment_error"></span>
                        </div>
                    </div>

                </div>
        
                <div class="modal-footer" id="detail_modal_footer">
                    <button type="submit"class="btn btn-warning" id="update_billing_update_btn">Update</button>

                    <button class="btn btn-warning" type="button" id="response_waiting_update_billing_update_btn" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
        
            </div>
        </div>
</div>

</form>