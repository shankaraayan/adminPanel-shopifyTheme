@extends('checkout.app')
@section('title','Review - Vitality Club - Checkout')
@section('style','#mainContent{padding-top:0;}.table thead th{border:none;} .table th{border:none;}')
@section('content')

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
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel2">INR {{Session::get('customer')['CODcharges']}}</p></div>
				                	</div>
				                	<div class="row">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Taxes</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">@if(Session::get('customer')['chargeable'] == "Yes")INR <?php $tax=($total - $discount)*(Session::get('customer')['tax']/100); echo number_format($tax, 2) ?> @else <?php $tax=0; ?>inclusive of all taxes @endif</p></div>
				                	</div>
									@if(Session::get('customer')['discount'] == "code")
									<div class="row mt-3">
									    <div class="col-8 p-0">
										    <p class="mb-0 totalLabel">Discount code: <b>{{Session::get('customer')['discount_name']}} applied</b></p>
										</div>
									    <div class="col-4 p-0">
										    <p class="mb-0 productPrice text-right"></p>
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
                    <button class="btn btn-link checkoutBtns active" onclick="location.href='/checkout/payment-method'">Payment</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
					<button class="btn btn-link checkoutBtns current">Review</button>
                </p>
				<div class="container shipping-info-main-cont mb-5">
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
					<div class="row m-0" style="border-bottom:1px solid #d6d2de;">
					    <div class="col-2 p-0"><p class="mb-0"><b>Shipping</b></p></div>
					    <div class="col-10"><p class="mb-0">{{Session::get('customer')['shipping_name']}} <span class="shippingDot"><i class="fas fa-circle"></i></span> <b>@if(Session::get('customer')['shipping_cost'] > 0) INR {{Session::get('customer')['shipping_cost']}} @else Free @endif</b></p></div>
					</div>
					<div class="row m-0">
					    <div class="col-2 p-0"><p class="mb-0"><b>Payment</b></p></div>
					    <div class="col-10"><p class="mb-0">@if(Session::get('customer')['payment_mode'] == "COD") Cash on delivery @else {{Session::get('customer')['payment_mode']}} @endif @if(Session::get('customer')['payment_mode'] == "Online")<span class="shippingDot"><i class="fas fa-circle"></i></span> <b>Credit/Debit card @endif</b></p></div>
					</div>
				</div>
                <div class="container p-0 py-5" style="border-bottom:1px solid #d6d2de;">
    			    <div class="row">
    				    <div class="col-md-6 order-md-2 mb-3 text-md-right text-center">
    				        @if(Session::get('customer')['payment_mode'] == "Online")
							    <button id="rzp-button1" class="btn continueBtn">Place Order</button>
							@else
							    <form action="{{$callbackUrl}}" method="post">
								    <button class="btn continueBtn" type="submit">Place Order</button>
								</form>
							@endif
    				    </div>
    				    <div class="col-md-6 order-md-1 mb-3 text-md-left text-center">
    				        <a class="btn btn-link returnToCart" href="/checkout/payment-method"><i class="fas fa-chevron-left"></i> Return to Payment</a>
    				    </div>
					</div>
    			</div>
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
    @if(Session::get('customer')['payment_mode'] == "Online")
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{$key_id}}",
            "amount": "{{$razorpayOrder['amount']}}",
            "currency": "{{$razorpayOrder['currency']}}",
            "name": "Vitality Club",
            "description": "{{$description}}",
            "image": "data:image/png;base64,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",
            "order_id": "{{$razorpayOrder['id']}}",
            "callback_url": "/orders",
            "prefill": {
                "name": "{{Session::get('customer')['first_name']}} {{Session::get('customer')['last_name']}}",
                "email": "{{Session::get('customer')['email']}}",
                "contact": "{{Session::get('customer')['phone']}}"
            },
            "theme": {
        		"color": "#cf597e"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response){
            /*alert(response.error.code);
            alert(response.error.description);
            alert(response.error.source);
            alert(response.error.step);
            alert(response.error.reason);
            alert(response.error.metadata);*/
        });
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
	@endif
@endsection
@section('endscripts')
@endsection