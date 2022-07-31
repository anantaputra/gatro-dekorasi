<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="">

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
            margin-right: 80px;
            width: 600px;
        }
        .kanan
        {
            width: 330px;
            margin-top: -415px;
            margin-bottom: 20px;
            margin-right: 75px;
            float: right;
        }
        .btn-kategori:hover{
            background-color: #c88a72;
            color: white;
            border: 1px solid #c88a72;
        }
        .btn-kat{
            background-color: #c88a72;
            color: white;
            border: 1px solid #c88a72;
        }
    </style>

    <link rel="icon" href="{{ asset('img/logogatro.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <title>
        Gatro Dekorasi 
    </title>
</head>
<body>

    @if (Request()->route()->getPrefix('admin'))

    <div class="w-100 row">
        {{-- link buat navigasi top --}}
        @include('navigation.topnav')

        @yield('content')
    </div>
        
    @else
        
    @include('navigation.topnav')

    <div class="jumbotron -m-4" style="background-image: url(img/landpage6.png);">
        <div class="d-flex justify-content-end mt-5"></div>
        <div class="d-flex justify-content-end mt-5"></div>
        <div class="d-flex justify-content-end mt-5"></div>
        <div class="d-flex justify-content-end mt-5"></div>
        <div class="d-flex justify-content-end mt-3"></div>
        <div class="d-flex justify-content-center mt-5 ml-5">
            <a href="#headingOne" role="button" class="btn btn-outline-dark " style="width: 8rem; height: 2.7rem; position: absolute; right: 40rem; margin-top: -1rem; background-color: #c88a72; color: white; border: 1px solid white">Book Now</a>
        </div>       
    </div>
    

    @yield('content')

    @endif

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

 <!-- Initialize Swiper -->
 <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        slidesPerView: 3,
        spaceBetween: 0.5,
        autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        });
    </script>

</body>
</html>
