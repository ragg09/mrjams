$(function(){
    let data_count = 0;
    //calling reusable script
    $.getScript("../../js/clinic/reusableFunction.js");

    // polling technique
    var timer = setInterval( reload_table, 5000);
    function reload_table(){
        //var data_count;
        var id = 0;
        $.ajax({
            type: "GET",
            url: "/clinic/appointment/"+id,
            success: function(data){
                // console.log(data);
                
                if(data_count == 0){
                    data_count = data.data;
                    //console.log("convert data count to count from db");
                }else{
                    if(data.data != data_count){
                        data_count = data.data;
                        //console.log("pasok sa refresh");
                        $("#appointment_table").load(window.location + " #appointment_table");
                    }else{
                        data_count = data.data;
                        //console.log("renew data count");
                    }
                }

            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
        
    }

    // appointment_data();

    // function appointment_data() {
    //     //alert('try');
    //     var id = 0;
    //     $.ajax({
    //         type: "GET",
    //         url: "/clinic/appointment/"+id,
    //         success: function(data){
    //             console.log("TRY");

    //             $.each(data.data, function(index, val){
    //                 // $("#package_body").append('<div class="col-lg-4 p-2 text-center"><div class="rounded p-2"  id="index_box"><div ><h4>'+val.ro_package_name+'</h4><div class="row"><p>'+val.ro_patient_details+'</p><div class="col-lg-6 d-flex jusify-content-center"><a href="/clinic/appointment/'+val.ro_id+'" class="btn btn-outline-primary w-100"><i class="fa fa-eye" aria-hidden="true"></i></a></div><div class="col-lg-6 d-flex justify-content-center"><a href="" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#delete_modal" id="delete_modal_up" data-id="'+val.ro_id+'" ><i class="fa fa-trash" aria-hidden="true"></i></a></div></div></div></div></div>');


    //                 // $("#appointment_table_body").empty();
    //                 // $("#appointment_table_body").append('<tr><td>'+val.ro_id+'</td><td>'+val.ro_patient_details+'</td><td>'+val.app_created_at+'</td><td>'+val.ro_package_name+'</td><td>wala pa</td></tr>');
                    

                    
    //            });

    //         },
    //         error: function(){
    //             console.log('AJAX load did not work');
    //             alert("error");
    //         }
    //     });
    // }


    //=================================================================================================

    // display of data in detail modal, detai_modal
    $(document).on('click', 'a#detail_modal', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/clinic/appointment/" + id,
            beforeSend: function(){
                $("#detail_modal_body").empty();
                $("#response_waiting").removeAttr("hidden");
            },
            success: function(data) {
                $("#response_waiting").attr("hidden", true);

                //console.log(data);

                $("#detail_modal_body").empty();

                $("#for_ro_id").val(id);

                
                // $("#accept_app_btn").attr('data-id', id);


                $("#detail_modal_body").append('<div class="col-lg-5" style="border-right: 1px solid black"><div class="row d-flex align-items-baseline"><div class="col-lg-4 col-md-4 col-sm-4"><img class="rounded-circle" src="'+data.data.user_avatar+'"></div><div class="col-lg-8 col-md-8 col-sm-8 align-bottom"><span>'+data.data.user_contact+'<br>'+data.data.user_email+'</span></div></div><div class="row mt-4 mx-4"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.user_name+'</p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.user_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.user_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.user_address+' </p></div></div><div class="col-lg-7 mt-md-5 mt-sm-5 mt-lg-0"><div class="row"><h2>Patient</h2><div class="col-lg-4 d-flex align-items-center justify-content-center"><i class="fas fa-briefcase-medical" style="font-size: 60px"></i></div><div class="col-lg-8"><h4 class="mx-4">&#x2022;'+data.data.package_service+'</h4></div></div><div class="row mt-5 mx-2"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.patient_name+' </p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.patient_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.patient_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.patient_address+' </p></div></div>');

                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });


    //USED IN  $("#accept_app_btn").on('click', function(e){
    //check Specialist availability
    function CheckSpeciistAppointments(timedate, specialist_id) {
        $.ajax({
            type: "GET",
            url: "/clinic/settings/" + specialist_id + "_specialist/edit",
            beforeSend: function(){
                $("#confirm_accept_btn_confirm").attr("hidden", true);
                $("#confirm_accept_btn_cancel").attr("hidden", true);
                $("#response_waiting_accepting_appointment").removeAttr("hidden");

                $("#accept_specialist_with_warning").attr("hidden", true);
                $("#accept_specialist_with_error").attr("hidden", true);
                $("#negotiation_specialist_with_error").attr("hidden", true);
                $("#calendar_btn").attr("hidden", true);

                $(document).find('span.error-text').text('');
            },
            success: function(data){
                $("#confirm_accept_btn_confirm").removeAttr("hidden");
                $("#confirm_accept_btn_cancel").removeAttr("hidden");
                $("#response_waiting_accepting_appointment").attr("hidden", true);

                var count_data = 0;

                console.log(data);
                // console.log(moment(timedate[0]+"," +timedate[1]).add(5, 'hours').format('h:mm a'));

                if(timedate[1] >= data.specialist.min_time && timedate[1] <= data.specialist.max_time){
                    console.log("SAKOP NG ORAS NI DR! PROCEED SA TRAPPING LOGIC");
                    $("#confirm_accept_btn_confirm").prop("disabled", false);
                    //Within Specialist Time Range

                    if(data.specialist_appointments != ""){ //check if clinic has any appointments
                        $.each(data.specialist_appointments, function(key, val){
                            count_data++
    
                            var plus_one_hour = moment(val.date + "," + val.time).add(1, 'hours').format('YYYY-MM-DD h:mm a');
                            var minus_one_hour = moment(val.date + "," + val.time).subtract(1, 'hours').format('YYYY-MM-DD h:mm a');
                            var selected_datetime = moment(timedate[0]+"," +timedate[1]).format('YYYY-MM-DD h:mm a');
                            
                            if($("#accept_modal_flatpicker").val() == val.datetime ){
                                //disable button ng submit
                                //console.log($("#accept_modal_flatpicker").val() + " | " + val.datetime);
    
                                console.log("ito ung nakuha na ung exact date at time|| RED ERROR MESSAGE");
                                
                                $("#calendar_btn").attr("hidden", false);
                                $("#accept_specialist_with_error").attr("hidden", false);
                                $("#confirm_accept_btn_confirm").prop("disabled", true);
                            }else {
                                if(selected_datetime >= minus_one_hour && selected_datetime <= plus_one_hour){
                                    console.log("warning na ipapakita ung date na may appointment si dr pero pwede padin iaccept");
                                    console.log(val.datetime);
                                    console.log(selected_datetime);
                                    $("#accept_specialist_with_warning").attr("hidden", false);
    
                                    $("#reminder_time").text(moment(val.datetime).format('LL HH:mmA'));
                                    $("#confirm_accept_btn_confirm").prop("disabled", false);
                                    
                                }else{
                                    var get_last = count_data - 1;
    
                                    if(count_data == data.specialist_appointments.length){
                                        
                                        if(timedate[0] != moment().format('YYYY-MM-DD')){
                                            // if no issue at all after looping through all of data in array
                                            console.log("All goods || no issue at all");
                                            $("#accept_specialist_with_warning").attr("hidden", true);
                                            $("#accept_specialist_with_error").attr("hidden", true);
                                            $("#calendar_btn").attr("hidden", true);
                                            $("#confirm_accept_btn_confirm").prop("disabled", false);
                                            //console.log(data.specialist_appointments.length);
                                        }     
                                    }
                                    
                                }
                            }
    
                            
                        });

                        
                        
                    }else if(data.specialist_nego != ""){
                        //checking if specialist has negotion on selected time
                        
                        $.each(data.specialist_nego, function(key, val){ 
                            
                            if($("#accept_modal_flatpicker").val() == val.datetime ){
                                // console.log("negotiation");
                                $("#negotiation_specialist_with_error").attr("hidden", false);
                                $("#confirm_accept_btn_confirm").prop("disabled", true);
                            } 
                        });
                    }else{
                        //console.log("ITO NGA PUTANG INA!");
                        console.log("NO APPOINTMENT AT ALL");
                        //No appointment at all
                        $("#confirm_accept_btn_confirm").prop("disabled", false);
                    }
                    

                }else{
                    console.log("HINDI NA SAKOP NG ORAS NI SPECIALIST");

                    $("#confirm_accept_btn_confirm").prop("disabled", true);
                }
                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    }

    //ACCEPT APPOINTMENT MODAL
    $("#accept_app_btn").on('click', function(e){
        e.preventDefault();
        var id =  document.getElementById("for_ro_id").value;
        console.log(id);
        var today = new Date();
        $.ajax({
            type: "GET",
            url: "/clinic/appointment/" + id,
            beforeSend: function(){
                // $("#detail_modal_body").empty();
                $("#response_waiting_accept").removeAttr("hidden");
                $("#accept_specialist_with_warning").attr("hidden", true);
                $("#accept_specialist_with_error").attr("hidden", true);
                $("#specialist_div").empty();
                $("#flatpicker").attr("hidden", true);
                $("#calendar_btn").attr("hidden", true);

                $('span.datetime_error').text("");
            },
            success: function(data) {
                $("#response_waiting_accept").attr("hidden", true);
                // $("#detail_modal_body").empty();
                console.log(data);
                $("#flatpicker").removeAttr("hidden");
                $("#specialist_div").empty();
                $("#accept_modal_flatpicker").empty();

                if(data.specialists.length > 0){
                    console.log(("nagana"));
                    $("#confirm_accept_btn_confirm").prop("disabled", true);

                    $("#specialist_div").append('<select class="form-control" id="specialist" name="specialist" style="width: 100%;">');
                    $("#specialist").append('<option value="">Select here</option>');
                    $.each(data.specialists, function(key, val){
                        $("#specialist").append('<option value="'+val.id+'">'+val.fullname+ " | "+ val.specialization+ " | "+ moment("2018-01-01,"+val.min_time ).format('h:mm a')  +' - '+  moment("2018-01-01,"+val.max_time ).format('h:mm a') +'</option>');
                    });

                    $("#specialist").on('change', function(e){ //GET SPECIALIST TIME AVAILABITY
                        var timedate = $("#accept_modal_flatpicker").val().split(" "); // 0 = date | 1 = time
                        var specialist_id = $("#specialist").val();
                        CheckSpeciistAppointments(timedate, specialist_id);
                       
                    })
                    
                }

                $("#customer_email").append('<input type="text" id="customer_email" name="customer_email" hidden value="'+data.data.user_email+'">');
                $("#accept_appointment_form").attr('action', "/clinic/appointment/"+id);
                
                $("#accept_modal_flatpicker").flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    inline: true,
                    minDate: today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(),
                    defaultDate: data.data.app_appointed_at + " " + data.data.time,
                    onChange: function(selectedDates, dateStr, instance) {//GET SPECIALIST TIME AVAILABITY
                        if(data.specialists.length > 0){
                            var timedate = $("#accept_modal_flatpicker").val().split(" "); // 0 = date | 1 = time
                            var specialist_id = $("#specialist").val();
                            if(specialist_id != ""){
                                CheckSpeciistAppointments(timedate, specialist_id);
                            }
                        }
                    }
                });

                $("#accept_modal_flatpicker").val(data.data.app_appointed_at + " " + data.data.time);

                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    //ACCEPT APPOINTMENT MODAL CONFIRMATION, edit the status
    $("#accept_appointment_form").on('submit', function(e){
        e.preventDefault();


        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#accept_appointment_form').serialize(),
            beforeSend: function(){
                // $("#accept_modal_up").modal('toggle');
                // $("#loading-screen-bg").css("visibility", "visible");
                
                
               
                $("#confirm_accept_btn_confirm").attr("hidden", true);
                $("#confirm_accept_btn_cancel").attr("hidden", true);
                $("#response_waiting_accepting_appointment").removeAttr("hidden");

                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                //console.log(data);

                $("#confirm_accept_btn_confirm").prop("disabled", false); //need to remove if specialist exists


                $("#confirm_accept_btn_confirm").removeAttr("hidden");
                $("#confirm_accept_btn_cancel").removeAttr("hidden");
                $("#response_waiting_accepting_appointment").attr("hidden", true);

                if(data.status == 0){
                    $('#calendar_btn').removeAttr('hidden');
                    $('span.datetime_error').text(data.datetime);
                }
                else if(data.status == 5){
                    $('span.datetime_error').text(data.datetime);
                    
                }else{
                    // if(data.count_app == 0){
                    //     location.reload();
                    // }else{
                    //     $("#appointment_table").load(window.location + " #appointment_table");
                    //     $("#accept_modal_up").modal('toggle');
                    //     bootstrapAlert(data.message, "success", 250);
                    // }

                    $("#appointment_table").load(window.location + " #appointment_table");
                    $("#accept_modal_up").modal('toggle');

                    bootstrapAlert(data.message, "success", 250);

                    
                    setInterval( reload_page, 2000);
                    function reload_page(){
                        location.reload()
                    }

                }

            }
        });

    });

    //DECLINE APPOINTMENT MODAL
    $("#decline_app_btn").on('click', function(e){
        e.preventDefault();
        var id =  document.getElementById("for_ro_id").value;
        
        //console.log(id);

        $("#decline_appointment").empty();
        $("#decline_appointment").append('<input type="text" class="form-control" id="delete_ro_id" value="'+id+'" hidden>');

    });

    

    $("#confirm_decline_appointment_decline").on('click', function(e){
        var id =  document.getElementById("delete_ro_id").value;
        //console.log(id);

        $.ajax({
            type: "DELETE",
            url: "/clinic/appointment/"+ id,
            data:{
                _token: $("input[name=_token]").val()
            },
            beforeSend: function(){
                $("#confirm_decline_appointment_cancel").attr("hidden", true);
                $("#confirm_decline_appointment_decline").attr("hidden", true);
                $("#response_waiting_decline").removeAttr("hidden");
            },
            success: function(data) {
                //console.log(data);

                $("#confirm_decline_appointment_cancel").removeAttr("hidden");
                $("#confirm_decline_appointment_decline").removeAttr("hidden");
                $("#response_waiting_decline").attr("hidden", true);



                $("#appointment_table").load(window.location + " #appointment_table");
                $("#decline_modal_up").modal('toggle');
                bootstrapAlert(data.message, "danger", 200);
                setInterval( reload_page, 2000);
                    function reload_page(){
                        location.reload()
                    }
            },
            error: function(error) {
              console.log('error');
            }
        });

    });

    //=================================================================================================

    // display of data in accepted view detail modal, accepted_view_detai_modal
    $(document).on('click', 'a#accepted_view_detail_modal', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "GET",
            url: "/clinic/appointment/" + id,
            beforeSend: function(){
                $("#accepted_detail_modal_body").empty();
                $("#response_waiting_accepted_details").removeAttr("hidden");
            },
            success: function(data) {
                $("#response_waiting_accepted_details").attr("hidden", true);
                // console.log(data);

                $("#ro_id_done").val(id);

                $("#proceed_billing").attr('href', "/clinic/billing/"+id);
                $("#accepted_detail_modal_body").empty();

                $("#accepted_detail_modal_body").append('<div class="col-lg-5" style="border-right: 1px solid black"><div class="row d-flex align-items-baseline"><div class="col-lg-4 col-md-4 col-sm-4"><img class="rounded-circle" src="'+data.data.user_avatar+'"></div><div class="col-lg-8 col-md-8 col-sm-8 align-bottom"><span>'+data.data.user_contact+'<br>'+data.data.user_email+'</span></div></div><div class="row mt-4 mx-4"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.user_name+'</p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.user_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.user_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.user_address+' </p></div></div><div class="col-lg-7 mt-md-5 mt-sm-5 mt-lg-0"><div class="row"><h2>Patient</h2><div class="col-lg-4 d-flex align-items-center justify-content-center"><i class="fas fa-briefcase-medical" style="font-size: 60px"></i></div><div class="col-lg-8"><h4 class="mx-4">&#x2022;'+data.data.package_service+'</h4></div></div><div class="row mt-5 mx-2"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.patient_name+' </p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.patient_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.patient_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.patient_address+' </p></div></div>');

                if(data.data.app_status == 5){
                    $("#proceed_billing").attr('hidden', true)
                }else{
                    $("#proceed_billing").removeAttr('hidden')
                }

                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    //DONE APPOINTMENT MODAL CONFIRMATION, edit the status || I USED DELETE FUNCTION
    $("#done_appointment_form").on('submit', function(e){
        e.preventDefault();
        //I AM NOT USING THIS FUNCTION ANYMORE
        // console.log("ito nga");

        // var id =  document.getElementById("ro_id_done").value;
        // console.log(id + " DONE");

        // $.ajax({
        //     type: "DELETE",
        //     url: "/clinic/appointment/"+ id + " DONE",
        //     data:{
        //         _token: $("input[name=_token]").val()
        //     },
        //     success: function(data) {
        //         console.log(data);
        //         $("#appointment_table_accepted").load(window.location + " #appointment_table_accepted");
        //         $("#accepted_view_detail_modal_up").modal('toggle');
        //         bootstrapAlert(data.message, "success", 200);
        //     },
        //     error: function(error) {
        //       console.log('error');
        //     }
        // });

    });

    $("#calendar_btn").on('click', function(e){
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/clinic/dashboard",
            success: function(data){
                var edata = [];
                
                if(data.status == 0){
                    var calendarEl = document.getElementById('view_calendar');
                    
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridDay'
                        },
                        //initialView: 'timeGridDay',
                        navLinks: true, // can click day/week names to navigate views
                        // businessHours: true, // display business hours
                        // editable: true,
                        selectable: true,
                    
                    });
                    calendar.render();
                }else{
                    $.each(data.data, function(index, val){
                        
                        edata.push({
                            title: val.ro_patient_details,
                            //start: moment(val.app_created_at).format("YYYY-MM-DD")+"T00:12:00",
                            start: moment(val.app_appointed_at).format("YYYY-MM-DD")+"T"+val.time,
                            //constraint: "businessHours",
                        })
                    });

                    var calendarEl = document.getElementById('view_calendar');
                    
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridDay'
                        },
                        //initialView: 'timeGridDay',
                        navLinks: true, // can click day/week names to navigate views
                        // businessHours: true, // display business hours
                        // editable: true,
                        selectable: true,
                        events: edata,
                    
                    });


                    calendar.render();
                }
                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    })
    


});