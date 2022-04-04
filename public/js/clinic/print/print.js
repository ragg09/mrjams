$(function(){
    //window.print();
    // // history.back();  
    // window.close();


    //auto close after print ONLY, cancel button is not in scope of this code
    setTimeout(function () { window.print(); }, 500);
    window.onfocus = function () { 
        setTimeout(function () { window.close(); }, 100); 
    }
    
});