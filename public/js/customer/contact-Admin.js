$(function(){
    
    //calling reusable script
    $.getScript("../../js/customer/reusableFunction.js");

    $("#contact_form").on('submit', function(e){
        e.preventDefault();
        // alert("hi");
        $.ajax({
            type: $(this).attr('method'),
	    	url: $(this).attr('action'),
	    	data: $('#contact_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                // console.log(data);
                if(data.status == 0){
                    // console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{      
                   
                    bootstrapAlert("Your Message to Admin is Successfully Created!", "success", 400);
                    setInterval(reloader, 1500);

                    function reloader(){
                        location.reload();
                    }
              
                  
                }
            }
        });
     });
     
});
 