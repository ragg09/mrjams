<form action="{{route('clinic.equipments.store')}}" method="POST" id="add_stock_main_form">
    @csrf
    <div class="modal fade" id="add_stock_material" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Stock</h5>
                    <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Adding an existing material will automatically add quantity given that the unit and type is the same. It is a prevention for duplications, but be informed that expiration date segerates the materials quantity count.">
                    </i>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Material</label>
                        <input type="text" class="form-control" id="add_stock_name" name="name" placeholder="Material Name" readonly>
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="supplier">Unit</label>
                        <input type="text" class="form-control" name="unit" id="add_stock_unit" placeholder="please enter supplier" readonly>
                        <span class="text-danger error-text unit_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="supplier">Type</label>
                        <input type="text" class="form-control" name="type" id="add_stock_type" placeholder="please enter supplier" readonly>
                        <span class="text-danger error-text type_error"></span>
                    </div>


                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="add_stock_quantity" name="quantity" placeholder="please enter quantity">
                        <span class="text-danger error-text quantity_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" class="form-control" id="add_stock_supplier" name="supplier" placeholder="please enter supplier">
                        <span class="text-danger error-text supplier_error"></span>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="acquired">Acquired</label>
                                <input type="date" class="form-control" id="add_stock_acquired" name="acquired" placeholder="Date Aquired">
                                <span class="text-danger error-text acquired_error"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="expiration">Expiration</label> <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Please be noted that the system will deduct quantity from the earliest date. Please manage your materials specially the consumable and medicine accordingly. If you are adding an equipment, please indicate its life expectancy in expiration date.">
                                </i>
                                <input type="date" class="form-control" id="add_stock_expiration" name="expiration" placeholder="Expiration Date" disabled>
                                <span class="text-danger error-text expiration_error"></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <button id="stock_create_equipment_close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="stock_create_equipment_add" type="submit" class="btn btn-primary">Add</button>

                    <button class="btn btn-primary" type="button" id="stock_response_waiting_equipment_create" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
    
            </div>
        </div>
    </div>
</form>