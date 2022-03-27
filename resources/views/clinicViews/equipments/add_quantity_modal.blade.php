<form method="POST" id="add_quantity_main_form">
    @csrf
    {{method_field('PUT')}}
    <div class="modal fade" id="add_quantity_modal_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Material's Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Consumables or Equipments</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="Equipment" value="ACCEPTED" hidden>
                            <select class="form-select" id="data_select">
                                @foreach ($data_all as $row)
                                    <option value="{{$row->id}}">{{$row->name}} | {{$row->unit}}</option>     
                                @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="edit_quantity" name="quantity" placeholder="please enter quantity to add">
                        <span class="text-danger error-text quantity_error"></span>
                    </div>

                    <input type="text" class="form-control" id="edit_add_equipment" name="add_equipment" value="true" hidden>
                    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"class="btn btn-primary">Add Quantity</button>
                </div>
    
            </div>
        </div>
    </div>
</form>