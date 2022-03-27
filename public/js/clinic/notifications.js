$(function(){

    // polling technique, check notif every 5 secs
    var timer = setInterval( updateNotification, 5000);
    function updateNotification(){
        
        $.ajax({
            type: "GET",
            url: "/clinic/logs/0",
            success: function(data){
                //console.log(data);
                if(data.data != ""){
                    $('#notification_list').empty();
                    
                    $.each(data.data, function(key, val){
                        if(val.message.includes("Stock left")){
                            $('#notification_list').append('<a href="/clinic/equipments" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-exclamation-circle fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("requested an appointment")){
                            $('#notification_list').append('<a href="/clinic/appointment/create" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-warning" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("agreed to the suggested appointment day and time")){
                            $('#notification_list').append('<a href="/clinic/appointment" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-primary" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("declined to the suggested appointment")){
                            $('#notification_list').append('<a href="" onclick="(function(e){e.preventDefault();})(event)" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
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
            url: "/clinic/logs/0",
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