<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="text-center">
    <h2> مرحبا بك {{$name}} </h2>
    <p>{!! App\Setting::first()->reply_msg ? App\Setting::first()->reply_msg : 'شكرا لتواصلك معنا, سوف نتواصل معك فى أقرب وقت' !!}</p>
</div>

</body>
</html>