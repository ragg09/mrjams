$(function(){

    //calling reusable script
    $.getScript("../../js/clinic/reusableFunction.js");


    //CREATE , create_modal
    $("#feedback_form").on('submit', function(e){
        e.preventDefault();
    
        $.ajax({
            type: $(this).attr('method'),
	    	url: $(this).attr('action'),
	    	data: $('#feedback_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 0){
                    // console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    // console.log(data);

                    $('#feedback_form')[0].reset();
                    $("#give_feedback").modal('toggle');
                    bootstrapAlert(data.message, "success", 250);

                    
                }
            }
        });
    });

})