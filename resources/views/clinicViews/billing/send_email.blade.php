<form action="{{route('clinic.email.store')}}" method="POST" id="send_email_main_form">
    @csrf

    <div class="modal fade" id="send_email_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
            
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
        
                <div class="modal-header">
                    {{-- <a  class="printPage" href="#">Print</a> --}}
                    <h5 class="modal-title" id="exampleModalLongTitle">Send Notfication to <span id="send_email_name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
        
                <div class="modal-body">
                    <div class="row" id="send_email_body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name_view" name="name_view" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email_view" name="email_view" disabled>
                                </div>
                            </div>
                        </div>

                        <input type="text" class="form-control" id="name" name="name" hidden>
                        <input type="text" class="form-control" id="email" name="email" hidden>
                        <input type="text" class="form-control" id="ro_id" name="ro_id" hidden>

                        <div class="form-group mt-2">
                            <label for="name">Subject</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Please Enter Subject of this email">
                            <span class="text-danger error-text title_error"></span>
                        </div>

                        <div class="form-group mt-2">
                            <label for="text">Details</label>
                            <textarea class="form-control w-100" id="text" style="min-height: 200px; max-height: 200px" placeholder="Input message" name="message"></textarea>
                            <span class="text-danger error-text message_error"></span>
                        </div>
                    </div>

                </div>
        
                <div class="modal-footer" id="detail_modal_footer">
                    <button type="submit"class="btn btn-danger" id="send_email_btn_send">Send Email</button>

                    <button class="btn btn-danger" type="button" id="response_waiting_send_email" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
        
            </div>
        </div>
    </div>

</form>