$(function(){
    appointment_data();

    function appointment_data() {
        //alert('try');
        var id = 0;
        var appointStatus;
        var color;

        $.ajax({
            type: "GET",
            url: "/customer/mail/"+id,
            success: function(data){
                console.log(data.all);

                if(data.status == 0 ){

                    // $.each(data.customer, function(index, val){

                    $("#info").empty();
                    $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">Hi, Welcome to MR. JAMS </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');

                    // });


                }else{

                    $.each(data.all, function(index, val){

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
                        
    
                        $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message ">'+val.name+'</td><td class="view-message  inbox-small-cells"><a href="/customer/mail/'+val.id+'"><i class="fa fa-eye" style="color: #000;"></i></a></td><td class="view-message ">'+val.appointed_at+'</td><td class="view-message ">'+val.created_at+'</td><td class="view-message "><a href="#" id="deleteStat" data-id="'+val.id+'" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a></td></tr>');
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
                if(e.status == "OK")
                {
                    alert("Successfully deleted!  - NEED PA AYUSIN");
                    $("#info").empty();
                    appointment_data();
                    // location.reload();
                    // $("#appointList").load(window.location + " #appointList");
                }
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
             console.log(id);
             $.ajax({
                 type: "GET",
                 url: "/customer/mail/"+id+" status",
                 success: function(data){
                    console.log(data.all);

                    if(data.status == 0 ){
                        
                    $("#info").empty();
                    $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">Hi, Welcome to MR. JAMS </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');

                    }else{
                        $("#info").empty();
                        $.each(data.all, function(index, val){
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
                           
                           $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message ">'+val.name+'</td><td class="view-message  inbox-small-cells"><a href="/customer/mail/'+val.id+'"><i class="fa fa-eye" style="color: #000;"></i></a></td><td class="view-message ">'+val.appointed_at+'</td><td class="view-message ">'+val.created_at+'</td><td class="view-message "><a href="#" class="btn btn-outline-primary" id="delete" data-id="'+val.id+'" >trash</a></td></tr>');
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

    $('#search').on('keyup', function(){
        // e.preventDefault();
        var query = $(this).val();
        if(query.length >= 3){
            // console.log(query); 
            var id = 0;
            $.ajax({
                type: "GET",
                url: "customer/mail/"+id+"/edit",
                data: {query:query},
                success: function(data){
                // console.log(data);
                if(data.status == 1){

                    if(data.ClinicAppoint.length == 0 ){
                        // alert("mm");
                        $("#info").empty();
                        $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">No More Appointments </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');


                    }else{
                        // alert("try");

                            $("#info").empty();
                            $.each(data.ClinicAppoint, function(index, val){
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
                                
                                $("#info").append('<tr><td class="view-message ">'+val.id+'</td><td class="inbox-small-cells"><i class="fa fa-star text-'+color+'" style="padding-left: 50px;"></i></td><td class="view-message ">'+val.name+'</td><td class="view-message  inbox-small-cells"><a href="/customer/mail/'+val.id+'"><i class="fa fa-eye" style="color: #000;"></i></a></td><td class="view-message ">'+val.appointed_at+'</td><td class="view-message ">'+val.created_at+'</td><td class="view-message "><a href="#" class="btn btn-outline-primary" id="delete" data-id="'+val.id+'" >trash</a></td></tr>');
                         });
                    }

                }else{

                    $("#info").empty();
                    $("#info").append('<tr><td class="view-message "></td><td class="inbox-small-cells"><i class="fa fa-star" style="padding-left: 50px; color: #6497B1"></i></td><td class="view-message ">No More Appointments </td><td class="view-message  inbox-small-cells"><a href="/customer/mail/"></a></td><td class="view-message "></td><td class="view-message "></td><td class="view-message "></td></tr>');
                }
                
                    
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
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
 