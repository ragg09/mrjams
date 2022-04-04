var map, marker, autocomplete;
// var clinicLatLng = " ";
// var currentLocation= " ";
var pointA = "";
var pointB = "";
var pointAlat = "";
var pointAlng = "";
var pointBlat = "";
var pointBlng = "";
// var pointBlongi = "";

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: { lat: 14.50453805256329, lng: 121.05283152757798 }, //papalitan to ng location ng user.
       
    });

   
    var id = $('#clinic_id').val();
    // console.log(id);

   
    


     $.ajax({
            type: "GET", 
            url: "/customer/announcement/"+id+"/edit",
            success: function(data){
                console.log(data); 

                 

                $.each(data.clinic_data, function(key, val){
                    // console.log(val.latitude);

                    pointBlat = val.latitude;
                    pointBlng = val.longitude;

                    
                      var marker = new google.maps.Marker({
                          position: { lat: parseFloat(val.latitude), lng: parseFloat(val.longitude) },
                          map:map,
                          icon: {
                              url: "/images/mrjams/mr-jams-logo.png",
                              size: new google.maps.Size(50, 60),
                              scaledSize: new google.maps.Size(50, 60),
                              anchor: new google.maps.Point(0, 60)
                          }
                         
                      });
        
                      const contentString = "<section class='about'><p style='font-size:15px; margin-bottom:3px; color: #6497B1; font-weight:bold;'>"+val.name+"</p><p style='font-size:12px; margin-bottom:3px; font-weight:bold;'><b>"+val.type+" Clinic</b></p><p style='font-size:12px; margin-bottom:3px;'><b>"+ val.city +" | "+ val.zip_code +"</b></p>";
        
        
                      var infoWindow = new google.maps.InfoWindow({
                          content: contentString,
                      });
        
                      marker.addListener('click', function(){
                          infoWindow.open(map, marker);
                      });
        
                });


                //current location
                infoWindow = new google.maps.InfoWindow();

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                    (position) => {
                        pointA = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        // console.log("hello"+pointA.lat);
            
                        pointAlat = position.coords.latitude;
                        pointAlng = position.coords.longitude;
            
                        // console.log(pointAlat);
            
                        // markerA = new google.maps.Marker({
                        //     position: pos,
                        //     title: "point A",
                        //     // label: "A",
                        //     map: map
                        //   })
            
                        // infoWindow.setPosition(pos);
                        // infoWindow.setContent("Your Location.");
                        infoWindow.open(map);
                        map.setCenter(pointA);

                console.log("hello "+pointA.lat);

                var pointALatitude = parseFloat(pointA.lat);
                var pointBLatitude = parseFloat(pointBlat);
                var pointALongi = parseFloat(pointA.lng);
                var pointBlongi = parseFloat(pointBlng);
                


                //direction
                var pointAa = new google.maps.LatLng(parseFloat(pointA.lat), parseFloat(pointA.lng));
                var pointBb = new google.maps.LatLng(parseFloat(pointBlat), parseFloat(pointBlng));
              
       
                directionsService = new google.maps.DirectionsService;
                directionsDisplay = new google.maps.DirectionsRenderer({
                  map: map
                });
        
       
                 // / get route from A to B
               calculateAndDisplayRoute(directionsService, directionsDisplay, pointAa, pointBb);
       
              function calculateAndDisplayRoute(directionsService, directionsDisplay, pointAa, pointBb) {
                   directionsService.route({
                     origin: pointAa,
                     destination: pointBb,
                     travelMode: google.maps.TravelMode.DRIVING
                   }, function(response, status) {
                     if (status == google.maps.DirectionsStatus.OK) {
                       directionsDisplay.setDirections(response);
                     } else {
                       window.alert('Directions request failed due to ' + status);
                     }
                   });
              }

              // Calculating Distance from current location to clinic:
              
                    // Draw a line showing the straight distance between the markers
                    var line = new google.maps.Polyline({path: [pointAa, pointBb], map: map});
                    
                    function haversine_distance() {
                      var R = 3958.8; // Radius of the Earth in miles
                      var rlat1 = pointALatitude * (Math.PI/180); // Convert degrees to radians
                      var rlat2 = pointBLatitude * (Math.PI/180); // Convert degrees to radians
                      var difflat = rlat2-rlat1; // Radian difference (latitudes)
                      var difflon = ( parseFloat(pointBlng) - pointALongi ) * (Math.PI/180); // Radian difference (longitudes)
                
                      var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
                      return d;
                    }

                    // Calculate and display the distance between markers
                    var distance = haversine_distance(pointAa, pointBb);
                    document.getElementById('msg').innerHTML = "<i>Distance between your Location and the Clinic: </i><b>" + distance.toFixed(2) + " mi. </b>";
              // 
                      
                    },
                    () => {
                        handleLocationError(true, infoWindow, marker, map.getCenter());
                    }
                    );
                }


            },
                error: function(){
                console.log('AJAX load did not work');
                alert("error");
                }
        });

        //   console.log(pointAlat);


          
      
   
}
