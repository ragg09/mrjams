<form action="" method="POST" id="edit_package_equipments_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="edit_package_equipment_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Equipments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
    
                <div class="modal-body">

                    <div class="d-flex justify-content-center">
                        <div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_equipments" hidden>
                            <span class="sr-only">Loading...</span>
                          </div>
                    </div>
                    
                    <div class="form-group" id="selected_equipments" hidden>
                        <label for="services">Services</label>
                            <select class="form-control" id="select_equipments" multiple name="select_equipments" style="width: 100%;">
                                {{-- options came appended from js --}}
                           </select>  
                           <input type="text" class="form-control" id="equipment_ids" name="equipment_ids" hidden>
                    </div>

                    <input type="text" class="form-control" name="package_update_filter" value="package_equipments" hidden>

                    <input type="text" class="form-control" id="equipments_original_ids" name="equipments_original_ids" value="orig: ">

                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_btn_equipments" data-bs-dismiss="modal">Close</button>
                    <button type="submit"class="btn btn-primary" id="update_btn_equipments">Update</button>

                    <button class="btn btn-primary" type="button" id="response_waiting_equipments_update" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
    
            </div>
        </div>
    </div>
</form>
