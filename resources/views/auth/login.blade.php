@extends('layouts.login')

@section('content')

<div class="py-5 mt-1">
    <div class="ml-5">
        <div class="row w-100">
            <div class="col mt-5 w-50">
                <div class="offset-ml-2 mt-5">
                    <img src="{{ asset('img/vektor-about.png') }}" width="320px" height="320px" class="card-img" alt="...">
                </div>    
            </div>

            <div class="col mt-5 w-50">
                <div class="mt-5 ml-5" style="width: 25rem;">
                    <div class="px-3">
                        <div class="w-100 d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: rgb(146, 80, 80)" width="45" height="45" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </div>
                    </div>
    
                    <div class="card-body outline-dark">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group">
                                
                                <div class="form-group">
                                    <input id="email" placeholder="Username/Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
    
                                <div class="form-group">
                                    <input id="password"  placeholder="Password"type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="w-100 d-flex align-items-center justify-content-between mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" style="color: black" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    </div>
                                </div>
                            </div>
    
    
                            <div class="row mb-0">
                                <div class="w-100">
                                    <div class="px-3">
                                        <button type="submit" class="w-100 btn btn-primary" style="background-color: rgb(146, 80, 80)">
                                            {{ __('Login') }}
                                        </button> 
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </div>

</div>

@endsection
