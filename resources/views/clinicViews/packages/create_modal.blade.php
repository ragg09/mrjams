<form action="{{route('clinic.packages.store')}}" method="POST" id="main_form">
    @csrf
    <div class="modal fade bd-example-modal-lg" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
    
                <div class="modal-body">
                    <div style="float: left; width:50%;" id="modal-body_left">
                        <div class="form-group">
                            <label for="name">Package Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Service Name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
    
                        <div class="form-group">
                            <label for="quantity">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Add Description">
                            <span class="text-danger error-text description_error"></span>
                        </div>
    
                        {{-- <div class="form-group">
                            <label for="price">Package Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Add Price">
                            <span class="text-danger error-text price_error"></span>
                        </div> --}}

                        <div class="form-group">
                            <label for="price">Price</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="min_price" name="min_price" placeholder="Minimum Price">
                                    <span class="text-danger error-text min_price_error"></span>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="max_price" name="max_price" placeholder="Max Price" value="0" hidden>
                                    <span class="text-danger error-text max_price_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div style="float: right; width: 45%;" id="modal-body_right" >
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Please be noted that Service and Materials are two separate entity in a package. Material in a service will not overlap in this package.">
                                </i>
                            </div>
                        </div>
                        <div  id="modal-body_right_service">
                            <div class="form-group">
                                <label for="services">Services</label>
                                    <select class="form-control" id="service_multiple" multiple name="service_multiple" style="width: 100%;">
                                        @foreach ($services as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>     
                                        @endforeach
                                   </select>  
                                   <input type="text" class="form-control" id="service_ids" name="service_ids" hidden>
                            </div>

                            <div class="form-group">
                                <label for="equipments">Materials</label>
                                    <select class="form-control" id="equipment_multiple" multiple name="equipment_multiple" style="width: 100%;">
                                        @foreach ($equipments as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>     
                                        @endforeach
                                   </select>  
                                   <input type="text" class="form-control" id="equipment_ids" name="equipment_ids" hidden>
                            </div>

                        </div>
                        
                    </div>

                    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_btn_create">Close</button>
                    <button type="submit"class="btn btn-primary" id="submit_services">Add</button>
                </div>
    
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {

        $("#service_multiple").select2({ 
            dropdownParent: $('#create_modal'),
            placeholder: "Select Services",
            allowClear: true,
            tags: true,
        });

        $("#service_multiple").change(function() {
            var ids = [];
            $('#service_multiple :selected').each(function(i, sel){ 
                ids.push($(sel).val());
            });
            $("#service_ids").val(ids);
        });

        $("#equipment_multiple").select2({ 
            dropdownParent: $('#create_modal'),
            placeholder: "Select Tools and Equipments",
            allowClear: true,
            tags: true,
        });

        $("#equipment_multiple").change(function() {
            var ids2 = [];
            $('#equipment_multiple :selected').each(function(i, sel){ 
                ids2.push($(sel).val());
            });
            $("#equipment_ids").val(ids2);
        });

    });
</script>

