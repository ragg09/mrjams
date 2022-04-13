<div class="modal fade" id="view_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><span id="material_name"></span> Storing Logs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_equipment_view">
                        <span class="sr-only">Loading...</span>
                      </div>
                </div>

                <div class="" id="equipments_inventory">
                    {{-- data came from js --}}
                    
                </div>
    
            </div>

            <div class="modal-footer">
                <button id="view_equipment_close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>