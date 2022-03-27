$(function(){
    appointment_data();

     //calling reusable script
     $.getScript("../../js/customer/reusableFunction.js");

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
                // console.log(data.customer);
                $('#customerName').text(data.customer.lname+', '+data.customer.fname);
                

                if(data.status == 0 ){

                    // $.each(data.customer, function(index, val){

                    $("#info").empty();
                    $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">Hi, Welcome to MR. JAMS </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');

                    // });


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
                            return '' + (d <= 9 ? '0' + d : d) + '-' + m + '-' + y;
                        }
                        // console.log(dateToYMD(new Date(date_appoint)));

                        create_appoint = val.created_at;

                        function datesToYMD(create_appoint) {
                            var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                            var d = create_appoint.getDate();
                            var m = strArray[create_appoint.getMonth()];
                            var y = create_appoint.getFullYear();
                            return '' + (d <= 9 ? '0' + d : d) + '-' + m + '-' + y;
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
                            color = "danger";
                        }else{
                            color = "danger";
                        }

                        // $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b>...</a></td><td class="view-message ">'+datesToYMD(new Date(create_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                        // console.log(val.status);

                        if(val.status == 5){
                            $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;"> The clinic would like to reschedule you on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b>...</a></td><td class="view-message "><button type="" class="btn btn-info" id="acceptStat" data-id="'+val.id+'" ><i class="fa fa-check" aria-hidden="true"></i> </button> <button type="" class="btn btn-danger" id="declineStat" data-id="'+val.id+'" ><i class="fa fa-times" aria-hidden="true"></i> </button></td><td class="view-message ">'+datesToYMD(new Date(create_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        }else if(val.status == 1){
                            $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">This clinic has completed your appointment....</a></td><td class="view-message "><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td class="view-message ">'+datesToYMD(new Date(create_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                        }
                        else{
                            $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(date_appoint))+'</b> at <b>'+tConv24(time_appoint)+'</b>...</a></td><td class="view-message "><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td class="view-message ">'+datesToYMD(new Date(create_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                        }
    
                        
                   });

                }

            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    }

    $(document).on('click', '#deleteStat[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id'); 
        // $("#aStatus-Delete").attr('action', "/customer/mail/"+id);
        $.ajax({
            method: "DELETE",
            url: "/customer/mail/"+id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(e){
                // console.log(e);

               bootstrapAlert("The Appointment is Successfully Deleted!", "danger", 330);

                // if(e.status == "OK")
                // {
                //     alert("Successfully deleted!  - NEED PA AYUSIN");
                    $("#info").empty();
                    appointment_data();
                    // location.reload();
                    //$("#appointList").load(window.location + " #appointList");
                // }
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    $(document).on('click', '#acceptStat[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id'); 
        // $("#aStatus-Delete").attr('action', "/customer/mail/"+id);
        $.ajax({
            method: "DELETE",
            url: "/customer/appointment/"+id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(e){
                // console.log(e);
                    bootstrapAlert("The Appointment is Successfully Accepted!", "primary", 350);
             
                    $("#info").empty();
                    appointment_data();
                   
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });

    $(document).on('click', '#declineStat[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id'); 
        // $("#aStatus-Delete").attr('action', "/customer/mail/"+id);
        $.ajax({
            method: "DELETE",
            url: "/customer/clinicList/"+id,
            data:{
                _token: $("input[name=_token]").val()
            },
            success: function(e){
                // console.log(e);
                    bootstrapAlert("The Appointment is Declined!", "danger", 290);
                
                    $("#info").empty();
                    appointment_data();
                   
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    });


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
                    console.log(data.all);

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
    
                            console.log(tConv24(times_appoint));

    
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
                               color = "danger";
                           }else{
                               color = "danger";
                           }
                        //    '+tConv24(times_appoint)+'

                        //    $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(dates_appoint))+'</b> at <b> '+tConv24(times_appoint)+'</b>...</a></td><td class="view-message ">'+datesToYMD(new Date(creates_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        if(val.status == 5){
                            $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(dates_appoint))+'</b> at <b>'+tConv24(times_appoint)+'</b>...</a></td><td class="view-message "><button type="submit" class="btn btn-info" id="accept"><i class="fa fa-check" aria-hidden="true"></i> </button> <button type="submit" class="btn btn-danger" id="decline"><i class="fa fa-times" aria-hidden="true"></i> </button></td><td class="view-message ">'+datesToYMD(new Date(creates_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');

                        }else if(val.status == 1){
                            $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">This clinic has completed your appointment....</a></td><td class="view-message "><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td class="view-message ">'+datesToYMD(new Date(creates_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                        }else{
                            $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message "><b>'+val.name+'</b></td><td class="view-message "><a href="/customer/mail/'+val.id+'" style="color:black; text-decoration: none;">Your appointment is scheduled on <b>'+dateToYMD(new Date(dates_appoint))+'</b> at <b>'+tConv24(times_appoint)+'</b>...</a></td><td class="view-message "><button class="btn btn-'+color+'" id="stat" style="border-radius: 15px;">'+val.remark+'</button></td><td class="view-message ">'+datesToYMD(new Date(creates_appoint))+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
                        }

                        });
                    
                    }
                        
                        
                     
                 },
                 error: function(){
                     console.log('AJAX load did not work');
                     alert("error");
                 }
             });
        }
            
        
    });

    
     
});
 