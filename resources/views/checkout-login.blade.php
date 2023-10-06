@extends('layouts.app')
@section('title','Log In - Vitality Club - Checkout')
@section('description','')
@section('keywords','')
@section('canonical','https://www.vitalityclub.in/checkout/login')
@section('style','')
@section('content')
<div class="container-fluid auth-cont">
    <div class="container containerLimit">
	    <div class="row">
		    <div class="col-md-6 left-col">
			    <p class="heading2">LOG IN</p>
		        <form method="post" action="/checkout/login">
		            @csrf
		        	<div class="form-group">
                        <label for="email" class="col-12 col-form-label">{{ __('Email') }}</label>
		        
                        <div class="col-12 pl-0">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
		        
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-12 col-form-label">{{ __('Password') }}</label>
		        
                        <div class="col-12 pl-0">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
		        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-4 no-pad">
                            <button type="submit" class="btn btn-primary">LOG IN</button>
						</div>
						<div class="col-8 text-right">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text2 no-pad" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
		        </form>
		        @if (session('warning'))
                    <div class="alert alert-danger alert-dismissible fade show mt-5">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('warning') }}
                    </div>
                @endif
			</div>
	        <div class="col-md-6 right-col mobSignUp">
			    <p class="heading2">Continue as a guest</p>
	        	<div class="form-group row m-0">
				    <div class="col-12 p-0">
				        <button class="btn btn-primary" onclick="location.href='{{ route('checkout.contact-information') }}'">Continue</button>
					</div>
				</div>
	        </div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
@endsection