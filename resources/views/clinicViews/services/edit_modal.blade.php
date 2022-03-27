<form action="" method="POST" id="edit_main_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="edit_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="Service Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    {{-- <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="edit_price" name="price" placeholder="price">
                        <span class="text-danger error-text price_error"></span>
                    </div> --}}

                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="edit_min_price" name="min_price" placeholder="Minimum Price">
                                <span class="text-danger error-text min_price_error"></span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="edit_max_price" name="max_price" placeholder="Max Price">
                                <span class="text-danger error-text max_price_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="description" placeholder="please enter a description">
                        <span class="text-danger error-text description_error"></span>
                    </div>

                    <div class="form-group" id="select_equipments_multiple">
                        <label for="equipments">Consumbale or Equipments</label>
                            <select class="form-control" id="select_equipments" multiple name="select_equipments" style="width: 100%;">
                                {{-- options came appended from js --}}
                           </select>
                           
                           <input type="text" class="form-control" id="equipment_ids_edit" name="equipment_ids_edit" hidden>
                           <input type="text" class="form-control" id="equipments_original_ids" name="equipments_original_ids" hidden>
                           
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"class="btn btn-primary">Update</button>
                </div>
    
            </div>
        </div>
    </div>
</form>