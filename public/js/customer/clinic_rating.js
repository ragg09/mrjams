$(function(){
    //calling reusable script
    $.getScript("../../js/customer/reusableFunction.js");

    $("#main_form").on('submit', function(e){
        e.preventDefault();
        // alert("hi");
        $.ajax({
            type: $(this).attr('method'),
	    	url: $(this).attr('action'),
	    	data: $('#main_form').serialize(),
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
                    // window.location.href = "/customer/announcement"; 
                    bootstrapAlert("Your Rate for this Clinic is Successfully Created", "warning", 400);
                    $("#appoint_info").append();
                    
                }
            }
        });
     });
     
});
 