<form action="" method="POST" id="edit_package_services_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="edit_package_service_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
    
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="services">Services</label>
                            <select class="form-control" id="select_services" multiple name="select_services" style="width: 100%;">
                                {{-- options came appended from js --}}
                           </select>  
                           <input type="text" class="form-control" id="service_ids" name="service_ids" >
                    </div>

                    <input type="text" class="form-control" name="package_update_filter" value="package_services" >

                    <input type="text" class="form-control" id="services_original_ids" name="services_original_ids" value="orig: " >

                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_btn_services" data-bs-dismiss="modal">Close</button>
                    <button type="submit"class="btn btn-primary" id="update_btn_services">Update</button>
                </div>
    
            </div>
        </div>
    </div>
</form>
