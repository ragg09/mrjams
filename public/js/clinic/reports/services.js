$(function(){
    //to load charts
    google.charts.load("current", {packages:["corechart"]});

    

    
    $.ajax({
        type: "GET",
        url: "/clinic/report/create",
        success: function(data){
            console.log(data);

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
                
                $.each(sorted_services, function(key, val){
                    //push data to "data_arr" to create the table
                    data_arr.push([val.name, val.count]);
                });

                var options = {
                    title: 'Top Selected Services Of Customer From Your Clinic',
                    vAxis: {
                        title: 'Count',
                        viewWindow:{
                            max:data.services_count, 
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
            
        },
        error: function(e){
            console.log(e);
            alert("error");
        }
    });

});
