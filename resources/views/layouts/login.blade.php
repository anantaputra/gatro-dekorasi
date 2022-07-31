<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="icon" href="{{ asset('img/logogatro.png') }}" type="image/x-icon">

    <!-- Link Swiper's CSS -->

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Gatro Dekorasi</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #c88a72" >
            <div class="container">           
                <div class="mx-auto">
                    <img src="{{asset('img/gatronav1.png')}}" width="40" height="40" alt="">
                </div>            
            </div>
        </nav>
    </header>
    
    @yield('content')    
    
</body>
</html>