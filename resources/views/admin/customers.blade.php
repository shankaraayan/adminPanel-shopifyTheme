@extends('admin.layout')
@section('title','Customers | Vitality Club')
@section('style','.admin-menu.customers i{color:black;} .admin-menu.customers{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <h1 class="heading1">Customers</h1>
	<div class="container info-cont">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        	<li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
        	</li>
        	<li class="nav-item" role="presentation"> <a class="nav-link" id="pills-subscribers-tab" data-toggle="pill" href="#subscribers" role="tab" aria-controls="pills-subscribers" aria-selected="false">Email subscribers</a>
        	</li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        	<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-all-tab">
	            <table class="table">
                	<thead>
                		<tr>
                			<th scope="col">Customer</th>
                			<th scope="col" class="text-center">Email Subscription status</th>
                			<th scope="col" class="text-center">No. of orders</th>
                			<th scope="col" class="text-center">Total spent</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($customers as $customer)
		        		<tr class="table-row" data-href="/admin/customer/{{$customer->id}}">
                			<th scope="row">{{$customer->email}}</th>
							<td class="align-middle text-center">
							    @if($customer->subscribed_status == "Yes")
					            	<div class="block3">Subscribed</div>
					            @else
					            	<div class="block4">Not subscribed</div>
					            @endif
							</td>
                			<td class="align-middle text-center">
							    @if($customer->ordersCount > 0)
								    {{$customer->ordersCount}} order
								@else
									0 orders
								@endif
							</td>
                			<td class="align-middle text-center">
							    @if($customer->totalSpent > 0)
								    INR @php echo number_format($customer->totalSpent) @endphp spent
								@else
									INR 0 spent
								@endif
							</td>
                		</tr>
		        		@endforeach
                	</tbody>
                </table>
				<div class="container pagination-cont">
				    {{$customers->links()}}
				</div>
        	</div>
        	<div class="tab-pane fade" id="subscribers" role="tabpanel" aria-labelledby="pills-subscribers-tab">
			    <table class="table">
                	<thead>
                		<tr>
                			<th scope="col">Customer</th>
                			<th scope="col" class="text-center">Email Subscription status</th>
                			<th scope="col" class="text-center">No. of orders</th>
                			<th scope="col" class="text-center">Total spent</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($customers as $customer)
		        		    @if($customer->subscribed_status == "Yes")
							<tr class="table-row" data-href="/admin/customer/{{$customer->id}}">
                		    	<th scope="row">{{$customer->email}}</th>
						    	<td class="align-middle text-center">
						    	    @if($customer->subscribed_status == "Yes")
					                	<div class="block3">Subscribed</div>
					                @else
					                	<div class="block4">Not subscribed</div>
					                @endif
						    	</td>
                		    	<td class="align-middle text-center">
						    	    @if($customer->ordersCount > 0)
						    		    {{$customer->ordersCount}} order
						    		@else
						    			0 orders
						    		@endif
						    	</td>
                		    	<td class="align-middle text-center">
						    	    @if($customer->totalSpent > 0)
						    		    INR @php echo number_format($customer->totalSpent) @endphp spent
						    		@else
						    			INR 0 spent
						    		@endif
						    	</td>
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
    $('#customersCollapse').collapse('show');
	
	$(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
</script>
@endsection