@extends('layouts.app')
@section('title','Forgot your password | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','')
@section('style','')
@section('content')
<div class="container-fluid auth-cont" style="background:none;">
    <div class="container containerLimit">
	    <div class="row m-0 justify-content-center padOnBoth">
		    <div class="col-md-6">
			
                <div class="text2 mb-4">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
	            
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
	            
                <x-jet-validation-errors class="mb-4" />
	            
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
	            
                    <div class="form-group">
						<label for="email" class="col-form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus />
						@error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
	            
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Email Password Reset Link') }}
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