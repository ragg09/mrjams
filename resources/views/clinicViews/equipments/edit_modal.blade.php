<form action="" method="POST" id="edit_main_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="edit_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
    
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_equipment_edit">
                            <span class="sr-only">Loading...</span>
                          </div>
                    </div>

                    <div id="edit_equipment_body">
                        <div class="form-group">
                            <label for="name">Consumables or Equipments</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Material Name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
    
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" id="edit_quantity" name="quantity" placeholder="please enter a quantity">
                            <span class="text-danger error-text quantity_error"></span>
                        </div>
    
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select class="form-select" name="unit" id="edit_unit">
                                <option value="pcs">pcs</option>
                                <option value="bottle">bottle</option>
                                <option value="box">box</option>
                            </select>
                        </div>
                    </div>
        
                </div>
    
                <div class="modal-footer">
                    <button id="edit_equipment_close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="edit_equipment_add" type="submit"class="btn btn-primary">Update</button>

                    <button class="btn btn-primary" type="button" id="response_waiting_equipment_edit_btn" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
    
            </div>
        </div>
    </div>
</form>