<form action="{{route('clinic.equipments.store')}}" method="POST" id="main_form">
    @csrf
    <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Material</h5>
                    <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Adding an existing material will automatically add quantity given that the unit is the same. It is a prevention for duplications.">
                    </i>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Consumables or Equipments</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Material Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="please enter quantity">
                        <span class="text-danger error-text quantity_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select class="form-select" name="unit" id="unit">
                            <option value="pcs">pcs</option>
                            <option value="bottle">bottle</option>
                            <option value="box">box</option>
                        </select>
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <button id="create_equipment_close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="create_equipment_add" type="submit" class="btn btn-primary">Add</button>

                    <button class="btn btn-primary" type="button" id="response_waiting_equipment_create" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
    
            </div>
        </div>
    </div>
</form>