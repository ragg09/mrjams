$(function(){

    clinic_availability();

    // services multiselect
    $("#service_multiple").select2({ 
        dropdownParent: $('#services_multi'),
        placeholder: "Select Services",
        allowClear: true,
        tags: true,
    });

    $("#service_multiple").change(function() {
        var ids = [];
        $('#service_multiple :selected').each(function(i, sel){ 
            ids.push($(sel).val());
        });
        $("#service_ids").val(ids);
    });

    // checkbox for packages
    var check = $("#CPackage");
    $("#CPackage").on('click',checkStatus);

    function checkStatus(){
        
    if(check.is(':checked'))
    {
        $("#package").prop('disabled', false);
    }
    else{
        $("#package").prop('disabled', true);
    }
        
    }

    // checkbox for services
    var checks = $("#CService");
    $("#CService").on('click',checkStatuss);

    function checkStatuss(){
        if(checks.is(':checked'))
        {
            $("#service_multiple").prop('disabled', false);
        }
        else{
            $("#service_multiple").prop('disabled', true);
        }
        
    }   

    // Date Time format

    var today = new Date();
      
      $("#accept_modal_flatpicker").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        // inline: true,
        minDate: today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(),
        // defaultDate: data.data.app_appointed_at + " " + data.data.time ,
      })


    function clinic_availability(){
        var id = $("#clinic_id").val();
        $.ajax({
            type: "GET",
            url: "/customer/relativeappoint/"+id,
            success: function(data){
                // console.log(data);

                // const month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                // const d = new Date();
                
                // const remaining_month = month.slice(d.getMonth())
                // var cur_year = today.getFullYear();

                // function daysInMonth( m, y, d ) {
                //     d = d + 1;
                //     var days = new Date( y,m,0 ).getDate();
                //     var day_col = [ d - (new Date( m +'/01/'+ y ).getDay()) ];
                //     for ( var i = day_col[0] + 7; i < days; i += 7 ) {
                //       day_col.push( "2022-03-"+i );
                //     }
                //     return day_col;
                // }


                // var date_to_disable = [];
                // $.each(remaining_month, function(index, val){
                //     month_toNumber = moment().month(val).format("M");

                //     console.log(month_toNumber);

                //     // for (let i = 1; i < 8; i++) {
                //     //     // console.log( daysInMonth( month_toNumber, cur_year, i ));

                //     //     date_to_disable.push( daysInMonth( month_toNumber, cur_year, i ) );

                       
                //     // }

                // });

                // console.log(date_to_disable);
                // var status_Monday = "";
                // var status_Tuesday = "";
                // var status_Wednesday = "";
                // var status_Thursday = "";
                // var status_Friday = "";
                // var status_Saturday = "";
                // var status_Sunday = "";

                // $.each(data.avail, function(index, val){
                //     status_
                // });

            //    console.log( data.avail[0].status);

            var day_num = ["Sunday" ,"Monday","Tuesday", "Wednesday" ,"Thursday","Friday" ,"Saturday"]
                
            var this_day = "";

                function FlatPickrFunction() {
                    $("#accept_modal_flatpicker").flatpickr({
                        enableTime: true,
                        minTime: "08:00",
                        maxTime: "22:00",
                        dateFormat: "Y-m-d H:i",
                        minDate: today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(),
                        disable: [
                            function(date) {
                                // disable sunday
                                if(data.avail[0].status == "off"){
                                    return (date.getDay() === 0);
                                }
                            },
                            function(date) {
                                // disable monday
                                
                                if(data.avail[1].status == "off"){
                                    return (date.getDay() === 1);
                                }
                            },
                            function(date) {
                                // disable tuesay
                                if(data.avail[2].status == "off"){
                                    return (date.getDay() === 2);
                                }
                            },
                            function(date) {
                                // disable wednesday
                                if(data.avail[3].status == "off"){
                                    return (date.getDay() === 3);
                                }
                            },
                            function(date) {
                                // disable thursday
                                if(data.avail[4].status == "off"){
                                    return (date.getDay() === 4);
                                }
                            },
                            function(date) {
                                // disable friday
                                if(data.avail[5].status == "off"){
                                    return (date.getDay() === 5);
                                }
                            },
                            function(date) {
                                // disable mondays
                                if(data.avail[6].status == "off"){
                                    return (date.getDay() === 6);
                                }
                            },
                        ],
                        onChange: function(selectedDates, dateStr, instance) {
                            //console.log(moment($("#accept_modal_flatpicker").val()).format('dddd'));
                            this_day = moment($("#accept_modal_flatpicker").val()).format('dddd');

                            
                            $("#appointment_b").removeAttr("disabled");
                            
    
                            $.each(data.avail, function(index, val){
                                if(val.day == this_day){ //getting the day name as trapping
                                    $("#accept_modal_flatpicker").flatpickr({
                                        enableTime: true,
                                        minTime: val.min,
                                        maxTime: val.max,
                                        dateFormat: "Y-m-d H:i",
                                        minDate: today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(),
                                        disable: [
                                            function(date) {
                                                // disable sunday
                                                if(data.avail[0].status == "off"){
                                                    return (date.getDay() === 0);
                                                }
                                            },
                                            function(date) {
                                                // disable monday
                                                
                                                if(data.avail[1].status == "off"){
                                                    return (date.getDay() === 1);
                                                }
                                            },
                                            function(date) {
                                                // disable tuesay
                                                if(data.avail[2].status == "off"){
                                                    return (date.getDay() === 2);
                                                }
                                            },
                                            function(date) {
                                                // disable wednesday
                                                if(data.avail[3].status == "off"){
                                                    return (date.getDay() === 3);
                                                }
                                            },
                                            function(date) {
                                                // disable thursday
                                                if(data.avail[4].status == "off"){
                                                    return (date.getDay() === 4);
                                                }
                                            },
                                            function(date) {
                                                // disable friday
                                                if(data.avail[5].status == "off"){
                                                    return (date.getDay() === 5);
                                                }
                                            },
                                            function(date) {
                                                // disable mondays
                                                if(data.avail[6].status == "off"){
                                                    return (date.getDay() === 6);
                                                }
                                            },
                                        ],
                                        onChange: function(selectedDates, dateStr, instance) {
                                            $("#appointment_b").removeAttr("disabled");
                                            //recast self on change if data changes
                                            if(data.avail[day_num.indexOf(this_day)].day != moment($("#accept_modal_flatpicker").val()).format('dddd')){
                                                this_day = moment($("#accept_modal_flatpicker").val()).format('dddd');
                                                
                                                FlatPickrFunction()
                                            }
                                            
                                            
                                        }
                                    })
                                }
                            });
                        
                        },
                    })
                }

                
                FlatPickrFunction();

               

            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    }

    
})