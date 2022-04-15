$(function(){

    // polling technique, check notif every 5 secs
    var timer = setInterval( updateNotification, 5000);
    function updateNotification(){
        
        $.ajax({
            type: "GET",
            url: "/customer/customerLogs/0",
            success: function(data){
                // console.log(data);
                if(data.data != ""){
                    $('#notification_list').empty();
                    
                    $.each(data.data, function(key, val){
                        if(val.message.includes("requested")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar-plus-o fs-3 text-warning" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("accepted")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar-check-o fs-3 text-primary" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("deleted")){
                            $('#notification_list').append('<a href="#" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-trash fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("cancelled")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar-times-o fs-3 text-secondary" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("Welcome")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-hand-peace-o fs-3 text-dark" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("negotiating")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-muted"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-comments fs-3 text-dark" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("declined")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar-times-o fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("is now finished. Thank you!")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-check-square-o fs-3 text-success" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("expired")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-times fs-3 text-dark" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("is complete. Thank you")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-check-square fs-3 text-success" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("balance left.")){
                            $('#notification_list').append('<a href="/customer/mail" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-money fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }



                        



                        
                    });

                    if(data.notif_count.length > 0){
                        $('#notif_count').text(data.notif_count.length)
                        //$('#ForNotifications').removeAttr('hidden');
                        $('#notif_count').removeAttr('hidden');
                    }
                }else{
                    $('#ForNotifications').attr("hidden",true);
                }
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });


    }

    updateNotification();


    

    $(document).on('click', '#notifIcon_btn', function(e) {
        $.ajax({
            type: "DELETE",
            url: "/customer/customerLogs/0",
            data:{
                _token: $("input[name=_token]").val()
            },
            beforeSend: function() {
                $('#notif_count').attr('hidden', true);
            },
            success: function(data) {
                // console.log(data);
                $('#notif_count').attr('hidden', true);
            },
            error: function(error) {
                console.log('error');
            }
        });
    })



})