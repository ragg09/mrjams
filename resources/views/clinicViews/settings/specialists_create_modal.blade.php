<form action="/clinic/settings/{{ $general->id }}_AddSpecialists" method="POST" id="add_specialist_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="create_specialists_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Specialists</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
                        <span class="text-danger error-text fullname_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="specialization">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Please Enter Specialization">
                        <span class="text-danger error-text specialization_error"></span>
                    </div>

                    <div class="row mt-2">
                        <label for=""> Time Availability</label>
                        <div class="col">
                            <div class="form-group">
                                <label for="min_time">Min</label>
                                <input class="form-control" type="time" id="min_time" name="min_time">
                                <span class="text-danger error-text min_time_error"></span>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="max_time">Max</label>
                                <input class="form-control" type="time" id="max_time" name="max_time">
                                <span class="text-danger error-text max_time_error"></span>
                            </div>
                        </div>
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