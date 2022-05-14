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
                    // console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    if(data.dataCount == 1){
                        $("#package_body").load(window.location + " #package_body");
                        $("#create_modal").modal('toggle');
                        bootstrapAlert(data.message, "success", 250);
                        $('#service_multiple').val(null).trigger('change');
                        $('#equipment_multiple').val(null).trigger('change');

                        setInterval( reload_page, 2000);
                        function reload_page(){
                            location.reload()
                        }
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
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
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
            beforeSend: function(){
                $(document).find('span.error-text').text('');
                
                $("#response_waiting_details").removeAttr("hidden")

            },
            success: function(data){
                
                $("#response_waiting_details").attr("hidden",true)


                
                $.each(data.package, function(key, val){
                    $("#edit_name").val(val.name);
                    $("#edit_description").val(val.description);
                    $("#edit_min_price").val(val.min_price);
                    $("#edit_max_price").val(val.max_price);
                    $("#edit_package_details_form").attr('action', "/clinic/packages/"+id);
               });
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
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
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
            }
        });
    });

    // *************************************** Package END *************************************** //

    // *************************************** Equiipment START *************************************** //
    $("#select_equipments").select2({ 
        dropdownParent: $('#edit_package_equipment_up'),
        placeholder: "Select Equipments",
        allowClear: true,
        // tags: true,
        noResults: function() {
            return '<button id="no-results-btn" onclick="noResultsButtonClicked()">No Result Found</a>';
          },
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
            beforeSend: function(){
                $(document).find('span.error-text').text('');
                
                $("#response_waiting_equipments").removeAttr("hidden")
                $("#selected_equipments").attr("hidden",true)
            },
            success: function(data){
                console.log(data.ids );
                console.log(data.equipments);

               
                const arrOfStr_ids_equip = [];

                $.each(data.ids, function(key, val){
                    arrOfStr_ids_equip.push(String(val));
                });


                $("#selected_equipments").removeAttr("hidden")
                $("#response_waiting_equipments").attr("hidden",true)

                $("#select_equipments").empty();

                $("#edit_package_equipments_form").attr('action', "/clinic/packages/"+package_id);
                $("#equipments_original_ids").attr('value', equipments_ids_array); 

                $.each(data.equipments, function(key, val){
                    if(arrOfStr_ids_equip.includes(String(val.id))){
                        $("#select_equipments").append('<option selected value="'+val.id+'">'+val.name+'</option> '); 
                    }else{
                        $("#select_equipments").append('<option value="'+val.id+'">'+val.name+'</option> '); 
                    }

                    
               });
                
                // console.log(data);
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
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
                $("#close_btn_equipments").attr("hidden", true);
                $("#update_btn_equipments").attr("hidden", true);
                $("#response_waiting_equipments_update").removeAttr("hidden");
                
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                $("#close_btn_equipments").removeAttr("hidden");
                $("#update_btn_equipments").removeAttr("hidden");
                $("#response_waiting_equipments_update").attr("hidden", true);

                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#edit_show_body").load(window.location + " #edit_show_body");
                    $("#edit_package_equipment_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                    // console.log(data.message);
                    $('#select_equipments').val(null).trigger('change');
                }
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
            }
        });
    });
    // *************************************** Equiipment END *************************************** //

    // *************************************** Service START *************************************** //
    $("#select_services").select2({ 
        dropdownParent: $('#edit_package_service_up'),
        placeholder: "Select services",
        allowClear: true,
        // tags: true,
        noResults: function() {
            return '<button id="no-results-btn" onclick="noResultsButtonClicked()">No Result Found</a>';
          },
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
            beforeSend: function(){
                $(document).find('span.error-text').text('');
                
                $("#response_waiting_services").removeAttr("hidden")
                $("#selected_services").attr("hidden",true)
            },
            success: function(data){
                $("#selected_services").removeAttr("hidden")
                $("#response_waiting_services").attr("hidden",true)


                $("#select_services").empty();

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
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
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
                $("#close_btn_services").attr("hidden", true);
                $("#update_btn_services").attr("hidden", true);
                $("#response_waiting_services_update").removeAttr("hidden");
                
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                $("#close_btn_services").removeAttr("hidden");
                $("#update_btn_services").removeAttr("hidden");
                $("#response_waiting_services_update").attr("hidden", true);
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#edit_show_body").load(window.location + " #edit_show_body");
                    $("#edit_package_service_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                    // console.log(data.message);
                    $('#select_services').val(null).trigger('change');
                }
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
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
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
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
                if(data.dataCount == 0){
                    $("#package_body").load(window.location + " #package_body");
                    $("#delete_modal").modal('toggle');
                    bootstrapAlert(data.message, "danger", 200);

                    setInterval( reload_page, 2000);
                    function reload_page(){
                        location.reload()
                    }
                }else{
                    $("#package_body").load(window.location + " #package_body");
                    $("#delete_modal").modal('toggle');
                    bootstrapAlert(data.message, "danger", 200);
                }
            },
            error: function(error) {
              console.log(error);
            }
          });
    });
    
});