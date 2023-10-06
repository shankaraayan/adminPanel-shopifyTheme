@extends('layouts.app')
@section('title','Home - Vitality Club - My account')
@section('description','')
@section('keywords','')
@section('canonical','')
@section('style','.myaccount{background-color:#cf597e;color:white;}.myaccount:hover{color:white;}')
@section('content')
<div class="container containerLimit myaccount-main-cont">
    <div class="row">
    	<div class="col-lg-3 myaccount-left-cont notOnMobile">
    		<div class="nav flex-lg-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			    <a class="nav-link myaccountBtn myaccount" href="/myaccount">My account</a>
    			<a class="nav-link myaccountBtn myorders" href="/myorders">Orders</a>
				<a class="nav-link myaccountBtn logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
    		</div>
    	</div>
		<div class="col-12 myaccount-left-cont onlyOnMobile">
            <div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle menuBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My account</button>
            	<div class="dropdown-menu">
				    <a class="dropdown-item myaccount" href="/myaccount">My information</a>
            		<a class="dropdown-item myorders" href="/myorders">Orders</a>
            		<a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            	</div>
            </div>
    	</div>
    	<div class="col-lg-9 myaccount-right-cont">
		    @if(session('status'))
                <div class="alert alert-success" role="alert">
			        {{ session('status') }}
                </div>
            @endif
			<div class="container">
			    <p class="subheading1">Contact Information</p>
				<div class="row">
				    <div class="col-2 text1">Name:</div>
				    <div class="col-10 text1">{{ Auth::user()->name }}</div>
				</div>
				<div class="row">
				    <div class="col-2 text1">Email:</div>
				    <div class="col-10 text1">{{ Auth::user()->email }}</div>
				</div>
			</div>
			<div class="container myaccount-divider"></div>
			<div class="container">
			    <div class="row">
				    <div class="col-md-6 mb-4 mb-md-0">
					    <p class="subheading1">Shipping Address</p>
						@if($user_info->shipping_address != '')
						<p class="text1 mb-0">{{$user_info->first_name}} {{$user_info->last_name}}</p>
						<p class="text1 mb-0">{{$user_info->shipping_address}}</p>
						<p class="text1 mb-0">{{$user_info->shipping_city}}, {{$user_info->shipping_state}} - {{$user_info->shipping_pincode}}</p>
						<p class="text1 mb-0">{{$user_info->shipping_country}}</p>
						<p class="text1 mb-0">{{$user_info->phone}}</p>
						@else
						<p class="text1 mb-0">No information</p>
						@endif
					</div>
				    <div class="col-md-6">
					    <p class="subheading1">Billing Address</p>
						@if($user_info->billing_address != '')
						    @if($user_info->billing_status != 'Yes')
								<p class="text1 mb-0">{{$user_info->billing_first_name}} {{$user_info->billing_last_name}}</p>
							    <p class="text1 mb-0">{{$user_info->billing_address}}</p>
						        <p class="text1 mb-0">{{$user_info->billing_city}}, {{$user_info->billing_state}} - {{$user_info->billing_pincode}}</p>
						        <p class="text1 mb-0">{{$user_info->billing_country}}</p>
						        <p class="text1 mb-0">{{$user_info->billing_phone}}</p>
							@else
								<p class="text1 mb-0">Same as shipping address</p>
							@endif
						@else
						<p class="text1 mb-0">No information</p>
						@endif
					</div>
				</div>
			</div>
			<div class="container myaccount-divider"></div>
			<div class="container">
			    <p class="subheading1">Subscription</p>
				<p class="text1 mb-5">@if($user_info != null) @if($user_info->subscribed_status == "Yes")Subscribled to our newsletter (Yes) @else Subscribled to our newsletter (No) @endif @else Subscribled to our newsletter (No) @endif</p>
				<button type="button" class="btn btn-primary accountMainBtn" data-toggle="modal" data-target="#myaccountInfo">Update details</button>
			</div>
    	</div>
    </div>
</div>
<div class="modal fade" id="myaccountInfo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
		        <form class="needs-validation myaccount-Information-form" action="/myaccount" method="POST" onsubmit="return validateForm()" novalidate>
				    @csrf
                	<div class="form-row">
    				    <div class="col-md-6 mb-3">
    					    <p class="label1 mb-0">Contact Information</p>
    					</div>
                		<div class="col-md-12 mb-3">
                			<input type="text" class="form-control" id="validationCustom01" name="name" value="{{ Auth::user()->name }}" placeholder="Name" readonly required />
                		</div>
    				</div>
                	<div class="form-group mb-5">
						<div class="custom-control custom-checkbox">
						    <input type="checkbox" class="custom-control-input" id="validationCustom02" name="subscribed" @if($user_info != null) @if($user_info->subscribed_status != "No") checked @endif @endif>
							<label class="custom-control-label label2" for="validationCustom02">Keep me up to date on news and exclusive offers</label>
						</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <p class="label1 mb-0">Shipping Address</p>
    					</div>
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control" id="validationCustom03" name="shippingFirstname" value="@if($user_info != null) {{$user_info->first_name}} @endif" placeholder="First Name" required />
                		</div>
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control" id="validationCustom04" name="shippingLastname" value="@if($user_info != null) {{$user_info->last_name}} @endif" placeholder="Last Name" required />
                		</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="text" class="form-control" id="validationCustom05" name="shippingAddress" value="@if($user_info != null) {{$user_info->shipping_address}} @endif" placeholder="Address" required />
    					</div>
                		<div class="col-md-12 mb-3">
                			<input type="text" class="form-control" id="validationCustom06" name="shippingCity" value="@if($user_info != null) {{$user_info->shipping_city}} @endif" placeholder="City" required />
                		</div>
                		<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom07" name="shippingCountry" required>
                				<option disabled value="">Country/Region</option>
                				<option value="India" selected>India</option>
                			</select>
                		</div>
    					<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom08" name="shippingState" required>
                				<option selected disabled value="">State</option>
                				@foreach ($shippings->unique('state') as $shipping)
								    <option value="{{$shipping->state}}" @if($user_info != null) @if($user_info->shipping_state == $shipping->state) selected @endif @endif>{{$shipping->state}}</option>
								@endforeach
                			</select>
                		</div>
                		<div class="col-md-4 mb-3">
                			<input type="number" class="form-control" id="validationCustom09" name="shippingPincode" value="@if($user_info != null){{$user_info->shipping_pincode}}@endif" placeholder="Pincode" required />
                		</div>
                	</div>
    				<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="number" class="form-control" id="validationCustom10" name="shippingPhone" value="@if($user_info != null){{$user_info->phone}}@endif" placeholder="Phone" required />
    					</div>
    				</div>
					<div class="form-group mb-5">
						<div class="custom-control custom-checkbox">
						    <input type="checkbox" class="custom-control-input" id="validationCustom11" name="billingCheckbox" onclick="updateBillingAddress(this)" @if($billing_status != "No") checked @endif>
							<label class="custom-control-label label2" for="validationCustom11">Billing address is same as Shipping address</label>
						</div>
                	</div>
					<div id="billingAddressForm">
					    <div class="form-row">
                	    	<div class="col-md-12 mb-3">
							    <p class="label1 mb-0">Billing address</p>
							</div>
                		    <div class="col-md-6 mb-3">
                		    	<input type="text" class="form-control" id="validationCustom12" name="billingFirstname" value="@if($user_info != null) {{$user_info->billing_first_name}} @endif" placeholder="First name" required />
                		    </div>
                		    <div class="col-md-6 mb-3">
                		    	<input type="text" class="form-control" id="validationCustom13" name="billingLastname" value="@if($user_info != null) {{$user_info->billing_last_name}} @endif" placeholder="Last name" required />
                		    </div>
							<div class="col-md-12 mb-3">
    				    	    <input type="text" class="form-control" id="validationCustom14" name="billingAddress" value="@if($user_info != null) {{$user_info->billing_address}} @endif" placeholder="Address" required />
    				    	</div>
                	    	<div class="col-md-12 mb-3">
                	    		<input type="text" class="form-control" id="validationCustom15" name="billingCity" value="@if($user_info != null) {{$user_info->billing_city}} @endif" placeholder="City" required />
                	    	</div>
                	    	<div class="col-md-4 mb-3">
                	    		<select class="custom-select" id="validationCustom16" name="billingCountry" required>
                			    	<option disabled value="">Country/Region</option>
                			    	<option value="India" selected>India</option>
                			    </select>
                	    	</div>
    				    	<div class="col-md-4 mb-3">
                	    		<select class="custom-select" id="validationCustom17" name="billingState" required>
                				    <option selected disabled value="">State</option>
                				    @foreach ($shippings->unique('state') as $shipping)
								        <option value="{{$shipping->state}}" @if($user_info != null) @if($user_info->billing_state == $shipping->state) selected @endif @endif>{{$shipping->state}}</option>
								    @endforeach
								</select>
                	    	</div>
                	    	<div class="col-md-4 mb-3">
                	    		<input type="number" class="form-control" id="validationCustom18" name="billingPincode" value="@if($user_info != null){{$user_info->billing_pincode}}@endif" placeholder="Pincode" required />
                	    	</div>
    				        <div class="col-md-12 mb-5">
    				        	<input type="number" class="form-control" id="validationCustom19" name="billingPhone" value="@if($user_info != null){{$user_info->billing_phone}}@endif" placeholder="Phone" required />
    				        </div>
                	    </div>
					</div>
                	<div class="form-row mt-4">
    				    <div class="col-md-12 mb-3">
    					    <button class="btn btn-primary" type="submit">Submit</button>
							<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
    					</div>
    				</div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
	var isBillingSame = "{{$billing_status}}";
	var billingAddressForm = document.getElementById("billingAddressForm");
	if(isBillingSame == "No"){
		billingAddressForm.style.display = "block";
	}
		
    function updateBillingAddress(billingCheckbox){
		var billingAddressForm = document.getElementById("billingAddressForm");
        billingAddressForm.style.display = billingCheckbox.checked ? "none" : "block";
	}
	
	function validateForm() {
		var billingCheckbox = document.getElementById("validationCustom11");
		if(billingCheckbox.checked){
			document.getElementById("validationCustom12").value = document.getElementById("validationCustom03").value;
			document.getElementById("validationCustom13").value = document.getElementById("validationCustom04").value;
			document.getElementById("validationCustom14").value = document.getElementById("validationCustom05").value;
			document.getElementById("validationCustom15").value = document.getElementById("validationCustom06").value;
			document.getElementById("validationCustom17").value = document.getElementById("validationCustom08").value;
			document.getElementById("validationCustom18").value = document.getElementById("validationCustom09").value;
			document.getElementById("validationCustom19").value = document.getElementById("validationCustom10").value;
		}
	}
</script>
@endsection
@section('endscripts')
@endsection