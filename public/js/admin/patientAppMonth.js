$(function(){
    var_id = $('#patientID').val();
    google.load('visualization', '1.0', {'packages':['corechart']});
    // alert($var_id);
    $.ajax({
        type: "GET",
        url: "/admin/patient/create?id="+ var_id,
        success: function (response) {
            // console.log(response.user);
            console.log(response.appointments.length);
      
            if(response.appointments.length > 0){
                var data = [
                  ['Month', 'Total'],
  
                ];
  
              $.each(response.appMonth, function (index,value) {
                  data.push([index, value]);
              });
  
        
                var options = {
                  title: 'Appointments per Month',
                  curveType: 'function',
                  legend: { position: 'bottom' }
                };
  
                var figure = google.visualization.arrayToDataTable(data);
  
                var chart = new google.visualization.LineChart(document.getElementById('appMonthPatient'));
                chart.draw(figure, options);
            }
        },
        error: function(){
            console.log('AJAX load did not work');
            alert("error");
        }
        

    });
});


