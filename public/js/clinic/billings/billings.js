$(function(){
    $("input[type='number']").inputSpinner();



    //STEP 2 PAYMENT
    $("#for_installment").hide();

    $(document).on('click', '#success-outlined', function(e) {
        $("#payment_method").val("fully paid");
        $("#finish_appointment").removeAttr("disabled");
        // $("#total_paid").attr("hidden", "true");
        $("#for_installment").hide();

        $('#payment_paid').text("0");
        $('#payment_balance').text("0");
        
    });

    $(document).on('click', '#danger-outlined', function(e) {
        $("#payment_method").val("installment");
        $("#finish_appointment").removeAttr("disabled");
        // $("#total_paid").removeAttr("hidden", "false");
        $("#for_installment").show();

    });

    //^^STEP 2 PAYMENT


    $(document).on('change', '#equipment_values', function(e) {
        equipment_values = []
        $("input[name='equipment_values']").each(function() {
            equipment_values.push($(this).val());
        });

        
        //console.log(equipment_values);
        $("#equipment_values_final").val(equipment_values);
    });

    

    //finish appointmnet submit
    $("#finish_appointment_form").on('submit', function(e){
        e.preventDefault();
        service_arr = [];
        
        $('.overall_pricing>div').map(function(){
            if($(this).find('input:checkbox').is(':checked')){
                service_arr.push($(this).find('p').text() +":"+ $(this).find('input:text').val());
            }
        }); 

        if( $('#addtional_service').has('div').length){
            $('#addtional_service>div').map(function(){
                if($(this).find('input:checkbox').is(':checked')){
                    service_arr.push($(this).find('p').text() +":"+ $(this).find('input:text').val());
                }
            });
        }

        $('#pricing_summary').val(service_arr)

        //console.log(service_arr);

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#finish_appointment_form').serialize(),
            beforeSend: function(){
                $("#loading_modal").modal('toggle');
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                console.log(data);
                if($("#print_receipt_on_success").is(':checked')) {
                    window.open('/clinic/print/'+data.ro_id+'_receipt', '_blank');
                }
                

                window.location.href = "/clinic/billing";

                // console.log(data);
                
                // if(data.status == 0){
                //     $.each(data.error, function(key, val){
                //         $('span.'+key+'_error').text(val[0]);
                //     });
                // }else{
                //     $("#edit_show_body").load(window.location + " #edit_show_body");
                //     $("#edit_package_service_up").modal('toggle');
                //     bootstrapAlert(data.message, "info", 200);
                //     console.log(data.message);
                //     $('#select_services').val(null).trigger('change');
                // }
            }
        });
    });

    //additional service modal
    $("#service_multiple").select2({ 
        dropdownParent: $('#additionals_modal'),
        placeholder: "Select Services",
        allowClear: true,
        minimumResultsForSearch: -1,
        // tags: true,
        noResults: function() {
            return '<button id="no-results-btn" onclick="noResultsButtonClicked()">No Result Found</a>';
          },
    });

    $("#service_multiple").change(function() {
        var ids = [];
        $('#service_multiple :selected').each(function(i, sel){ 
            ids.push($(sel).val());
        });
        $("#service_ids").val(ids);
    });

    //additional service modal
    $("#material_multiple").select2({ 
        dropdownParent: $('#additionals_material_modal'),
        placeholder: "Select Materials",
        allowClear: true,
        minimumResultsForSearch: -1,
        // tags: true,
        noResults: function() {
            return '<button id="no-results-btn" onclick="noResultsButtonClicked()">No Result Found</a>';
          },
    });

    $("#material_multiple").change(function() {
        var ids = [];
        $('#material_multiple :selected').each(function(i, sel){ 
            ids.push($(sel).val());
        });
        $("#material_ids").val(ids);
    });


});