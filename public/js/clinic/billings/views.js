$(function(){

    //calling reusable script
    $.getScript("../js/clinic/reusableFunction.js");

     // display of data in view modal, I used billing delete function
    $(document).on('click', 'a#view_billing_detail_btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type: "DELETE",
            url: "/clinic/billing/"+ id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(data) {
                // console.log(data);
                $("#detail_modal_body").empty();

                $("#detail_modal_body").append('<div class="col-lg-5" style="border-right: 1px solid black"><div class="row d-flex align-items-baseline"><div class="col-lg-4 col-md-4 col-sm-4"><img class="rounded-circle" src="'+data.data.user_avatar+'"></div><div class="col-lg-8 col-md-8 col-sm-8 align-bottom"><span>'+data.data.user_contact+'<br>'+data.data.user_email+'</span></div></div><div class="row mt-4 mx-4"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.user_name+'</p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.user_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.user_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.user_address+' </p></div></div><div class="col-lg-7 mt-md-5 mt-sm-5 mt-lg-0"><div class="row"><h2>Patient</h2><div class="col-lg-4 d-flex align-items-center justify-content-center"><i class="fas fa-briefcase-medical" style="font-size: 60px"></i></div><div class="col-lg-8"><h4 class="mx-4">&#x2022;'+data.data.ro_package_name+data.data.ro_services_name+'</h4></div></div><div class="row mt-5 mx-2"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.patient_name+' </p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.patient_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.patient_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.patient_address+' </p></div></div>');

                $('#view_bill_details_print').attr('href', "/clinic/print/"+id+"_receipt");
                
            },
            error: function(error) {
              console.log('error');
            }
        });


    });

    // display of data in update modal, I used billing edit function
    $(document).on('click', 'a#view_billing_update_btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: "/clinic/billing/"+id+"/edit",
            beforeSend: function(){
                $("#update_billing_name").text("");
                $("#edit_total").val("");
                $("#edit_balance").val("");
                $("#edit_total2").val("");
                $("#edit_balance2").val("");
                $("#payment_update").val("");
                
                $("#update_bill_body").attr("hidden", true);
                $("#response_waiting_billing_update").removeAttr("hidden");
            },
            success: function(data) {
                console.log(data);
                $("#response_waiting_billing_update").attr("hidden", true);
                $("#update_bill_body").removeAttr("hidden");

                $("#update_billing_name").text(data.customer.fname + " " + data.customer.lname);
                $("#edit_total").val(data.billing.total_paid + data.billing.balance);
                $("#edit_balance").val(data.billing.balance);
                $("#edit_total2").val(data.billing.total_paid + data.billing.balance);
                $("#edit_balance2").val(data.billing.balance);

                $('#update_main_form').attr('action', "/clinic/billing/"+id+"_UpdateBalance");
                
            },
            error: function(error) {
              console.log(error);
            }
        });


    });

    //Update Balance
    $("#update_main_form").on('submit', function(e){
        e.preventDefault();


        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#update_main_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');

                
                $('#update_billing_update_btn').attr("hidden", true)
                $('#response_waiting_update_billing_update_btn').removeAttr("hidden");
            },
            success: function(data) {
                //$("#update_main_form")[0].reset();
                $('#update_billing_update_btn').removeAttr("hidden");
                $('#response_waiting_update_billing_update_btn').attr("hidden", true)

                console.log(data);

                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                   });
                }else{
                    
                    $("#div_bill_table").load(window.location + " #div_bill_table");
                    $("#update_bill_view").modal('toggle');
                    bootstrapAlert(data.message, "success", 150);
                }

            },
            error: function(error) {
              console.log(error);
            }
        });

    });


    

    // display of data in update modal, I used billing edit function
    $(document).on('click', 'a#send_email_btn', function(e) {
        e.preventDefault();

        var name = $(this).data('name');
        var email = $(this).data('email');
        var ro_id = $(this).data('ro_id');

        // console.log(name);
        // console.log(email);
        // console.log(ro_id);

        
        $("#send_email_name").text(name)
        $("#name_view").val(name)
        $("#email_view").val(email)

        $("#name").val(name)
        $("#email").val(email)
        $("#ro_id").val(ro_id)
    });

    //Send Email
    $("#send_email_main_form").on('submit', function(e){
        e.preventDefault();


        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#send_email_main_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');

                
                $('#send_email_btn_send').attr("hidden", true)
                $('#response_waiting_send_email').removeAttr("hidden");
            },
            success: function(data) {
                //$("#update_main_form")[0].reset();
                $('#send_email_btn_send').removeAttr("hidden");
                $('#response_waiting_send_email').attr("hidden", true)

                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                   });
                }else{
                    // console.log(data);
                    $("#send_email_modal").modal('toggle');
                    bootstrapAlert(data.message, "success", 300);
                }

            },
            error: function(error) {
              console.log(error);
            }
        });

    });



});