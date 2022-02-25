$(document).on('click', 'a#editUser', function(e) {
    // e.preventDefault();
    // var id = $(this).data('id');
    // $.ajax({
    //     type: "GET",
    //     url: "/admin/patient/" + id + "/edit",
    //     success: function (response) {
    //         // console.log(response.user);
    //         console.log(response);
    //         // console.log('shit');
    //         $("#name").val(response.name); // set textbox with id name
    //         $("#phone").val(response.phone); // set textbox with id sex
    //         $("#telephone").val(response.telephone); // set textbox with id phone
    //     },
    //     error: function(){
    //         console.log('AJAX load did not work');
    //         alert("error");
    //     }
    // });

    // $("#patientShow").on('click',"#dltbtnPatient",function(e) {
    //     var id = $(this).data('id');
    //     // var $tr = $(this).closest('tr');
    //     console.log(id);
    //         e.preventDefault();
    //         bootbox.confirm({
    //             message: "do you want to delete this producer",
    //             buttons: {
    //                 confirm: {
    //                     label: 'yes',
    //                     className: 'btn-success'
    //                 },
    //                 cancel: {
    //                     label: 'no',
    //                     className: 'btn-danger'
    //                 }
    //             },
    //             callback: function (result) {
    //                 if (result){
    //                     $.ajax({
    //                         type: "DELETE",
    //                         url: "/admin/patient/"+ id,
    //                         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //                         dataType: "json",
    //                         success: function(data) {
    //                             console.log(data);
    //                             // bootbox.alert('success');
    //                             $tr.find('td').fadeOut(2000,function(){ 
    //                             $tr.remove();  
    //                             });   
    //                         },
    //                         error: function(error) {
    //                             console.log('error');
    //                         }
    //                         });
    //                 }
    //             }
    //         });
    //     });

    // $( "#dltbtnPatient" ).click(function() {
    //     alert( "Handler for .click() called." );
    //   });

    // $( "#viewPatient" ).click(function() {
    //     alert( "VIEW" );
    //   });

});

$(document).on('click', 'a#dltbtnPatient', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: "/admin/patient/" + id + "@" ,
        success: function(data){
            console.log(data);
            $('#userIDDelete').val(data.patients.id);
        },
        error: function(){
            console.log('AJAX load did not work');
            alert("error");
        }
    });
});

$(document).on('click', 'button#confirm_delete', function(e) {
    e.preventDefault();
    var id = $("input#userIDDelete").val();
    $.ajax({
        type: "DELETE",
        url: "/admin/patient/"+ id,
        // data:{
        //     _token: "_token",
        // },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        success: function(data) {
            $("#patientShow").load(window.location + " #patientShow");
            $("#delete_modal_up").modal('toggle');
        },
        error: function(error) {
          console.log('error');
        }
      });
});