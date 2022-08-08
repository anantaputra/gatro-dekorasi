@extends('layouts.login')

@section('content')

<div class="py-5 mt-5 offset-ml-2">
    <div class="container">
        <div class="row">
            <div class="offset-ml-2">
                <img src="img/vektor-register.png" width="860px" height="390px" class="card-img" alt="...">
            </div>
            <div class="col mt-3">
                    <div>
                        <div><h4><center>{{ __('Register') }}</center></h4></div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
    
                                <div class="row mb-3">
                                    {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}
    
                                    <div class="col">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama" autofocus>
    
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    {{-- <label for="alamat" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label> --}}
    
                                    <div class="col">
                                        <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}" autofocus>
    
                                        @error('alamat')
                                            {{-- <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> --}}
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    {{-- <label for="kota" class="col-md-4 col-form-label text-md-end">{{ __('Kota') }}</label> --}}
    
                                    <div class="col">
                                        <input id="kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" placeholder="Kota" value="{{ old('kota') }}" autofocus>
    
                                        @error('kota')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    {{-- <label for="no_hp1" class="col-md-4 col-form-label text-md-end">{{ __('No HP 1') }}</label> --}}
    
                                    <div class="col">
                                        <input id="no_hp1" type="text" class="form-control @error('no_hp1') is-invalid @enderror" name="no_hp1" value="{{ old('no_hp1') }}" placeholder="No HP 1" autocomplete="no_hp1" autofocus>
    
                                        @error('no_hp1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    {{-- <label for="no_hp2" class="col-md-4 col-form-label text-md-end">{{ __('No HP 2') }}</label> --}}
    
                                    <div class="col">
                                        <input id="no_hp2" type="text" class="form-control @error('no_hp2') is-invalid @enderror" name="no_hp2" placeholder="No HP 2" value="{{ old('no_hp2') }}" autocomplete="no_hp2" autofocus>
    
                                        @error('no_hp2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}
    
                                    <div class="col">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
    
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}
    
                                    <div class="col">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> --}}
    
                                    <div class="col">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password">
                                    </div>
                                </div>
    
                                
    
                                <div class="row mb-0">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary col-12">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-4 mb-0">
                                    <div class="col-12">
                                        <div>
                                            <p>Sudah punya akun? <a href="{{ route('login')}}">Login</a></p> 
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
