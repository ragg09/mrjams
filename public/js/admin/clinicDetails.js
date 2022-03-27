$(document).on('click', 'button#clinicTypeSubmit', function(e) {
    // var id = $('input#clinicID').val();
    // console.log(data);
    $.ajax({
        type: "POST",
        url: "/admin/clinicTpyes/",
        data: data,
        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
            success: function(data) {
                console.log(data);
                // $('#editModalgenre').each(function(){
                //         $(this).modal('hide'); });
                // location.reload();
            },
            error: function(error) {
                console.log('error');
            }
    });

});

$(document).on('click', 'button#updateClinic', function(e) {
    var id = $('input#clinicID').val();
    console.log(data);
    $.ajax({
        type: "PUT",
        url: "/admin/clinic/" + id ,
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
            success: function(data) {
                console.log(data);
                // $('#editModalgenre').each(function(){
                //         $(this).modal('hide'); });
                // location.reload();
            },
            error: function(error) {
                console.log('error');
            }
    });

});

$(document).on('click', 'a#dltbtnClinic', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: "/admin/clinic/" + id + "@" ,
        success: function(data){
            console.log(data);
            $('#userIDDeleteClinic').val(data.clinics.id);
        },
        error: function(){
            console.log('AJAX load did not work');
            alert("error");
        }
    });
});

$(document).on('click', 'button#confirm_delete', function(e) {
    e.preventDefault();
    var id = $("input#userIDDeleteClinic").val();
    $.ajax({
        type: "DELETE",
        url: "/admin/clinic/"+ id,
        // data:{
        //     _token: "_token",
        // },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        success: function(data) {
            $("#clinicShow").load(window.location + " #clinicShow");
            $("#delete_modal_clinic").modal('toggle');
        },
        error: function(error) {
          console.log('error');
        }
      });
});