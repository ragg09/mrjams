var map, marker, autocomplete;
    

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: { lat: parseInt(14.50453805256329), lng: parseInt(121.05283152757798) }, //papalitan to ng location ng user.
    });

    //initial mapping
    $.ajax({
        type: "GET", 
        url: "/customer/customermap/create",
        success: function(data){
        // console.log(data);
        
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
  
                const contentString = "<section class='about'><p style='font-size:25px; margin-bottom:3px; color: #6497B1; font-weight:bold;'>"+val.name+"</p><p style='font-size:15px; margin-bottom:3px; font-weight:bold;'><b>"+val.type+" Clinic</b></p><p style='font-size:13px; margin-bottom:3px;'><b>Address:</b>"+ val.address_line_1 +" "+ val.address_line_2 +" ,<br>"+ val.city +" "+ val.zip_code +"</p><p style='font-size:13px; margin-bottom:3px;'><b>Phone: </b>"+val.phone+"</p><p style='font-size:13px; margin-bottom:3px;'><b>Telephone: </b>"+val.telephone+"</p><a class='btn btn-light' href='/customer/appointment/"+val.id+"' style='color: white; font-size:12px;'>View More</a></section>";
  
              // const contentString = "<section class='about'><p class='subtitle'>"+val.name+"</p><p style='font-size:15px;'><b>"+val.type+" Clinic</b></p><p class='parag'><strong>Address:</strong>"+ val.address_line_1 +" "+ val.address_line_2 +" ,<br>"+ val.city +" "+ val.zip_code +"</p><p><b>Phone: </b>"+val.phone+"</p><p><b>Telephone: </b>"+val.telephone+"</p><p class='parag'><a class='btn btn-light' href='/customer/appointment/"+val.id+"' style='color: white;'>View More</a></section>";
  
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



    //search box
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('searchInput')
        // document.getElementById('searchInput')),
        // {
        //     types: ['establishment'],
        //     componentRestrictions: {'country': 'ph'},
        //     fields: ['place_id, geometry', 'name'],
        // }

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('searchInput')),
        // {
        //     types: ['establishment'],
        //     componentRestrictions: {'country': 'ph'},
        //     fields: ['place_id, geometry', 'name'],
        // }
    );

    autocomplete.addListener("place_changed", () => {
        // document.getElementById('mapModal').click();
        // document.getElementById('addressaddress').style.visibility="visible";
        const place = autocomplete.getPlace();

        map = new google.maps.Map(document.getElementById("map"), {
            center: place.geometry.location,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });

        $.ajax({
            type: "GET", 
            url: "/customer/customermap/create",
            success: function(data){
                // console.log(data);
                marker = new google.maps.Marker({
                    position: place.geometry.location,
                    map,
                    title: "MY SPECIFIC LOCATION AFTER SEARCH",
                });    

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
        
                    const contentString = "<section class='about'><p style='font-size:25px; margin-bottom:3px; color: #6497B1; font-weight:bold;'>"+val.name+"</p><p style='font-size:15px; margin-bottom:3px; font-weight:bold;'><b>"+val.type+" Clinic</b></p><p style='font-size:13px; margin-bottom:3px;'><b>Address:</b>"+ val.address_line_1 +" "+ val.address_line_2 +" ,<br>"+ val.city +" "+ val.zip_code +"</p><p style='font-size:13px; margin-bottom:3px;'><b>Phone: </b>"+val.phone+"</p><p style='font-size:13px; margin-bottom:3px;'><b>Telephone: </b>"+val.telephone+"</p><a class='btn btn-light' href='/customer/appointment/"+val.id+"' style='color: white; font-size:12px;'>View More</a></section>";
        
        
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
      
    });
   
}
