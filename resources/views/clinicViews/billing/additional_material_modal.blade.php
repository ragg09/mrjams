
    <div class="modal fade" id="additionals_material_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
        
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Additional Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
        
                <div class="modal-body">
                    <div class="form-group">
                        <label for="material">Materials</label>
                            <select class="form-control" id="material_multiple" multiple name="material_multiple" style="width: 100%;">
                                @foreach ($clinic_materials as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>     
                                @endforeach
                           </select>  
                           <input type="text" class="form-control" id="material_ids" name="material_ids" >
                    </div>
    
                </div>
        
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="additional_material_form_btn">Add Material</button>
                </div>
        
            </div>
        </div>
    </div>