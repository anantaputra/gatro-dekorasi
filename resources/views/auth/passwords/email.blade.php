@extends('layouts.detail')

@section('content')

<div class="py-5 mt-1">
    <div class="ml-5">
        <div class="row w-100">
            <div class="col mt-5 w-50">
                <div class="offset-ml-4 mt-1">
                    <img src="{{ asset('img/forgot.png') }}" width="320px" height="420px" class="card-img" alt="...">
                </div>    
            </div>

            <div class="col mt-5 w-50">
                <div class="mt-5 ml-5" style="width: 25rem;">
                    <div class="px-3">
                        <div class="w-100 d-flex justify-content-left">
                            <h2>FORGOT</h2>
                        </div>
                        <div class="w-100 d-flex justify-content-left">
                            <h2>PASSWORD</h2>
                        </div>
                        <div class="w-100 d-flex justify-content-left">
                            <p>Please enter your email here</p>
                        </div>
                    </div>

                    <div class="card-body outline-dark">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                <div class="col-md">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
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