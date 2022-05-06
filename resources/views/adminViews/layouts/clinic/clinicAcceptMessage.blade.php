<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MRJAMS NOTIFICATIONS</title>
</head>
<body>
   
    <div class="row">
        <div class="col">
            <div  style="padding: 20px; border: 2px solid #6497B1; width: 800px;">
                
                <div style="width: 100%;">
                    <img src="https://res.cloudinary.com/mrjams/image/upload/v1651734738/MRJAMS/email-mrjams_wcpjef.png" id="email_sent" style="width: 60%; display: block;margin-left: auto; margin-right: auto;"/>
                </div>

                <div style=" text-align: center;">
                    <h1></i><span>{{$details['title']}}</span></h1>
                    <h3>{{$details['body']}}</h3>
                    <p>We will keep you posted on the latest events, updates, and announcements.</p>
                    <a  href="https://mrjams.herokuapp.com/" style="color: white; text-decoration: none; border-radius: 5px; background-color: #6497B1;">&nbsp; Home &nbsp;</a>
                </div>

            </div>
        </div>
    </div>
    {{-- #6497B1 --}}

</body>
</html>