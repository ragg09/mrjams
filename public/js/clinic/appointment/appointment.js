$(function(){
    let data_count = 0;
    //calling reusable script
    $.getScript("/js/clinic/reusableFunction.js");

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
            success: function(data){

                //console.log(data);

                $("#detail_modal_body").empty();

                $("#for_ro_id").val(id);

                $("#detail_modal_body").append('<div class="col-lg-5" style="border-right: 1px solid black"><div class="row d-flex align-items-baseline"><div class="col-lg-4 col-md-4 col-sm-4"><img class="rounded-circle" src="'+data.data.user_avatar+'"></div><div class="col-lg-8 col-md-8 col-sm-8 align-bottom"><span>'+data.data.user_contact+'<br>'+data.data.user_email+'</span></div></div><div class="row mt-4 mx-4"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.user_name+'</p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.user_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.user_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.user_address+' </p></div></div><div class="col-lg-7 mt-md-5 mt-sm-5 mt-lg-0"><div class="row"><h2>Patient</h2><div class="col-lg-4 d-flex align-items-center justify-content-center"><i class="fas fa-briefcase-medical" style="font-size: 60px"></i></div><div class="col-lg-8"><h4 class="mx-4">&#x2022;'+data.data.ro_package_name+'</h4></div></div><div class="row mt-5 mx-2"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.patient_name+' </p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.patient_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.patient_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.patient_address+' </p></div></div>');

                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    //ACCEPT APPOINTMENT MODAL
    $("#accept_app_btn").on('click', function(e){
        e.preventDefault();
        var id =  document.getElementById("for_ro_id").value;
        var today = new Date();
        
        
        $.ajax({
            type: "GET",
            url: "/clinic/appointment/" + id,
            success: function(data){   
                console.log(data);

                $("#customer_email").append('<input type="text" id="customer_email" name="customer_email" hidden value="'+data.data.user_email+'">');
                $("#accept_appointment_form").attr('action', "/clinic/appointment/"+id);
                $("#accept_modal_flatpicker").flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    inline: true,
                    minDate: today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(),
                    defaultDate: data.data.app_appointed_at + " " + data.data.time , 
                });

                
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
                $("#accept_modal_up").modal('toggle');
                $("#loading-screen-bg").css("visibility", "visible");
                $(document).find('span.error-text').text('');
                


            },
            success: function(data) {
                console.log(data);
                if(data.status == 0){
                    $('span.datetime_error').text(data.datetime);
                }else{
                    // $("#appointment_table").load(window.location + " #appointment_table");
                    //$("#accept_modal_up").modal('toggle');
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
        
        console.log(id);

        $("#decline_appointment").empty();
        $("#decline_appointment").append('<input type="text" class="form-control" id="delete_ro_id" value="'+id+'" hidden>');

    });

    

    $("#confirm_decline_appointment").on('click', function(e){
        var id =  document.getElementById("delete_ro_id").value;
        console.log(id);

        $.ajax({
            type: "DELETE",
            url: "/clinic/appointment/"+ id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(data) {
                console.log(data);
                $("#appointment_table").load(window.location + " #appointment_table");
                $("#decline_modal_up").modal('toggle');
                // $("#equipment_table").load(window.location + " #equipment_table");
                // $("#delete_modal_up").modal('toggle');
                // bootstrapAlert(data.message, "danger", 200);
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
        console.log(id);
        $.ajax({
            type: "GET",
            url: "/clinic/appointment/" + id,
            success: function(data){

                //console.log(data);

                $("#accepted_detail_modal_body").empty();

                $("#accepted_detail_modal_body").append('<div class="col-lg-5" style="border-right: 1px solid black"><div class="row d-flex align-items-baseline"><div class="col-lg-4 col-md-4 col-sm-4"><img class="rounded-circle" src="'+data.data.user_avatar+'"></div><div class="col-lg-8 col-md-8 col-sm-8 align-bottom"><span>'+data.data.user_contact+'<br>'+data.data.user_email+'</span></div></div><div class="row mt-4 mx-4"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.user_name+'</p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.user_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.user_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.user_address+' </p></div></div><div class="col-lg-7 mt-md-5 mt-sm-5 mt-lg-0"><div class="row"><h2>Patient</h2><div class="col-lg-4 d-flex align-items-center justify-content-center"><i class="fas fa-briefcase-medical" style="font-size: 60px"></i></div><div class="col-lg-8"><h4 class="mx-4">&#x2022;'+data.data.ro_package_name+'</h4></div></div><div class="row mt-5 mx-2"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.patient_name+' </p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.patient_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.patient_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.patient_address+' </p></div></div>');

                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
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