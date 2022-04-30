var tableData;

$(function(){
    appointment_data();

     //calling reusable script
     $.getScript("../../js/customer/reusableFunction.js");

   

    // Appointment list
    function appointment_data() {
        //alert('try');
        var id = 0;
        var appointStatus;
        var time_appoint;
        var date_appoint;
        var create_appoint;
        var color;

        $.ajax({
            type: "GET",
            url: "/customer/mail/"+id,
            success: function(data){
                // console.log(data);
                $('#customerName').text(data.customer.lname+', '+data.customer.fname);
                

                if(data.status == 0 ){

                    $("#mailTable").DataTable();

                    $("#info").empty();
                    $("#info").append('<tr><td><i class="fa fa-star" style="color: #6497B1"></i></td><td></td><td class="view-message ">Hi, Welcome to MR. JAMS </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');


                }else{



                    $.each(data.all, function(index, val){

                        time_appoint = val.time;

                        function tConv24(time_appoint) {
                            var ts = time_appoint;
                            var H = +ts.substr(0, 2);
                            var h = (H % 12) || 12;
                            h = (h < 10)?("0"+h):h;  // leading 0 at the left for 1 digit hours
                            var ampm = H < 12 ? " AM" : " PM";
                            ts = h + ts.substr(2, 3) + ampm;
                            return ts;
                        };

                        // console.log(tConv24(time_appoint));

                        date_appoint = val.appointed_at;

                        function dateToYMD(date_appoint) {
                            var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                            var d = date_appoint.getDate();
                            var m = strArray[date_appoint.getMonth()];
                            var y = date_appoint.getFullYear();
                            return '' + m + '-' +(d <= 9 ? '0' + d : d) + '-' + y;
                        }
                        // console.log(dateToYMD(new Date(date_appoint)));

                        create_appoint = val.created_at;

                        function datesToYMD(create_appoint) {
                            var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                            var d = create_appoint.getDate();
                            var m = strArray[create_appoint.getMonth()];
                            var y = create_appoint.getFullYear();
                            return '' + m + '-' +(d <= 9 ? '0' + d : d) + '-' + y;
                        }
                        // console.log(datesToYMD(new Date(create_appoint)));

                        appointStatus = val.status;
                        if(appointStatus == 1){
                            color = "success";
                        }else if(appointStatus == 2){
                            color = "warning";
                        }else if(appointStatus == 3){
                            color = "danger";
                        }else if(appointStatus == 4){
                            color = "primary";
                        }else if(appointStatus == 5){
                            color = "muted";
                        }else if(appointStatus == 6){
                            color = "dark";
                        }else if(appointStatus == 8){
                            color = "secondary";
                        }else{
                            color = "danger";
                        }

                        if(val.status == 5){
                            $("#info").append('<tr><th class="text-center"><i class="fa fa-star text-'+color+'"></i></th><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"><b>'+val.name+'</b></a></td> <td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"> The clinic would like to reschedule you on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b>...</a></td> <td class="text-center"><button type="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#accept_modal_up" id="accept_modal" data-id="'+val.id+'" ><i class="fa fa-check" aria-hidden="true"></i> </button> <button type="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#decline_modal_up" id="decline_modal" data-id="'+val.id+'" ><i class="fa fa-times" aria-hidden="true"></i> </button></td> <td class="text-center">'+datesToYMD(new Date(create_appoint))+'</td> <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#cancel_modal_up" id="cancel_modal" data-id="'+val.id+'" ><i class="fa fa-ban text-danger" aria-hidden="true"></i></a></td></tr>');

                        }else if(val.status == 1){
                            $("#info").append('<tr><th class="text-center"><i class="fa fa-star text-'+color+'"></i><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"><b>'+val.name+'</b></a></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">This clinic has completed your appointment....</a></td><td class="text-center"><button class="btn btn-'+color+' center" id="stat" style="border-radius: 8px;">'+val.remark+'</button></td><td class="text-center">'+datesToYMD(new Date(create_appoint))+'</td> <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                        }else if(val.status == 8){

                            $("#info").append('<tr><th class="text-center"><i class="fa fa-star text-'+color+'"></i></th><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"><b>'+val.name+'</b></a></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b> was <b>Cancelled</b>...</a></td><td class="text-center"><button class="btn btn-'+color+'" id="stat" style="border-radius: 8px;">'+val.remark+'</button></td><td class="text-center">'+datesToYMD(new Date(create_appoint))+'</td> <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        }else if(val.status == 6){

                            $("#info").append('<tr><th class="text-center"><i class="fa fa-star text-'+color+'"></i><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"><b>'+val.name+'</b></a></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your Appointment from this Clinic has been <b>Expired</b>....</a></td><td class="text-center"><button class="btn btn-'+color+'" id="stat" style="border-radius: 8px;">'+val.remark+'</button></td><td class="text-center">'+datesToYMD(new Date(create_appoint))+'</td> <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        }else{
                            $("#info").append('<tr><th class="text-center"><i class="fa fa-star text-'+color+'"></i><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"><b>'+val.name+'</b></a></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b>...</a></td><td class="text-center"><button class="btn btn-'+color+'" id="stat" style="border-radius: 8px;">'+val.remark+'</button></td><td class="text-center">'+datesToYMD(new Date(create_appoint))+'</td><td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#cancel_modal_up" id="cancel_modal" data-id="'+val.id+'" ><i class="fa fa-ban text-danger" aria-hidden="true"></i></a></tr>');
                        }
    
                       
                        
                   });

                   tableData = $("#mailTable").DataTable({
                        "ordering": true,
                        "pageLength": 10,
                        "pagingType": "simple_numbers",
                        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
                        "info": true,
                        "Destroy": true
                        
                    });

                    // tableData.ajax.reload();

                   

                }

            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });

    }

    // Actions: Appointments
    
     $(document).on('click', '#cancel_modal[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "GET",
            url: "/customer/mail/" + id,
            success: function(data){
                // console.log(data);
                $("#cancel_name").empty();
                // $("#cancel_packages").empty();
                $("#cancel_name").append('<input type="text" value="'+id+'" id="cancelStat" data-id="'+id+'" hidden>');

              
               
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });

    $(document).on('click', '#confirm_cancel', function(e) {
        e.preventDefault();
        var id = $("input#cancelStat").val(); 
        // $("#aStatus-Delete").attr('action', "/customer/mail/"+id);
        $.ajax({
            method: "DELETE",
            url: "/customer/relativeappoint/"+id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(e){
                // console.log(e);
                    $("#cancel_modal_up").modal('toggle');

                    if ($.fn.DataTable.isDataTable('#mailTable')) {
                        $('#mailTable').DataTable().destroy();
                    }

                    $("#info").empty();
                    appointment_data();
                
                    bootstrapAlert("The Appointment is Successfully Cancelled!", "secondary", 380);
                    
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });
   
    $(document).on('click', '#delete_modal[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "GET",
            url: "/customer/mail/" + id,
            success: function(data){
                // console.log(data);
                $("#delete_name").empty();
                // $("#delete_packages").empty();
                $("#delete_name").append('<input type="text" value="'+id+'" id="deleteStat" data-id="'+id+'" hidden>');
               
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });
   
    $(document).on('click', '#confirm_delete', function(e) {
        e.preventDefault();
        var id = $("input#deleteStat").val();
        // console.log(id);
        // $("#aStatus-Delete").attr('action', "/customer/mail/"+id);
        $.ajax({
            method: "DELETE",
            url: "/customer/mail/"+id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(e){
                // console.log(e);
                $("#delete_modal_up").modal('toggle');
                
                if ($.fn.DataTable.isDataTable('#mailTable')) {
                    $('#mailTable').DataTable().destroy();
                }

                $("#info").empty();
                appointment_data();

                bootstrapAlert("The Appointment is Successfully Deleted!", "danger", 380);
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });

     $(document).on('click', '#accept_modal[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "GET",
            url: "/customer/mail/" + id,
            success: function(data){
                // console.log(data);
                $("#accept_name").empty();
                // $("#accept_packages").empty();
                $("#accept_name").append('<input type="text" value="'+id+'" id="acceptStat" data-id="'+id+'" hidden>');
               
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });

    $(document).on('click', '#confirm_accept', function(e) {
        e.preventDefault();
        var id = $("input#acceptStat").val();
        // $("#aStatus-Delete").attr('action', "/customer/mail/"+id);
        $.ajax({
            method: "DELETE",
            url: "/customer/appointment/"+id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(e){
                // console.log(e);

                    $("#accept_modal_up").modal('toggle');

                    if ($.fn.DataTable.isDataTable('#mailTable')) {
                        $('#mailTable').DataTable().destroy();
                    }

                    $("#info").empty();
                    appointment_data();

                    bootstrapAlert("The Appointment is Successfully Accepted!", "primary", 350);
                   
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });

    $(document).on('click', '#decline_modal[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "GET",
            url: "/customer/mail/" + id,
            success: function(data){
                // console.log(data);
                $("#decline_name").empty();
                // $("#decline_packages").empty();
                $("#decline_name").append('<input type="text" value="'+id+'" id="declineStat" data-id="'+id+'" hidden>');
               
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });

    $(document).on('click', '#confirm_decline', function(e) {
        e.preventDefault();
        var id = $("input#declineStat").val();

        // $("#aStatus-Delete").attr('action', "/customer/mail/"+id);
        $.ajax({
            method: "DELETE",
            url: "/customer/clinicList/"+id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(e){
                // console.log(e);

                    $("#decline_modal_up").modal('toggle');
                 
                    if ($.fn.DataTable.isDataTable('#mailTable')) {
                        $('#mailTable').DataTable().destroy();
                    }

                    $("#info").empty();
                    appointment_data();

                    bootstrapAlert("The Appointment is Declined!", "danger", 290);
                   
            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    });


    // Dropdown Filter
    $('#appointStatus').click(function(){
        // e.preventDefault();
        var id = $(this).val();
        var appointStatus;
        var color;
        if(id == "AppointStatus"){
            $("#info").empty();
            appointment_data();
        }else{
             // console.log(query);
            //  var id = 2;
            //  console.log(id);
             $.ajax({
                 type: "GET",
                 url: "/customer/mail/"+id+" status",
                 success: function(data){
                    // console.log(data.all);

                    // $('#customerName').text(data.customer.lname+', '+data.customer.fname);
                    
                    if(data.status == 0 ){
                        
                    $("#info").empty();
                    $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">Hi, Welcome to MR. JAMS </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');

                    }else{
                        $("#info").empty();
                        $.each(data.all, function(index, val){

                            var times_appoint = val.time;

                            function tConv24(times_appoint) {
                                var ts = times_appoint;
                                var H = +ts.substr(0, 2);
                                var h = (H % 12) || 12;
                                h = (h < 10)?("0"+h):h;  // leading 0 at the left for 1 digit hours
                                var ampm = H < 12 ? " AM" : " PM";
                                ts = h + ts.substr(2, 3) + ampm;
                                return ts;
                            };
    
                            // console.log(tConv24(times_appoint));

    
                            var dates_appoint = val.appointed_at;
    
                            function dateToYMD(dates_appoint) {
                                var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                var d = dates_appoint.getDate();
                                var m = strArray[dates_appoint.getMonth()];
                                var y = dates_appoint.getFullYear();
                                return '' + (d <= 9 ? '0' + d : d) + '-' + m + '-' + y;
                            }
                            // console.log(dateToYMD(new Date(dates_appoint)));
    
                            var creates_appoint = val.created_at;
    
                            function datesToYMD(creates_appoint) {
                                var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                var d = creates_appoint.getDate();
                                var m = strArray[creates_appoint.getMonth()];
                                var y = creates_appoint.getFullYear();
                                return '' + (d <= 9 ? '0' + d : d) + '-' + m + '-' + y;
                            }
                            // console.log(datesToYMD(new Date(creates_appoint)));

                           appointStatus = val.status;
                           if(appointStatus == 1){
                               color = "success";
                           }else if(appointStatus == 2){
                               color = "warning";
                           }else if(appointStatus == 3){
                               color = "danger";
                           }else if(appointStatus == 4){
                               color = "primary";
                           }else if(appointStatus == 5){
                               color = "muted";
                           }else if(appointStatus == 6){
                               color = "dark";
                           }else if(appointStatus == 8){
                            color = "secondary";
                            }else{
                               color = "danger";
                           }
                        //    '+tConv24(times_appoint)+'

                        //    $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(dates_appoint))+'</b> at <b> '+tConv24(times_appoint)+'</b>...</a></td><td class="view-message ">'+datesToYMD(new Date(creates_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        if(val.status == 5){
                            $("#info").append('<tr><th scope="row">'+val.id+'</th> <td><i class="fa fa-star text-'+color+'"style="padding-left: 50px;"></i></td> <td ><b>'+val.name+'</b></td> <td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"> The clinic would like to reschedule you on <b>'+dateToYMD(new Date(dates_appoint))+'</b> at <b>'+tConv24(times_appoint)+'</b>...</a></td> <td><button type="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#accept_modal_up" id="accept_modal" data-id="'+val.id+'" ><i class="fa fa-check" aria-hidden="true"></i> </button> <button type="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#decline_modal_up" id="decline_modal" data-id="'+val.id+'" ><i class="fa fa-times" aria-hidden="true"></i> </button></td> <td>'+datesToYMD(new Date(creates_appoint))+'</td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#cancel_modal_up" id="cancel_modal" data-id="'+val.id+'" ><i class="fa fa-ban text-danger" aria-hidden="true"></i></a></td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        }else if(val.status == 1){
                            $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">This clinic has completed your appointment....</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(creates_appoint))+'</td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                        }else if(val.status == 8){

                            $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment on <b>'+dateToYMD(new Date(dates_appoint))+'</b> at <b>'+tConv24(times_appoint)+'</b> was <b>Cancelled</b>...</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(creates_appoint))+'</td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        }else if(val.status == 6){

                            $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your Appointment from this Clinic has been <b>Expired</b>....</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(creates_appoint))+'</td> <td><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        }else{
                            $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(dates_appoint))+'</b> at <b>'+tConv24(times_appoint)+'</b>...</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(creates_appoint))+'</td><td><a href="#" data-bs-toggle="modal" data-bs-target="#cancel_modal_up" id="cancel_modal" data-id="'+val.id+'" ><i class="fa fa-ban text-danger" aria-hidden="true"></i></a></td> </tr>');
                        }

                        });
                    
                    }
                        
                        
                     
                 },
                 error: function(){
                     console.log('AJAX load did not work');
                    //  alert("error");
                 }
             });
        }
            
        
    });


    // Search Appointment
    $('#search').on('keyup', function(){
        // e.preventDefault();
        var query = $(this).val();
        if(query.length >= 3){
            // console.log(query); 
            var id = 0;
            $.ajax({
                type: "GET",
                url: "/customer/mail/create",
                data: {query:query},
                success: function(data){

                // console.log(data);

                if(data.status == 1){

                    if(data.all.length == 0 ){
                        // alert("mm");
                        $("#info").empty();
                        $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">Hi, Welcome to MR. JAMS </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');

                    }else{
                        $("#info").empty();
                        $.each(data.all, function(index, val){

                            time_appoint = val.time;
                            date_appoint = val.appointed_at;
                            create_appoint = val.created_at;

                            function tConv24(time_appoint) {
                                var ts = time_appoint;
                                var H = +ts.substr(0, 2);
                                var h = (H % 12) || 12;
                                h = (h < 10)?("0"+h):h;  // leading 0 at the left for 1 digit hours
                                var ampm = H < 12 ? " AM" : " PM";
                                ts = h + ts.substr(2, 3) + ampm;
                                return ts;
                            };
    
                            function dateToYMD(date_appoint) {
                                var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                var d = date_appoint.getDate();
                                var m = strArray[date_appoint.getMonth()];
                                var y = date_appoint.getFullYear();
                                return '' + (d <= 9 ? '0' + d : d) + '-' + m + '-' + y;
                            }
                           
                            function datesToYMD(create_appoint) {
                                var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                var d = create_appoint.getDate();
                                var m = strArray[create_appoint.getMonth()];
                                var y = create_appoint.getFullYear();
                                return '' + (d <= 9 ? '0' + d : d) + '-' + m + '-' + y;
                            } 

                            appointStatus = val.status;
                            if(appointStatus == 1){
                                color = "success";
                            }else if(appointStatus == 2){
                                color = "warning";
                            }else if(appointStatus == 3){
                                color = "danger";
                            }else if(appointStatus == 4){
                                color = "primary";
                            }else if(appointStatus == 5){
                                color = "muted";
                            }else if(appointStatus == 6){
                                color = "dark";
                            }else if(appointStatus == 8){
                                color = "secondary";
                            }else{
                                color = "danger";
                            }
    
                            if(val.status == 5){
                                $("#info").append('<tr><th scope="row">'+val.id+'</th> <td><i class="fa fa-star text-'+color+'"style="padding-left: 50px;"></i></td> <td ><b>'+val.name+'</b></td> <td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"> The clinic would like to reschedule you on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b>...</a></td> <td><button type="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#accept_modal_up" id="accept_modal" data-id="'+val.id+'" ><i class="fa fa-check" aria-hidden="true"></i> </button> <button type="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#decline_modal_up" id="decline_modal" data-id="'+val.id+'" ><i class="fa fa-times" aria-hidden="true"></i> </button></td> <td>'+datesToYMD(new Date(create_appoint))+'</td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#cancel_modal_up" id="cancel_modal" data-id="'+val.id+'" ><i class="fa fa-ban text-danger" aria-hidden="true"></i></a></td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
    
                            }else if(val.status == 1){
                                $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">This clinic has completed your appointment....</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(create_appoint))+'</td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                            }else if(val.status == 8){
    
                                $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b> was <b>Cancelled</b>...</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(create_appoint))+'</td><td><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
    
                            }else if(val.status == 6){
    
                                $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your Appointment from this Clinic has been <b>Expired</b>....</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(create_appoint))+'</td><td><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
    
                            }else{
                                $("#info").append('<tr><th scope="row">'+val.id+'</th><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td><b>'+val.name+'</b></td><td><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b>...</a></td><td><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td>'+datesToYMD(new Date(create_appoint))+'</td><td><a href="#" data-bs-toggle="modal" data-bs-target="#cancel_modal_up" id="cancel_modal" data-id="'+val.id+'" ><i class="fa fa-ban text-danger" aria-hidden="true"></i></a></td> <td><a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_up" id="delete_modal" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                            }
        
                            
                       });
                    }

                }else{

                        $("#info").empty();
                        $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">Hi, Welcome to MR. JAMS </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');

                }
                
                    
                },
                error: function(){
                    console.log('AJAX load did not work');
                    // alert("error");
                }
            });
            
        }if(query.length == 0){
            $("#info").empty();
            appointment_data();
        }
        else{
            // $("#info").empty();
            // clinic_data();
           
        }
        
    });

    
     
});
 