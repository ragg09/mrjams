$(function(){
    $('#TimeDate').hide()
    $('#Preferences').hide()
    $('#Specialists').hide();

    $('#DetailsSettings').on('click', function(e){
        e.preventDefault();
        $('#Details').show();
        $('#TimeDate').hide();
        $('#Preferences').hide();
        $('#Specialists').hide();
    });

    $('#TimeDateSettings').on('click', function(e){
        e.preventDefault();
        $('#Details').hide();
        $('#TimeDate').show();
        $('#Preferences').hide();
        $('#Specialists').hide();

        // $.ajax({
        //     type: "GET",
        //     url: "/clinic/settings/timedate/edit",
        //     success: function(data){   
        //         console.log(data);
        //         $.each(data.data, function(key, val){
        //             $('#put_timedate').append('<div class="row align-items-baseline""><div class="col d-flex justify-content-center"><p class="fw-bold">'+val.day+'</p></div><div class="col d-flex justify-content-center"><div class="form-group" id="flatpickr"><input type="text" class="form-control" id="min_time" name="min_time" value="'+val.min+'"></div></div><div class="col d-flex justify-content-center"><div class="form-groug" id="flatpickr"><input type="text" class="form-control" id="max_time" name="max_time" value="'+val.max+'"></div></div><div class="col d-flex justify-content-center"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault check="true" ></div></div></div>');
        //         });

        //         const full = $("#min_time");

        //         const arr = [...full].map(input => input.value);
        //         console.log(arr);

        //     },
        //     error: function(){
        //         console.log('AJAX load did not work');
        //         alert("error");
        //     }
        // });
        
    });

    $('#SpecialistsSettings').on('click', function(e){
        e.preventDefault();
        $('#Details').hide();
        $('#TimeDate').hide();
        $('#Preferences').hide();
        $('#Specialists').show();
    });

    $('#PreferencesSettings').on('click', function(e){
        e.preventDefault();
        $('#Details').hide();
        $('#TimeDate').hide();
        $('#Preferences').show();
        $('#Specialists').hide();
    });
})