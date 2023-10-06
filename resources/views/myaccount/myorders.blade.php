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
            @if(count($orders) > 0)
			<table class="table table-hover notOnMobile">
            	<thead>
            		<tr>
            			<th scope="col" style="font-weight:600;">Order no.</th>
            			<th scope="col" style="font-weight:600;">Order status</th>
            			<th scope="col" style="font-weight:600;">Total amount</th>
            			<th scope="col" style="font-weight:600;">Payment mode</th>
            			<th scope="col" style="font-weight:600;">Date & Time</th>
            		</tr>
            	</thead>
            	<tbody>
            		@foreach($orders as $order)
					<tr>
            			<th scope="row" class="text1"><a class="btn btn-primary text-white w-100" href="/myorders/{{$order->custom_order_id}}" style="font-weight:600;color:black;">#{{$order->id}}</a></th>
            			<td class="text1">@if($order->order_status == "Reviewed") Processing @else {{$order->order_status}} @endif</td>
            			<td class="text1">INR @php echo number_format($order->total_amount, 2) @endphp</td>
            			<td class="text1">{{$order->payment_mode}}</td>
            			<td class="text1">@php echo date_format($order['created_at'], "d M Y"); echo " at "; echo date_format($order['created_at'], "h:i a"); @endphp</td>
            		</tr>
					@endforeach
            	</tbody>
            </table>
			<div class="orders-accordions onlyOnMobile">
			    @foreach($orders as $order)
				    <button class="accordion">Order #{{$order->id}}</button>
					<div class="panel">
					    <div class="row">
						    <div class="col-6 text1">Date & Time</div>
						    <div class="col-6 text1">@php echo date_format($order['created_at'], "d M Y"); echo " at "; echo date_format($order['created_at'], "h:i a"); @endphp</div>
						</div>
					    <div class="row">
						    <div class="col-6 text1">Order status</div>
						    <div class="col-6 text1">@if($order->order_status == "Reviewed") Processing @else {{$order->order_status}} @endif</div>
						</div>
					    <div class="row">
						    <div class="col-6 text1">Payment mode</div>
						    <div class="col-6 text1">{{$order->payment_mode}}</div>
						</div>
					    <div class="row">
						    <div class="col-6 text1">Total amount</div>
						    <div class="col-6 text1">INR @php echo number_format($order->total_amount, 2) @endphp</div>
						</div>
						<a href="/myorders/{{$order->custom_order_id}}" class="btn btn-primary viewOrder">View order details</a>
					</div>
				@endforeach
			</div>
			@else
				<p class="text1 text-center mt-3">No orders</p>
			@endif
    	</div>
    </div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
@endsection