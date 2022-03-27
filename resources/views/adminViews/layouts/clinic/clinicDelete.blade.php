<div class="modal fade" id="delete_modal_clinic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
    
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <strong></strong><p id="delete_name"> </p></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body bg-secondary text-white m-2 p-2 rounded border-dark">
                <div class="d-flex justify-content-center ">
                    <p><strong>Please Note: </strong>Are you sure do you want to delete this clinic?</p>
                    <input id="userIDDeleteClinic" hidden>
                   
                </div>
                <strong><p id="delete_packages"> </p></strong>
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="confirm_delete">Delete</button>
            </div>
            </div>
        </div>
    </div>