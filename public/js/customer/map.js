


function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 17,
    center: { lat: 14.50453805256329, lng: 121.05283152757798 }, //papalitan to ng location ng user.
    });
   
    
    
    $.ajax({
      type: "GET", 
      url: "/customer/customermap/create",
      success: function(data){
      //console.log(data);
      
        $.each(data.data, function(key, val){
            // console.log(val.latitude);
            new google.maps.Marker({
                position: { lat: parseInt(val.latitude), lng: parseInt(val.longitude) },
                map,
                icon: {
                  url: "/images/mrjams/mr-jams-logo.png",
                  size: new google.maps.Size(60, 80),
                  scaledSize: new google.maps.Size(60, 0),
                  anchor: new google.maps.Point(0, 80)
                 }

                
            });

            var marker = new google.maps.Marker({
                position: { lat: val.latitude, lng: val.longitude },
                map:map,
                icon: {
                  url: "/images/mrjams/mr-jams-logo.png",
                  size: new google.maps.Size(60, 80),
                  scaledSize: new google.maps.Size(60, 80),
                  anchor: new google.maps.Point(0, 80)
                 }
                // icon:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachlfag.png'
                  // size = new google.maps.Size(71, 71),
            });

            const contentString = "<section class='about'><p class='subtitle'>Dental Place</p><p class='parag'><strong>Address:</strong> Upper Bicutan, Taguig City 1633</p><p class='parag'><strong>Latitude:</strong> 12.123456789</p><p class='parag'><strong>Longitude:</strong> 12.123456789</p></section>" + 
            "<a class='modal-open' href='/customer/appointment/2'>View More</a>";

            
        

            // const contentString = "" + val.latitude;

            var infoWindow = new google.maps.InfoWindow({
                content: contentString,
            });

            marker.addListener('click', function(){
                infoWindow.open(map, marker);
            });

        });

      
      },
      error: function(){
        console.log('AJAX load did not work');
        alert("error");
      }
    });
  
  
}
