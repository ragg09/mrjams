<form action="" method="POST" id="edit_specialist_form">
    @csrf
    {{ method_field('PUT') }}
    <div class="modal fade" id="edit_specialists_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Specialists</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" id="edit_specialist_fullname" name="fullname"
                            placeholder="Fullname">
                        <span class="text-danger error-text fullname_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="specialization">Specialization</label>
                        <input type="text" class="form-control" id="edit_specialist_specialization"
                            name="specialization" placeholder="Please Enter Specialization">
                        <span class="text-danger error-text specialization_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="specialization">Rate per service</label>
                        <input type="number" step="10" min="0" max="50" class="form-control"
                            id="edit_compensation_rate" name="compensation_rate"
                            placeholder="Enter percentage per service">
                        <span class="text-danger error-text compensation_rate_error"></span>
                    </div>

                    <div class="row mt-2">
                        <label for=""> Time Availability</label>
                        <div class="col">
                            <div class="form-group">
                                <label for="min_time">Min</label>
                                <input class="form-control" type="time" id="edit_specialist_min_time"
                                    name="min_time">
                                <span class="text-danger error-text min_time_error"></span>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="max_time">Max</label>
                                <input class="form-control" type="time" id="edit_specialist_max_time"
                                    name="max_time">
                                <span class="text-danger error-text max_time_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 mb-2" id="min_max_time_error_edit" hidden>
                        <div class="col-12 w-75 mx-auto rounded" style="background: rgb(207, 0, 0)">
                            <div class=" mx-auto p-1">
                                <p class="text-white text-center">
                                    Max Time Must be Greater Than Min Time.
                                </p>
                            </div>
                        </div>
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
