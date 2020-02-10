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
    <h2>Hi </h2>
    <br/>
    <h4>Welcome to myWallet</h4>
     Please click on the below button to Reset Password
    <br>
    <a href="{{url('/auth/resetPassword', $user->token)}}" class="btn btn-info">Reset Password</a>
</body>
</html>