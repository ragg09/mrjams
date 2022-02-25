<form action="{{route('clinic.services.store')}}" method="POST" id="main_form">
    @csrf
    <div class="modal fade" id="create_modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Service Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                        <span class="text-danger error-text price_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Add Description">
                        <span class="text-danger error-text description_error"></span>
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