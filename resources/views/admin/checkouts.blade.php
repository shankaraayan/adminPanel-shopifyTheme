@extends('admin.layout')
@section('title','Checkouts | Vitality Club')
@section('style','.admin-menu.orders i{color:black;}.admin-menu1.checkouts{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <h1 class="heading1">Abandoned checkouts</h1>
	<div class="container info-cont">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        	<li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
        	</li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        	<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-home-tab">
	            <table class="table">
                	<thead>
                		<tr>
                			<th scope="col">Checkout</th>
                			<th scope="col">Date</th>
                			<th scope="col">Placed by</th>
                			<th scope="col">Email Status</th>
                			<th scope="col">Recovery Status</th>
                			<th scope="col">Total</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($checkouts as $checkout)
		        		<tr class="table-row" data-href="/admin/checkouts/{{$checkout['id']}}">
                			<th scope="row">#{{$checkout['id']}}</th>
                			<td>@php echo date_format($checkout['created_at'], "d M"); echo " at "; echo date_format($checkout['created_at'], "h:i a"); @endphp</td>
                			<td>{{$checkout['customers_name']}}</td>
                			<td>
							    @if($checkout['email_status'] == "Sent")
					            	<div class="block3">{{$checkout['email_status']}}</div>
					            @else
					            	<div class="block4">{{$checkout['email_status']}}</div>
					            @endif
							</td>
                			<td>
							    @if($checkout['recovery_status'] == "Recovered")
					            	<div class="block3">{{$checkout['recovery_status']}}</div>
					            @else
					            	<div class="block4">{{$checkout['recovery_status']}}</div>
					            @endif
							</td>
                			<td>INR @php echo number_format($checkout['total']) @endphp</td>
                		</tr>
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
</script>
@endsection