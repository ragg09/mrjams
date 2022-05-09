
    $("#patientShow").DataTable({
        "ordering": true,
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "info": true,
        // "responsive": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print',
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
        ]
    });

     

$(document).on('click', 'button#updatePatient', function(e) {
    // $.getScript("../../js/admin/reusableFunction.js");
    

    var id = $('input#userID').val();
    // console.log(data);
    $.ajax({
        type: "PUT",
        url: "/admin/patient/" + id ,
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
            success: function(data) {
                // console.log(data);
                // $('#editModalgenre').each(function(){
                //         $(this).modal('hide'); });
                // location.reload();
               
                $("#UpdateUser").load(window.location + " #UpdateUser");
            
                // bootstrapAlert("Successfully Updated", "success", 250);
                setInterval( reload_page, 1000);

                function reload_page(){
                    location.reload()
                }
            },
            error: function(error) {
                console.log(error);
            }
    });

});

$(document).on('click', 'a#dltbtnPatient', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: "/admin/patient/" + id + "@" ,
        success: function(data){
            // console.log(data);
            $('#userIDDeletePatient').val(data.patients.id);
        },
        error: function(e){
            // console.log('AJAX load did not work');
            // alert("error");
            console.log(e);
        }
    });
});

$(document).on('click', 'button#confirm_delete', function(e) {
    e.preventDefault();
    var id = $("input#userIDDeletePatient").val();

    // console.log(id);
 //hmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm asan master mo?
    $.ajax({
        type: "DELETE",
        url: "/admin/patient/"+ id,
        data:{
            _token: $("input[name=_token]").val()
        },
        success: function(data) {

            // console.log(data);
            $("#patientShow").load(window.location + " #patientShow");
            $("#delete_modal_patient").modal('toggle');
        },
        error: function(error) {
          console.log(error);
        }
      });
});

// $(function(){
//     $("#patientShow").DataTable({
//         "ordering": false,
//         "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
//         "info": false,
//     });
// })


//nagets mo ba gnwa ko? hindi wait

//san controller close mo lagat ng tab na d magagamit