$("#menu-toggle").click(function (e){
    e.preventDefault();
    $("#wrapper").toggleClass("menuDisplayed"); 
    $(".menu_appointment_dropdown").hide(100);
    //$(".menu_services_dropdown").hide(100);
    // $(".menu_equipments_dropdown").hide(100);
    // $(".menu_packages_dropdown").hide(100);
       
});

$(".menu_appointment").click(function (e){
    e.preventDefault();
    $(".menu_appointment_dropdown").toggle(200);

    // to open sidebar while in spacesaver mode
    if($("#sidebar-wrapper").width() == 45){
        $("#wrapper").toggleClass("menuDisplayed");
    }
});

// $(".menu_services").click(function (e){
//     e.preventDefault();
//     $(".menu_services_dropdown").toggle(200);

//     if($("#sidebar-wrapper").width() == 45){
//         $("#wrapper").toggleClass("menuDisplayed");
//     }
// });

// $(".menu_equipments").click(function (e){
//     e.preventDefault();
//     $(".menu_equipments_dropdown").toggle(200);

//     if($("#sidebar-wrapper").width() == 45){
//         $("#wrapper").toggleClass("menuDisplayed");
//     }
// });

// $(".menu_packages").click(function (e){
//     e.preventDefault();
//     $(".menu_packages_dropdown").toggle(200);

//     if($("#sidebar-wrapper").width() == 45){
//         $("#wrapper").toggleClass("menuDisplayed");
//     }
// });