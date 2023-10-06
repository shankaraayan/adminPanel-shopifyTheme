@extends('admin.layout')
@section('title','Customers | Vitality Club')
@section('style','.admin-menu.customers i{color:black;} .admin-menu.customers{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container mb-4">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/customers'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-11 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    @if($user['name'] != "")<h2 class="heading2">{{$user['name']}}</h2> @else <h2 class="heading2">{{$customer['email']}}</h2> @endif
				</td></tr></table>
			</div>
		</div>
	</div>
	<div class="container">
        <div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <div class="row">
					    <div class="col-1" style="padding-top:2px;">
						    <img style="width:40px;height:auto;" src="{{asset('backgrounds/5d0f62792c5695c4208b1dd74120de26.png')}}" />
						</div>
					    <div class="col-11">
						    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
							    @if($user['name'] != "")<h3 class="info-cont-heading mb-1">{{$user['name']}}</h3> @else <h3 class="info-cont-heading mb-1">{{$customer['email']}}</h3> @endif
								@if($customer['shipping_state'] != "")<p class="mb-1">{{$customer['shipping_state']}}, {{$customer['shipping_country']}}</p>@endif
							</td></tr></table>
						</div>
					</div>
					<div class="info-cont-divider"></div>
					@if(count($orders) > 0)
					    <div class="row">
					        @php
					    	    $totatSpent = 0;
					    		$noOfOders = count($orders->unique('orders_id'));
					    	@endphp
					    	<div class="col-4 text-center">
					    	    <p class="mb-1">Total orders to date</p>
					    		<p class="subtext2 mb-1">{{$noOfOders}} orders</p>
					    	</div>
					        <div class="col-4 text-center">
					    		<p class="mb-1">Total spent to date</p>
					    	    @foreach($orders->unique('orders_id') as $order)
					    		    @php $totatSpent += $order['total_amount']; @endphp
					    		@endforeach
					    		@php
					    			$avgOrderValue = number_format($totatSpent / $noOfOders);
					    		@endphp
					    		<p class="subtext2 mb-1">INR @php echo number_format($totatSpent) @endphp</p>
					    	</div>
					        <div class="col-4 text-center">
					    	    <p class="mb-1">Average order value</p>
					    		<p class="subtext2 mb-1">INR {{$avgOrderValue}}</p>
					    	</div>
					    </div>
					@else
						<div class="row">
					    	<div class="col-4 text-center">
					    	    <p class="mb-1">Total orders to date</p>
					    		<p class="subtext2 mb-1">0 order</p>
					    	</div>
					        <div class="col-4 text-center">
					    		<p class="mb-1">Total spent to date</p>
					    		<p class="subtext2 mb-1">INR 0</p>
					    	</div>
					        <div class="col-4 text-center">
					    	    <p class="mb-1">Average order value</p>
					    		<p class="subtext2 mb-1">INR 0</p>
					    	</div>
					    </div>
					@endif
				</div>
				@foreach($orders->unique('orders_id') as $order)
				    <div class="container info-cont">
					    <h3 class="info-cont-heading">Order placed</h3>
						<div class="row">
						    <div class="col-4">
							    <p><a href="/admin/orders/{{$order->orders_id}}">Order #{{$order->orders_id}}</a></p>
							</div>
						    <div class="col-8 text-right">
							    <p>@php echo date_format($order['created_at'], "d F Y"); echo " at "; echo date_format($order['created_at'], "h:i a"); @endphp</p>
							</div>
						</div>
						<p class="mb-1">INR @php echo number_format($order->total_amount) @endphp</p>
						@if($order['order_status'] == "Fulfilled")
					    	<div class="block1"><i class="fas fa-circle"></i>{{$order['order_status']}}</div>
					    @elseif($order['order_status'] == "Shipped")
					    	<div class="block3"><i class="far fa-circle"></i>{{$order['order_status']}}</div>
					    @elseif($order['order_status'] == "Cancelled")
					        <div class="block5"><i class="fas fa-circle"></i>{{$order['order_status']}}</div>
					    @else
					    	<div class="block2"><i class="far fa-circle"></i>{{$order['order_status']}}</div>
					    @endif
						@php $tempID = $order->orders_id @endphp
						@foreach($orders->where('orders_id', $tempID) as $order)
						    <div class="row mt-4">
						        <div class="col-12 pro-flex">
								    <div class="img-block" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',$order['product_modelNo']) @endphp/{{$order['product_pic1']}}');">
				                    	<div class="item-count">{{$order['product_quantity']}}</div>
				                    </div>
    			            		<div class="text-block">
						    		    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
						    			    <p class="mb-0"><a href="/shop/@php echo strtolower(str_replace(' ','-',$order['product_category'])) @endphp/@php echo strtolower(str_replace(' ','-',$order['product_url'])); @endphp" target="_blank">{{$order['product_name']}}</a></p>
						    				<p class="mb-0">SKU: @if($order['product_isVariant'] == "No"){{$order['product_modelNo']}} @else {{$order['product_variationSKU']}} @endif</p>
						    				@if($order['product_variationValue'] != '')
											    <p class="mb-0">{{$order['product_variationType']}}: {{$order['product_variationValue']}}</p>
											@endif
						    			</td></tr></table>
						    		</div>
    			            	</div>
						    </div>
						@endforeach
					</div>
				@endforeach
			</div>
		    <div class="col-md-4">
			    <div class="container info-cont">
				    <h3 class="info-cont-heading">Customer overview</h3>
					<p class="mb-1">{{$customer['email']}}</p>
					<p class="mb-1">{{$customer['phone']}}</p>
					<p class="mb-0">@if($customer->users_id == 0) No account @else Account @endif</p>
					@if($customer['shipping_address'] != "")
						<div class="info-cont-divider"></div>
					    <h3 class="info-cont-subheading">Shipping Information</h3>
					    <p class="mb-0">{{$customer['first_name']}} {{$customer['last_name']}}</p>
					    <p class="mb-0">{{$customer['shipping_address']}}</p>
					    <p class="mb-0">{{$customer['shipping_city']}}, {{$customer['shipping_state']}} - {{$customer['shipping_pincode']}}</p>
					    <p class="mb-0">{{$customer['shipping_country']}}</p>
					    <p class="mb-0">{{$customer['phone']}}</p>
					@endif
					@if($customer['billing_address'] != "")
					    <div class="info-cont-divider"></div>
					    <h3 class="info-cont-subheading">Billing Information</h3>
					    @if($customer['billing_status'] == "Yes")
					    	<p class="mb-0">Same as Shipping address</p>
					    @else
					        <p class="mb-0">{{$customer['billing_first_name']}} {{$customer['billing_last_name']}}</p>
					        <p class="mb-0">{{$customer['billing_address']}}</p>
					        <p class="mb-0">{{$customer['billing_city']}}, {{$customer['billing_state']}} - {{$customer['billing_pincode']}}</p>
					        <p class="mb-0">{{$customer['billing_country']}}</p>
					        <p class="mb-0">{{$customer['billing_phone']}}</p>
					    @endif
					@endif
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Email Marketing</h3>
					<p>
					    @if($customer->subscribed_status == "Yes")
					    	<div class="block3">Subscribed</div>
					    @else
					    	<div class="block4">Not subscribed</div>
					    @endif
					</p>
					<p class="mb-0">Subscribed on @php echo date_format($customer['created_at'], "d F Y") @endphp.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#customersCollapse').collapse('show');
	
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</script>
@endsection