@extends('checkout.app')
@section('title','Payment - Vitality Club - Checkout')
@section('style','#mainContent{padding-top:0;}.table thead th{border:none;} .table th{border:none;}#discountCodeForm{display:block;}')
@section('content')

@error('discountCode')
<style>#discountCodeForm{display:block;}</style>
@enderror

@if(Session::get('customer')['payment_mode'] != "COD")
	<style>#codCharges{display:none}</style>
@endif

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
				                		    <p class="mb-0 productPrice">INR <?php echo number_format(($product['price'] * $product['quantity']), 2) ?></p>
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
				                	@if(Session::get('customer')['discount_value'] > 0)
				                	<div class="row mb-2">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Discount @if(Session::get('customer')['discount'] == 'automatic')({{Session::get('customer')['discount_name']}}) @endif</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice" id="discount">@if(Session::get('customer')['discount_type'] == "Percentage") @php $discount = (($total * Session::get('customer')['discount_value']) / 100) @endphp @else @php $discount = Session::get('customer')['discount_value'] @endphp @endif - INR @php echo number_format($discount, 2) @endphp</p></div>
				                	</div>
				                	@else
				                		@php $discount = 0 @endphp
				                	@endif
				                	<div class="row mb-2">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Shipping</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel2">@if(Session::get('customer')['shipping_cost'] > 0) INR {{Session::get('customer')['shipping_cost']}} @else Free @endif</p></div>
				                	</div>
									<div class="row mb-2" id="codCharges">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">COD Charges</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel2">INR 50</p></div>
				                	</div>
				                	<div class="row @if(Session::get('customer')['discount_value'] == 0) mb-2 @endif">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Taxes</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">@if(Session::get('customer')['chargeable'] == "Yes")INR <?php $tax=($total - $discount)*(Session::get('customer')['tax']/100); echo number_format($tax, 2) ?> @else <?php $tax=0; ?>inclusive of all taxes @endif</p></div>
				                	</div>
									@if(Session::get('customer')['discount_value'] == 0)
									<div class="row">
				                	    <div class="col-12 p-0"><p class="mb-0 productPrice"><a onclick="showCodeForm()" style="cursor:pointer">Have a discount code?</a></p></div>
										<div id="discountCodeForm" class="col-12 px-0">
										    <form action="/checkout/apply-discount-code" method="post" class="needs-validation" novalidate>@csrf
    	                                    	<div class="form-row m-0">
    	                                    		<div class="col-9 pl-0">
    	                                    			<input type="text" class="form-control @error('discountCode') is-invalid @enderror" id="validationCustom11" name="discountCode" placeholder="Enter your discount code here" value="{{old('discountCode')}}" required>
														@error('discountCode')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
    	                                    		</div>
    	                                    		<div class="col-3 pr-0">
    	                                    			<button class="btn btn-primary w-100" type="submit">Apply</button>
    	                                    		</div>
    	                                    	</div>
    	                                    </form>
										</div>
									</div>
									@endif
									@if(Session::get('customer')['discount'] == "code")
									<div class="row mt-3">
									    <div class="col-8 p-0">
										    <p class="mb-0 totalLabel">Discount code: <b>{{Session::get('customer')['discount_name']}} applied</b></p>
										</div>
									    <div class="col-4 p-0">
										    <p class="mb-0 productPrice text-right"><a onclick="removeCode()" style="cursor:pointer">Remove</a></p>
										</div>
									</div>
									@endif
				                </div>
				                <div class="container py-3">
				                    <div class="row">
				                	    <div class="col-6 p-0"><p class="mb-0 orderValueLabel">Total</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 orderValue" id="totalCost">INR <?php echo number_format(($total-$discount+Session::get('customer')['shipping_cost']+Session::get('customer')['CODcharges']+$tax), 2) ?></p></div>
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
                    <button class="btn btn-link checkoutBtns active" onclick="location.href='/checkout/contact-information'">Information</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns active" onclick="location.href='/checkout/shipping-method'">Shipping</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns current">Payment</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
					<button class="btn btn-link checkoutBtns">Review</button>
                </p>
				<div class="container shipping-info-main-cont">
				    <div class="row m-0" style="border-bottom:1px solid #d6d2de;">
					    <div class="col-2 p-0"><p class="mb-0"><b>Contact</b></p></div>
					    <div class="col-8"><p class="mb-0">{{Session::get('customer')['email']}}</p></div>
					    <div class="col-2 p-0"><p class="text-right mb-0"><button class="btn btn-link changeBtn" onclick="location.href='/checkout/contact-information'">Change</button></p></div>
					</div>
					<div class="row m-0" style="border-bottom:1px solid #d6d2de;">
					    <div class="col-2 p-0"><p class="mb-0"><b>Ship to</b></p></div>
					    <div class="col-8"><p class="mb-0">{{Session::get('customer')['address']}}, {{Session::get('customer')['city']}}, {{Session::get('customer')['state']}} {{Session::get('customer')['pincode']}}, {{Session::get('customer')['country']}}</p></div>
					    <div class="col-2 p-0"><p class="text-right mb-0"><button class="btn btn-link changeBtn" onclick="location.href='/checkout/contact-information'">Change</button></p></div>
					</div>
					<div class="row m-0">
					    <div class="col-2 p-0"><p class="mb-0"><b>Shipping</b></p></div>
					    <div class="col-10"><p class="mb-0">{{Session::get('customer')['shipping_name']}} <span class="shippingDot"><i class="fas fa-circle"></i></span> <b>@if(Session::get('customer')['shipping_cost'] > 0) INR {{Session::get('customer')['shipping_cost']}} @else Free @endif</b></p></div>
					</div>
				</div>
		        <form class="needs-validation checkout-Information-form" action="/checkout/payment-method" method="post" novalidate>{{ csrf_field() }}
                	<div class="form-row m-0 mb-3" style="border-bottom:1px solid #d6d2de;border-radius:.25rem;">
    				    <div class="col-12 mb-3">
    					    <p class="label1 mb-0">Payment method</p>
						</div>
						@php $paymentCounter = 0; @endphp
						@for($i=0;$i<count($payments);$i++)
						@if($payments[$i] == "Online")
						<div class="col-12 payment-radio">
							<div class="row m-0">
							    <div class="col-md-9 col-7 payment-radio-leftCont">
						@elseif($payments[$i] == "COD")
						<div class="col-12 shipping-radio" style="padding-left:.4rem">
							<div class="row m-0">
							    <div class="col-md-9 col-7 payment-radio-leftCont">
						@else
						<div class="col-12 shipping-radio">
							<div class="row m-0">
							    <div class="col-12 p-0">
						@endif
								    <div class="custom-control custom-radio @if($payments[$i] == 'Online') custom-payment-radio @endif">
							        	<input type="radio" id="paymentRadio{{$payments[$i]}}" name="paymentRadio" class="custom-control-input" value="{{$payments[$i]}}" onclick="updateCODCharges(this)" @if($payments[$i] == Session::get('customer')['payment_mode']) checked @endif @if(Session::get('customer')['payment_mode'] == "" && $payments[$i] == "Online") checked @endif required>
							        	<label class="custom-control-label" for="paymentRadio{{$payments[$i]}}" style="text-transform:capitalize;">@if($payments[$i] == "Online") Credit/Debit card/UPI/Wallet @elseif($payments[$i] == "COD") Cash on delivery @else {{$payments[$i]}} @endif</label>
							        </div>
								</div>
								@if($payments[$i] == "Online")
								<div class="col-md-3 col-5 p-0">
								    <p class="mb-0 text-right"><span class="payment-icon"><i class="fab fa-cc-visa"></i></span><span class="payment-icon"><i class="fab fa-cc-mastercard"></i></span><span class="payment-icon"><i class="fab fa-cc-amex"></i></span></p>
								</div>
								@endif
								@if($payments[$i] == "COD")
								<div class="col-md-3 col-5 p-0">
									<p class="mb-0 text-right shipping-cost-label">INR 50</p>
								</div>
								@endif
							</div>
						</div>
						@php $paymentCounter++; @endphp
						@endfor
    				</div>
                	<div class="form-row mt-5">
    				    <div class="col-md-6 order-md-2 mb-3 text-md-right text-center">
    					    <button class="btn continueBtn" type="submit">Continue to Review</button>
    					</div>
    				    <div class="col-md-6 order-md-1 mb-3 text-md-left text-center">
    					    <a class="btn btn-link returnToCart" href="/checkout/shipping-method"><i class="fas fa-chevron-left"></i> Return to Shipping</a>
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
@endsection
@section('endscripts')
<script>
    function showCodeForm(){
		document.getElementById("discountCodeForm").style.display = "block";
	}
	function removeCode(){
		$.ajax({
			url: '/checkout/remove-discount-code',
			method: "POST",
			data: {_token: '{{ csrf_token() }}'},
			success: function (response) {
				window.location.reload();
			}
		});
	}
	
	function updateCODCharges(paymentRadio){
		if(paymentRadio.value == "COD"){
			document.getElementById("codCharges").style.display = "flex";
			var totalOrderCost =  {{$total}} - {{$discount}} + {{Session::get('customer')['shipping_cost']}} + {{$tax}} + 50;
			document.getElementById("totalCost").innerHTML = "INR "+ Number(parseFloat(totalOrderCost).toFixed(2)).toLocaleString();
		}else{
			document.getElementById("codCharges").style.display = "none";
			var totalOrderCost =  {{$total}} - {{$discount}} + {{Session::get('customer')['shipping_cost']}} + {{$tax}};
			document.getElementById("totalCost").innerHTML = "INR "+ Number(parseFloat(totalOrderCost).toFixed(2)).toLocaleString();
		}
	}
</script>
@endsection