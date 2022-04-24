<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mrjams Appointment Notification</title>
</head>
<body>
    
    
    <img src="https://res.cloudinary.com/mrjams/image/upload/v1650790344/MRJAMS/logowithname_hek7qj.png" id="logo"/>
    {{-- <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" id="logo"/> --}}
    

    <h1>{{ $details['title'] }}</h1>

    <h3>{{ $details['clinic'] }}</h3>
    <p>{{ $details['address'] }}</p>
    <p>{{ $details['contact'] }}</p>

    <br>

    {{-- <p>Reference: {{ $details['app_id'] }}</p> --}}
    {{-- <p>Receipt No.: {{ $details['ro_id'] }}</p> --}}
    <br>

    <p>{{ $details['body'] }}</p>



    <p>Thank You!!</p>
</body>
</html>