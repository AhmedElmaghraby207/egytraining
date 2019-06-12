<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="col-sm-12 panel-primary">
    <div class="panel-heading">
        <p class="h3 text-center text-bold">تفعيل الحساب الشخصى</p>
    </div>
    <div class="panel-body">
        <p class="text-center">
            To verify your email <a href="{{route('sendVerifyEmailDone', ["email" => $user->email, "verifyToken" => $user->verifyToken])}}">click here</a>
        </p>
    </div>

</div>
</body>
</html>
