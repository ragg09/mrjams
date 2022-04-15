$(function () {

    //to load charts
    //google.load('visualization', '1.0', {'packages':['corechart']});

    var resizeTimer;
    $(window).on('resize', function(e) {

        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {

            console.log("DONE!");
            dashboard();
                    
        }, 250);

    });

    $("#dashboard_table").load(window.location + " #dashboard_table");
    
    dashboard();
    
    var timer = setInterval( updatedashboard_table_logs, 5000);
    // polling techniquw
    function updatedashboard_table_logs(){
        //console.log("pasok");
        //dashboard();
        //$("#dashboard_table").load(window.location + " #dashboard_table");
    }

    // var id = 0;
    //     $.ajax({
    //         type: "GET",
    //         url: "/clinic/appointment/"+id,
    //         success: function(data){
    //             // console.log(data);
                
    //             if(data_count == 0){
    //                 data_count = data.data;
    //                 console.log("convert data count to count from db");
    //             }else{
    //                 if(data.data != data_count){
    //                     data_count = data.data;
    //                     console.log("pasok sa refresh");
    //                     $("#appointment_table").load(window.location + " #appointment_table");
    //                 }else{
    //                     data_count = data.data;
    //                     console.log("renew data count");
    //                 }
    //             }

    //         },
    //         error: function(){
    //             console.log('AJAX load did not work');
    //             alert("error");
    //         }
    //     });

    function EmptyCalendar() {
        var calendarEl = document.getElementById('calendar_div');
                    
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridDay'
            },
            //initialView: 'timeGridDay',
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            // editable: true,
            selectable: true,
                    
        });
        calendar.render();
        
    }

    function dashboard() {
        $.ajax({
            type: "GET",
            url: "/clinic/dashboard",
            beforeSend: function(){
                EmptyCalendar();
            },
            success: function(data){
                // console.log(data);
                var edata = [];
                
                if(data.status == 0){
                    EmptyCalendar();
                }else{
                    $.each(data.data, function(index, val){
                        
                        edata.push({
                            title: "Receipt order: ~" + val.ro_id + "~ " +val.ro_patient_details,
                            //start: moment(val.app_created_at).format("YYYY-MM-DD")+"T00:12:00",
                            start: moment(val.app_appointed_at).format("YYYY-MM-DD")+"T"+val.time,
                            //constraint: "businessHours",
                        })
                    });

                    var calendarEl = document.getElementById('calendar_div');
                    
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridDay'
                        },
                        //initialView: 'timeGridDay',
                        navLinks: true, // can click day/week names to navigate views
                        businessHours: true, // display business hours
                        //editable: true,
                        contentHeight: 700,
                        selectable: true,
                        events: edata,
                        eventClick: function(arg) {
                            data = arg.event.title;
                            var get_id = data.substring(
                                data.indexOf("~") + 1, 
                                data.lastIndexOf("~")
                            );
                            
                            //console.log(get_id);

                            $.ajax({
                                type: "GET",
                                url: "/clinic/appointment/" + get_id,
                                success: function(data){
                                    // console.log(data);
                                    
                                    $("#ro_id_done").val(get_id);
                    
                                    $("#proceed_billing").attr('href', "/clinic/billing/"+get_id);
                                    $("#accepted_detail_modal_body").empty();
                    
                                    $("#accepted_detail_modal_body").append('<div class="col-lg-5" style="border-right: 1px solid black"><div class="row d-flex align-items-baseline"><div class="col-lg-4 col-md-4 col-sm-4"><img class="rounded-circle" src="'+data.data.user_avatar+'"></div><div class="col-lg-8 col-md-8 col-sm-8 align-bottom"><span>'+data.data.user_contact+'<br>'+data.data.user_email+'</span></div></div><div class="row mt-4 mx-4"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.user_name+'</p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.user_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.user_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.user_address+' </p></div></div><div class="col-lg-7 mt-md-5 mt-sm-5 mt-lg-0"><div class="row"><h2>Patient</h2><div class="col-lg-4 d-flex align-items-center justify-content-center"><i class="fas fa-briefcase-medical" style="font-size: 60px"></i></div><div class="col-lg-8"><h4 class="mx-4">&#x2022;'+data.data.package_service+'</h4></div></div><div class="row mt-5 mx-2"><p><i class="fas fa-user-tag mx-3"></i> '+data.data.patient_name+' </p><p><i class="fas fa-venus-mars mx-3"></i>'+data.data.patient_gender+' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>'+data.data.patient_age+' y/o </p><p><i class="fas fa-address-book mx-3"></i> '+data.data.patient_address+' </p></div></div>');
                    
                                    
                                },
                                error: function(){
                                    console.log('AJAX load did not work');
                                    alert("error");
                                }
                            });


                            $('#accepted_view_detail_modal_up').modal('show'); 
                        },
                    
                    });


                    calendar.render();
                }

                // var data_arr = [
                //     ['Date', 'Count'],
                // ];
                
                // $.each(data.data, function(key, val){
                //     //push data to "data_arr" to create the table
                //     data_arr.push([val.date, val.total]);
                // });

                // var options = {
                //     title: 'Logs Per Day || PAPALITAN KO PA TO EXAMPLE LANG',
                //     vAxis: {
                //         title: 'Count'
                //     },
                //     curveType: 'function',
                //     legend: { position: 'bottom' }
                // };

                // var figure = google.visualization.arrayToDataTable(data_arr);

                // var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                // chart.draw(figure, options);

                
            },
            error: function(){
                console.log('AJAX load did not work');
                alert("error");
            }
        });
    }

    // google.charts.load('current', {'packages':['corechart']});
    //   google.charts.setOnLoadCallback(drawChart);

    //   function drawChart() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['Date', 'Count', 'Expenses'],
    //       ['2004',  1000,      400],
    //       ['2005',  1170,      460],
    //       ['2006',  660,       1120],
    //       ['2007',  1030,      540]
    //     ]);

    //     var options = {
    //       title: 'Company Performance',
    //       vAxis: {
    //         title: 'Count'
    //       },
    //       curveType: 'function',
    //       legend: { position: 'bottom' }
    //     };

    //     var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    //     chart.draw(data, options);
    //   } 

});