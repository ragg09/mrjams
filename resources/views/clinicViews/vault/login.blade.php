{{-- <form action="{{ route('clinic.owners-vault.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <button type="submit" class="btn btn-primary">Open Vault</button>
</form> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"
        integrity="sha512-nhY06wKras39lb9lRO76J4397CH1XpRSLfLJSftTeo3+q2vP7PaebILH9TqH+GRpnOhfAGjuYMVmVTOZJ+682w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>


</head>

<body>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Open Owner's Vault</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="/">Return to
                            Dashboard</a></div>
                </div>

                <div style="padding-top:30px" class="panel-body">

                    @if ($message = Session::get('wrong_pass'))
                        <div style="display:block" id="login-alert" class="alert alert-danger col-sm-12">
                            {{ $message }}</div>
                    @endif



                    <form action="{{ route('clinic.owners-vault.store') }}" method="POST">
                        @csrf
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password"
                                placeholder="password">
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <button type="submit" class="btn btn-primary">Open Vault</button>

                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>
</body>



</html>
