$(document).on('click', 'button#acceptClinicReg', function(e) {
    var id = $('input#clinicRegID').val();
    // console.log(data);
    $.ajax({
        type: "PUT",
        url: "/admin/clinicReg/" + id ,
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
            success: function(data) {
                // console.log(data);
                window.location.href = "/admin/clinic";
            },
            error: function(error) {
                console.log(error);
            }
    });

});

$(document).on('click', 'a#deleteClinicReg', function(e) {
    var id = $('input#clinicRegID').val();
    $.ajax({
        type: "DELETE",
        url: "/admin/clinicReg/" + id ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
            success: function(data) {
                // console.log(data);
                window.location.href = "/admin/clinic";
            },
            error: function(error) {
                console.log(error);
            }
    });

});