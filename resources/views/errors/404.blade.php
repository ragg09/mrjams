<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ URL::asset('images/mrjams/mr-jams-logo.png') }}"/>
    <title>Page Not Found</title>

    {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bootstrap 5.1.1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

      {{-- font-awesome  --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        :root {
            --varyDarkBlue: hsl(234, 12%, 34%);
            --grayishBlue: hsl(229, 6%, 66%);
            --veryLightGray: hsl(0, 0%, 98%);
        }

        #pagenotfound{
            padding: 0px;
            margin: 0px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: var(--veryLightGray);
            box-shadow: 0px 40px 50px -20px var(--grayishBlue);
            border-top: 5px solid rgb(11, 95, 173);
            border-radius: 10px;
        }

        #pagenotfound2{
            padding: 0px;
            margin: 0px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: var(--veryLightGray);
            box-shadow: 0px 40px 50px -20px var(--grayishBlue);
            border-top: 5px solid rgb(11, 95, 173);
            border-radius: 10px;
        }

        #back_btn{
            margin-bottom: 100px;
        }
        /* #pagenotfound1{
            width: 100%;
        } */
    </style>
</head>
<body>
    {{-- <h1>CUSTOM PAGE NOT FOUND</h1>
    <a href="">Back Previous Page</a> --}}
    {{-- <div id="pagenotfound">
        <img src="{{ URL::asset('images/mrjams/page_not_found_1.png') }}" id="pagenotfound1"/>
        <button onclick="history.back()" type="button" class="btn btn-primary mx-auto d-block" id="back_btn"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</button>
    </div> --}}

    <div id="pagenotfound2">
        <img src="{{ URL::asset('images/mrjams/page_not_found_2.png') }}" id="pagenotfound1"/>
        <button onclick="history.back()" type="button" class="btn btn-primary mx-auto d-block" id="back_btn"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</button>
    </div>
</body>
</html>