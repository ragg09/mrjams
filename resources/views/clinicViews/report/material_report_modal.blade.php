<form action="/clinic/report/{{ $clinic->id }}" method="GET" target="_blank">
    <div class="modal fade" id="material_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Generate Material Reports</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    
                    <h6>Select Range of Dates to Generate</h6>
    
                    <div class="form-group d-flex justify-content-center mt-2" id="flatpickr">
                        <input type="text" class="" id="material_modal_flatpicker" name="datetime" hidden>
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <button id="generate_report" type="submit" class="btn btn-primary" disabled>Print <i class="fa fa-print" aria-hidden="true"></i></button>
    
                    <button class="btn btn-primary" type="button" id="response_waiting_equipment_create" disabled hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . . 
                    </button>
                </div>
    
            </div>
        </div>
    </div>

</form>