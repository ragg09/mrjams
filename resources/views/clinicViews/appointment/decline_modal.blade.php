<div class="modal fade" id="decline_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Decline Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="decline_appointment">

                </div>
                Are you sure you want to decline this appointment? 
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="confirm_decline_appointment_cancel">Cancel</button>
                <button type="submit"class="btn btn-danger" id="confirm_decline_appointment_decline" >Decline</button>

                <button class="btn btn-danger" type="button" id="response_waiting_decline" disabled hidden>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Waiting for response . . . 
                </button>
            </div>

        </div>
    </div>
</div>