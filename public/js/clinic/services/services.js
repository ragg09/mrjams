$(function(){
    //reload table first
    $("#service_table").load(window.location + " #service_table");

    //calling reusable script
    $.getScript("../../js/clinic/reusableFunction.js");

    //CREATE , create_modal
    $("#equipment_multiple").select2({ 
        dropdownParent: $('#create_modal'),
        placeholder: "Select equipments",
        allowClear: true,
        tags: true,
    });

    $("#equipment_multiple").on('change', function() {
        var ids = [];
        $('#equipment_multiple :selected').each(function(i, sel){ 
            ids.push($(sel).val());
        });
        $("#equipment_ids").val(ids);
    });

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
                console.log(data);
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else if(data.status == 3){
                    $('span.name_error').text('You already have this service');
                }
                else{
                    if(data.dataCount == 1){
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
                        $("#service_table").load(window.location + " #service_table");
                        $("#create_modal").modal('toggle');
                        bootstrapAlert(data.message, "success", 250);
                    }
                }
            }
        });
    });

    // display of data in stats modal, stats_modal
    // $(document).on('click', 'a#stats_modal', function(e) {
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     $.ajax({
    //         type: "GET",
    //         url: "/clinic/services/" + id + "_stats/edit",
    //         success: function(data){
    //             console.log(data);

    //              // Load the Visualization API and the corechart package.
    //             google.charts.load('current', {'packages':['corechart']});

    //             // Set a callback to run when the Google Visualization API is loaded.
    //             google.charts.setOnLoadCallback(drawChart);

    //             // Callback that creates and populates a data table,
    //             // instantiates the pie chart, passes in the data and
    //             // draws it.
    //             function drawChart() {

    //                 // Create the data table.
    //                 var data = new google.visualization.DataTable();
    //                 data.addColumn('string', 'Topping');
    //                 data.addColumn('number', 'Slices');
    //                 data.addRows([
    //                 ['Mushrooms', 3],
    //                 ['Onions', 1],
    //                 ['Olives', 1],
    //                 ['Zucchini', 1],
    //                 ['Pepperoni', 2]
    //                 ]);

    //                 // Set chart options
    //                 var options = {'title':'How Much Pizza I Ate Last Night',
    //                             'width':400,
    //                             'height':300};

    //                 // Instantiate and draw our chart, passing in some options.
    //                 var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    //                 chart.draw(data, options);
    //             }
        
    //         },
    //         error: function(){
    //             console.log('AJAX load did not work');
    //             alert("error");
    //         }
    //     });
    // });

    // display of data in edit modal, edit_modal
    $(document).on('click', 'a#edit_modal', function(e) {
        $('#equipment_ids_edit').val(null).trigger('change');
        $("#select_equipments").empty();
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({ 
            type: "GET",
            url: "/clinic/services/" + id + "/edit",
            success: function(data){
                console.log(data);
                $("#edit_name").val(data.services.name);
                $("#edit_min_price").val(data.services.min_price);
                $("#edit_max_price").val(data.services.max_price);
                $("#edit_description").val(data.services.description);
                $("#edit_main_form").attr('action', "/clinic/services/"+id);
                
                
                $.each(data.allequipments, function(key, val){
                    if(data.myequipments_orig_ids.includes(val.id)){
                        $("#select_equipments").append('<option selected value="'+val.id+'">'+val.name+'</option> '); 
                    }else{
                        $("#select_equipments").append('<option value="'+val.id+'">'+val.name+'</option> '); 
                    }
               });

               $("#equipments_original_ids").attr('value', data.myequipments_orig_ids);
                
            },
            error: function(e){
                console.log(e);
                // alert("error");
            }
        });
    });

    $("#select_equipments").select2({ 
        dropdownParent: $('#select_equipments_multiple'),
        placeholder: "Select equipments",
        allowClear: true,
        tags: true,
    });

    $("#select_equipments").on('change', function() {
        var ids = [];
        $('#select_equipments :selected').each(function(i, sel){ 
            ids.push($(sel).val());
        });
        $("#equipment_ids_edit").val(ids);
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
                //console.log(data);
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    $("#service_table").load(window.location + " #service_table");
                    $("#edit_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "info", 200);
                    $('#equipment_ids_edit').val(null).trigger('change');
                }
            },
            error: function(e){
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
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
            url: "/clinic/services/"+ id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(data) {
                

                if(data.dataCount == 0){
                    $("#service_table").load(window.location + " #service_table");
                    $("#delete_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "danger", 200);
                    setInterval( reload_page, 2000);

                    function reload_page(){
                        location.reload()
                    }
                }else{
                    $("#service_table").load(window.location + " #service_table");
                    $("#delete_modal_up").modal('toggle');
                    bootstrapAlert(data.message, "danger", 200);
                }
            },
            error: function(error) {
              console.log(error);
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
                        $("#service_table_body").append('<tr><td><div style="display: flex; justify-content: center; align-item: center; margin-top: 30px;"><img src="/images/mrjams/noData2.jpg" alt="no data available"></div><div style="display: flex; justify-content: center; align-item: center;  margin-top: 30px;"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_modal">Create New Data</button></div></td></tr>');
                    }else{
                        $('#services_table_head').show();
                        $('#service_table_body').empty();
                        $('#pagination_div').css('height', '0px');
                        $.each(data.data, function(key, val){
                            $("#service_table_body").append('<tr><th scope="row">'+val.id+'</th><td>'+val.name+'</td><td>'+val.description+'</td><td><a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_modal_up" id="edit_modal" data-id="'+val.id+'" title="Edit '+val.name+'"><i class="fa fa-pencil" aria-hidden="true" ></i></a><a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" title="Delete '+val.name+'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
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
            $("#service_table").load(window.location + " #service_table");
            $('#pagination_div').css('height', '54px');
        }
        
    });

});