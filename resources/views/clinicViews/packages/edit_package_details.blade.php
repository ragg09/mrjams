<form action="" method="POST" id="edit_package_details_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="edit_package_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="Package Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="description" placeholder="please enter a description">
                        <span class="text-danger error-text description_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="edit_price" name="price" placeholder="please enter a price">
                        <span class="text-danger error-text price_error"></span>
                    </div>
                    
                    <input type="text" class="form-control" name="package_update_filter" value="package_details">
                    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"class="btn btn-primary">Update</button>
                </div>
    
            </div>
        </div>
    </div>
</form>