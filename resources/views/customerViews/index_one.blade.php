@extends('customerViews.layouts.customerlayout')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/index_one.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/map.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/infowindow.css')}}">
    <link rel="stylesheet" href="{{asset('./css/customer/customer.css')}}">
@endsection
@section('content')
@include('customerViews.header.header1')


      <section class="hero">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;	background-image: url(/images/mrjams/index_one.jpg); background-size: cover; z-index: -1; background-color: #80a3db;"></div>
          <div class="hero-content-area">
            <h1>Your Health is our Priority!</h1>
            <h3>Just a Reminder, It's Time For Your Appointment</h3>

            <a href="#map_locate" class="btn">Get Appointment</a>
          </div>
      </section>
      
      <section class="mapcontain">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="mapModal" hidden>
        </button>

       

        <div class="container" id="map_locate">

          <div class="form-floating mb-3" >
            <input class="form-control" type="text" id="searchInput" placeholder="" >
            <label for="floatingInput">Search landmark near to your location</label>
          </div>

          <div id="map"></div>
        </div>
          <br><br>
      </section>

      <section >

                <div class="container">
                  <div class="row align-items-center">
                      <div class="col-lg-6 mb-4 mb-lg-0">
                          <div class="mx-auto text-center">
                            <img src="/images/mrjams/steps1.png" alt="" width="100%" height="300px"/>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                            <br>
                            <p style="font-size: 30px;"><b>Guide for Making Appointments</b></p>
                            <p><b>Step 1: Navigate to the Mapping section and select the clinic where you'd want to schedule an appointment.</b> Customers can schedule an appointment in one of two ways: first, go to the maps and select a clinic, or second, go to the clinic tab and search for the clinic they wish to visit. There's also a category search to help you discover the clinic you're looking for more quickly. </p>
                                 
                                 
                          </div>
                      </div>
                  </div>
                </div>
          
                <div class="container">
                  <div class="row align-items-center">
                     

                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                          <br>
                          <br>
                          <!-- <h1>Column 1</h1> -->
                          <p><b>Step 2: When you click "View More," all of the clinic's information will show.</b> Then you will see the clinic's contact information, such as phone and fax numbers. There's also the clinic's address, as well as the clinic's packages and services. You can also make an appointment on this page if you see a package or service that you want at that clinic. </p>
                                 
                          </div>
                      </div>

                      <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="mx-auto text-center">
                          <img src="/images/mrjams/steps2.png" alt="" width="100%" height="300px"/>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="container">
                  <div class="row align-items-center">
                      <div class="col-lg-6 mb-4 mb-lg-0">
                          <div class="mx-auto text-center">
                            <img src="/images/mrjams/steps3.png" alt="" width="100%" height="300px"/>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                            <br>
                            <br>
                          <p><b>Step 3: After clicking "Get Appointment," you'll be asked if this appointment is for you or for someone else, such as a relative or friend. </b>It is important for the clinic you choose to know if this appointment is for you or not. Because the clinic requires the patient's details in order to schedule an appointment</p>
                                 
                                 
                          </div>
                      </div>
                  </div>
                </div>


                <div class="container" style="margin-bottom: 40px;">
                  <div class="row align-items-center">
                     

                      <div class="col-lg-6">
                          <div class="ps-lg-6 ps-xl-10 w-lg-90">
              
                            <br>
                            <br>
                            <p><b>Step 4: After you've answered the question, you'll be directed to the appointment page, where you may fill out the necessary details. </b>Personal information such as name, age, address, and other details must be filled in. There's also one for the service or package you choose. After you've completed all of the required fields, you can submit your request and wait for confirmation from the clinic of your choice.</p>
                                 
                          </div>
                      </div>

                      <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="mx-auto text-center">
                          <img src="/images/mrjams/steps4.png" alt="" width="100%" height="300px"/>
                        </div>
                    </div>
                  </div>
                </div>


    </section>

    <section class="packages">
      <ul class="grid">
        <li>
          <i class="fa fa-map-marker fa-4x"></i>
          <h4>Mapping</h4>
          <p>Mapping for nearby and available clinics.</p>
        <li>
          <i class="fa fa-medkit fa-4x"></i>
          <h4>Medical Services</h4>
          <p>list of services offered by a clinic.</p>
        </li>
        <li>
          <i class="fa fa-user-md fa-4x"></i>
          <h4>Find A Doctor</h4>
          <p>A doctor who specializes in the service you need.</p>
        </li>
        <li>
          <i class="fa fa-calendar fa-4x"></i>
          <h4>Request an Appoinment</h4>
          <p>You can schedule an appointment at any time and from any location.</p>
        </li>
      </ul>
      <br><br>
    </section>

@include('customerViews.footer.footer1')
@endsection
@section('jsScript')

<script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap&libraries=places">
</script>

<script>
var map, marker, autocomplete;
    

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: { lat: parseFloat(4.50453805256329), lng: parseFloat(121.05283152757798) }, //papalitan to ng location ng user.
        });
    
        //initial mapping
        $.ajax({
            type: "GET", 
            url: "/customer/customermap/create",
            success: function(data){
            console.log(data);
            
              $.each(data.data, function(key, val){
                  // console.log(val.latitude);
                    new google.maps.Marker({
                        position: { lat: parseFloat(val.latitude), lng: parseFloat(val.longitude) },
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
                            position: { lat: parseFloat(val.latitude), lng: parseFloat(val.longitude) },
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
    
</script>
  
  {{-- <script src="{{ URL::asset('js/customer/map.js') }}"></script> --}}
@endsection


  

  
 