<div class="modal fade" id="delete_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
    
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <strong></strong><p id="delete_name"> </p></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body bg-secondary text-white m-2 p-2 rounded border-dark">

                <div class="d-flex justify-content-center ">
                    <p><strong>Please Note: </strong>Deleting this material will remove all of its record and will make changes to the following packages and services  :</p>
                   
                </div>
                <strong><p id="delete_packages"> </p></strong>
            </div>
    
            <div class="modal-footer">
                <button id="delete_equipment_close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="delete_equipment_delete" type="submit" class="btn btn-danger">Delete</button>

                <button class="btn btn-danger" type="button" id="response_waiting_equipment_delete_btn" disabled hidden>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Waiting for response . . . 
                </button>
            </div>
    
            </div>
        </div>
    </div>
