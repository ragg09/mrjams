<div class="modal fade" id="detail_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
    
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Customer & Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <div class="modal-body">
                <input type="text" class="form-control" id="for_ro_id"  placeholder="Service Name" hidden>
                    <div class="row" id="detail_modal_body">
                        {{-- data came from js --}}
                    </div>
            </div>
    
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="accept_app_btn" data-bs-toggle="modal" data-bs-target="#accept_modal_up" >Accept <i class="fas fa-calendar-check"></i></button>
                <button type="submit" class="btn btn-danger" id="decline_app_btn" data-bs-toggle="modal" data-bs-target="#decline_modal_up">Decline <i class="fa fa-trash" aria-hidden="true"></i></i></button>
            </div>
    
            </div>
        </div>
    </div>
