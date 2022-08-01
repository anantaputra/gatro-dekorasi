
@if (auth()->user() && auth()->user()->is_admin == 1 && Request::is('admin*')) 

@extends('navigation.sidebar-admin')

@else

{{-- navigasi untuk user --}}

{{-- ig wa nav
<nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #0b9999">
<div class="container">
    
    <div class="mx-auto">

        <a href="https://www.instagram.com/gatro_dekorasipati/"><img src="img/ig1.png" width="30px" height="30px" class="mx-2" alt=""></a> 
        <img src="img/wa.png" width="30px" height="30px" alt=""> 
        
    </div>
    
</div>
</nav> --}}

{{-- top navigation bar --}}
<nav class="navbar navbar-expand-md navbar-light border-bottom" style="background-color: #c88a72">
<div class="container text-center">
    
        <ul class="navbar-nav col-md-1">
        
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav mx-auto">
            <li class="nav-item mx-5">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item dropdown mx-5">
                <a class="nav-link dropdown" href="#kategori">Category</a>
            </li>
            <li class="nav-item mx-5">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item mx-5">
                <a class="nav-link" href="#galeri">Gallery</a>
            </li>
            <li class="nav-item mx-5">
                <a class="nav-link" href="#contact">Contact</a>
            </li>
            
            <!-- Authentication Links -->
        </ul>
        <ul class="navbar-nav col-md-1">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown ms-auto">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="{{ route('user.profil', ['id' => Auth::user()->id]) }}" class="dropdown-item">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</div>
</nav>

@endif
