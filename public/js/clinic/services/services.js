$(function(){
    //reload table first
    $("#service_table").load(window.location + " #service_table");

    //calling reusable script
    $.getScript("../js/clinic/reusableFunction.js");

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
                    $("#service_table").load(window.location + " #service_table");
                    $("#create_modal").modal('toggle');
                    bootstrapAlert(data.message, "success", 250);
                }
            }
        });
    });

    // display of data in edit modal, edit_modal
    $(document).on('click', 'a#edit_modal', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/services/" + id + "/edit",
            success: function(data){
                // $.each(data.services, function(key, val){
                //     $("#edit_name").val(data.services.name);
                //     $("#edit_price").val(data.services.price);
                //     $("#edit_description").val(data.services.description);
                //     $("#edit_main_form").attr('action', "/clinic/services/"+id);
                // }); 
                $("#edit_name").val(data.services.name);
                $("#edit_price").val(data.services.price);
                $("#edit_description").val(data.services.description);
                $("#edit_main_form").attr('action', "/clinic/services/"+id);
                console.log(data);
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
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
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#service_table").load(window.location + " #service_table");
                    $("#edit_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
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
            url: "/clinic/services/" + id + "/edit",
            success: function(data){
                $("#delete_name").empty();
                $("#delete_packages").empty();

                var packages = "";
                $.each(data.packages, function(key, val){
                    var count = 0;
                    packages += val[count].name.toUpperCase()+ ", ";
                    count++;
                });

                $("#delete_name").append(data.services.name.toUpperCase() + '<input type="text" value="'+id+'" id="todelete" hidden>');

                if(packages !== ""){
                    $("#delete_packages").append(packages);
                }else{
                    $("#delete_packages").append("No Package Involvement Yet");
                }
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
            url: "/clinic/services/"+ id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(data) {
                $("#service_table").load(window.location + " #service_table");
                $("#delete_modal_up").modal('toggle');
                bootstrapAlert(data.message, "danger", 200);
            },
            error: function(error) {
              console.log('error');
            }
          });
    });

    $('#search').on('keyup', function(){
        var query = $(this).val();
        if(query.length > 1){
            $.ajax({
                type: $('#search_form').attr('method'),
                url: $('#search_form').attr('action'),
                data: {query:query},
                success: function(data){
                    if(data.data.length == 0){
                        $('#services_table_head').hide();
                        $('#service_table_body').empty();
                        $("#service_table_body").append('<tr><td><div style="display: flex; justify-content: center; align-item: center; margin-top: 30px;"><h4>No data found!</h4></div><div style="display: flex; justify-content: center; align-item: center;  margin-top: 30px;"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_modal">Create New Data</button></div></td></tr>');
                    }else{
                        $('#services_table_head').show();
                        $('#service_table_body').empty();
                        $('#pagination_div').css('height', '0px');
                        $.each(data.data, function(key, val){
                            $("#service_table_body").append('<tr><th scope="row">'+val.id+'</th><td>'+val.name+'</td><td>'+val.description+'</td><td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_modal_up" id="edit_modal" data-id="'+val.id+'" title="Edit '+val.name+'"><i class="fa fa-pencil" aria-hidden="true" ></i></a><a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" title="Delete '+val.name+'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
                        });
                    }
                    
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
            
        }else{
            $("#service_table").load(window.location + " #service_table");
            $('#pagination_div').css('height', '54px');
        }
        
    });

    
});