@extends('checkout.app')
@section('title','Thank you! - Vitality Club - Checkout')
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
							    <div class="container" style="border-bottom:1px solid #c9c9c9;">
    			                    @foreach($orders_items as $product)
    			                    <div class="row mb-3">
    			                    	<div class="col-8 pro-flex p-0">
											<div class="img-block" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',strtoupper($product['product_modelNo'])) @endphp/{{$product['product_pic1']}}');">
											    <div class="item-count">{{$product['product_quantity']}}</div>
											</div>
    			                    		<div class="text-block">
						            		    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
						            			    <p class="mb-0 productName">{{$product['product_name']}}</p>
						            				@if($product['product_variationValue'] != "")
						            				<p class="mb-0 productColor">{{$product['product_variationType']}}: {{$product['product_variationValue']}}</p>
						            				@endif
						            			</td></tr></table>
						            		</div>
    			                    	</div>
						            	<div class="col-4 p-0">
						            	    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
						            		    <p class="mb-0 productPrice">INR @php echo number_format($product['product_discountedPrice'] * $product['product_quantity']) @endphp</p>
						            		</td></tr></table>
						            	</div>
    			                    </div>
									@endforeach
					            </div>
					            <div class="container py-3" style="border-bottom:1px solid #c9c9c9;">
					                <div class="row mb-2">
					            	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Subtotal</p></div>
					            	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">INR @php echo number_format($orders->subtotal, 2) @endphp</p></div>
					            	</div>
					            	@if($orders->discount_value > 0)
					            	<div class="row mb-2">
					            	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Discount</p></div>
					            	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice" id="discount">- INR @php echo number_format($orders->discount, 2) @endphp</p></div>
					            	</div>
					            	@endif
					            	<div class="row mb-2">
					            	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Shipping</p></div>
					            	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel2">@if($orders->shipping_cost > 0) INR {{$orders->shipping_cost}} @else Free @endif</p></div>
					            	</div>
									@if($orders->cod_charges > 0)
									<div class="row mb-2" id="codCharges">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">COD Charges</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel2">INR {{$orders->cod_charges}}</p></div>
				                	</div>
									@endif
					            	<div class="row">
					            	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Taxes</p></div>
					            	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">@if($orders->tax > 0)INR @php echo number_format($orders->tax, 2) @endphp @else inclusive of all taxes @endif</p></div>
					            	</div>
									@if($orders['discount_category'] == "code")
									<div class="row mt-3">
									    <div class="col-8 p-0">
										    <p class="mb-0 totalLabel">Discount code: <b>{{$orders['discount_name']}} applied</b></p>
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
					            	    <div class="col-6 p-0 text-right"><p class="mb-0 orderValue" id="totalCost">INR @php echo number_format($orders->total_amount, 2) @endphp</p></div>
					            	</div>
				                </div>
				            </div>
						</div>
					</div>
				</div>
    		</div>
    		<div class="col-lg-7 order-lg-1 checkout-cont-left">
                <p class="text-center notOnIpad"><a href="/"><img class="checkout-logo" src="{{asset('images/vitality-club-logo.jpg')}}"/></a></p>
				<div class="container order-confirmation-box">
				    <div class="row mb-2">
					    <div class="col-2 text-center">
						    <p class="tick-icon mb-0"><i class="far fa-check-circle"></i></p>
						</div>
					    <div class="col-10 p-0">
						    <p class="info1">Order #{{$orders->id}}</p>
							<p class="info2 mb-0">Thank you {{$orders_customers[0]['first_name']}}!</p>
						</div>
					</div>
					<p class="info3">Your order is confirmed</p>
					<p class="info1 mb-0">You’ll receive an email when your order is ready.</p>
				</div>
				<div class="container order-confirmation-box">
				    <p class="info3">Customer information</p>
				    <div class="row">
					    <div class="col-6">
						    <p class="info4">Contact information</p>
							<p class="info1">{{$orders_customers[0]['email']}}</p>
						</div>
					    <div class="col-6">
						    <p class="info4">Payment method</p>
							<p class="info1">@if($orders['payment_mode'] == "COD")Cash on delivery @else <i class="far fa-credit-card"></i> INR <?php echo number_format($orders->total_amount, 2) ?> @endif</p>
						</div>
					</div>
					<div class="row">
					    <div class="col-6">
						    <p class="info4">Shipping address</p>
							<p class="info1">{{$orders_customers[0]['first_name']}} {{$orders_customers[0]['last_name']}}</p>
							<p class="info1">{{$orders_customers[0]['shipping_address']}} {{$orders_customers[0]['shipping_city']}} {{$orders_customers[0]['shipping_state']}} {{$orders_customers[0]['shipping_pincode']}} {{$orders_customers[0]['shipping_country']}}</p>
							<p class="info1 mb-0">{{$orders_customers[0]['phone']}}</p>
						</div>
					    <div class="col-6">
						    <p class="info4">Billing address</p>
							<p class="info1">{{$orders_customers[0]['billing_first_name']}} {{$orders_customers[0]['billing_last_name']}}</p>
							<p class="info1">{{$orders_customers[0]['billing_address']}} {{$orders_customers[0]['billing_city']}} {{$orders_customers[0]['billing_state']}} {{$orders_customers[0]['billing_pincode']}} {{$orders_customers[0]['billing_country']}}</p>
							<p class="info1 mb-0">{{$orders_customers[0]['billing_phone']}}</p>
						</div>
					</div>
					<div class="row">
					    <div class="col-6">
						    <p class="info4">Shipping method</p>
							<p class="info1 mb-0">{{$orders->shipping_name}}</p>
						</div>
					</div>
				</div>
				<div class="container order-confirmation-box1">
    			    <div class="row">
    			        <div class="col-md-6 order-md-2 mb-3 text-md-right text-center">
    				        <button class="btn continueBtn" onclick="location.href='/'">Continue Shopping</button>
    				    </div>
					    <div class="col-md-6 order-md-1 mb-3 text-md-left text-center">
    				        <a class="btn btn-link returnToCart" href="mailto:{{ config('app.email') }}">Need help? Contact us</a>
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
@endsection
@section('endscripts')
@if($orders['event_trigger'] == "true")
<script>
    var shippingCharges = parseInt({{$orders->shipping_cost}}) + parseInt({{$orders->cod_charges}});
	
	gtag('event', 'purchase', {
        "transaction_id": "{{$orders->id}}",
        "value": {{$orders->subtotal}},
        "currency": "INR",
        "shipping": shippingCharges,
        "items": [
        @foreach($orders_items as $product)
		{
          "name": "{{$product['product_name']}}",
          "category": "{{$product['product_category']}}",
          "variant": "{{$product['product_variationValue']}}",
          "quantity": {{$product['product_quantity']}},
          "price": {{$product['product_discountedPrice']}}
        },
		@endforeach
      ]
    });
</script>

<script>
    gtag('event', 'conversion', {
		'send_to': 'AW-360341349/V0KgCPLR1-cCEOW-6asB',
		'value': {{$orders->subtotal}},
		'currency': 'INR',
		'transaction_id': '{{$orders->id}}',
		'coupon': '{{$orders['discount_name']}}'
	});
</script> 

<script>
    fbq('track', 'Purchase',
	    {
			content_name: "{{$orders_items[0]['product_name']}}",
			currency: "INR",
			value: {{$orders->subtotal}},
			content_type: "{{$orders_items[0]['product_category']}}",
		}
	);
</script>

<script type="text/javascript">
	var orderId = {{$orders->custom_order_id}};
	$.ajax({
        url: '/event-trigger/'+orderId,
        method: "GET",
        data: {_token: '{{ csrf_token() }}'},
        success: function (response) {}
    });
</script>
@endif
@endsection