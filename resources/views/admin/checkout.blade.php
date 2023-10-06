@extends('admin.layout')
@section('title','Checkouts | Vitality Club')
@section('style','.admin-menu.orders i{color:black;}.admin-menu1.checkouts{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container mb-4">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/checkouts'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-1 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <h2 class="heading2">#{{$checkouts['id']}}</h2>
				</td></tr></table>
			</div>
		</div>
		<div class="row">
		    <div class="col-md-1"></div>
		    <div class="col-md-11 pl-0">
			    <p class="subtext1 mb-0">@php echo date_format($checkouts['created_at'], "d F Y"); echo " at "; echo date_format($checkouts['created_at'], "h:i a"); @endphp</p>
			</div>
		</div>
	</div>
	<div class="container">
        <div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <h3 class="info-cont-heading">Checkout details</h3>
					@php $subtotal=0; $i=0; @endphp
					@foreach($products->unique('product_code') as $product)
    			        @php $subtotal += $product['product_price'] * $quantities[$i]; @endphp
    			        <div class="row m-0 mb-4">
    			        	<div class="col-6 pro-flex p-0">
    			        		<div class="img-block img-port" style="background-image:url('/storage/shop/{{$product['product_code']}}/{{$product['product_pic1']}}');">
								</div>
    			        		<div class="text-block">
								    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
									    <p class="mb-0"><a href="/shop/@php echo strtolower(str_replace(' ','-',$product['product_category'])) @endphp/@php echo strtolower(str_replace(' ','-',$product['product_url'])); @endphp" target="_blank">{{$product['product_name']}}</a></p>
										<p class="mb-0">SKU: {{$product['product_code']}}</p>
									</td></tr></table>
								</div>
    			        	</div>
							<div class="col-2 p-0">
							    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
								    <p class="mb-0">INR @php echo number_format($product['product_price']) @endphp</p>
								</td></tr></table>
							</div>
							<div class="col-1">
							    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
								    x
								</td></tr></table>
							</div>
							<div class="col-1">
							    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
								    {{$quantities[$i]}}
								</td></tr></table>
							</div>
							<div class="col-2 p-0">
							    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
								    <p class="mb-0">INR <?php echo number_format($product['product_price'] * $quantities[$i]) ?></p>
								</td></tr></table>
							</div>
    			        </div>
						@php $i++; @endphp
    			    @endforeach
					<div class="info-cont-divider"></div>
					<div class="row m-0 mb-2">
					    <div class="col-3 p-0"><p class="mb-0">Subtotal</p></div>
					    <div class="col-3 p-0"><p class="mb-0">@php echo count($products)." item"; @endphp</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR <?php echo number_format($subtotal) ?></p></div>
					</div>
					<div class="row m-0 mb-2">
					    <div class="col-6 p-0"><p class="mb-0">Taxes</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR <?php echo number_format(0) ?></p></div>
					</div>
					<div class="row m-0 mb-2 pb-2">
					    <div class="col-6 p-0"><p class="mb-0">Total</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR <?php echo number_format($checkouts['total']) ?></p></div>
					</div>
					<div class="info-cont-divider"></div>
					<div class="row m-0">
					    <div class="col-6 p-0"><p class="mb-0">To be paid by customer</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR <?php echo number_format($checkouts['total']) ?></p></div>
					</div>
				</div>
			</div>
		    <div class="col-md-4">
			    <div class="container info-cont">
				    <h3 class="info-cont-heading">Customer</h3>
					<p class="mb-0">{{$customers['first_name']}} {{$customers['last_name']}}</p>
					<p class="mb-0">{{$customers['email']}}</p>
					@if($customers['users_id'] == 0)<p class="mb-0">No account</p>@endif
					<div class="info-cont-divider"></div>
					<h3 class="info-cont-subheading">Shipping Information</h3>
					<p class="mb-0">{{$customers['first_name']}} {{$customers['last_name']}}</p>
					<p class="mb-0">{{$customers['shipping_address']}}</p>
					<p class="mb-0">{{$customers['shipping_city']}}, {{$customers['shipping_state']}} - {{$customers['shipping_pincode']}}</p>
					<p class="mb-0">{{$customers['shipping_country']}}</p>
					<p class="mb-0">{{$customers['phone']}}</p>
					<div class="info-cont-divider"></div>
					<h3 class="info-cont-subheading">Billing Information</h3>
					@if($customers['billing_status'] == "Yes")
						<p class="mb-0">Same as Shipping address</p>
					@else
					    <p class="mb-0">{{$customers['billing_first_name']}} {{$customers['billing_last_name']}}</p>
					    <p class="mb-0">{{$customers['billing_address']}}</p>
					    <p class="mb-0">{{$customers['billing_city']}}, {{$customers['billing_state']}} - {{$customers['billing_pincode']}}</p>
					    <p class="mb-0">{{$customers['billing_country']}}</p>
					    <p class="mb-0">{{$customers['billing_phone']}}</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#ordersCollapse').collapse('show');
</script>
@endsection