<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Link Swiper's CSS -->

    <link
    rel="stylesheet"
    href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
    />
    <style>
        .swiper {
        width: 600px;
        height: 300px;
        }
        .kiri
        {
            padding: 10px;
            margin-top: 0px;
            margin-right: 90px;
            width: 600px;
        }
        .kanan
        {
            width: 330px;
            margin-top: -492px;
            margin-bottom: 20px;
            margin-right: 75px;
            float: right;
        }
        @media print
        {
            .no-print{
                display: none!important;
            }
        }

    </style>

    <link rel="icon" href="{{ asset('img/gatronav1.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <title>Gatro Dekorasi</title>
</head>
<body style="background-color: #f1f0f0fd">

    {{-- ig wa nav --}}
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #c88a72">
        <div class="container">
            
            <div class="ml-5 mr-auto text-white" style="font-family: 'Courier New', Courier, monospace">
                <img src="{{ asset('img/gatronav1.png') }}" width="35px" height="35px" alt=""> Gatro Dekorasi                
            </div>
            
        </div>
    </nav>


        @yield('content')

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
