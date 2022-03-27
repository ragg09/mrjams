<form action="" method="POST" id="edit_specialist_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="edit_specialists_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Specialists</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" id="edit_specialist_fullname" name="fullname" placeholder="Fullname">
                        <span class="text-danger error-text fullname_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="specialization">Specialization</label>
                        <input type="text" class="form-control" id="edit_specialist_specialization" name="specialization" placeholder="Please Enter Specialization">
                        <span class="text-danger error-text specialization_error"></span>
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