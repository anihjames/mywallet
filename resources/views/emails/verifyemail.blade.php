<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <title>myWallet</title>
</head>
<body>
    <h2>Hi {{$user['first_name']}}</h2>
    <br/>
    <h4>Welcome to myWallet</h4>
    <br/>
    Your registered email-id is {{$user['email']}}, Please click on the below button to verify your email account
    <br>
    <a href="{{url('user/verify', $user->verifyUser->token)}}" class="btn btn-info">Verify Email</a>
</body>
</html>