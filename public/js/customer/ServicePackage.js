$(function(){

  $("#CService").on("click", function(e){

      if($(this).is(':checked')){
        $("#accept_modal_flatpicker").removeAttr("disabled");
        if(($("#accept_modal_flatpicker").val() != "") && ($("#service_multiple").val() != "") && ($("#service_ids").val() != "")){
          $("#appointment_b").removeAttr("disabled");
        
        }
        
      }else if($('#CPackage').is(':checked')){
        if($("#accept_modal_flatpicker").val() != ""){
          $("#appointment_b").removeAttr("disabled");
        }
      }
      else{
        $("#appointment_b").attr("disabled", true);
        $("#accept_modal_flatpicker").attr("disabled", true);
      }

    })

    $("#CPackage").on("click", function(e){
      if($(this).is(':checked')){
        $("#accept_modal_flatpicker").removeAttr("disabled");
        if($("#accept_modal_flatpicker").val() != ""){
          $("#appointment_b").removeAttr("disabled");
        }
      }else if($('#CService').is(':checked')){
        if(($("#accept_modal_flatpicker").val() != "") && ($("#service_ids").val() != "")){
          $("#appointment_b").removeAttr("disabled");
        }
      }
      else{
        $("#appointment_b").attr("disabled", true);
        $("#accept_modal_flatpicker").attr("disabled", true);
      }

    })

})