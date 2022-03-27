$(function(){

    //calling reusable script
    $.getScript("/js/clinic/reusableFunction.js");

    var days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

    function AutoSchedDataProcessing(){
        $("#auto_sched_btn").removeAttr("disabled");
                var all_day_summary = "";
                $.each(days, function(key, value){
                    var this_day = "";

                    for (let i = 1; i < 25; i++) { 
                        if($("#"+value+"_"+i).is(':checked')){
                            
                            this_day = this_day + "o";
                        }else{
                           
                            this_day = this_day + "x";
                        }
                    }


                    //for day status
                    if($("#"+value+"_status").is(':checked')){
                        var this_day_status = "on";
                    }else{
                       
                        var this_day_status = "off";
                    }

                    //for auto accept input
                    if($("#auto_accept_switch").is(':checked')){
                        $("#auto_accept").val("on")
                    }else{
                       
                        $("#auto_accept").val("off")
                    }

                    //for auto accept input
                    if($("#auto_fill_date_switch").is(':checked')){
                        $("#auto_fill_date").val("on")
                    }else{
                       
                        $("#auto_fill_date").val("off")
                    }
                    
                    //console.log(value+":" + this_day_status +"*"+ this_day);


                    all_day_summary = all_day_summary + this_day_status +"*"+ this_day + "&";

                    

                    this_day = "";



                });
                //console.log(all_day_summary.slice(0, -1));
                $("#auto_summary").val(all_day_summary.slice(0, -1));
    }

    $.each(days, function(key, val){
        //map each inputs of 
        $("#div_"+val).map(function(){
            $(this).find('input').on('change', function(e){
                AutoSchedDataProcessing();
            });
        })
        //buttons for toggle
        $('#btn_'+val).on('click', function(){
            $('#div_'+val).slideToggle('fast');
        });
    });

    $("#auto_accept_switch").on('change', function(e){
        AutoSchedDataProcessing();
    });

    $("#auto_fill_date_switch").on('change', function(e){
        AutoSchedDataProcessing();
    });

    $("#edit_autosched_form").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData();
        formData.append('username', 'Chris');
        formData.append('asdasd', 'Chris');
        formData.append('asdasd', 'Chris');

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#edit_autosched_form').serialize(),
            success: function(data) {
                //console.log(data);
                bootstrapAlert(data.message, "success", 300);
                $("#auto_sched_btn").prop("disabled", true);
            }
        });
    });










    for (let i = 0; i < 8; i++) { 
        $("#min_time"+i).flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    
        $("#max_time"+i).flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    }

    $("#edit_timedate_form").map(function(){
        $(this).find('input').on('change', function(e){
            $("#timedata_btn").prop("disabled", false);
        });
    })

    $("#edit_timedate_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#edit_timedate_form').serialize(),
            success: function(data) {
                bootstrapAlert(data.message, "success", 300);
                $("#timedata_btn").prop("disabled", true);
            }
        });
    });
})