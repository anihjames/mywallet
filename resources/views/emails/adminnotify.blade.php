<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>myWallet</title>
</head>
<body>
    Hello Admin
    <h4> <p><B>{{$user->fname}} {{$user->lname}}</B> with email {{$user['email']}} just registered into the {{config('app.name')}}</p> </h4>

    <br>
    <br>
    <a href="{{URL::to('/')}}">myWallet</a>
</body>
</html>