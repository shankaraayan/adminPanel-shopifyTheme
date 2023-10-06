@extends('layouts.app')
@section('title','Reset your password | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','')
@section('style','')
@section('content')
<div class="container-fluid auth-cont" style="background:none;">
    <div class="container containerLimit">
	    <div class="row m-0 justify-content-center padOnBoth">
		    <div class="col-md-6">

                <x-jet-validation-errors class="mb-4" />
	            
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
	            
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
	            
                    <div class="form-group">
						<label for="email" class="col-form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email', $request->email)}}" required autofocus />
						@error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
	            
                    <div class="form-group mt-4">
                        <label for="password" class="col-form-label">{{ __('Password') }}</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    </div>
	            
                    <div class="form-group mt-4">
                        <label for="password_confirmation" class="col-form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
	            
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
				
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptContent')
@endsection