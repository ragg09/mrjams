$(function(){
    $('#edit_details').on('click', function(e){
        
        if ($(this).is(':checked')) {
            $("#edit_detials_form :input").prop("disabled", false);
            $("#edit_detials_form :button").prop("disabled", false);
         }else{
            $("#edit_detials_form :input").prop("disabled", true);
            $("#edit_detials_form :button").prop("disabled", true);
         }
    });

    $("#edit_detials_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#edit_detials_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                console.log(data);
                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    location.reload();
                //     $('#edit_details').trigger("click");
                //     $("#equipment_table").load(window.location + " #equipment_table");
                //     $("#edit_modal_up").modal('toggle');
                //     bootstrapAlert(data.message, "info", 200);
                }
            }
        });
    });
    

    
})