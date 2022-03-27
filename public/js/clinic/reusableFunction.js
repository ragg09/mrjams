//GROWL function for popup messages
function bootstrapAlert(message, type, width){
    $.bootstrapGrowl(message, // Messages
    { // options
        type: type, // info, success, warning and danger
        ele: "body", // parent container
        offset: {
            from: "top",
            amount: 20
        },
        align: "center", // right, left or center
        width: width,
        delay: 1000,
        allow_dismiss: false, // add a close button to the message
        stackup_spacing: 10
    });
}