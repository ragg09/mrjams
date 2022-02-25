@extends('adminViews.layouts.master')

@section('title', 'SHIT')


@section('extraStyle')
    
@endsection


@section('content')

<div id="chartContainerUser" style="height: 370px; width: 100%;">a</div>
<hr class="rounded">
<div id="chartContainerClinics" style="height: 370px; width: 100%; margin-top:100px;">b</div>
<hr class="rounded">
<div id="chartContainerCustomer" style="height: 370px; width: 100%; margin-top:100px;">c</div>
    
@endsection

@section('extraScript')

<?php

// echo "<pre>"; print_r($customersCount); die;
    // echo "<pre>"; print_r($usersCount); die;
    // echo "<pre>"; print_r($clinicsCount); die;
    echo "<pre>"; print_r($customersCount); die;

// echo $current_month = date('M Y', strtotime("-0 month"));

$months = array();
$count = 0;
while ($count <= 4 ) {
    $months[] = date('M Y', strtotime("-".$count." month"));
    $count++;
}

// echo "<pre>"; print_r($months); die;

//ALL USERS
$dataPointsUser = array(
	array("y" => $usersCount[4], "label" => $months[4]),
	array("y" => $usersCount[3], "label" => $months[3]),
	array("y" => $usersCount[2], "label" => $months[2]),
	array("y" => $usersCount[1], "label" => $months[1]),
	array("y" => $usersCount[0], "label" => $months[0]),
);
 
?>
    <script>
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainerUser", {
            title: {
                text: "Registered Users"
            },
            // axisY: {
            //     title: "Number of Push-ups"
            // },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPointsUser, JSON_NUMERIC_CHECK); ?>
            }],
        });
        chart.render();
        
        }
    </script>

//CLINIC
<?php
$dataPointsClinic = array(
	array("y" => $clinicsCount[4], "label" => $months[4]),
	array("y" => $clinicsCount[3], "label" => $months[3]),
	array("y" => $clinicsCount[2], "label" => $months[2]),
	array("y" => $clinicsCount[1], "label" => $months[1]),
	array("y" => $clinicsCount[0], "label" => $months[0]),
);
 
?>
    <script>
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainerClinics", {
            title: {
                text: "Registered Clinic"
            },
            // axisY: {
            //     title: "Number of Push-ups"
            // },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPointsClinic, JSON_NUMERIC_CHECK); ?>
            }],
        });
        chart.render();
        
        }
    </script>

//CUSTOMER
<?php
$dataPointsCustomer = array(
	array("y" => $customersCount[4], "label" => $months[4]),
	array("y" => $customersCount[3], "label" => $months[3]),
	array("y" => $customersCount[2], "label" => $months[2]),
	array("y" => $customersCount[1], "label" => $months[1]),
	array("y" => $customersCount[0], "label" => $months[0]),
);
 
?>
    <script>
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainerCustomer", {
            title: {
                text: "Registered Customer"
            },
            // axisY: {
            //     title: "Number of Push-ups"
            // },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPointsCustomer, JSON_NUMERIC_CHECK); ?>
            }],
        });
        chart.render();
        
        }
    </script>
    
@endsection