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
                            <label for="unit">Unit</label>
                            <select class="form-select" name="unit" id="edit_unit">
                                <option value="pcs">pcs</option>
                                <option value="bottle">bottle</option>
                                <option value="box">box</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-select" name="type" id="edit_type">
                                <option value="consumable">consumable</option>
                                <option value="equipment">equipment</option>
                                <option value="medicine">medicine</option>
                            </select>
                            <span class="text-danger error-text type_error"></span>
                        </div>

                        <div id="select_inventory_date">
                            <div class="row mt-4" id="accept_specialist_with_warning">
                                <div class="col-12 w-75 mx-auto rounded" style="background: rgb(245, 121, 6)">
                                    <div class="mx-auto">
                                        <p class="text-white mt-1 ">
                                            <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
                                            You have stored more than one expiration dates on this material, please select date to edit.
                                        </p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <label for="unit">Select Date</label>
                                <select class="form-select" name="selected_date" id="selected_date">
                                    <option value=""></option>
                                    {{-- <option value="date">date</option>
                                    <option value="date">date</option>
                                    <option value="date">date</option> --}}
                                </select>
                                <span class="text-danger error-text selected_date_error"></span>
                            </div>
                        </div>

                        <div id="edit_inventory">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control" id="edit_quantity" name="quantity" placeholder="please enter quantity">
                                <span class="text-danger error-text quantity_error"></span>
                            </div>
        
                            <div class="form-group">
                                <label for="supplier">Supplier</label>
                                <input type="text" class="form-control" id="edit_supplier" name="supplier" placeholder="please enter supplier">
                                <span class="text-danger error-text supplier_error"></span>
                            </div>
    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="acquired">Acquired</label>
                                        <input type="date" class="form-control" id="edit_acquired" name="acquired" placeholder="Date Aquired">
                                        <span class="text-danger error-text acquired_error"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="expiration">Expiration</label> <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Please be noted that the system will deduct quantity from the earliest date. Please manage your materials specially the consumable and medicine accordingly.">
                                        </i>
                                        <input type="date" class="form-control" id="edit_expiration" name="expiration" placeholder="Expiration Date">
                                        <span class="text-danger error-text expiration_error"></span>
                                    </div>
                                </div>
                            </div>

                            <input type="text" id="raw_expiration_date" name="raw_expiration_date">
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