$(function(){

    //calling reusable script
    $.getScript("../../js/customer/reusableFunction.js");

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
                // console.log(data);
                if(data.status == 0){
                    // console.log(data);
                    $.each(data.error, function(key, val){
                         $('span.'+key+'_error').text(val[0]);
                    });
                }else{      
                    // window.location.href = "/customer/customerinfo/create"; 
                    bootstrapAlert("Your Profile is Successfully Updated!", "success", 290);

                    setInterval(reloader, 1500);

                    function reloader(){
                        location.reload();
                    }

                    // $("#main_form")[0].reset();
                    // $("#profile").load(window.location + " #profile");

                    //dugain muna kaya natin HAHHAHAHAHHA
                    //paano?
                    //ang pinaka habol mo sa gantong approach ung allert message dba?
                    // oo sige sige pansamantala dudugain muna natin yan
                    // paano? alin di ako mag palit palit mamaya sa checking?
                    
                }
            }
        });
     });
     
});
 