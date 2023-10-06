@extends('layouts.app')
@section('title','Sign Up | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','')
@section('style','')
@section('content')
<div class="container-fluid auth-cont" style="background:none;">
    <div class="container containerLimit">
	    <div class="row justify-content-center">
		    <div class="col-md-6">
			    <p class="heading2 text-center">SIGN UP</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-12 col-form-label">{{ __('Name') }}</label>
                        <div class="col-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
	
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-12 col-form-label">{{ __('Email') }}</label>
	
                        <div class="col-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
	
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
	
                    <div class="form-group">
                        <label for="password" class="col-12 col-form-label">{{ __('Password') }}</label>
	
                        <div class="col-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
	
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
	
                    <div class="form-group">
                        <label for="password-confirm" class="col-12 col-form-label">{{ __('Confirm Password') }}</label>
	
                        <div class="col-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
					
					<input id="role" type="hidden" class="form-control" name="role" value="customer">
	
                    <div class="form-group row mb-0">
                        <div class="col-12 padLeft30">
                            <button type="submit" class="btn btn-primary">SIGN UP</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptContent')
@endsection