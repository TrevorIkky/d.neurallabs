<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @component('mail::message')
    <h1>{{ $email_message }}</h1>
    @component('mail::button', ['url'=> $url, 'color' => 'success'])
    Complete Sign-Up
    @endcomponent
    @endcomponent
</body>

</html>