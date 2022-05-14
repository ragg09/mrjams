
$(function(){

    

    //reload table first
    $("#equipment_table").load(window.location + " #equipment_table");

    // $("#EquipmentDataTable").DataTable({
    //     "order" : [[ 0, 'asc' ], [ 1, 'asc' ]],
    //     "bFilter" : false,
    //     "paging":   false,
    //     "info":     false,
    // });

    $("#EquipSortIcon").removeAttr("hidden");
    $("#EquipSortIcon2").removeAttr("hidden");

    //calling reusable script
    $.getScript("../js/clinic/reusableFunction.js");

    //to prevent date that is less than its expiration
    $("#acquired").on('change', function(e){
        // console.log( $("#acquired").val());
        $("#expiration").attr("min", $("#acquired").val());
        $("#expiration").attr("disabled", false);
        
    })

    $("#add_stock_acquired").on('change', function(e){
        // console.log( $("#add_stock_acquired").val());
        $("#add_stock_expiration").attr("min", $("#add_stock_acquired").val());
        $("#add_stock_expiration").attr("disabled", false);
        
    })


    

    //CREATE , create_modal
    $("#main_form").on('submit', function(e){
        e.preventDefault();
    
        $.ajax({
            type: $(this).attr('method'),
	    	url: $(this).attr('action'),
            headers: {  'Access-Control-Allow-Origin': 'https://mrjams.herokuapp.com/' },
	    	data: $('#main_form').serialize(),
            beforeSend: function(){
                $("#create_equipment_add").attr("hidden", true);
                $("#create_equipment_close").attr("hidden", true);
                $("#response_waiting_equipment_create").removeAttr("hidden");
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                $("#create_equipment_add").removeAttr("hidden");
                $("#create_equipment_close").removeAttr("hidden");
                $("#response_waiting_equipment_create").attr("hidden", true);


                if(data.status == 0){
                    // console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    if(data.dataCount == 1){
                        $("#equipment_table").load(window.location + " #equipment_table");
                        $("#create_modal").modal('toggle');
                        bootstrapAlert(data.message, "success", 250);
                        setInterval( reload_page, 2000);

                        function reload_page(){
                            location.reload()
                        }
                    }else{
                        $.each(data.keys, function(key, val){
                            $('input#'+key).val('');
                        });
                        $("#equipment_table").load(window.location + " #equipment_table");
                        
                        $("#create_modal").modal('toggle');
                        bootstrapAlert(data.message, "success", 250);
                        
                        $("#name").val("");
                        $("#quantity").val("");
                        $("#supplier").val("");
                        $("#acquired").val("");
                        $("#expiration").val("");
                        $("#expiration").attr("disabled", true);
                    }

                   

                    
                }
            }
        });
    });



    


    //add stock view
    $(document).on('click', 'a#add_stock', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        console.log(id);
        $.ajax({
            type: "GET",
            url: "/clinic/equipments/" + id + "_addStock",
            success: function(data){
                console.log(data);


                $("#add_stock_name").val(data.data.name);
                $("#add_stock_unit").val(data.data.unit);
                $("#add_stock_type").val(data.data.type);
                
                
                
                
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
            }
        });
    });

    //ADD STOCK MODAL SUBMIT
    $("#add_stock_main_form").on('submit', function(e){
        e.preventDefault();
    
        $.ajax({
            type: $(this).attr('method'),
	    	url: $(this).attr('action'),
            headers: {  'Access-Control-Allow-Origin': 'https://mrjams.herokuapp.com/' },
	    	data: $('#add_stock_main_form').serialize(),
            beforeSend: function(){
                $("#stock_create_equipment_add").attr("hidden", true);
                $("#stock_create_equipment_close").attr("hidden", true);
                $("#stock_response_waiting_equipment_create").removeAttr("hidden");
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                $("#create_equipment_add").removeAttr("hidden");
                $("#create_equipment_close").removeAttr("hidden");
                $("#stock_response_waiting_equipment_create").attr("hidden", true);
                $("#stock_create_equipment_add").attr("hidden", false);
                $("#stock_create_equipment_close").attr("hidden", false);


                if(data.status == 0){
                    // console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    if(data.dataCount == 1){
                        $("#equipment_table").load(window.location + " #equipment_table");
                        $('#add_stock_material').modal('toggle');
                        bootstrapAlert(data.message, "success", 250);
                        setInterval( reload_page, 2000);

                        function reload_page(){
                            location.reload()
                        }
                    }else{
                        $.each(data.keys, function(key, val){
                            $('input#'+key).val('');
                        });
                        $("#equipment_table").load(window.location + " #equipment_table");
                        
                        $('#add_stock_material').modal('toggle');
                        bootstrapAlert(data.message, "success", 250);
                        
                        $("#add_stock_name").val("");
                        $("#add_stock_quantity").val("");
                        $("#add_stock_supplier").val("");
                        $("#add_stock_acquired").val("");
                        $("#add_stock_expiration").val("");
                        $("#add_stock_expiration").attr("disabled", true);
                    }

                   

                    
                }
            }
        });
    });


    // display of data in view modal, view_modal || equipment show function
    $(document).on('click', 'a#view_modal', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/equipments/" + id + "_inventory",
            beforeSend: function(){
                $("#equipments_inventory").empty();
                $("#material_name").text("");
                $("#response_waiting_equipment_view").removeAttr("hidden");
                
            },
            success: function(data){
                // console.log(data);
                $("#response_waiting_equipment_view").attr("hidden", true);

                $("#material_name").text(data.material.name.toUpperCase());

                $.each(data.data, function(key, val){
                    $('#equipments_inventory').append('<p><span class="fw-bold">Stock:</span> '+ val.quantity +' <br> <span class="fw-bold">Supplier:</span> '+ val.supplier +' <br> <span class="fw-bold">Acquired:</span> '+ moment(val.acquired).format('LL') +' <br><span class="fw-bold">Expiration:</span> '+ moment(val.expiration).format('LL') +'</p>');
                });
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
            }
        });
    });

    // display of data in edit modal, edit_modal
    $(document).on('click', 'a#edit_modal', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/equipments/" + id + "/edit",
            beforeSend: function(){
              
                
                $("#response_waiting_equipment_edit").removeAttr("hidden");

                $("#edit_equipment_body").attr("hidden", true);

                $("#selected_date").empty();
                
                // $("#edit_inventory").attr("hidden", true);
                

                $(document).find('span.error-text').text('');


            },
            success: function(data){
                // console.log(data.inventory.length);

                $("#response_waiting_equipment_edit").attr("hidden", true);

                $("#edit_equipment_body").removeAttr("hidden");

                $("#edit_name").val(data.equipment.name);
                // $("#edit_quantity").val(data.equipment.quantity);
                $("#edit_unit").val(data.equipment.unit);
                $("#edit_type").val(data.equipment.type);
                $("#edit_main_form").attr('action', "/clinic/equipments/"+id); 

                if(data.inventory.length > 1){
                    // console.log(data.inventory);

                    $("#select_inventory_date").attr("hidden", false);
                    // $("#selected_date").append('<option value=""></option>');
                    $.each(data.inventory, function(key, val){
                        if(val.quantity > 0){

                        }
                        $("#selected_date").append('<option value="'+id +'_'+val.expiration+'">'+moment(val.expiration).format('LL')+'</option>');
                    });

                    $("#edit_quantity").val(data.inventory[0].quantity);
                    $("#edit_supplier").val(data.inventory[0].supplier);
                    $("#edit_acquired").val(moment(data.inventory[0].acquired).format('YYYY-MM-DD'));
                    $("#edit_expiration").val(moment(data.inventory[0].expiration).format('YYYY-MM-DD'));
                    $("#raw_expiration_date").val(data.inventory[0].expiration);
                    

                    $("#selected_date").on('change', function(e){
                        //$("#edit_inventory").attr("hidden", true);
                        $("#edit_quantity").val("");
                        $("#edit_supplier").val("");
                        $("#edit_acquired").val("");
                        $("#edit_expiration").val("");
                        $("#raw_expiration_date").val("");

                        if($(this).val() !== ""){
                            //console.log($(this).val());
                            $.ajax({
                                type: "GET",
                                url: "/clinic/equipments/" + $(this).val() + "_getselecteddate",
                                success: function(data){
                                    // console.log(data);
                                    $("#edit_inventory").attr("hidden", false);
                                    
                                    $("#edit_quantity").val(data.data.quantity);
                                    $("#edit_supplier").val(data.data.supplier);
                                    $("#edit_acquired").val(moment(data.data.acquired).format('YYYY-MM-DD'));
                                    $("#edit_expiration").val(moment(data.data.expiration).format('YYYY-MM-DD'));
                                    $("#raw_expiration_date").val(data.data.expiration);
                                    
                                },
                                error: function(e){
                                    console.log('AJAX load did not work');
                                    console.log(e);
                                    // alert(error);
                                }
                            });
                        }
                    })
                }else{
                    $("#select_inventory_date").attr("hidden", true);
                    $("#edit_inventory").attr("hidden", false);
                    
                    $("#edit_quantity").val(data.inventory[0].quantity);
                    $("#edit_supplier").val(data.inventory[0].supplier);
                    $("#edit_acquired").val(moment(data.inventory[0].acquired).format('YYYY-MM-DD'));
                    $("#edit_expiration").val(moment(data.inventory[0].expiration).format('YYYY-MM-DD'));
                    $("#raw_expiration_date").val(data.inventory[0].expiration);
                }
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert(error);
            }
        });
    });

    //EDIT, edit_modal
    $("#edit_main_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#edit_main_form').serialize(),
            beforeSend: function(){
                $("#edit_equipment_add").attr("hidden", true);
                $("#edit_equipment_close").attr("hidden", true);
                $("#response_waiting_equipment_edit_btn").removeAttr("hidden");
                

                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                $("#edit_equipment_add").removeAttr("hidden");
                $("#edit_equipment_close").removeAttr("hidden");
                $("#response_waiting_equipment_edit_btn").attr("hidden", true);

                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    // console.log(data);
                    $("#equipment_table").load(window.location + " #equipment_table");
                    $("#edit_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                }
            }
        });
    });



    //EDIT,ADD QUANTITY
    $("#add_quantity_main_form").on('submit', function(e){
        e.preventDefault();
        var $option = $('#data_select').find('option:selected');
        var id = $option.val();
        $.ajax({
            type: $(this).attr('method'),
            url: 'equipments/'+id,
            data: $('#add_quantity_main_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#equipment_table").load(window.location + " #equipment_table");
                    $("#add_quantity_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                    // console.log(data.message);
                }
            }
        });
    });

    //DELETE
    // display of data in delete modal, delete_modal
    $(document).on('click', 'a#delete_modal', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/equipments/" + id + "/edit",
            success: function(data){
                // console.log(data);
                $("#delete_name").empty();
                $("#delete_packages").empty();

                var packages = "";
                $.each(data.packages, function(key, val){
                    var count = 0;
                    packages += val[count].name.toUpperCase()+ ", ";
                    count++;
                });

                $("#delete_name").append(data.equipment.name.toUpperCase() + '<input type="text" value="'+id+'" id="todelete" hidden>');

                if(packages !== "" || data.services_summary !== ""){
                    $("#delete_packages").append(packages + data.services_summary.substring(1).toUpperCase());
                }else{
                    $("#delete_packages").append("No Package Involvement Yet");
                } 

                
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
            }
        });
    });

    //DELETE, delete_modal
    $(document).on('click', '#delete_equipment_delete', function(e) {
        e.preventDefault();
        var id = $("input#todelete").val();
        $.ajax({
            type: "DELETE",
            url: "/clinic/equipments/"+ id,
            data:{
                _token: $("input[name=_token]").val()
            },
            beforeSend: function(){
                $("#delete_equipment_close").attr("hidden", true);
                $("#delete_equipment_delete").attr("hidden", true);
                $("#response_waiting_equipment_delete_btn").removeAttr("hidden");
                
            },
            success: function(data) {
            
                if(data.dataCount == 0){
                    $("#equipment_table").load(window.location + " #equipment_table");
                    $("#delete_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "danger", 200);
                    setInterval( reload_page, 2000);

                    function reload_page(){
                        location.reload()
                    }
                }else{
                    $("#equipment_table").load(window.location + " #equipment_table");
                    $("#delete_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "danger", 200);
                }

                $("#delete_equipment_close").removeAttr("hidden");
                $("#delete_equipment_delete").removeAttr("hidden");
                $("#response_waiting_equipment_delete_btn").attr("hidden", true);
            },
            error: function(error) {
              console.log('error');
            }
        });
    });

    $('#search').on('keyup', function(){
        var query = $(this).val();
        if(query.length > 1){
            //console.log(query);
            $.ajax({
                type: $('#search_form').attr('method'),
                url: $('#search_form').attr('action'),
                data: {query:query},
                beforeSend: function() {
                    $('#equipment_table_body').empty();
                    $("#equipment_table_body").append('<div class="row"><div class="col-12 d-flex justify-content-center"><div class="spinner-border"style="width: 3rem; height: 3rem;" role="status" id="response_waiting_accept"><span class="sr-only">Loading..</span></div></div></div>');

                    
                },
                success: function(data){
                    //console.log(data.data.length);
                    if(data.data_name.length == 0 && data.data_type.length == 0){
                        $('#equipment_table_head').hide();
                        $('#equipment_table_body').empty();
                        $("#equipment_table_body").append('<tr><td></p><div style="display: flex; justify-content: center; align-item: center; margin-top: 30px;"><img data-loading-text="LOADING...<span></span>" src="/images/mrjams/noData2.jpg" alt="no data available"></div><div style="display: flex; justify-content: center; align-item: center;  margin-top: 30px;"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_modal">Create New Data</button></div></td></tr>');
                    }
                    else{
                        $('#equipment_table_head').show();
                        $('#equipment_table_body').empty();
                        $('#pagination_div').css('height', '0px');
                        $.each(data.data_name, function(key, val){
                            $("#equipment_table_body").append('<tr><td>'+val.name+'</td><td>'+val.quantity+' '+val.unit+'</td><td>'+val.type+'</td><td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_modal_up" id="edit_modal" data-id="'+val.id+'" title="Edit '+val.name+'"><i class="fa fa-pencil" aria-hidden="true" ></i></a><a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" title="Delete '+val.name+'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
                        });
                        $.each(data.data_type, function(key, val){
                            $("#equipment_table_body").append('<tr><td>'+val.name+'</td><td>'+val.quantity+' '+val.unit+'</td><td>'+val.type+'</td><td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_modal_up" id="edit_modal" data-id="'+val.id+'" title="Edit '+val.name+'"><i class="fa fa-pencil" aria-hidden="true" ></i></a><a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" title="Delete '+val.name+'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
                        });
                    }  
                },
                error: function(e){
                    console.log('AJAX load did not work');
                    console.log(e);
                    // alert("error");
                }
            });
            
        }else{
            $("#equipment_table").load(window.location + " #equipment_table");
            $('#pagination_div').css('height', '54px');
        }
        
    });

    
});