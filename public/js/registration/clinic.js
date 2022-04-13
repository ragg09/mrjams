$(function(){

    $('#terms_conditions').on('click', function(e){
        if ($(this).is(':checked') && $("#latitude").val() != "") {
            $("#register_btn").prop("disabled", false);
            $("#put_location_first").prop("hidden", true);
         }else{
            $("#register_btn").prop("disabled", true);
            $("#put_location_first").prop("hidden", false);
            $(this).prop( "checked", false );
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
            },
            success: function(data) {
                //console.log(data);
                if(data.status == 0){
                    console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{
                    // console.log("FINISH NA");
                    //console.log(data);
                    window.location.href = "/clinic"; 
                    
                }
            }
        });
     });
     
});