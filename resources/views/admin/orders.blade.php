@extends('admin.layout')
@section('title','Orders | Vitality Club')
@section('style','.admin-menu.orders i{color:black;}.admin-menu1.orders{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <h1 class="heading1">Orders</h1>
	<div class="container info-cont">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        	<li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
        	</li>
        	<li class="nav-item" role="presentation"> <a class="nav-link" id="pills-open-tab" data-toggle="pill" href="#open" role="tab" aria-controls="pills-open" aria-selected="false">Open</a>
        	</li>
        	<li class="nav-item" role="presentation"> <a class="nav-link" id="pills-closed-tab" data-toggle="pill" href="#closed" role="tab" aria-controls="pills-closed" aria-selected="false">Closed</a>
        	</li>
        	<li class="nav-item" role="presentation"> <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#cancelled" role="tab" aria-controls="pills-contact" aria-selected="false">Cancelled</a>
        	</li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        	<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-all-tab">
	            <table class="table">
                	<thead>
                		<tr>
                			<th scope="col">Order</th>
                			<th scope="col">Date</th>
                			<th scope="col">Customer</th>
                			<th scope="col" class="text-center">Total</th>
                			<th scope="col" class="text-center">Payment</th>
                			<th scope="col" class="text-center">Fulfillment</th>
                			<th scope="col" class="text-center">Items</th>
                			<th scope="col">Delivery Method</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($orders as $order)
		        		<tr class="table-row" data-href="/admin/orders/{{$order[0]['id']}}">
                			<th scope="row">#{{$order[0]['id']}}</th>
                			<td>@php echo date_format($order[0]['created_at'], "d M"); echo " at "; echo date_format($order[0]['created_at'], "h:i a"); @endphp</td>
                			<td>{{$order[0]['first_name']}} {{$order[0]['last_name']}}</td>
                			<td class="text-center">INR @php echo number_format($order[0]['total_amount'], 2) @endphp</td>
							<td class="text-center">
							    @if($order[0]['payment_status'] == "Paid")
					            	<div class="block1"><i class="fas fa-circle"></i>{{$order[0]['payment_status']}}</div>
					            @else
					            	<div class="block2"><i class="far fa-circle"></i>{{$order[0]['payment_status']}}</div>
					            @endif
							</td>
							<td class="text-center">
							    @if($order[0]['order_status'] == "Fulfilled")
					            	<div class="block1 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
					            @elseif($order[0]['order_status'] == "Shipped")
								    <div class="block3 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
								@elseif($order[0]['order_status'] == "Cancelled")
								    <div class="block5 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
								@else
					            	<div class="block2 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
					            @endif
							</td>
							@php
							    $noOfItems = 0;
								for($i=0;$i<count($order);$i++){
									$noOfItems += $order[$i]['product_quantity'];
								}
							@endphp
                			<td class="text-center">{{$noOfItems}}</td>
                			<td>{{$order[0]['shipping_name']}}</td>
                		</tr>
		        		@endforeach
                	</tbody>
                </table>
        	</div>
        	<div class="tab-pane fade" id="open" role="tabpanel" aria-labelledby="pills-open-tab">
			    <table class="table">
                	<thead>
                		<tr>
                			<th scope="col">Order</th>
                			<th scope="col">Date</th>
                			<th scope="col">Customer</th>
                			<th scope="col" class="text-center">Total</th>
                			<th scope="col" class="text-center">Payment</th>
                			<th scope="col" class="text-center">Fulfillment</th>
                			<th scope="col" class="text-center">Items</th>
                			<th scope="col">Delivery Method</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($orders as $order)
		        		    @if($order[0]['order_status'] == "Reviewed" || $order[0]['order_status'] == "Partial Shipped" || $order[0]['order_status'] == "Shipped")
						        <tr class="table-row" data-href="/admin/orders/{{$order[0]['id']}}">
                		        	<th scope="row">#{{$order[0]['id']}}</th>
                		        	<td>@php echo date_format($order[0]['created_at'], "d M"); echo " at "; echo date_format($order[0]['created_at'], "h:i a"); @endphp</td>
                		        	<td>{{$order[0]['first_name']}} {{$order[0]['last_name']}}</td>
                		        	<td class="text-center">INR @php echo number_format($order[0]['total_amount']) @endphp</td>
						        	<td class="text-center">
						        	    @if($order[0]['payment_status'] == "Paid")
					                    	<div class="block1"><i class="fas fa-circle"></i>{{$order[0]['payment_status']}}</div>
					                    @else
					                    	<div class="block2"><i class="far fa-circle"></i>{{$order[0]['payment_status']}}</div>
					                    @endif
						        	</td>
						        	<td class="text-center">
						        	    @if($order[0]['order_status'] == "Fulfilled")
					                    	<div class="block1 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
					                    @elseif($order[0]['order_status'] == "Shipped")
								            <div class="block3 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
								        @elseif($order[0]['order_status'] == "Cancelled")
								            <div class="block5 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
								        @else
					                    	<div class="block2 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
					                    @endif
						        	</td>
							        @php
							            $noOfItems = 0;
							        	for($i=0;$i<count($order);$i++){
							        		$noOfItems += $order[$i]['product_quantity'];
							        	}
							        @endphp
                			        <td class="text-center">{{$noOfItems}}</td>
                		        	<td>{{$order[0]['shipping_name']}}</td>
                		        </tr>
							@endif
		        		@endforeach
                	</tbody>
                </table>
        	</div>
        	<div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="pills-closed-tab">
			    <table class="table">
                	<thead>
                		<tr>
                			<th scope="col">Order</th>
                			<th scope="col">Date</th>
                			<th scope="col">Customer</th>
                			<th scope="col" class="text-center">Total</th>
                			<th scope="col" class="text-center">Payment</th>
                			<th scope="col" class="text-center">Fulfillment</th>
                			<th scope="col" class="text-center">Items</th>
                			<th scope="col">Delivery Method</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($orders as $order)
		        		    @if($order[0]['order_status'] == "Fulfilled")
						        <tr class="table-row" data-href="/admin/orders/{{$order[0]['id']}}">
                		        	<th scope="row">#{{$order[0]['id']}}</th>
                		        	<td>@php echo date_format($order[0]['created_at'], "d M"); echo " at "; echo date_format($order[0]['created_at'], "h:i a"); @endphp</td>
                		        	<td>{{$order[0]['first_name']}} {{$order[0]['last_name']}}</td>
                		        	<td class="text-center">INR @php echo number_format($order[0]['total_amount']) @endphp</td>
						        	<td class="text-center">
						        	    @if($order[0]['payment_status'] == "Paid")
					                    	<div class="block1"><i class="fas fa-circle"></i>{{$order[0]['payment_status']}}</div>
					                    @else
					                    	<div class="block2"><i class="far fa-circle"></i>{{$order[0]['payment_status']}}</div>
					                    @endif
						        	</td>
						        	<td class="text-center">
						        	    @if($order[0]['order_status'] == "Fulfilled")
					                    	<div class="block1 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
					                    @elseif($order[0]['order_status'] == "Shipped")
								            <div class="block3 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
								        @elseif($order[0]['order_status'] == "Cancelled")
								            <div class="block5 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
								        @else
					                    	<div class="block2 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
					                    @endif
						        	</td>
							        @php
							            $noOfItems = 0;
							        	for($i=0;$i<count($order);$i++){
							        		$noOfItems += $order[$i]['product_quantity'];
							        	}
							        @endphp
                			        <td class="text-center">{{$noOfItems}}</td>
                		        	<td>{{$order[0]['shipping_name']}}</td>
                		        </tr>
							@endif
		        		@endforeach
                	</tbody>
                </table>
        	</div>
        	<div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="pills-contact-tab">
			    <table class="table">
                	<thead>
                		<tr>
                			<th scope="col">Order</th>
                			<th scope="col">Date</th>
                			<th scope="col">Customer</th>
                			<th scope="col" class="text-center">Total</th>
                			<th scope="col" class="text-center">Payment</th>
                			<th scope="col" class="text-center">Fulfillment</th>
                			<th scope="col" class="text-center">Items</th>
                			<th scope="col">Delivery Method</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($orders as $order)
		        		    @if($order[0]['order_status'] == "Cancelled")
						        <tr class="table-row" data-href="/admin/orders/{{$order[0]['id']}}">
                		        	<th scope="row">#{{$order[0]['id']}}</th>
                		        	<td>@php echo date_format($order[0]['created_at'], "d M"); echo " at "; echo date_format($order[0]['created_at'], "h:i a"); @endphp</td>
                		        	<td>{{$order[0]['first_name']}} {{$order[0]['last_name']}}</td>
                		        	<td class="text-center">INR @php echo number_format($order[0]['total_amount']) @endphp</td>
						        	<td class="text-center">
						        	    @if($order[0]['payment_status'] == "Paid")
					                    	<div class="block1"><i class="fas fa-circle"></i>{{$order[0]['payment_status']}}</div>
					                    @else
					                    	<div class="block2"><i class="far fa-circle"></i>{{$order[0]['payment_status']}}</div>
					                    @endif
						        	</td>
						        	<td class="text-center">
						        	    @if($order[0]['order_status'] == "Fulfilled")
					                    	<div class="block1 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
					                    @elseif($order[0]['order_status'] == "Shipped")
								            <div class="block3 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
								        @elseif($order[0]['order_status'] == "Cancelled")
								            <div class="block5 mr-0"><i class="fas fa-circle"></i>{{$order[0]['order_status']}}</div>
								        @else
					                    	<div class="block2 mr-0"><i class="far fa-circle"></i>{{$order[0]['order_status']}}</div>
					                    @endif
						        	</td>
							        @php
							            $noOfItems = 0;
							        	for($i=0;$i<count($order);$i++){
							        		$noOfItems += $order[$i]['product_quantity'];
							        	}
							        @endphp
                			        <td class="text-center">{{$noOfItems}}</td>
                		        	<td>{{$order[0]['shipping_name']}}</td>
                		        </tr>
							@endif
		        		@endforeach
                	</tbody>
                </table>
        	</div>
        </div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#ordersCollapse').collapse('show');
	
	$(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
	
	if(document.URL.indexOf("#open") >= 0){
		document.getElementById('pills-open-tab').click();
	}
</script>
@endsection