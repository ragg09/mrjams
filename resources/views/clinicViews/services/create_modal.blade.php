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
                        <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Please insert your expected price range for this service."></i>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="min_price" name="min_price" placeholder="Minimum Price">
                                <span class="text-danger error-text min_price_error"></span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="max_price" name="max_price" placeholder="Max Price">
                                <span class="text-danger error-text max_price_error"></span>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="price">Max Price</label>
                        <input type="text" class="form-control" id="max_price" name="max_price" placeholder="Price">
                        <span class="text-danger error-text max_price_error"></span>
                    </div> --}}

                    <div class="form-group">
                        <label for="quantity">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Add Description">
                        <span class="text-danger error-text description_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="equipments">Consumable / Medicine</label>
                            <select class="form-control" id="equipment_multiple" multiple name="equipment_multiple" style="width: 100%;">
                                @foreach ($equipments as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>     
                                @endforeach
                           </select>  
                           <input type="text" class="form-control" id="equipment_ids" name="equipment_ids" hidden>
                           <span class="text-danger error-text equipment_ids_error"></span>
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

