$(function(){
    var_id = $('#clinicID').val();
    google.load('visualization', '1.0', {'packages':['corechart']});
    // alert($var_id);
    $.ajax({
        type: "GET",
        url: "/admin/clinic/create?id="+ var_id,
        success: function (response) {
            // console.log(response.user);
            // console.log(response);

            // google.charts.load('current', {'packages':['corechart']});
            // google.charts.setOnLoadCallback(drawChart);
            if(response.appointments.length > 0){
                var data = [
                  ['Month', 'Total'],
                  // ['Feb', '1'],
                  // ['Mar', '2'],
                ];

              $.each(response.appMonth, function (index,value) {
                  data.push([index, value]);
              });

              // console.log(data);
        
                var options = {
                  title: 'Appointments per Month',
                  curveType: 'function',
                  legend: { position: 'bottom' }
                };

                var figure = google.visualization.arrayToDataTable(data);

                var chart = new google.visualization.LineChart(document.getElementById('appMonthClinic'));
                chart.draw(figure, options);
            }else{
              
              $('#appMonthPatient_nodata').attr("hidden", false);
            }
              
        },
        error: function(e){
            // console.log('AJAX load did not work');
            // alert("error");
            console.log(e);
        }
        

    });
});


