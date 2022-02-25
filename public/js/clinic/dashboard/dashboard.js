$(document).ready(function () {

    //to load charts
    google.load('visualization', '1.0', {'packages':['corechart']});

    $("#dashboard_table").load(window.location + " #dashboard_table");
    
    dashboard();
    
    var timer = setInterval( updatedashboard_table_logs, 5000);
    // polling techniquw
    function updatedashboard_table_logs(){
        //console.log("pasok");
        dashboard();
        $("#dashboard_table").load(window.location + " #dashboard_table");
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

    function dashboard() {
        $.ajax({
            type: "GET",
            url: "/clinic/dashboard",
            success: function(data){
                //console.log(data);
                var edata = [];
                
                if(data.status == 0){
                    var calendarEl = document.getElementById('calendar_div');
                    
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

                    var calendarEl = document.getElementById('calendar_div');
                    
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