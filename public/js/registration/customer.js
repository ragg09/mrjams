$(function(){

    $('#terms_conditions').on('click', function(e){
        if ($(this).is(':checked') && $("#latitude").val() != "") {
            $("#register").prop("disabled", false);
         }else{
            $("#register").prop("disabled", true);

         }
    });


    $("#main_form").on('submit', function(e){
        e.preventDefault();
    
        $.ajax({
            type: $(this).attr('method'),
	    	url: $(this).attr('action'),
	    	data: $('#main_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');

                $("#register").prop("hidden", true);
                $("#register_response_waiting").prop("hidden", false);
            },
            success: function(data) {
                $("#register").prop("hidden", false);
                $("#register_response_waiting").prop("hidden", true);
                //console.log(data);
                if(data.status == 0){
                    // console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{      
                    window.location.href = "/customer"; 
                    
                }
            }
        });
     });
     
});
 