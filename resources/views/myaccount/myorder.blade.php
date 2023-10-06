@extends('layouts.app')
@section('title','Orders - Vitality Club - My account')
@section('description','')
@section('keywords','')
@section('canonical','')
@section('style','.myorders{background-color:#cf597e;color:white;}.myorders:hover{color:white;}')
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
			<div class="container">
			    <p class="subheading1">Order Information</p>
				<div class="row">
				    <div class="col-md-6">
						<table class="table table-sm table-borderless orderDetails-table mb-0">
						    <tbody>
							    <tr>
								    <td><p class="text1 mb-0">Order ID:</p></td>
									<td><p class="text1 mb-0">{{$orders->id}}</p></td>
								</tr>
								<tr>
								    <td><p class="text1 mb-0">Order amount:</p></td>
									<td><p class="text1 mb-0">INR @php echo number_format($orders->total_amount, 2) @endphp</p></td>
								</tr>
								<tr>
								    <td><p class="text1 mb-0">Order status:</p></td>
									<td><p class="text1 mb-0">@if($orders->order_status == "Reviewed") Processing @else {{$orders->order_status}} @endif</p>
								</tr>
							</tbody>
						</table>
					</div>
				    <div class="col-md-6">
						<table class="table table-sm table-borderless orderDetails-table mb-0">
						    <tbody>
							    <tr>
								    <td><p class="text1 mb-0">Shipping:</p></td>
									<td><p class="text1 mb-0">{{$orders->shipping_name}}</p></td>
								</tr>
								<tr>
								    <td><p class="text1 mb-0">Payment mode:</p></td>
									<td><p class="text1 mb-0">{{$orders->payment_mode}}</p></td>
								</tr>
								<tr>
								    <td><p class="text1 mb-0">Payment status:</p></td>
									<td><p class="text1 mb-0">{{$orders->payment_status}}</p></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="container myaccount-divider"></div>
			<div class="container">
			    <div class="row">
				    <div class="col-md-6 mb-4 mb-md-0">
					    <p class="subheading1">Shipping Address</p>
						<p class="text1 mb-0">{{$orders_customers->first_name}} {{$orders_customers->last_name}}</p>
						<p class="text1 mb-0">{{$orders_customers->shipping_address}}</p>
						<p class="text1 mb-0">{{$orders_customers->shipping_city}}, {{$orders_customers->shipping_state}} - {{$orders_customers->shipping_pincode}}</p>
						<p class="text1 mb-0">{{$orders_customers->shipping_country}}</p>
						<p class="text1 mb-0">{{$orders_customers->phone}}</p>
					</div>
				    <div class="col-md-6">
					    <p class="subheading1">Billing Address</p>
						@if($orders_customers->billing_status != "Yes")
						    <p class="text1 mb-0">{{$orders_customers->billing_first_name}} {{$orders_customers->billing_last_name}}</p>
						    <p class="text1 mb-0">{{$orders_customers->billing_address}}</p>
						    <p class="text1 mb-0">{{$orders_customers->billing_city}}, {{$orders_customers->billing_state}} - {{$orders_customers->billing_pincode}}</p>
						    <p class="text1 mb-0">{{$orders_customers->billing_country}}</p>
						    <p class="text1 mb-0">{{$orders_customers->billing_phone}}</p>
						@else
							<p class="text1 mb-0">Same as shipping address</p>
						@endif
					</div>
				</div>
			</div>
			<div class="container myaccount-divider"></div>
			<div class="container">
                <div class="row">
				    <div class="col-md-7">
					    @foreach($orders_items as $orders_item)
						<div class="row mb-1">
						    <div class="col-2">
								<img class="respImg" src="/storage/shop/@php echo str_replace(' ','-',str_replace('/','',$orders_item['product_modelNo'])) @endphp/{{$orders_item['product_pic1']}}" />
							</div>							
							<div class="col-6 p-0 text1">{{$orders_item->product_name}} x {{$orders_item->product_quantity}}</div>
						    <div class="col-4 text-right text1">INR @php echo number_format($orders_item->product_discountedPrice) @endphp</div>
						</div>
						@endforeach
					</div>
					<div class="container myaccount-divider onlyOnMobile"></div>
				    <div class="col-md-5">
					    <div class="row">
						    <div class="col-4 text1">Subtotal:</div>
						    <div class="col-8 text-right text1">INR @php echo number_format($orders->subtotal, 2) @endphp</div>
						</div>
						@if($orders->discount > 0)
						<div class="row">
						    <div class="col-4 text1">Discount:</div>
						    <div class="col-8 text-right text1">- INR @php echo number_format($orders->discount, 2) @endphp</div>
						</div>
						@endif
						<div class="row">
						    <div class="col-4 text1">Shipping:</div>
						    <div class="col-8 text-right text1">@if($orders->shipping_cost > 0)INR {{$orders->shipping_cost}} @else Free @endif</div>
						</div>
						@if($orders->cod_charges > 0)
						<div class="row">
						    <div class="col-4 text1">COD Charges:</div>
						    <div class="col-8 text-right text1">INR @php echo number_format($orders->cod_charges, 2) @endphp</div>
						</div>
						@endif
						<div class="row mb-3">
						    <div class="col-4 text1">Taxes:</div>
						    <div class="col-8 text-right text1">@if($orders->tax > 0)INR {{$orders->tax}} @else Inclusive of all taxes @endif</div>
						</div>
						<div class="row pt-3" style="border-top:1px solid #f2f2f2">
						    <div class="col-4 text1" style="font-weight:600;">Total:</div>
						    <div class="col-8 text-right text1" style="font-weight:600;">INR @php echo number_format($orders->total_amount, 2) @endphp</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container mt-5 mb-3">
			    <button type="button" class="btn btn-primary accountMainBtn" onclick="window.location.href='/myorders'">Back</button>
			</div>
    	</div>
    </div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
@endsection