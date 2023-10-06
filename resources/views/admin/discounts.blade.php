@extends('admin.layout')
@section('title','Discounts | Vitality Club')
@section('style','.admin-menu.discounts{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container p-0 mb-4">
	    <div class="row">
		    <div class="col-6">
			    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
					<h1 class="heading1">Discounts</h1>
				</td></tr></table>
			</div>
			<div class="col-6 text-right">
				<div class="btn-group">
                	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create discount </button>
                	<div class="dropdown-menu dropdown-menu-right">
                		<button class="dropdown-item" type="button" onclick="window.location.href='/admin/discounts/code/new'">Discount code</button>
                		<button class="dropdown-item" type="button" onclick="window.location.href='/admin/discounts/automatic/new'">Automatic discount</button>
                	</div>
                </div>
			</div>
		</div>
	</div>
	<div class="container info-cont">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        	<li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-discount-tab" data-toggle="pill" href="#discount" role="tab" aria-controls="pills-discount" aria-selected="true">Discount codes</a></li>
        	<li class="nav-item" role="presentation"> <a class="nav-link" id="pills-automatic-tab" data-toggle="pill" href="#automatic" role="tab" aria-controls="pills-automatic" aria-selected="false">Automatic discounts</a></li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        	<div class="tab-pane fade show active" id="discount" role="tabpanel" aria-labelledby="pills-discount-tab">
			    @if(count($discountCodes) > 0)
	                <table class="table">
                    	<thead>
                    		<tr>
                    			<th scope="col">Showing @php echo count($discountCodes) @endphp discount code</th>
                    			<th scope="col"></th>
                    			<th scope="col"></th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($discountCodes as $discount)
				    		    <tr class="table-row" data-href="/admin/discounts/code/{{$discount['id']}}">
				    			    <th scope="row">
				    				    <p class="mb-0">{{$discount['discountCode']}}</p>
				    				    <p class="mb-0">{{$discount['discountValue']}}% off . @if($discount['discountMinPurchaseAmt'] == 0) No Minimum purchase @else Minimum purchase of INR @php echo number_format($discount['discountMinPurchaseAmt']) @endphp @endif @if($discount['discountOncePerUser'] == "Yes"). Once per customer @endif</p>
				    				</th>
				    				<td class="align-middle text-center">
				    				    @if($discount['discountStatus'] == "Active")
				    						<div class="block3">{{$discount['discountStatus']}}</div>
				    					@else
				    						<div class="block4">{{$discount['discountStatus']}}</div>
				    					@endif
				    				</th>
				    				<td class="align-middle text-center">@php $startDate=date_create($discount['discountStartDate']); echo date_format($startDate, 'd M, Y'); @endphp - @if($discount['discountEndDate'] != null) @php $endDate=date_create($discount['discountEndDate']); echo date_format($endDate, 'd M, Y'); @endphp @else No end date @endif</th>
				    			</tr>
				    		@endforeach
                    	</tbody>
                    </table>
				@else
					<div class="container p-5 text-center">
				        <p><img src="/backgrounds/7a6e434b6697415172cb3c0217823710.svg" /></p>
						<p class="heading1 mb-2">Manage discounts and promotions</p>
						<p>Create discount codes and automatic discounts that apply at checkout.</p>
						<p class="mb-0"><button class="btn btn-primary" onclick="window.location.href='/admin/discounts/code/new'">Create discount code</button></p>
				    </div>
				@endif
        	</div>
        	<div class="tab-pane fade" id="automatic" role="tabpanel" aria-labelledby="pills-automatic-tab">
			    @if(count($automaticDiscounts) > 0)
	                <table class="table">
                    	<thead>
                    		<tr>
                    			<th scope="col">Showing @php echo count($automaticDiscounts) @endphp automatic discount</th>
                    			<th scope="col"></th>
                    			<th scope="col"></th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($automaticDiscounts as $discount)
				    		    <tr class="table-row" data-href="/admin/discounts/automatic/{{$discount['id']}}">
				    			    <th scope="row">
				    				    <p class="mb-0">{{$discount['discountTitle']}}</p>
				    				    <p class="mb-0">{{$discount['discountValue']}}% off . @if($discount['discountMinPurchaseAmt'] == 0) No Minimum purchase @else Minimum purchase of INR @php echo number_format($discount['discountMinPurchaseAmt']) @endphp @endif</p>
				    				</th>
				    				<td class="align-middle text-center">
				    				    @if($discount['discountStatus'] == "Active")
				    						<div class="block3">{{$discount['discountStatus']}}</div>
				    					@else
				    						<div class="block4">{{$discount['discountStatus']}}</div>
				    					@endif
				    				</th>
				    				<td class="align-middle text-center">@php $startDate=date_create($discount['discountStartDate']); echo date_format($startDate, 'd M, Y'); @endphp - @if($discount['discountEndDate'] != null) @php $endDate=date_create($discount['discountEndDate']); echo date_format($endDate, 'd M, Y'); @endphp @else No end date @endif</th>
				    			</tr>
				    		@endforeach
                    	</tbody>
                    </table>
				@else
					<div class="container p-5 text-center">
				        <p><img src="/backgrounds/7a6e434b6697415172cb3c0217823710.svg" /></p>
						<p class="heading1 mb-2">Manage discounts and promotions</p>
						<p>Create automatic discounts that apply at checkout.</p>
						<p class="mb-0"><button class="btn btn-primary" onclick="window.location.href='/admin/discounts/automatic/new'">Create discount</button></p>
				    </div>
				@endif
        	</div>
        </div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#discountsCollapse').collapse('show');
	
	$(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
</script>
@endsection