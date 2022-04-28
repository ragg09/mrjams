$(function(){

    // google.charts.load('current', {'packages':['corechart']});
    google.load('visualization', '1.0', {'packages':['corechart']});
    // google.charts.setOnLoadCallback(drawChart);

    

    $.ajax({
        type: "GET",
        url: "/admin/analytics/1",
        success: function (response) {
            // console.log(response.user);
            // console.log(response);
            // console.log('shit');

            var data_users = [
                ['Month', 'Total'],

            ];

            $.each(response.data, function (index,value) {
                data_users.push([value.month, value.total]);
            });

            // console.log(data_users);

            var options = {
                title: 'Registered Users',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var figure = google.visualization.arrayToDataTable(data_users);

            var chart = new google.visualization.LineChart(document.getElementById('linechartUsers'));
            chart.draw(figure, options);
            

        },
        error: function(){
            console.log('AJAX load did not work');
            // alert("error");
        }
        

    });

    $.ajax({
        type: "GET",
        url: "/admin/analytics/1",
        success: function (response) {
            // console.log(response.user);
            // console.log(response);
            // console.log('shit');

            var data_users = [
                ['Month', 'Total'],

            ];

            $.each(response.clinic, function (index,value) {
                data_users.push([value.month, value.total]);
            });

            // console.log(data_users);

            var options = {
                title: 'Registered Clinic',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var figure = google.visualization.arrayToDataTable(data_users);

            var chart = new google.visualization.LineChart(document.getElementById('linechartClinic'));
            chart.draw(figure, options);

        },
        error: function(){
            console.log('AJAX load did not work');
            // alert("error");
        }
        

    });

    $.ajax({
        type: "GET",
        url: "/admin/analytics/1",
        success: function (response) {
            // console.log(response.user);
            // console.log(response);
            // console.log('shit');

            var data_users = [
                ['Month', 'Total'],

            ];

            $.each(response.customer, function (index,value) {
                data_users.push([value.month, value.total]);
            });

            // console.log(data_users);

            var options = {
                title: 'Registered Customer',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var figure = google.visualization.arrayToDataTable(data_users);

            var chart = new google.visualization.LineChart(document.getElementById('linechartCustomer'));
            chart.draw(figure, options);

        },
        error: function(){
            console.log('AJAX load did not work');
            // alert("error");
        }
        

    });

    $.ajax({
        type: "GET",
        url: "/admin/analytics/1",
        success: function (response) {
            // console.log(response.user);
            // console.log(response.appointment.length);
            // console.log('shit');

            if(response.appointment.length == 0){
                var data_users = [
                    ['Month', 'Total'],
                    ['N/A', 0],
    
                ];
    

    
                // console.log(data_users);
    
                var options = {
                    title: 'Appointments per Month',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                };
    
                var figure = google.visualization.arrayToDataTable(data_users);
    
                var chart = new google.visualization.LineChart(document.getElementById('appPerMonth'));
                chart.draw(figure, options);
    
            }else{
                var data_users = [
                    ['Month', 'Total'],
    
                ];
    
                $.each(response.appointment, function (index,value) {
                    data_users.push([index, parseFloat(value)]);
                });
    
                // console.log(data_users);
    
                var options = {
                    title: 'Appointments per Month',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                };
    
                var figure = google.visualization.arrayToDataTable(data_users);
    
                var chart = new google.visualization.LineChart(document.getElementById('appPerMonth'));
                chart.draw(figure, options);
    
            }

            
        },
        error: function(){
            console.log('AJAX load did not work');
            // alert("error");
        }
        

    });
    
});