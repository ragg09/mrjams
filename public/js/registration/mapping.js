let map, marker, autocomplete;
    var latitude = document.getElementById("latitude").value;    
    var longitude = document.getElementById("longitude").value;
    var myLatLng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });

        // //MARKERS 
        // marker = new google.maps.Marker({
        //     position: myLatLng,
        //     map,
        //     title: "MY SPECIFIC LOCATION",
        //     draggable: true,
        // });

        // marker.addListener("dragend", () => {
        //     document.getElementById("latitude").value = marker.getPosition().lat();    
        //     document.getElementById("longitude").value = marker.getPosition().lng();

        //     console.log('lat: ' + marker.getPosition().lat() + ', lng: ' + marker.getPosition().lng());
            
        //     //get address using api 
        //     // $.ajax({
        //     //     url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+marker.getPosition().lat()+','+marker.getPosition().lng()+'&key=AIzaSyCLGt1NI04qMdTtPkL3KAiHYf4pNTx7cF0',
        //     //     dataType: 'json',
        //     //     type: 'GET',
        //     //     success: function(data){
        //     //         console.log(data);
        //     //     }
            
        //     // });

        // });

        //AUTO COMPLETE SERACH
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('searchInput'),
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('searchInput')),
            {
                types: ['establishment'],
                componentRestrictions: {'country': 'ph'},
                fields: ['place_id, geometry', 'name'],
            }
        );
        
        autocomplete.addListener("place_changed", () => {
            document.getElementById('mapModal').click();
            document.getElementById('address').style.visibility="visible";
            const place = autocomplete.getPlace();

            //console.log(place);

            map = new google.maps.Map(document.getElementById("map"), {
            center: place.geometry.location,
            zoom: 20,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            });

            //MARKERS 
            marker = new google.maps.Marker({
                position: place.geometry.location,
                map,
                title: "MY SPECIFIC LOCATION AFTER SEARCH",
                draggable: true,
            });

            marker.addListener("dragend", () => {
            document.getElementById("latitude").value = marker.getPosition().lat();    
            document.getElementById("longitude").value = marker.getPosition().lng();

            console.log('lat: ' + marker.getPosition().lat() + ', lng: ' + marker.getPosition().lng());
            
            //get address using api 
            $.ajax({
                url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+marker.getPosition().lat()+','+marker.getPosition().lng()+'&key=AIzaSyCLGt1NI04qMdTtPkL3KAiHYf4pNTx7cF0',
                dataType: 'json',
                type: 'GET',
                success: function(data){
                    console.log(data);
                }
            
            });

            });
            
        });


        
    }