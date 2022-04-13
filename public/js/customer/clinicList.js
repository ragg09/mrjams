$(function(){
    clinic_data();

    // clinic List
    function clinic_data() {
        //alert('try');
        var id = 0;
        var packagee;
        $.ajax({
            type: "GET",
            url: "/customer/clinicList/create",
            success: function(data){
                // console.log(data);

                $('#customerName').text(data.customer.lname+', '+data.customer.fname);

                if(data.status == 0 ){
                    $("#info").empty();
                    $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px;"></h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><img src="../images/mrjams/noData.jpg" width="100%"></div></div>');

                }else{

                    $("#info").empty();
                    $.each(data.all, function(index, val){
                        $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px; font-weight:bold;">'+val.type_of_clinic+' Clinic | Address: '+val.address_line_1+', '+val.address_line_2+'</h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><h5 class="card-title" style="font-size: 45px;">'+val.name+'</h5><p class="card-text"><strong>Packages: </strong>'+val.package+'... | <strong>Services: </strong>'+val.service+'...</p><br><a href="/customer/appointment/'+val.id+'" class="btn btn-primary" style="background-color:#6497B1; margin-top: 5px;">View More</a></div></div>');
                   });
    
                }
               
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    }


    $('#search').on('keyup', function(){
        // e.preventDefault();
        var query = $(this).val();
        if(query.length >= 3){
            // console.log(query); 
            var id = 0;
            $.ajax({
                type: "GET",
                url: "/customer/clinicList/"+id,
                data: {query:query},
                success: function(data){
                // console.log(data);
                if(data.status == 1){

                    if(data.ClinicAdd.length == 0 ){
                        // alert("mm");
                        $("#info").empty();
                        $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px;"></h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><img src="../images/mrjams/noData.jpg" width="100%"></div></div>');

                    }else{
                        // alert("try");

                            $("#info").empty();
                            $.each(data.ClinicAdd, function(index, val){
                                $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px; font-weight:bold;">'+val.type+' Clinic | Address: '+val.addLine1+', '+val.addLine2+'</h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><h5 class="card-title" style="font-size: 45px;">'+val.name+'</h5><p class="card-text"><strong>Packages: </strong>'+val.package+'... | <strong>Services: </strong>'+val.service+'...</p><br><a href="/customer/appointment/'+val.id+'"  class="btn btn-primary" style="background-color:#6497B1; margin-top: 5px;">View More</a></div></div>');
                            });
                    }

                }else{

                    $("#info").empty();
                    $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px;"></h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><img src="../images/mrjams/noData.jpg" width="100%"></div></div>');

                }
                
                    
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
            
        }if(query.length == 0){
            $("#info").empty();
            clinic_data();
        }
        else{
            // $("#info").empty();
            // clinic_data();
           
        }
        
    });

    $('#ClinicType').click(function(){
        // e.preventDefault();
        var query = $(this).val();
        if(query == "ClinicTypes"){
            $("#info").empty();
            clinic_data();
        }else{
             // console.log(query);
             var id = 1;
             $.ajax({
                 type: "GET",
                 url: "/customer/clinicList/"+id,
                 data: {query:query},
                 success: function(data){
                    //  console.log(data);

                        if(data.status == 1){

                            if(data.ClinicAdd.length == 0 ){
                                // alert("mm");
                                $("#info").empty();
                                $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px;"></h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><img src="../images/mrjams/noData.jpg" width="100%"></div></div>');
        
                            }else{
                                // alert("try");
        
                                    $("#info").empty();
                                    $.each(data.ClinicAdd, function(index, val){
                                        $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px; font-weight:bold;">'+val.type+' Clinic | Address: '+val.addLine1+', '+val.addLine2+'</h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><h5 class="card-title" style="font-size: 45px;">'+val.name+'</h5><p class="card-text"><strong>Packages: </strong>'+val.package+'... | <strong>Services: </strong>'+val.service+'...</p><br><a href="/customer/appointment/'+val.id+'"  class="btn btn-primary" style="background-color:#6497B1; margin-top: 5px;">View More</a></div></div>');
                                });
                            }
        
                        }else{
        
                            $("#info").empty();
                            $("#info").append('<div style="width:60%; margin-left: 20%; margin-right: 20%; padding-top:20px;"><h5 class="card-header" style="background-color:#B3CDE0; font-size: 15px;"></h5><div class="card-body" style="text-align:center; width:100%; border-bottom: 5px solid #B3CDE0;"><img src="../images/mrjams/noData.jpg" width="100%"></div></div>');
        
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
 