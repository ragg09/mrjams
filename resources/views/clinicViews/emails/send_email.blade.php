<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mrjams Appointment Notification</title>
</head>
<body>
    
    
    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/274802526_901807270513550_6683193842280506738_n.png?stp=dst-png_p206x206&_nc_cat=101&ccb=1-5&_nc_sid=aee45a&_nc_eui2=AeEE8Da4OtEPemfMZvPVu-OEHmhrUgHqaYoeaGtSAeppihGu8t42qsOvDznc94OeAR3Ky8WRX4-az8xCulXpODGB&_nc_ohc=CyUWpl79w0UAX-7Mk25&_nc_oc=AQlAh9m1__OcCmqX2YmyJnWYI3ROzgb88d49HEwZeJexiLjFipwww476wNmbFsHOowUoWfu7fYSXqlTwivol--fT&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AVLUnRTeKSJ9cffUE_gA7NciL0LyR2SLqS5H8SQSoG6bFA&oe=62613BFC" id="logo"/>
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