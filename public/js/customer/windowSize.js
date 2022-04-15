var resizeTimer;
var width;

    $(window).on('resize', function(e) {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {

            $regularSize = 500;
            width = window.innerWidth;

            if(width < $regularSize){
                // console.log("hi");
                window.location.href = "/customer/download/apk"; 
            }

            // console.log("DONE!");


        }, 250);


    });