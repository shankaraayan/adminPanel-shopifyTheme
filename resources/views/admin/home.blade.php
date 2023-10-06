@extends('admin.layout')
@section('title','Home | Vitality Club')
@section('style','.admin-main-cont{padding:0 15px;}.admin-menu.home{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="row">
    <div class="col-8 home-left">
	    <p>Here’s what’s happening with your store today.</p>
		<div class="row">
		    <div class="col-6">
		        <div class="container info-cont">
		        	<h3 class="info-cont-heading">Total Sales</h3>
		        	<p class="mb-0">@if($todayOrders[0]['totalSales'] > 0)INR @php echo number_format($todayOrders[0]['totalSales']) @endphp @else No sales yet @endif</p>
		        	<div class="info-cont-divider"></div>
		        	<p class="mb-0">@if($todayOrders[0]['noOfOrders'] > 0){{$todayOrders[0]['noOfOrders']}} orders @else No orders yet @endif</p>
		        </div>
		    </div>
			<div class="col-6">
		        <div class="container info-cont">
		        	<h3 class="info-cont-heading">Total Abandoned Checkouts</h3>
		        	<p class="mb-0">@if($todayCheckouts[0]['totalCheckouts'] > 0)INR @php echo number_format($todayCheckouts[0]['totalCheckouts']) @endphp @else No checkout yet @endif</p>
		        	<div class="info-cont-divider"></div>
		        	<p class="mb-0">@if($todayCheckouts[0]['noOfCheckouts'] > 0){{$todayCheckouts[0]['noOfCheckouts']}} orders @else No checkout yet @endif</p>
		        </div>
		    </div>
		</div>
		@if($noOfUnfulfillOrders > 0)
		<a href="/admin/orders#open" style="text-decoration:none;color:#626262;">
	    <div class="container info-cont">
		    <div class="row">
			    <div class="col-9">
				    <p class="info-cont-heading mb-0"><i class="fas fa-download mr-3"></i>{{$noOfUnfulfillOrders}} orders to fulfill</p>
				</div>
			    <div class="col-3">
				    <p class="info-cont-heading text-right mb-0"><i class="fas fa-chevron-right"></i></p>
				</div>
			</div>
		</div>
		</a>
		@endif
	</div>
	<div class="col-4 home-right">
	    <form class="needs-validation" novalidate>
		    <div class="form-row">
			    <div class="col-12">
				    <select class="custom-select">
					    <option value="All Time" selected>All Time</option>
					</select>
				</div>
			</div>
		</form>
		<div class="info-cont-divider"></div>
		<h3 class="info-cont-subheading">Total sales</h3>
		<p class="mb-0">@if($orders[0]['totalSales'] > 0)INR @php echo number_format($orders[0]['totalSales']) @endphp @else No orders yet @endif</p>
		<div class="info-cont-divider"></div>
		<h3 class="info-cont-subheading">Total no. of orders</h3>
		<p class="mb-0">@if($orders[0]['noOfOrders'] > 0){{$orders[0]['noOfOrders']}} orders @else No orders yet @endif</p>
		<div class="info-cont-divider"></div>
		<h3 class="info-cont-subheading">Total abandoned checkouts</h3>
		<p class="mb-0">@if($checkouts[0]['totalCheckouts'] > 0)INR @php echo number_format($checkouts[0]['totalCheckouts']) @endphp @else No abandoned checkout yet @endif</p>
		<div class="info-cont-divider"></div>
		<h3 class="info-cont-subheading">Total no. of abandoned checkouts</h3>
		<p class="mb-0">@if($checkouts[0]['noOfCheckouts'] > 0){{$checkouts[0]['noOfCheckouts']}} checkouts @else No abandoned checkout yet @endif</p>
	</div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
@endsection