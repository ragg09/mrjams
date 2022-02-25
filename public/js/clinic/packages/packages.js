$(function(){

    //calling reusable script
    $.getScript("/js/clinic/reusableFunction.js");

    //CREATE , create_modal
    $("#main_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
	    	url: $(this).attr('action'),
	    	data: $('#main_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 0){
                    console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $.each(data.keys, function(key, val){
                        $('input#'+key).val('');
                    });
                    $("#package_body").load(window.location + " #package_body");
                    $("#create_modal").modal('toggle');
                    bootstrapAlert(data.message, "success", 250);
                    $('#service_multiple').val(null).trigger('change');
                    $('#equipment_multiple').val(null).trigger('change');
                }
            }
        });
    });

    $(document).on('click', '#close_btn_create', function(e) {
        e.preventDefault();
        $('#service_multiple').val(null).trigger('change');
        $('#equipment_multiple').val(null).trigger('change');
        
    });


    // *************************************** Package START *************************************** //
    // // display of data in edit_package_details modal
    $(document).on('click', 'a#edit_package_get_details', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            type: "GET",
            url: "/clinic/packages/" + id + "/edit",
            success: function(data){
                $.each(data.package, function(key, val){
                    $("#edit_name").val(val.name);
                    $("#edit_description").val(val.description);
                    $("#edit_price").val(val.price);
                    $("#edit_package_details_form").attr('action', "/clinic/packages/"+id);
               });
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    // //EDIT, edit_package_detail
    $("#edit_package_details_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#edit_package_details_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#edit_show_body").load(window.location + " #edit_show_body");
                    $("#edit_package_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                }
            }
        });
    });

    // *************************************** Package END *************************************** //

    // *************************************** Equiipment START *************************************** //
    $("#select_equipments").select2({ 
        dropdownParent: $('#edit_package_equipment_up'),
        placeholder: "Select Equipments",
        allowClear: true,
        tags: true,
    });

    $("#select_equipments").change(function() {
        var ids = [];
        $('#select_equipments :selected').each(function(i, sel){ 
            ids.push($(sel).val());
        });
        $("#equipment_ids").val(ids);

        if($("#equipment_ids").val() === ""){
            $('#update_btn_equipments').prop('disabled', true);
        }else{
            $('#update_btn_equipments').prop('disabled', false);
        }
    });

    $(document).on('click', '#close_btn_equipments', function(e) {
        e.preventDefault();
        $('#select_equipments').val(null).trigger('change');
        
    });

    

    // // display of data in edit_package_details modal
    $(document).on('click', 'a#edit_package_get_equipments', function(e) {
        e.preventDefault();
        var ids = $(this).data('id');
        var equipments_ids_array = ids.split(",");
        var package_id = equipments_ids_array.pop(); 
        
        $.ajax({
            type: "GET",
            url: "/clinic/equipments/" + equipments_ids_array,
            success: function(data){
                $("#edit_package_equipments_form").attr('action', "/clinic/packages/"+package_id);
                $("#equipments_original_ids").attr('value', equipments_ids_array); 

                $.each(data.equipments, function(key, val){
                    if(data.ids.includes(val.id)){
                        $("#select_equipments").append('<option selected value="'+val.id+'">'+val.name+'</option> '); 
                    }else{
                        $("#select_equipments").append('<option value="'+val.id+'">'+val.name+'</option> '); 
                    }
               });
                
                // console.log(data);
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    //EDIT, edit_package_detail
    $("#edit_package_equipments_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#edit_package_equipments_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#edit_show_body").load(window.location + " #edit_show_body");
                    $("#edit_package_equipment_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                    console.log(data.message);
                    $('#select_equipments').val(null).trigger('change');
                }
            }
        });
    });
    // *************************************** Equiipment END *************************************** //

    // *************************************** Service START *************************************** //
    $("#select_services").select2({ 
        dropdownParent: $('#edit_package_service_up'),
        placeholder: "Select services",
        allowClear: true,
        tags: true,
    });

    $("#select_services").change(function() {
        var ids = [];
        $('#select_services :selected').each(function(i, sel){ 
            ids.push($(sel).val());
        });
        $("#service_ids").val(ids);

        if($("#service_ids").val() === ""){
            $('#update_btn_services').prop('disabled', true);
        }else{
            $('#update_btn_services').prop('disabled', false);
        }
    });

    $(document).on('click', '#close_btn_services', function(e) {
        e.preventDefault();
        $('#select_services').val(null).trigger('change');
        
    });

    // // display of data in edit_package_details modal
    $(document).on('click', 'a#edit_package_get_services', function(e) {
        e.preventDefault();
        var ids = $(this).data('id');
        var services_ids_array = ids.split(",");
        var package_id = services_ids_array.pop(); 
        
        $.ajax({
            type: "GET",
            url: "/clinic/services/" + services_ids_array,
            success: function(data){
                $("#edit_package_services_form").attr('action', "/clinic/packages/"+package_id);
                $("#services_original_ids").attr('value', services_ids_array); 

                $.each(data.services, function(key, val){
                    if(data.ids.includes(val.id)){
                        $("#select_services").append('<option selected value="'+val.id+'">'+val.name+'</option> '); 
                    }else{
                        $("#select_services").append('<option value="'+val.id+'">'+val.name+'</option> '); 
                    }
               });
                
                // console.log(data);
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    //EDIT, edit_package_detail
    $("#edit_package_services_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#edit_package_services_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#edit_show_body").load(window.location + " #edit_show_body");
                    $("#edit_package_service_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                    console.log(data.message);
                    $('#select_services').val(null).trigger('change');
                }
            }
        });
    });
    // *************************************** Service END *************************************** //

    //DELETE
    // display of data in delete modal, delete_modal
    $(document).on('click', 'a#delete_modal_up', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/packages/" + id + "/edit",
            success: function(data){
                $("#delete_name").empty();
                $("#delete_name").append(data.package[0].name + '<input type="text" value="'+id+'" id="todelete" hidden>'); 
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    //DELETE, delete_modal
    $(document).on('click', '#confirm_delete', function(e) {
        e.preventDefault();
        var id = $("input#todelete").val();
        $.ajax({
            type: "DELETE",
            url: "/clinic/packages/"+ id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(data) {
                //console.log(data);
                $("#package_body").load(window.location + " #package_body");
                $("#delete_modal").modal('toggle');
                bootstrapAlert(data.message, "danger", 200);
            },
            error: function(error) {
              console.log('error');
            }
          });
    });

    // $('#search').on('keyup', function(){
    //     var query = $(this).val();
    //     if(query.length > 1){
    //         $.ajax({
    //             type: $('#search_form').attr('method'),
    //             url: $('#search_form').attr('action'),
    //             data: {query:query},
    //             success: function(data){
    //                 $('#service_table_body').empty();
    //                 $('#pagination_div').css('height', '0px');
    //                 $.each(data.data, function(key, val){
    //                     $("#service_table_body").append(
    //                         '<tr>'
    //                             +'<th scope="row">'+val.id+'</th>'
    //                             +'<td>'+val.name+'</td><td>'+val.description+'</td>'
    //                             +'<td>'
    //                                 +'<a href="" class="btn btn-outline-warning launch-modal" data-toggle="modal" data-target="#edit_modal_up" id="edit_modal" data-id="'+val.id+'" title="Edit '+val.name+'"><i class="fa fa-pencil" aria-hidden="true" ></i></a>'
    //                                 +'<a href="" class="btn btn-outline-danger launch-modal" data-toggle="modal" data-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" title="Delete '+val.name+'"><i class="fa fa-trash" aria-hidden="true"></i></a>'
    //                             +'</td>'
    //                         +'</tr>'
    //                         );
    //                 });
    //             },
    //             error: function(){
    //                 console.log('AJAX load did not work');
    //                 alert("error");
    //             }
    //         });
            
    //     }else{
    //         $("#service_table").load(window.location + " #service_table");
    //         $('#pagination_div').css('height', '54px');
    //     }
        
    // });

    
});