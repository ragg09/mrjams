$(function(){
    // alert('bobo');
    google.load('visualization', '1.0', {'packages':['corechart']});

    $.ajax({
        type: "GET",
        url: "/admin/dashboard/create", //san to?
        success: function (response) {
            // console.log(response.user);
            console.log(response.clinic_complete.length);
            console.log('shit');

            if(response.clinic_complete.length == 0){
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    
    
                var dataArray = [["Name", "Rating", { role: "style" }],
                ["N/A", 0, '#B3CDE0']];
                // console.log(dataArray);
                var figure = google.visualization.arrayToDataTable(dataArray)
            
                  var view = new google.visualization.DataView(figure);
                  view.setColumns([0, 1,
                                   { calc: "stringify",
                                     sourceColumn: 1,
                                     type: "string",
                                     role: "annotation" },
                                   2]);
            
                  var options = {
                    title: "Average Ratings",
                    // width: 600,
                    // height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                  chart.draw(view, options);
              }
            }else{
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    
    
                var clinicComplete = response.clinic_complete;
                // clinicComplete.sort(dynamicSort('avg'));
                // console.log(clinicComplete);
    
                clinicComplete.sort(function(a, b){
                    var a1= a.avg, b1= b.avg;
                    if(a1== b1) return 0;
                    return a1< b1? 1: -1;
                });
    
                //sorting from highest to lowest
                var top5Clinic_appoinments = response.top5Clinic_App;
                top5Clinic_appoinments.sort(function(a, b){
                    var a1= a.count, b1= b.count; // ung name ng dapat mong isort // hmm oks itutulad ko analng din dto yung sa query para almost the same na 
                    if(a1== b1) return 0;
                    return a1< b1? 1: -1;
                }); // as is na to pag ginawa ko sa patient pre? oo pre, ang need mo lang baguin is 
    
                // console.log(top5Clinic_appoinments)
    
    
    
                var dataArray = [["Name", "Rating", { role: "style" }],];
                $.each(response.clinic_complete, function (index,value) {
                        //   console.log(value);
                        dataArray.push([value.name, parseFloat(value.avg), '#B3CDE0']);
                });
    
                // console.log(dataArray);
                var figure = google.visualization.arrayToDataTable(dataArray)
            
                  var view = new google.visualization.DataView(figure);
                  view.setColumns([0, 1,
                                   { calc: "stringify",
                                     sourceColumn: 1,
                                     type: "string",
                                     role: "annotation" },
                                   2]);
            
                  var options = {
                    title: "Average Ratings",
                    // width: 600,
                    // height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                  };
                  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                  chart.draw(view, options);
              }
            }

        
          

        },
        error: function(){
            console.log('AJAX load did not work');
            alert("error");
        }
        

    });

    // $.ajax({
    //   type: "GET",
    //   url: "/admin/dashboard/create",
    //   success: function (response) {
    //       // console.log(response.user);
    //     //   console.log(response);
    //       // console.log('shit');

    //       var data_users = [
    //           ['Month', 'Total'],

    //       ];

    //       $.each(response.regMonth, function (index,value) {
    //           data_users.push([index, value]);
    //       });

    //       // console.log(data_users);

    //       var options = {
    //           title: 'Registration per Month',
    //           curveType: 'function',
    //           legend: { position: 'bottom' }
    //       };

    //       var figure = google.visualization.arrayToDataTable(data_users);

    //       var chart = new google.visualization.LineChart(document.getElementById('regPerMonth'));
    //       chart.draw(figure, options);

    //   },
    //   error: function(){
    //       console.log('AJAX load did not work');
    //       alert("error");
    //   }
      

    // });

    $.ajax({
        type: "GET",
        url: "/admin/dashboard/create",
        success: function (response) {
            // console.log(response.user);
            // console.log(response);
            // console.log('shit');

            if(response.clinic_complete.length == 0){
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                //console.log(top5Clinic_appointments)

                var dataArray = [["Name", "Appointments", { role: "style" }],
                ["N/A", 0, '#6497B1']];


                console.log("==============");
                console.log(dataArray);
                console.log("==============");

                var figure = google.visualization.arrayToDataTable(dataArray)
            
                var view = new google.visualization.DataView(figure);
                view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);
            
                var options = {
                    title: "Total Appointments",
                    // width: 600,
                    // height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("topClinicsApp"));
                
                chart.draw(view, options);
                }
            }else{
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {

                //sorting from highest to lowest
                var top5Clinic_appointments = response.top5Clinic_App;
                top5Clinic_appointments.sort(function(a, b){
                    var a1= a.count, b1= b.count; // ung name ng dapat mong isort 
                    if(a1== b1) return 0;
                    return a1< b1? 1: -1;
                });

                //console.log(top5Clinic_appointments)

                var dataArray = [["Name", "Appointments", { role: "style" }],];
                $.each(top5Clinic_appointments, function (index,value) {
                    // console.log("==============");
                    //       console.log(value);
                        dataArray.push([value.name, parseInt(value.count), '#6497B1']); // panong pawala? 
                });
                // ayy? pano naging wala meron sya sa response

                console.log("==============");
                console.log(dataArray);
                console.log("==============");

                var figure = google.visualization.arrayToDataTable(dataArray)
            
                var view = new google.visualization.DataView(figure);
                view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);
            
                var options = {
                    title: "Total Appointments",
                    // width: 600,
                    // height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("topClinicsApp"));
                
                chart.draw(view, options);
                }
            }
        },
        error: function(){
            console.log('AJAX load did not work');
            alert("error");
        }
        

    });

    $.ajax({
        type: "GET",
        url: "/admin/dashboard/create",
        success: function (response) {
            console.log(response.top5Customer_App.length);
            // console.log(response);
            console.log('tangina');

            if(response.top5Customer_App.length == 0){
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {

                //sorting from highest to lowest
                var top5Customer_appointments = response.top5Customer_App;
                top5Customer_appointments.sort(function(a, b){
                    var a1= a.count, b1= b.count; // ung name ng dapat mong isort 
                    if(a1== b1) return 0;
                    return a1< b1? 1: -1;
                });

                //console.log(top5Clinic_appointments)

                var dataArray = [["Name", "Appointments", { role: "style" }],
                ["N/A", 0, '#116895']];

                console.log("==============");
                console.log(dataArray);
                console.log("==============");

                var figure = google.visualization.arrayToDataTable(dataArray)
            
                var view = new google.visualization.DataView(figure);
                view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);
            
                var options = {
                    title: "Total Appointments",
                    // width: 600,
                    // height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("TopCustomerApp"));
                
                chart.draw(view, options);
                }
            }else{ 
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {

                //sorting from highest to lowest
                var top5Customer_appointments = response.top5Customer_App;
                top5Customer_appointments.sort(function(a, b){
                    var a1= a.count, b1= b.count; // ung name ng dapat mong isort 
                    if(a1== b1) return 0;
                    return a1< b1? 1: -1;
                });

                //console.log(top5Clinic_appointments)

                var dataArray = [["Name", "Appointments", { role: "style" }],];
                $.each(top5Customer_appointments, function (index,value) {
                    //       console.log(value);
                        dataArray.push([value.name, parseInt(value.count), '#116895']);
                });

                console.log("==============");
                console.log(dataArray);
                console.log("==============");

                var figure = google.visualization.arrayToDataTable(dataArray)
            
                var view = new google.visualization.DataView(figure);
                view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);
            
                var options = {
                    title: "Total Appointments",
                    // width: 600,
                    // height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("TopCustomerApp"));
                
                chart.draw(view, options);
                }
            }

        

        },
        error: function(){
            console.log('AJAX load did not work');
            alert("error");
        }
        

    });

});
