@extends('checkout.app')
@section('title','Information - Vitality Club - Checkout')
@section('style','#mainContent{padding-top:0;}.table thead th{border:none;} .table th{border:none;}')
@section('content')
<div class="container-fluid checkout-main-cont">
    <div class="container checkout-cont">
        <p class="text-center onlyOnIpad mb-0"><a href="/"><img class="checkout-logo" src="{{asset('images/vitality-club-logo.jpg')}}"/></a></p>
		<div class="row">
    		<div class="col-lg-5 order-lg-2 checkout-cont-right">
    			<div class="accordion" id="accordionExample">
	                <div class="card">
	                	<div class="card-header" id="headingOne">
	                		<h2 class="mb-0">
							<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#cartSummaryCollapse" aria-expanded="true" aria-controls="cartSummaryCollapse">
							<i class="fas fa-shopping-cart"></i> Order summary <span class="orderSummaryArrow"></span><span id="orderSummaryAmt" style="float:right"></span>
							</button>
							</h2>
	                	</div>
	                	<div id="cartSummaryCollapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
	                		<div class="card-body">
							    <?php $total=0 ?>
				                <div class="container" style="border-bottom:1px solid #c9c9c9;">
    			                @foreach(session('cart') as $products => $product)
    			                <?php $total += $product['price'] * $product['quantity'] ?>
    			                <div class="row mb-3">
    			                	<div class="col-8 pro-flex p-0">
										<div class="img-block" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',strtoupper($product['code'])) @endphp/{{$product['image']}}');">
				                			<div class="item-count">{{$product['quantity']}}</div>
				                		</div>
    			                		<div class="text-block">
				                		    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				                			    <p class="mb-0 productName">{{$product['name']}}</p>
				                				@if($product['variantValue'] != "")
				                				    <p class="mb-0 productColor">{{$product['variantType']}}: <?php echo ucwords(str_replace('+',' ',$product['variantValue'])) ?></p>
				                				@endif
				                			</td></tr></table>
				                		</div>
    			                	</div>
				                	<div class="col-4 p-0">
				                	    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
				                		    <p class="mb-0 productPrice">INR <?php echo number_format($product['price'] * $product['quantity']) ?></p>
				                		</td></tr></table>
				                	</div>
    			                </div>
    			                @endforeach
				                </div>
				                <div class="container py-3" style="border-bottom:1px solid #c9c9c9;">
				                    <div class="row mb-2">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Subtotal</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">INR <?php echo number_format($total, 2) ?></p></div>
				                	</div>
									@php $discount = 0; @endphp
									@if(count((array) session('autoDiscount')) > 0)
									@php if(Session::get('autoDiscount')['discountType'] == "Percentage"){ $discount = $total * (Session::get('autoDiscount')['discountValue'] / 100); }else{ $discount = Session::get('autoDiscount')['discountValue']; } @endphp
									<div class="row mb-2">
			            	    	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Discount ({{Session::get('autoDiscount')['discountTitle']}})</p></div>
			            	    	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">- INR <?php echo number_format($discount, 2) ?></p></div>
			            	    	</div>
									@elseif(Session::get('customer')['discount_value'] > 0)
									@php if(Session::get('customer')['discount_type'] == "Percentage"){ $discount = $total * (Session::get('customer')['discount_value'] / 100); }else{ $discount = Session::get('customer')['discount_value']; } @endphp
									<div class="row mb-2">
			            	    	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Discount</p></div>
			            	    	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">- INR <?php echo number_format($discount, 2) ?></p></div>
			            	    	</div>
									@endif
				                	<div class="row mb-2">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Shipping</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel1">Calculated at next step</p></div>
				                	</div>
				                	<div class="row">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Taxes</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel1">Calculated at next step</p></div>
				                	</div>
				                </div>
				                <div class="container py-3">
				                    <div class="row">
				                	    <div class="col-6 p-0"><p class="mb-0 orderValueLabel">Total</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 orderValue" id="totalCost">INR <?php echo number_format(($total - $discount), 2) ?></p></div>
				                	</div>
				                </div>
							</div>
						</div>
					</div>
				</div>
    		</div>
    		<div class="col-lg-7 order-lg-1 checkout-cont-left">
                <p class="text-center notOnIpad"><a href="/"><img class="checkout-logo" src="{{asset('images/vitality-club-logo.jpg')}}"/></a></p>
                <p class="text-center">
                    <button class="btn btn-link checkoutBtns active" onclick="location.href='/cart'">Cart</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns current" style="cursor:context-menu">Information</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns">Shipping</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns">Payment</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns">Review</button>
                </p>
		        <form class="needs-validation checkout-Information-form" action="/checkout/contact-information" method="post" onsubmit="return validateForm()" novalidate>{{ csrf_field() }}
                	<div class="form-row">
    				    <div class="col-md-6 mb-3">
    					    <p class="label1 mb-0">Contact Information</p>
    					</div>
    				    <div class="col-md-6 mb-3">
    					    @if(Auth::guest())<p class="label2 text-md-right mb-0">Already have an account? <a href="/checkout/login" class="checkout-login"><b>Log in</b></a></p>@endif
    					</div>
    				    <div class="col-md-12 mb-2">
    					    <input type="email" class="form-control @error('email') is-invalid @enderror" id="validationCustom01" name="email" value="{{old('email')}}{{Session::get('customer')['email']}}" required @if(Auth::user()) readonly @else autofocus @endif>@if(Auth::guest())<span class="floating-label">Email</span>@endif</input>
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
    					</div>
    				</div>
                	<div class="form-group mb-md-5 mb-4">
						<div class="custom-control custom-checkbox">
						    <input type="checkbox" class="custom-control-input" id="validationCustom02" name="subscribed" @if(Session::get('customer')['subscribed_status'] != "No") checked @endif>
							<label class="custom-control-label label2" for="validationCustom02">Keep me up to date on news and exclusive offers</label>
						</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <p class="label1 mb-0">Shipping address</p>
    					</div>
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control @error('firstname') is-invalid @enderror" id="validationCustom03" name="firstname" value="{{old('firstname')}}{{Session::get('customer')['first_name']}}" required><span class="floating-label">First name</span></input>
							@error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control @error('lastname') is-invalid @enderror" id="validationCustom04" name="lastname" value="{{old('lastname')}}{{Session::get('customer')['last_name']}}" required><span class="floating-label">Last name</span></input>
							@error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="text" class="form-control @error('address') is-invalid @enderror" id="validationCustom05" name="address" value="{{old('address')}}{{Session::get('customer')['address']}}" required><span class="floating-label">Address</span></input>
							@error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
    					</div>
                		<div class="col-md-12 mb-3">
                			<input type="text" class="form-control @error('city') is-invalid @enderror" id="validationCustom06" name="city" value="{{old('city')}}{{Session::get('customer')['city']}}" required><span class="floating-label">City</span></input>
							@error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                		<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom07" name="country" required>
                				<option disabled value="">Country/Region</option>
                				<option value="India" selected>India</option>
                			</select>
                		</div>
    					<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom08" name="state" required>
                				<option selected disabled value="">State</option>
                				@foreach ($shippings->unique('state') as $shipping)
								    <option value="{{$shipping->state}}" @if(Session::get('customer')['state'] == $shipping->state || old('state') == $shipping->state) selected @endif>{{$shipping->state}}</option>
								@endforeach
                			</select>
                		</div>
                		<div class="col-md-4 mb-3">
                			<input type="number" class="form-control @error('pincode') is-invalid @enderror" id="validationCustom09" name="pincode" value="{{old('pincode')}}{{Session::get('customer')['pincode']}}" required><span class="floating-label">PIN code</span></input>
							@error('pincode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                	</div>
    				<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="validationCustom10" name="phone" value="{{old('phone')}}{{Session::get('customer')['phone']}}" required><span class="floating-label">Phone</span></input>
							@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
    					</div>
    				</div>
					<div class="form-group mb-5">
						<div class="custom-control custom-checkbox">
						    <input type="checkbox" class="custom-control-input" id="validationCustom11" name="billingCheckbox" onclick="updateBillingAddress(this)" @if(Session::get('customer')['billing_checkbox'] != "No") checked @endif>
							<label class="custom-control-label label2" for="validationCustom11">Billing address is same as Shipping address</label>
						</div>
                	</div>
					<div id="billingAddressForm">
					    <div class="form-row">
                	    	<div class="col-md-12 mb-3">
							    <p class="label1 mb-0">Billing address</p>
							</div>
                		    <div class="col-md-6 mb-3">
                		    	<input type="text" class="form-control @error('billingFirstname') is-invalid @enderror" id="validationCustom12" name="billingFirstname" value="{{old('billingFirstname')}}{{Session::get('customer')['billing_first_name']}}" required><span class="floating-label">First name</span></input>
								@error('billingFirstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                		    </div>
                		    <div class="col-md-6 mb-3">
                		    	<input type="text" class="form-control @error('billingLastname') is-invalid @enderror" id="validationCustom13" name="billingLastname" value="{{old('billingLastname')}}{{Session::get('customer')['billing_last_name']}}" required><span class="floating-label">Last name</span></input>
								@error('billingLastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                		    </div>
							<div class="col-md-12 mb-3">
    				    	    <input type="text" class="form-control @error('billingAddress') is-invalid @enderror" id="validationCustom14" name="billingAddress" value="{{old('billingAddress')}}{{Session::get('customer')['billing_address']}}" required><span class="floating-label">Address</span></input>
								@error('billingAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    				    	</div>
                	    	<div class="col-md-12 mb-3">
                	    		<input type="text" class="form-control @error('billingCity') is-invalid @enderror" id="validationCustom15" name="billingCity" value="{{old('billingCity')}}{{Session::get('customer')['billing_city']}}" required><span class="floating-label">City</span></input>
								@error('billingCity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                	    	</div>
                	    	<div class="col-md-4 mb-3">
                	    		<select class="custom-select" id="validationCustom16" name="billingCountry" required>
                	    			<option disabled value="">Country/Region</option>
                	    			@foreach ($shippings->unique('country') as $shipping)
									<option value="{{$shipping->country}}" @if($shipping->country == "India") selected @endif>{{$shipping->country}}</option>
									@endforeach
                	    		</select>
                	    	</div>
    				    	<div class="col-md-4 mb-3">
                	    		<select class="custom-select" id="validationCustom17" name="billingState" required>
                	    			<option selected disabled value="">State</option>
                				    @foreach ($shippings->unique('state') as $shipping)
									<option value="{{$shipping->state}}" @if(Session::get('customer')['billing_state'] == $shipping->state || old('billingState') == $shipping->state) selected @endif>{{$shipping->state}}</option>
								    @endforeach
                	    		</select>
                	    	</div>
                	    	<div class="col-md-4 mb-3">
                	    		<input type="number" class="form-control @error('billingPincode') is-invalid @enderror" id="validationCustom18" name="billingPincode" value="{{old('billingPincode')}}{{Session::get('customer')['billing_pincode']}}" required><span class="floating-label">PIN code</span></input>
								@error('billingPincode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                	    	</div>
    				        <div class="col-md-12 mb-5">
    				        	<input type="number" class="form-control @error('billingPhone') is-invalid @enderror" id="validationCustom19" name="billingPhone" value="{{old('billingPhone')}}{{Session::get('customer')['billing_phone']}}" required><span class="floating-label">Phone</span></input>
								@error('billingPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    				        </div>
                	    </div>
					</div>
                	<div class="form-row mt-4">
    				    <div class="col-md-6 order-md-2 mb-3 text-md-right text-center">
    					    <button class="btn continueBtn" type="submit">Continue to Shipping</button>
    					</div>
						<div class="col-md-6 order-md-1 mb-3 text-md-left text-center">
    					    <a class="btn btn-link returnToCart" href="/cart"><i class="fas fa-chevron-left"></i> Return to Cart</a>
    					</div>
    				</div>
                </form>
    			<p class="py-3 mb-0">
                    <button class="btn btn-link checkout-policy-btns" onclick="window.open('/shipping-policy','_blank')">Shipping policy</button>
                    <button class="btn btn-link checkout-policy-btns" onclick="window.open('/cancellation-policy','_blank')">Cancellation policy</button>
                    <button class="btn btn-link checkout-policy-btns" onclick="window.open('/return-policy','_blank')">Return Policy</button>
                    <button class="btn btn-link checkout-policy-btns" onclick="window.open('/privacy-policy','_blank')">Privacy Policy</button>
                </p>
    		</div>
    	</div>
    </div>
</div>
@endsection
@section('scriptContent')
<script>
    fbq('track', 'InitiateCheckout');
	
	gtag('event', 'begin_checkout', {
		"items": [
		@foreach(session('cart') as $products => $product)
		{
			"name": "{{$product['name']}}",
			"category": "{{$product['category']}}",
			"variant": "{{$product['variantValue']}}",
			"quantity": {{$product['quantity']}},
			"price": {{$product['price']}}
		},
		@endforeach
		]
	});

	
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
	
	(function() {
		var billingCheck = "{{Session::get('customer')['billing_checkbox']}}";
		if(billingCheck == "No"){
			var billingAddressForm = document.getElementById("billingAddressForm");
			billingAddressForm.style.display = "block";
		}
	})();
</script>
@endsection
@section('endscripts')
@endsection