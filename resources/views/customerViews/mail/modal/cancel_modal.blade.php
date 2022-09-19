<div class="modal fade" id="cancel_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cancel Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <h5><b>Are you sure you want to cancel this appointment?</b></h5>
                </div>
                <div class="d-flex justify-content-center">
                    <p><i>Please keep in mind that you cannot cancel an appointment less than one hour before to the
                            scheduled time; If you want the transaction to proceed smoothly, it is best to contact the
                            clinic.</i></p>
                </div>
                <div class="d-flex justify-content-center">
                    <strong>
                        <p id="cancel_name"></p>
                    </strong>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="confirm_cancel">Confirm</button>
            </div>

        </div>
    </div>
</div>
