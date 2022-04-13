$(function(){
    //to load charts
    google.charts.load("current", {packages:["corechart"]});

    var resizeTimer;
    $(window).on('resize', function(e) {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            ReportStatistics();     
        }, 200);
    });

    //calling Reports
    ReportStatistics();
    
    function ReportStatistics() {
        $.ajax({
            type: "GET",
            url: "/clinic/report/create",
            success: function(data){
                console.log(data);

                //TOP APPOINTMENTS
                if(data.appointment_stats && data.appointment_stats.length >= 5){

                    var total_incoming = 0;
                    var total_done = 0;
                    
                    $.each(data.appointment_stats, function(key, val){
                        total_incoming += val.incoming;
                        total_done += val.done;
                    });

                    $('#appointment_numerical').empty();
                    $('#appointment_numerical').append('<h6 class="text-end">Last '+data.appointment_stats.length+' Days<br>'+total_done+'/'+total_incoming+'</h6>');

                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data_arr = [
                            ['Date', 'Incoming', 'Done'],
                        ];
                        
                        for (let index = 0; index < 30; index++) {
                            if(data.appointment_stats[index]){
                                
                                data_arr.push([moment(data.appointment_stats[index].date).format('MMM D'), data.appointment_stats[index].incoming, data.appointment_stats[index].done]);
                            }
                        }


                        var options = {
                        title: 'Appointment Comparison between Incoming and Done',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                        };
                        
                        var figure = google.visualization.arrayToDataTable(data_arr);
                        var chart = new google.visualization.LineChart(document.getElementById('appointments_chart'));
                
                        chart.draw(figure, options);
                    }
                }else{
                    $('#appointments_chart').empty();
                    $('#appointments_chart').append('<div class="d-flex justify-content-center"><h5>Not enough data to show Appointment Statistics</h5><div class="spinner-border text-dark mx-3" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                }
                //^^TOP APPOINTMENTS
                
                //TOP SERVICES
                if(data.services_stats && data.services_stats.length >= 5){
                    var sorted_services = data.services_stats;
                    sorted_services.sort(function(a, b){
                        var a1= a.count, b1= b.count;
                        if(a1== b1) return 0;
                        return a1< b1? 1: -1;
                    });
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data_arr = [
                            ['Name', 'Total'],
                        ];
                        
                        for (let index = 0; index < 5; index++) {
                            data_arr.push([sorted_services[index].name, sorted_services[index].count]);
                        }

                        // $.each(sorted_services, function(key, val){
                        //     //push data to "data_arr" to create the table
                        //     data_arr.push([val.name, val.count]);

                        //     console.log(key);
                        //     // if (obj.name === 'Steph') {
                        //     //     break;
                        //     //   }
                        // });
        
                        var options = {
                            title: 'Top Selected Services Of Customer From Your Clinic',
                            vAxis: {
                                title: 'Count',
                                viewWindow:{
                                    //max:data.services_count, 
                                    min: 0, 
                                }
                            },
                            curveType: 'function',
                            legend: { position: 'none' }
                        };
                        var figure = google.visualization.arrayToDataTable(data_arr);
                        var chart = new google.visualization.ColumnChart(document.getElementById('services_chart'));
                        chart.draw(figure, options);
                    }
                }else{
                    $('#services_chart').empty();
                    $('#services_chart').append('<div class="d-flex justify-content-center"><h5>Not enough data to show Services Statistics</h5><div class="spinner-border text-dark mx-3" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                }
                //^^TOP SERVICES

                //TOP PACKAGE
                if(data.packages_stats && data.packages_stats.length >= 5){
                    var sorted_packages = data.packages_stats;
                    sorted_packages.sort(function(a, b){
                        var a1= a.count, b1= b.count;
                        if(a1== b1) return 0;
                        return a1< b1? 1: -1;
                    });
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data_arr = [
                            ['Name', 'Total'],
                        ];
                        
                        for (let index = 0; index < 5; index++) {
                            data_arr.push([sorted_packages[index].name, sorted_packages[index].count]);
                        }

                        // $.each(sorted_packages, function(key, val){
                        //     //push data to "data_arr" to create the table
                        //     data_arr.push([val.name, val.count]);

                        //     console.log(key);
                        //     // if (obj.name === 'Steph') {
                        //     //     break;
                        //     //   }
                        // });
        
                        var options = {
                            title: 'Top Selected Packages Of Customer From Your Clinic',
                            vAxis: {
                                title: 'Count',
                                viewWindow:{
                                    //max:data.packages_count, 
                                    min: 0, 
                                }
                            },
                            curveType: 'function',
                            legend: { position: 'none' }
                        };
                        var figure = google.visualization.arrayToDataTable(data_arr);
                        var chart = new google.visualization.ColumnChart(document.getElementById('packages_chart'));
                        chart.draw(figure, options);
                    }
                }else{
                    $('#packages_chart').empty();
                    $('#packages_chart').append('<div class="d-flex justify-content-center"><h5>Not enough data to show packages Statistics</h5><div class="spinner-border text-dark mx-3" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                }
                //^^TOP PACKAGE

                //TOP MATERIAL
                if(data.materials_stats && data.materials_stats.length >= 10){

                    //print summary visbility of condition passes
                    if(data.appointment_stats.length >= 5 && data.services_stats.length >= 5 && data.packages_stats.length >= 5 &&data.materials_stats.length >= 10){
                        $('#print_summary').removeAttr("hidden");
                    }
                    //print invetory visbility of condition passes
                    $('#print_inventory').removeAttr("hidden");

                    var sorted_materials = data.materials_stats;
                    sorted_materials.sort(function(a, b){
                        var a1= a.count, b1= b.count;
                        if(a1== b1) return 0;
                        return a1< b1? 1: -1;
                    });
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data_arr = [
                            ['Name', 'Total'],
                        ];
                        
                        for (let index = 0; index < 10; index++) {
                            if(sorted_materials[index]){
                                data_arr.push([sorted_materials[index].name, sorted_materials[index].count]);
                            }
                        }

                        // $.each(sorted_materials, function(key, val){
                        //     //push data to "data_arr" to create the table
                        //     data_arr.push([val.name, val.count]);

                        //     console.log(key);
                        //     // if (obj.name === 'Steph') {
                        //     //     break;
                        //     //   }
                        // });
        
                        var options = {
                            title: 'Most Used Consumable Materials',
                            vAxis: {
                                title: 'Count',
                                viewWindow:{
                                    //max:data.materials_count, 
                                    min: 0, 
                                }
                            },
                            curveType: 'function',
                            legend: { position: 'none' }
                        };
                        var figure = google.visualization.arrayToDataTable(data_arr);
                        var chart = new google.visualization.ColumnChart(document.getElementById('materials_chart'));
                        chart.draw(figure, options);
                    }
                }else{
                    $('#materials_chart').empty();
                    $('#materials_chart').append('<div class="d-flex justify-content-center"><h5>Not enough data to show Materials Statistics</h5><div class="spinner-border text-dark mx-3" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                }
                //^^TOP MATERIAL
                
            },
            error: function(e){
                console.log(e);
                alert("error");
            }
        });
    }
    
    var report_date = "";

    $("#material_modal_flatpicker").flatpickr({
        dateFormat: "Y-m-d",
        inline: true,
        mode: "range",
        onChange: function(selectedDates, dateStr, instance) {
            //console.log(dateStr);
            report_date = dateStr;
            $("#generate_report").attr("disabled", false)
        }

    });

    // $(document).on('click', '#generate_report', function(e) {
    //     e.preventDefault();
    //     // alert("Asdasd")
    //     //console.log(report_date)

    //     $.ajax({
    //         type: "GET",
    //         url: "/clinic/report/" + report_date,
    //         beforeSend: function(){
               
    //         },
    //         success: function(data) {
    //           console.log(data);
    //         },
    //         error: function(error){
    //             console.log('AJAX load did not work');
    //             alert(error);
    //         }
    //     });

    // });

});
