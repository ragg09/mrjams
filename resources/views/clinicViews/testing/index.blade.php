<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <title>MR. JAMS</title>


  <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Raleway" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('./css/customer/index_one.css')}}">
  <link rel="stylesheet" href="{{asset('./css/customer/map.css')}}">
  <link rel="stylesheet" href="{{asset('./css/customer/customer.css')}}">


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>



  <!-- Forked from a template on Tutorialzine: https://tutorialzine.com/2016/06/freebie-landing-page-template-with-flexbox -->
  <header>
    <h2><img src="{{ URL::asset('images/mrjams/logowithname.png') }}" class="logotitle"></h2>

    <nav>
      <li><a href="/">Home</a></li>
      <li><a href="">About</a></li>
      <li><a href="">Contact</a></li>
      <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                      </li>
                      
      <img class="sticky" src="" alt="sticky-div">
   
  </nav>
  </header>


 

  
  <section class="hero">
    <div class="background-image"></div>
    <div class="hero-content-area">
      <h1>Your Health is our Priority!</h1>
      <h3>Just a Remember, It's Time For Your Appointment</h3>

      <a href="#appoint" class="btn">Get Appointment</a>
    </div>
  </section>

  <section>
  <div>
  <!-- <h1>Simple Navbar</h1>
  <p>This is simple navbar somehow inspired Material Design, pure CSS.</p> -->
  <div id="map" style="width: 1000px; height: 1000px;"></div>

  

   
</div>

  </section>

 
  <section class="packages">
  <!--  <h3 class="title">Services</h3>  -->
    <!-- <p>We offer a variety of group (minimum 5 people) packages. Whether you've spent some summers together or this might be your first adventure, we've got the perfect vacation for you.</p>
 -->   
 <!--  <hr>
 -->
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
  </section>

  
  <footer>
    <p>MR. JAMS</p>
    <p>Created with <i class="fa fa-heart"></i> by TUPT - BSIT 4A | 2018-2022</p>
    <ul>
      <li><a href="#"><i class="fa fa-twitter-square fa-2x"></i></a></li>
      <li><a href="#"><i class="fa fa-facebook-square fa-2x"></i></a></li>
      <li><a href="#"><i class="fa fa-snapchat-square fa-2x"></i></a></li>
    </ul>
  </footer>
    
</body>

<script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLGt1NI04qMdTtPkL3KAiHYf4pNTx7cF0&callback=initMap">
    </script>

<script>
    function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 25,
    center: { lat: 14.50453805256329, lng: 121.05283152757798 }, //papalitan to ng location ng user.
    });
     const image ={
        url: "/images/mrjams/mr-jams-logo.png",
        size: new google.maps.Size(36, 50),
        scaledSize: new google.maps.Size(36, 50),
        anchor: new google.maps.Point(0, 50)
    };
    
    
    
    $.ajax({
      type: "GET", 
      url: "/public/testing/create",
      success: function(data){
      console.log(data);
      
        $.each(data.clinic_add, function(key, val){
            // console.log(val.latitude);
            new google.maps.Marker({
                position: { lat: val.latitude, lng: val.longitude },
                map,
                icon: image,
                
            });

            var marker = new google.maps.Marker({
                position: { lat: val.latitude, lng: val.longitude },
                map:map,
                icon: {
                  url: "/images/mrjams/mr-jams-logo.png",
                  size: new google.maps.Size(36, 50),
                  scaledSize: new google.maps.Size(36, 50),
                  anchor: new google.maps.Point(0, 50)
                 },

            });

            // const contentString = "<h1>MR. JAMS</h1><br>" + "<form>hello, my friend</form><br><br>" + 
            // "<button><a>Appointment</a></button>";

            marker.addListener('click', function(){
                
                $.ajax({
                    type: "GET",
                    url: "/public/testing/" + val.id,
                    success: function(data){
                        console.log(data);

                        const contentString = ""+data.address[0]['address_line_1']+" "+data.address[0]['address_line_2']+" "+data.address[0]['city']+" "+data.address[0]['zip_code'];

                        var infoWindow = new google.maps.InfoWindow({
                        content: contentString,
                        });
                        
                        infoWindow.open(map, marker);
                    


                       

                        
                    },
                    error: function(){
                        console.log('AJAX load did not work');
                        alert("error");
                    }
                });

            });

        });

      
      },
      error: function(){
        console.log('AJAX load did not work');
        alert("error");
      }
    });
  
  
}
</script>

</html>