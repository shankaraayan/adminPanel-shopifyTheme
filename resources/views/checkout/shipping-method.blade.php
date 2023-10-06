@extends('checkout.app')
@section('title','Shipping - Vitality Club - Checkout')
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
									@if(Session::get('customer')['discount_value'] > 0)
									@php if(Session::get('customer')['discount_type'] == "Percentage"){ $discount = $total * (Session::get('customer')['discount_value'] / 100); }else{ $discount = Session::get('customer')['discount_value']; } @endphp
									<div class="row mb-2">
			            	    	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Discount @if(Session::get('customer')['discount'] == 'automatic')({{Session::get('customer')['discount_name']}}) @endif</p></div>
			            	    	    <div class="col-6 p-0 text-right"><p class="mb-0 productPrice">- INR <?php echo number_format($discount, 2) ?></p></div>
			            	    	</div>
									@endif
				                	<div class="row mb-2">
				                	    <div class="col-6 p-0"><p class="mb-0 totalLabel">Shipping</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 totalLabel2" id="shippingCost">@if(Session::get('customer')['shipping_cost'] == 0) @php $shipCost = $shippings[0]['cost'] @endphp @else @php $shipCost = Session::get('customer')['shipping_cost'] @endphp @endif @if($shipCost > 0) INR {{$shipCost}} @else Free @endif</p></div>
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
										    <p class="mb-0 productPrice text-right"><a onclick="removeCode()" style="cursor:pointer">Remove</a></p>
										</div>
									</div>
									@endif
				                </div>
				                <div class="container py-3">
				                    <div class="row">
				                	    <div class="col-6 p-0"><p class="mb-0 orderValueLabel">Total</p></div>
				                	    <div class="col-6 p-0 text-right"><p class="mb-0 orderValue" id="totalCost">INR <?php echo number_format(($total - $discount + $shipCost + $tax), 2) ?></p></div>
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
                    <button class="btn btn-link checkoutBtns current">Shipping</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns">Payment</button><span class="checkoutRightArrow"><i class="fas fa-chevron-right"></i></span>
                    <button class="btn btn-link checkoutBtns">Review</button>
                </p>
				<div class="container shipping-info-main-cont">
				    <div class="row m-0" style="border-bottom:1px solid #d6d2de;">
					    <div class="col-2 p-0"><p class="mb-0"><b>Contact</b></p></div>
					    <div class="col-8"><p class="mb-0">{{Session::get('customer')['email']}}</p></div>
					    <div class="col-2 p-0"><p class="text-right mb-0"><button class="btn btn-link changeBtn" onclick="location.href='/checkout/contact-information'">Change</button></p></div>
					</div>
					<div class="row m-0">
					    <div class="col-2 p-0"><p class="mb-0"><b>Ship to</b></p></div>
					    <div class="col-8"><p class="mb-0">{{Session::get('customer')['address']}}, {{Session::get('customer')['city']}}, {{Session::get('customer')['state']}} {{Session::get('customer')['pincode']}}, {{Session::get('customer')['country']}}</p></div>
					    <div class="col-2 p-0"><p class="text-right mb-0"><button class="btn btn-link changeBtn" onclick="location.href='/checkout/contact-information'">Change</button></p></div>
					</div>
				</div>
		        <form class="needs-validation checkout-Information-form" action="/checkout/shipping-method" method="post" novalidate>{{ csrf_field() }}
                	<div class="form-row m-0 mb-3" style="border-bottom:1px solid #d6d2de;border-radius:.25rem;">
    				    <div class="col-12 mb-3">
    					    <p class="label1 mb-0">Shipping method</p>
						</div>
						@php $shippingCounter = 0; $finalAmount = $total - $discount; @endphp
						@foreach($shippings as $shipping)
						@if($finalAmount > $shipping['min_order_value'])
						    @if($shipping['max_order_value'] > $shipping['min_order_value'])
							    @if($finalAmount < $shipping['max_order_value'])
						        <div class="col-12 shipping-radio">
						            <div class="row m-0">
						        	    <div class="col-9 p-0">
						        		    <div class="custom-control custom-radio">
						        	        	<input type="radio" id="shippingRadio{{$shippingCounter}}" name="shippingRadio" class="custom-control-input" value="{{$shipping['cost']}}" onclick="updateShippingMethod(this)" >
						        	        	<label class="custom-control-label" for="shippingRadio{{$shippingCounter}}" style="text-transform:capitalize;">{{$shipping['name']}}</label>
						        	        </div>
						        		</div>
						        		<div class="col-3 p-0">
						        		    <p class="mb-0 text-right shipping-cost-label">@if($shipping['cost'] > 0) INR {{$shipping['cost']}} @else Free @endif</p>
						        		</div>
						        	</div>
						        </div>
								@php $shippingCounter++; @endphp
								@endif
							@elseif($shipping['max_order_value'] == 0)
							    <div class="col-12 shipping-radio">
						            <div class="row m-0">
						        	    <div class="col-9 p-0">
						        		    <div class="custom-control custom-radio">
						        	        	<input type="radio" id="shippingRadio{{$shippingCounter}}" name="shippingRadio" class="custom-control-input" value="{{$shipping['cost']}}" onclick="updateShippingMethod(this)" >
						        	        	<label class="custom-control-label" for="shippingRadio{{$shippingCounter}}" style="text-transform:capitalize;">{{$shipping['name']}}</label>
						        	        </div>
						        		</div>
						        		<div class="col-3 p-0">
						        		    <p class="mb-0 text-right shipping-cost-label">@if($shipping['cost'] > 0) INR {{$shipping['cost']}} @else Free @endif</p>
						        		</div>
						        	</div>
						        </div>
								@php $shippingCounter++; @endphp
							@else
							@endif
						@endif
						@endforeach
    				</div>
                	<div class="form-row mt-5">
    				    <div class="col-md-6 order-md-2 mb-3 text-md-right text-center">
    					    <button class="btn continueBtn" type="submit">Continue to Payment</button>
    					</div>
    				    <div class="col-md-6 order-md-1 mb-3 text-md-left text-center">
    					    <a class="btn btn-link returnToCart" href="/checkout/contact-information"><i class="fas fa-chevron-left"></i> Return to Information</a>
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
    var shippingCost = {{Session::get('customer')['shipping_cost']}};
	
	var shippingCostRadios = document.getElementsByName('shippingRadio');
	var allShippingCost = [];
	for(i=0; i<shippingCostRadios.length; i++){
		var result = shippingCostRadios[i].value;
		allShippingCost.push(result);
	}
	if(allShippingCost.includes(shippingCost)){
	}else{
		shippingCostRadios[0].checked = true;
		updateShippingMethod(shippingCostRadios[0]);
	}
	
	function updateShippingMethod(radioshipCost){
		if(radioshipCost.value == 0){
			var updateShippingCost = "Free";
			var totalOrderCost =  {{$total}} - {{$discount}} + {{$tax}} + parseInt(radioshipCost.value);
		}else{
			var updateShippingCost = 'INR '+radioshipCost.value;
			var totalOrderCost =  {{$total}} - {{$discount}} + {{$tax}} + parseInt(radioshipCost.value);
		}
		document.getElementById("shippingCost").innerHTML = updateShippingCost;
		document.getElementById("totalCost").innerHTML = "INR "+ Number(parseFloat(totalOrderCost).toFixed(2)).toLocaleString();
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
</script>
@endsection
@section('endscripts')
@endsection