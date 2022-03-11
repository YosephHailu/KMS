<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>403 Forbidden</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{asset('css/error_page_style.css')}}" />

</head>

<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>4<span>0</span>3</h1>
            </div>
            <h2>You're not allowed to access this resource</h2>
            <a href="{{url()->previous()}}" class="home_btn"> Go back</a>
            <a href="{{url('/')}}" class="home_btn_home"> Go Home</a>
        </div>
    </div>
</body>

</html>