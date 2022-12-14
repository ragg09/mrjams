$(function(){
    const digits_only = string => [...string].every(c => '0123456789'.includes(c)); //removing characters
    var computed_price = 0;
    var dynamic_price = 0;

    function ViewTotal() {
        $('#total_price_text').text(computed_price)
        $('#total_price_input').val(computed_price)
    }
    

    //loop parent div to get child inputs
    $('.overall_pricing>div').map(function(){
        
        // getting name of checked items (alternative of ID since package/service is unique for each clinic)
        // var p = $(this).find('p');
        // console.log(p.text());

        if($(this).find('input:checkbox').is(':checked')){
            computed_price = computed_price + parseInt($(this).find('input:text').val());    
        }

        $(this).find('input:checkbox').on('change', function(e){
            computed_price = 0; //re initialize value

            //re-loop parent div to get child inputs
            $('.overall_pricing>div').map(function(){

                if($(this).find('input:checkbox').is(':checked')){
                    // getting name of checked items (alternative of ID since package/service is unique for each clinic)
                    // var p = $(this).find('p');
                    // console.log(p.text());
                    //console.log($(this).find('input:text').val());
                    computed_price = computed_price + parseInt($(this).find('input:text').val());
                }
            });


            if( $('#addtional_service').has('div').length){
                //console.log("meron na");
                computed_price = 0;

                $('.overall_pricing>div').map(function(){
                    if($(this).find('input:checkbox').is(':checked')){
                        computed_price = computed_price + parseInt($(this).find('input:text').val());
                    }
                });

                $('#addtional_service>div').map(function(){
                    if($(this).find('input:checkbox').is(':checked')){
                        computed_price = computed_price + parseInt($(this).find('input:text').val());
                    }
                });
            }

            //on change price
            //console.log(computed_price); 
            ViewTotal();
        });

        
    })

     // initial price
    //console.log(computed_price); 
    ViewTotal();

    function CallAdditionalServiceListner() { //called in the onclick button


        $('#addtional_service').css("border-top", "1px dashed black");
        if(dynamic_price === 0){
            computed_price = 0;

            $('.overall_pricing>div').map(function(){
                if($(this).find('input:checkbox').is(':checked')){
                    computed_price = computed_price + parseInt($(this).find('input:text').val());
                }
            });    

            $('#addtional_service>div').map(function(){
                if($(this).find('input:checkbox').is(':checked')){
                    dynamic_price = dynamic_price + parseInt($(this).find('input:text').val());
                }
            });


            // console.log(computed_price);
            // console.log(dynamic_price);
            computed_price = dynamic_price + computed_price;
        }


        $('#addtional_service>div').map(function(){
            
            $(this).find('input:checkbox').on('change', function(e){
                //console.log("heto na nga");

                computed_price = 0;
                dynamic_price = 0;

                $('.overall_pricing>div').map(function(){
                    if($(this).find('input:checkbox').is(':checked')){
                        computed_price = computed_price + parseInt($(this).find('input:text').val());
                    }
                });    
    
                $('#addtional_service>div').map(function(){
                    if($(this).find('input:checkbox').is(':checked')){
                        dynamic_price = dynamic_price + parseInt($(this).find('input:text').val());
                    }
                });
    
    
                // // console.log(computed_price);
                // // console.log(dynamic_price);
                computed_price = dynamic_price + computed_price;

                ViewTotal();
                
            });

            
        })

    //CHECK BOX AND INPUT BOX ON CHANGE LISTENERS
    //check every service's price if it only contains numbers
    $('#addtional_service').find('input:text').each(function() {
        //console.log($(this).val());
        $(this).on('keyup', function(){              
            var input = $(this).val();
            if(!digits_only(input) || input == ''){
        
                if(input == ''){
                    $(this).val('0');
                    computed_price = 0; 

                    //loop parent div to get child inputs
                    $('#addtional_service>div').map(function(){

                        computed_price = 0;
                        dynamic_price = 0;
        
                        $('.overall_pricing>div').map(function(){
                            if($(this).find('input:checkbox').is(':checked')){
                                computed_price = computed_price + parseInt($(this).find('input:text').val());
                            }
                        });    
            
                        $('#addtional_service>div').map(function(){
                            if($(this).find('input:checkbox').is(':checked')){
                                dynamic_price = dynamic_price + parseInt($(this).find('input:text').val());
                            }
                        });
            
            
                        // // console.log(computed_price);
                        // // console.log(dynamic_price);
                        computed_price = dynamic_price + computed_price;
        
                        ViewTotal();
                
                
                
                    });
                    //on change price
                    //console.log(computed_price); 
                    ViewTotal();
                }else{
                    input = input.substr(0,input.length-1);
                    $(this).val(parseInt(input));
                }
                        
            }else{
                computed_price = 0; 

                $(this).val(parseInt(input)); // making sure that user will not see xtra zero in front of the numbers
    
                //loop parent div to get child inputs
                $('#addtional_service>div').map(function(){

                    computed_price = 0;
                    dynamic_price = 0;
    
                    $('.overall_pricing>div').map(function(){
                        if($(this).find('input:checkbox').is(':checked')){
                            computed_price = computed_price + parseInt($(this).find('input:text').val());
                        }
                    });    
        
                    $('#addtional_service>div').map(function(){
                        if($(this).find('input:checkbox').is(':checked')){
                            dynamic_price = dynamic_price + parseInt($(this).find('input:text').val());
                        }
                    });
        
        
                    // // console.log(computed_price);
                    // // console.log(dynamic_price);
                    computed_price = dynamic_price + computed_price;
    
                    ViewTotal();
            
                });
                //on change price
                //console.log(computed_price); 
                ViewTotal();
            }
        });
    });    

        //computed_price = computed_price + dynamic_price;

        //console.log(dynamic_price);
        ViewTotal();
        
    }

    


    //dynamic adding of services
    $('#additionals_form_btn').on('click', function(e){
        e.preventDefault();
        dynamic_price = 0;
        
        $.ajax({
            type: 'GET',
            url: '/clinic/services/' + $("#service_ids").val() + ' BILLING',
            success: function(data) {
                //console.log(data);
                

                if( $("#addtional_equipment").has('div').length){
                    var p_arr = [];
                    var p2_arr = [];

                    $('.overall_equipments>div').map(function(){
                        p_arr.push($(this).find('p').text());
                    });

                    $("#addtional_equipment>div").map(function(){
                        p_arr.push($(this).find('p').text());
                    });

                    

                    //getting first word of text and pushing to new array
                    p_arr.forEach( e => { 
                        p2_arr.push(e.split(' (')[0]);
                    });
                    
                    // const filtered_arr = p2_arr.filter( e => {
                    //     return e !== '';
                    // });

                    //console.log(p2_arr);

                    $.each(data.equipments, function(key, val){
                        if(!p2_arr.includes(val.name)){
                            //console.log(val.name);
                            $("#addtional_equipment").append('<div class="row"><div class="col"><p>'+val.name+' ('+val.unit+')</p></div><div class="col"><input type="number" class=" positive-numeric-only" min="1" max="'+val.quantity+'" value="1" id="equipment_values" name="equipment_values" ></div></div>');
                            //$() 

                            //  
                            this_id = $("#equipment_ids_final").val();
                            this_id = this_id + val.id + ",";
                            $("#equipment_ids_final").val(this_id);
    
                            this_val = $("#equipment_values_final").val();
                            this_val = this_val + "1" + ",";
                            $("#equipment_values_final").val(this_val);        
                        }

                        
                    });

                }else{
                    var p_arr = [];
                    var p2_arr = [];

                    $('.overall_equipments>div').map(function(){
                        p_arr.push($(this).find('p').text());
                    });

                    //getting first word of text and pushing to new array
                    p_arr.forEach( e => { 
                        p2_arr.push(e.split(' (')[0]);
                    });
                    
                    // const filtered_arr = p2_arr.filter( e => {
                    //     return e !== '';
                    // });

                    //console.log(p2_arr);

                    $.each(data.equipments, function(key, val){
                        if(!p2_arr.includes(val.name)){
                            //console.log(val.name);
                            $("#addtional_equipment").append('<div class="row"><div class="col"><p>'+val.name+' ('+val.unit+')</p></div><div class="col"><input type="number" class=" positive-numeric-only" min="1" max="'+val.quantity+'" value="1" id="equipment_values" name="equipment_values" ></div></div>');
                            //$() 

                            this_id = $("#equipment_ids_final").val();
                            this_id = this_id + val.id + ",";
                            $("#equipment_ids_final").val(this_id);
    
                            this_val = $("#equipment_values_final").val();
                            this_val = this_val + "1" + ",";
                            $("#equipment_values_final").val(this_val);     
                        }

                       
                    });

                    
                }

                
                $("input[type='number']").inputSpinner();


                
                if( $('#addtional_service').has('div').length){//if div exist within additional services
                    var p_arr = [];
                    $('#addtional_service>div').map(function(){
                        p_arr.push($(this).find('p').text());
                    });

                    //console.log(p_arr);

                    $.each(data.services, function(key, val){
                        if(!p_arr.includes(val.name)){
                            $("#addtional_service").append('<div class="row"><div class="col"><p>'+val.name+'</p></div><div class="col"><input type="text" class="w-75" value="'+val.max_price+'"></div><div class="col"><input class="form-check-input" type="checkbox" value="" id="" checked></input></div>');
                            
                        }
                         
                    });

                    CallAdditionalServiceListner();
                    
                }else{//if additional services is empty
                    $.each(data.services, function(key, val){
                        $("#addtional_service").append('<div class="row"><div class="col"><p>'+val.name+'</p></div><div class="col"><input type="text" class="w-75" value="'+val.max_price+'"></div><div class="col"><input class="form-check-input" type="checkbox" value="" id="" checked></input></div>'); 
                    });

                    CallAdditionalServiceListner();  
                }
    
                $("#additionals_modal").modal('toggle');
                
            },
            error: function(error) {
              console.log(error);
            }
        });
        
        
    });

    //CHECK BOX AND INPUT BOX ON CHANGE LISTENERS
    //check every service's price if it only contains numbers
    $('.overall_pricing').find('input:text').each(function() {
        //console.log($(this).val());
        $(this).on('keyup', function(){              
            var input = $(this).val();
            if(!digits_only(input) || input == ''){
        
                if(input == ''){
                    $(this).val('0');
                    computed_price = 0; 

                    //loop parent div to get child inputs
                    $('.overall_pricing>div').map(function(){

                        if($(this).find('input:checkbox').is(':checked')){
                            //console.log($(this).find('input:text').val());
                            computed_price = computed_price + parseInt($(this).find('input:text').val());
                        }
                
                
                
                    });
                    //on change price
                    //console.log(computed_price); 
                    ViewTotal();
                }else{
                    input = input.substr(0,input.length-1);
                    $(this).val(parseInt(input));
                }
                        
            }else{
                computed_price = 0; 

                $(this).val(parseInt(input)); // making sure that user will not see xtra zero in front of the numbers
    
                //loop parent div to get child inputs
                $('.overall_pricing>div').map(function(){

                    if($(this).find('input:checkbox').is(':checked')){
                        //console.log($(this).find('input:text').val());
                        computed_price = computed_price + parseInt($(this).find('input:text').val());
                    }
            
                });
                //on change price
                //console.log(computed_price); 
                ViewTotal();
            }
        });
    });


    //STEP 1 PAYMENT
    $(document).on('click', '#cash_payment', function(e) {
        
        if($(this).is(':checked')){
            $("#paid_in_cash_div").attr("hidden", false);
        }else{
            $('#paid_in_cash').val(0);
            var paid_in_card = $('#paid_in_card').val(); 
            var current_total = $('#total_price_input').val();
            $("#paid_in_cash_div").attr("hidden", true);

           
            if(parseInt($("#total_paid").val()) == 0){
                // console.log("wala pang input");
                $('#success-outlined').prop("checked",false);
                $('#danger-outlined').prop("checked",false);
                $("#payment_method").val("");
                $("#for_installment").hide();
                $("#finish_appointment").attr("disabled", true);
            }else{
                // console.log("may input na siguro sa card");
                $("#finish_appointment").attr("disabled", false);

                if($('#card_payment').is(':checked')){
                    var balance =  parseInt(current_total) - parseInt(paid_in_card);
                    $('#total_paid').val(parseInt(paid_in_card));

                    //console.log(balance);
                    if(balance == 0){
                        // console.log("Wala na balance check mo ung fully paid button");
                        $('#success-outlined').prop("checked", true );
                        $("#for_installment").hide();
                        $("#payment_paid").text(parseInt(paid_in_card));
                        $("#payment_balance").text(balance);
                        $("#balance").val(balance);
                        $("#payment_method").val("fully paid");
                    }else if(parseInt(paid_in_card) > current_total){
                        $("#finish_appointment").attr("disabled", true);
                        $("#input_exceeds").attr("hidden", false);  
                        $('#success-outlined').prop("checked",false);
                        $('#danger-outlined').prop("checked",false);
                    }else{
                        // console.log("may balance dapat mag kalaman ung balance input ");
                        $('#danger-outlined').prop("checked", true );
                        $("#for_installment").show();
                        $("#payment_paid").text(parseInt(paid_in_card));
                        $("#payment_balance").text(balance);
                        $("#balance").val(balance);
                        $("#payment_method").val("installment");
                    }

                }else{
                    $("#balance").val(0);
                    $("#payment_paid").text(0);
                    $("#payment_balance").text(0);
                    $('#total_paid').val(0)
                    $("#payment_method").val("");

                    $("#finish_appointment").attr("disabled", true); 
                    $('#success-outlined').prop("checked",false);
                    $('#danger-outlined').prop("checked",false);    
                }
                
                
            }
            
        }
    });

    $(document).on('click', '#card_payment', function(e) {
       
        if($(this).is(':checked')){
            $("#select_card").attr("hidden", false);
        }else{
            $('#paid_in_card').val(0);
            $("#paid_in_card_div").attr("hidden", true);
            $("#select_card").attr("hidden", true);
            var paid_in_cash = $('#paid_in_cash').val(); 
            var current_total = $('#total_price_input').val();

           
            if(parseInt($("#total_paid").val()) == 0){
                // console.log("wala pang input");
                $('#success-outlined').prop("checked",false);
                $('#danger-outlined').prop("checked",false);
                $("#payment_method").val("");
                $("#for_installment").hide();
                $("#finish_appointment").attr("disabled", true);
            }else{
                // console.log("may input na siguro sa cash");
                $("#finish_appointment").attr("disabled", false);

                if($('#cash_payment').is(':checked')){
                    var balance =  parseInt(current_total) - parseInt(paid_in_cash);
                    $('#total_paid').val(parseInt(paid_in_cash));

                    //console.log(balance);
                    if(balance == 0){
                        // console.log("Wala na balance check mo ung fully paid button");
                        $('#success-outlined').prop("checked", true );
                        $("#for_installment").hide();
                        $("#payment_paid").text(parseInt(paid_in_cash));
                        $("#payment_balance").text(balance);
                        $("#balance").val(balance);
                        $("#payment_method").val("fully paid");
                    }else if(parseInt(paid_in_cash) > current_total){
                        $("#finish_appointment").attr("disabled", true);
                        $("#input_exceeds").attr("hidden", false);  
                        $('#success-outlined').prop("checked",false);
                        $('#danger-outlined').prop("checked",false);
                    }else{
                        // console.log("may balance dapat mag kalaman ung balance input ");
                        $('#danger-outlined').prop("checked", true );
                        $("#for_installment").show();
                        $("#payment_paid").text(parseInt(paid_in_cash));
                        $("#payment_balance").text(balance);
                        $("#balance").val(balance);
                        $("#payment_method").val("installment");
                    }

                }else{
                    $("#balance").val(0);
                    $("#payment_paid").text(0);
                    $("#payment_balance").text(0);
                    $('#total_paid').val(0)
                    $("#payment_method").val("");

                    $("#finish_appointment").attr("disabled", true); 
                    $('#success-outlined').prop("checked",false);
                    $('#danger-outlined').prop("checked",false);    
                }
                
                
            }
            
        }
    });

    $(document).on('change', '#select_card', function(e) {
        if($(this).val() != ""){
            $("#paid_in_card_div").attr("hidden", false);
        }else{
            $("#paid_in_card_div").attr("hidden", true);
        }
    });

    //^^STEP 1 PAYMENT
        

    //for payment method computation CASH
    $('#paid_in_cash').on('keyup', function(){
        var input = $(this).val(); 
        var paid_in_card = $('#paid_in_card').val(); 
        var current_total = $('#total_price_input').val();

        $("#payment_paid").text(0);
        $("#payment_balance").text(0);
        $('#total_paid').val(0);
        $("#input_exceeds").attr("hidden", true); 
        $('#success-outlined').prop("checked",false);
        $('#danger-outlined').prop("checked",false);
       
        if(digits_only(input) || input == ''){
            if(input == ''){
                    $(this).val(0);
                    input = 0;
                    $("#payment_method").val("");
                    $("#finish_appointment").attr("disabled", true);
                    
            }else{
                $("#finish_appointment").attr("disabled", false);
                var balance =  parseInt(current_total) - (parseInt(input) + parseInt(paid_in_card));

                $('#total_paid').val(parseInt(input) + parseInt(paid_in_card));
                //console.log(balance);
                if(balance == 0){
                    // console.log("Wala na balance check mo ung fully paid button");
                    $('#success-outlined').prop("checked", true );
                    $("#for_installment").hide();
                    $("#payment_paid").text(parseInt(input) + parseInt(paid_in_card));
                    $("#payment_balance").text(balance);
                    $("#balance").val(balance);
                    $("#payment_method").val("fully paid");
                }else if(parseInt(input) + parseInt(paid_in_card) > current_total){
                    $("#finish_appointment").attr("disabled", true);
                    $("#input_exceeds").attr("hidden", false);  
                    $('#success-outlined').prop("checked",false);
                    $('#danger-outlined').prop("checked",false);
                }else{
                    // console.log("may balance dapat mag kalaman ung balance input ");
                    $('#danger-outlined').prop("checked", true );
                    $("#for_installment").show();
                    $("#payment_paid").text(parseInt(input) + parseInt(paid_in_card));
                    $("#payment_balance").text(balance);
                    $("#balance").val(balance);
                    $("#payment_method").val("installment");
                }
                    
            }
    
        }else{
            input = input.substr(0,input.length-1);
            $(this).val(input);
        }

        $(this).val(parseInt(input));
    });

    //for payment method computation CARD
    $('#paid_in_card').on('keyup', function(){
        var input = $(this).val(); 
        var paid_in_cash = $('#paid_in_cash').val(); 
        var current_total = $('#total_price_input').val();

        $("#payment_paid").text(0);
        $("#payment_balance").text(0);
        $('#total_paid').val(0);
        $("#input_exceeds").attr("hidden", true); 
        $('#success-outlined').prop("checked",false);
        $('#danger-outlined').prop("checked",false);
       
        if(digits_only(input) || input == ''){
            if(input == ''){
                    $(this).val(0);
                    input = 0;
                    $("#payment_method").val("");
                    $("#finish_appointment").attr("disabled", true);
                    
            }else{
                $("#finish_appointment").attr("disabled", false);
                var balance =  parseInt(current_total) - (parseInt(input) + parseInt(paid_in_cash));

                $('#total_paid').val(parseInt(input) + parseInt(paid_in_cash));
                //console.log(balance);
                if(balance == 0){
                    // console.log("Wala na balance check mo ung fully paid button");
                    $('#success-outlined').prop("checked", true );
                    $("#for_installment").hide();
                    $("#payment_paid").text(parseInt(input) + parseInt(paid_in_cash));
                    $("#payment_balance").text(balance);
                    $("#balance").val(balance);
                    $("#payment_method").val("fully paid");
                }else if(parseInt(input) + parseInt(paid_in_cash) > current_total){
                    $("#finish_appointment").attr("disabled", true);
                    $("#input_exceeds").attr("hidden", false);  
                    $('#success-outlined').prop("checked",false);
                    $('#danger-outlined').prop("checked",false);
                }else{
                    // console.log("may balance dapat mag kalaman ung balance input ");
                    $('#danger-outlined').prop("checked", true );
                    $("#for_installment").show();
                    $("#payment_paid").text(parseInt(input) + parseInt(paid_in_cash));
                    $("#payment_balance").text(balance);
                    $("#balance").val(balance);
                    $("#payment_method").val("installment");
                }
                    
            }
    
        }else{
            input = input.substr(0,input.length-1);
            $(this).val(input);
        }

        $(this).val(parseInt(input));
    });





    //for installment computation
    $('#total_paid').on('keyup', function(){
        var input = $(this).val();  
        var current_total = $('#total_price_input').val();
            
            if(digits_only(input) || input == ''){
                if(input == ''){
                    $(this).val(0);
                    input = 0;
                    var balance =  parseInt(current_total) - parseInt(input);
                    $("#payment_paid").text(parseInt(input));
                    $("#payment_balance").text(balance);
                    $("#balance").val(balance);
                    $(this).val(parseInt(input));
                    
                }else{
                    var balance =  parseInt(current_total) - parseInt(input);
                    $("#payment_paid").text(parseInt(input));
                    $("#payment_balance").text(balance);
                    $("#balance").val(balance);
                    $(this).val(parseInt(input));
                }
    
            }else{
                input = input.substr(0,input.length-1);
                $(this).val(input);
            }
    });
    
})