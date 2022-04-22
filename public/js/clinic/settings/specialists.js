$(function () {

    //calling reusable script
    $.getScript("/js/clinic/reusableFunction.js");




    //ADD
    $("#add_specialist_form").on('submit', function (e) {
        e.preventDefault();

        if ($("#max_time").val() <= $("#min_time").val()) {
            $("#min_max_time_error").attr("hidden", false);
        } else {
            $("#min_max_time_error").attr("hidden", true);
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $('#add_specialist_form').serialize(),
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (key, val) {
                            $('span.' + key + '_error').text(val[0]);
                        });
                    } else {
                        $("#specialists_table").load(window.location + " #specialists_table");
                        $("#create_specialists_modal").modal('toggle');
                        bootstrapAlert(data.message, "success", 200);
                    }
                }
            });
        }

    });


    // display of data in edit modal, edit_modal
    $(document).on('click', 'a#edit_specialist', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/settings/" + id + "_specialist/edit",
            success: function (data) {
                console.log(data);
                // $("#edit_name").val(data.equipment.name);
                // $("#edit_quantity").val(data.equipment.quantity);
                // $("#edit_unit").val(data.equipment.unit);


                // $("#edit_specialist_form").attr('action', "/clinic/equipments/"+id); 

                $("#edit_specialist_fullname").val(data.specialist.fullname);
                $("#edit_specialist_specialization").val(data.specialist.specialization);
                $("#edit_specialist_min_time").val(data.specialist.min_time);
                $("#edit_specialist_max_time").val(data.specialist.max_time);

                $("#edit_specialist_form").attr('action', "/clinic/settings/" + id + "_EditSpecialists");

            },
            error: function (e) {
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
            }
        });
    });

    //EDIT, edit_modal
    $("#edit_specialist_form").on('submit', function (e) {
        e.preventDefault();
        if ($("#edit_specialist_max_time").val() <= $("#edit_specialist_min_time").val()) {
            $("#min_max_time_error_edit").attr("hidden", false);
        } else {
            $("#min_max_time_error_edit").attr("hidden", true);
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $('#edit_specialist_form').serialize(),
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (key, val) {
                            $('span.' + key + '_error').text(val[0]);
                        });
                    } else {
                        //console.log(data);
                        $("#specialists_table").load(window.location + " #specialists_table");
                        $("#edit_specialists_modal").modal('toggle');
                        bootstrapAlert(data.message, "info", 200);
                    }
                }
            });
        }


    });


    //DELETE
    // display of data in delete modal, delete_modal
    $(document).on('click', 'a#delete_specialist', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/settings/" + id + "_specialist/edit",
            success: function (data) {
                // console.log(data);
                $("#delete_specialist_name").empty();

                $("#delete_specialist_name").append(data.specialist.fullname.toUpperCase() + '<input type="text" value="' + id + '" id="todeletespecialist" hidden>');
            },
            error: function (e) {
                console.log('AJAX load did not work');
                console.log(e);
                // alert("error");
            }
        });
    });

    //DELETE, delete_modal
    $(document).on('click', '#confirm_delete', function (e) {
        e.preventDefault();
        var id = $("input#todeletespecialist").val();
        $.ajax({
            type: "DELETE",
            url: "/clinic/settings/" + id + "_DeleteSpecialists",
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (data) {
                $("#specialists_table").load(window.location + " #specialists_table");
                $("#delete_specialists_modal").modal('toggle');
                bootstrapAlert(data.message, "danger", 200);
            },
            error: function (error) {
                console.log('error');
            }
        });
    });



})