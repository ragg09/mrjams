
let map, marker, autocomplete;
var latitude = document.getElementById("lat").value;    
var longitude = document.getElementById("lon").value;
var myLatLng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

var drag_val = false;


function MapListner(){
    
    if(drag_val == false){
        drag_val = true;
        initMap(drag_val)
        document.getElementById("p1").innerHTML = "Cancel";
        document.getElementById("p1").className = "btn btn-outline-danger";
    }else{
        drag_val = false;
        initMap(drag_val)
        document.getElementById("p1").innerHTML = "Edit";
        document.getElementById("p1").className = "btn btn-outline-primary";
    }
}

    
function initMap(drag_val) {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
        zoom: 19,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });

    marker = new google.maps.Marker({
        position: myLatLng,
        map,
        title: "My Clinic",
        draggable: drag_val,
      });

    marker.addListener("dragend", () => {
        document.getElementById("lat").value = marker.getPosition().lat();    
        document.getElementById("lon").value = marker.getPosition().lng();
        //console.log('lat: ' + marker.getPosition().lat() + ', lng: ' + marker.getPosition().lng());
    });
    
}
    
 

    

    