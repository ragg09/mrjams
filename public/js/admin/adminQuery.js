$(document).on('submit', '#formQuery', function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "https://mrjams.herokuapp.com/admin/adminQuery/",
        // url: "/admin/adminQuery/",
        data: $('#formQuery').serialize(),
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        // headers: {  'Access-Control-Allow-Origin': 'https://mrjams.herokuapp.com/' },
            success: function(data) {

                $('#queryHead').empty();
                $('#table_body').empty();
                $.each(data.query[0], function (index,value) {
                    $('#queryHead').append('<th scope="col">'+index+'</th>');
                });

                $.each(data.query, function (index,value) {
                    var tr = $("<tr>");
                    var row = 1;
                    $.each(value, function (ind,val) {
                        if(row == 3 && val.includes(".com")){
                            tr.append($("<td>").html('<img src="'+val+'">'));
                        }else{
                            tr.append($("<td>").html(val));
                        }
                        row++
                    })
                    $("#table_body").append(tr);
                });
            },
            error: function(error) {
                console.log(error);
                // alert("Your Query is undefined");
            }
    });

});