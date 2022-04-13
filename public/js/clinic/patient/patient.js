$(function(){
    $("#PatientDataTable").DataTable({
        "ordering": false,
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "info": false,
    });


    $(document).on('click', 'a#send_email_btn', function(e) {
        e.preventDefault();
        // alert("Asdasd")
        var name = $(this).data('name');
        var email = $(this).data('email');


        
        $("#send_email_name").text(name)

        $("#name").val(name)
        $("#email").val(email)

    });

    //Send Email
    $("#send_email_main_form").on('submit', function(e){
        e.preventDefault();


        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $('#send_email_main_form').serialize(),
            beforeSend: function(){
                $(document).find('span.error-text').text('');

                
                $('#send_email_btn_send').attr("hidden", true)
                $('#response_waiting_send_email').removeAttr("hidden");
            },
            success: function(data) {
                //$("#update_main_form")[0].reset();
                $('#send_email_btn_send').removeAttr("hidden");
                $('#response_waiting_send_email').attr("hidden", true)

                if(data.status == 0){
                    $.each(data.error, function(key, val){
                        $('span.'+key+'_error').text(val[0]);
                   });
                }else{
                    // console.log(data);
                    $("#send_email_modal").modal('toggle');
                    bootstrapAlert(data.message, "success", 300);
                }

            },
            error: function(error) {
              console.log(error);
            }
        });

    });
})

