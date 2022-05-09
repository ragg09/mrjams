$(function(){

    // polling technique, check notif every 5 secs
    var timer = setInterval( updateNotification, 5000);
    

    function updateNotification(){
        
        $.ajax({
            type: "GET",
            url: "/clinic/logs/0",
            success: function(data){
                // console.log(data.rate);

                $('#rating_in_drodwn').text(data.clinic.name);

                if(data.rate){
                    $('#numerical_rating').text(data.rate.toFixed(2));
                    $(".my-rating").starRating({
                        starSize: 25,
                        setReadOnly: true,
                        initialRating: data.rate,
                        readOnly: true,
                        useGradient: false,
                        forceRoundUp: false,
                        
                    });

                }else{
                    $('#numerical_rating').text("No ratings yet");
                    $(".my-rating").starRating({
                        starSize: 25,
                        setReadOnly: true,
                        initialRating: 0,
                        readOnly: true,
                        useGradient: false,
                        forceRoundUp: false,
                        
                    });
                }
                

                

                if(data.data != ""){
                    $('#notification_list').empty();
                    
                    $.each(data.data, function(key, val){
                        if(val.message.includes("Stock left")){
                            $('#notification_list').append('<a href="/clinic/equipments" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-exclamation-circle fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("requested an appointment")){
                            $('#notification_list').append('<a href="/clinic/appointment/create" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-warning" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("agreed to the suggested appointment day and time")){
                            $('#notification_list').append('<a href="/clinic/appointment" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-primary" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("declined to the suggested appointment")){
                            $('#notification_list').append('<a href="" onclick="(function(e){e.preventDefault();})(event)" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("be informed that you are now using the next stock in your inventory")){
                            $('#notification_list').append('<a href="" onclick="(function(e){e.preventDefault();})(event)" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-shopping-cart fs-3 text-warning" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("the system will automatically remove it to your inventory")){
                            $('#notification_list').append('<a href="" onclick="(function(e){e.preventDefault();})(event)" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-shopping-cart  text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("Welcome")){
                            $('#notification_list').append('<a href="" onclick="(function(e){e.preventDefault();})(event)" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-map-marker fs-3 text-dark" aria-hidden="true"></i></div><div class="col-10"><p style="font-size: 13px;">'+val.message+'</p><p style="margin-top: -10px; font-size: 12px; color: #6497B1">'+val.date +' '+ val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("Announcement Notice")){
                            $('#notification_list').append('<a href="/clinic/announcement" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-bullhorn fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("cancelled")){
                            $('#notification_list').append('<a href="/clinic/appointment" onclick="(function(e){e.preventDefault();})(event)" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
                        }else if(val.message.includes("expired")){
                            $('#notification_list').append('<a href="" onclick="(function(e){e.preventDefault();})(event)" class="text-decoration-none text-dark"><li class="pt-2 pb-2 m-1  rounded"><div style="width: 400px"><div class="row m-1"><div class="col-2 my-auto"><i class="fa fa-calendar fs-3 text-danger" aria-hidden="true"></i></div><div class="col-10"><p>'+val.message.toUpperCase()+'</p><p class="text-muted" style="margin-top: -20px; font-size: 12px;">'+val.date + val.time+'</p></div></div></div></li></a>');
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
            error: function(error){
                console.log(error);
                // alert("error");
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