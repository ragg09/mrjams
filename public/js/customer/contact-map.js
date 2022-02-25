function initMap(){
    var options = {
        zoom:12,
        center:{lat:14.520445,lng:121.053886}
    }

    var mapcontact = new google.maps.Map(document.getElementById('map'), options);

    var marker = new google.maps.Marker({
      position:{lat:14.520445,lng:121.053886},
      map:mapcontact,
      // icon:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
    });

    const contentString = "<h1>MR. JAMS</h1>";

    var infoWindow = new google.maps.InfoWindow({
      content: contentString,
    });

    // marker.addListener('click', function(){
    //   infoWindow.open(map, marker);
    // });

    marker.addListener("click", () => { 
        infoWindow.open(mapcontact, marker);
    });


}