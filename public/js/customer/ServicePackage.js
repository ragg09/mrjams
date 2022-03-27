$(function(){

  $("#CService").on("click", function(e){

      if($(this).is(':checked')){
        if($("#accept_modal_flatpicker").val() != ""){
          $("#appointment_b").removeAttr("disabled");
        }
        
      }else if($('#CPackage').is(':checked')){
        if($("#accept_modal_flatpicker").val() != ""){
          $("#appointment_b").removeAttr("disabled");
        }
      }
      else{
        $("#appointment_b").attr("disabled", true);
      }

    })

    $("#CPackage").on("click", function(e){
      if($(this).is(':checked')){
        if($("#accept_modal_flatpicker").val() != ""){
          $("#appointment_b").removeAttr("disabled");
        }
      }else if($('#CService').is(':checked')){
        if($("#accept_modal_flatpicker").val() != ""){
          $("#appointment_b").removeAttr("disabled");
        }
      }
      else{
        $("#appointment_b").attr("disabled", true);
      }

    })

})