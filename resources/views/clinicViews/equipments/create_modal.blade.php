<form action="{{route('clinic.equipments.store')}}" method="POST" id="main_form">
    @csrf
    <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Equipment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tools or Equipment</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Equipment">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="please enter equipment's quantity">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"class="btn btn-primary">Add</button>
                </div>
    
            </div>
        </div>
    </div>
</form>