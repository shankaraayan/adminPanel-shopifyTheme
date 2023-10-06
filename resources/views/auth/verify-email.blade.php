@extends('layouts.app')
@section('title','Verify your email | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','')
@section('style','')
@section('content')
<div class="container-fluid auth-cont" style="background:none;">
    <div class="container containerLimit">
	    <div class="row m-0 justify-content-center padOnBoth">
		    <div class="col-md-6">
                <p class="mb-4">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>
	            
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
	            
                <div class="mt-4 flex justify-between">
                    <div class="row">
					    <div class="col-8 pr-0 no-pad">
						    <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <div>
                                    <button type="submit" class="btn btn-primary text-left no-pad">
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                </div>
                            </form>
						</div>
					    <div class="col-4 p-0 text-right">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
					    
                            <button type="submit" class="btn btn-link">
                                {{ __('Logout') }}
                            </button>
                        </form>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptContent')
@endsection