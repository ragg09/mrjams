
    <div class="modal fade" id="additionals_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
        
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Additional Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
        
                <div class="modal-body">
                    <div class="form-group">
                        <label for="services">Services</label>
                            <select class="form-control" id="service_multiple" multiple name="service_multiple" style="width: 100%;">
                                @foreach ($clinic_services as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>     
                                @endforeach
                           </select>  
                           <input type="text" class="form-control" id="service_ids" name="service_ids" hidden>
                    </div>
    
                </div>
        
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="additionals_form_btn">Add service</button>
                </div>
        
            </div>
        </div>
    </div>