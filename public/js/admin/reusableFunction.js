//GROWL function for popup messages
function bootstrapAlert(message, type, width){
    $.bootstrapGrowl(message, // Messages
    { // options
    type: type, // info, success, warning and danger
    ele: "body", // parent container
    offset: {
        from: "top",
        amount: 530
    },
    align: "right", // right, left or center
    width: width,
    delay: 1000,
    allow_dismiss: false, // add a close button to the message
    stackup_spacing: 10
    });
}