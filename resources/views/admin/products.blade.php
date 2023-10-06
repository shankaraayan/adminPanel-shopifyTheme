@extends('admin.layout')
@section('title','Products | Vitality Club')
@section('style','.admin-menu.products i{color:black;}.admin-menu1.products{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container p-0 mb-4">
	    <div class="row">
		    <div class="col-6">
			    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
					<h1 class="heading1">Products</h1>
				</td></tr></table>
			</div>
			<div class="col-6 text-right">
			    <button class="btn btn-primary" onclick="window.location.href='/admin/products/new'">Add product</button>
			</div>
		</div>
	</div>
	<div class="container info-cont">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        	<li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
        	</li>
        	<li class="nav-item" role="presentation"> <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#active" role="tab" aria-controls="pills-profile" aria-selected="false">Active</a>
        	</li>
        	<li class="nav-item" role="presentation"> <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#draft" role="tab" aria-controls="pills-contact" aria-selected="false">Draft</a>
        	</li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        	<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-home-tab">
	            <table class="table">
                	<thead>
                		<tr>
                			<th scope="col" style="width:100px"></th>
                			<th scope="col">Product</th>
                			<th scope="col">Status</th>
                			<th scope="col">Category</th>
                			<th scope="col">Sub Category</th>
                			<th scope="col">Price</th>
                			<th scope="col">Date</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($products as $product)
		        		<tr class="table-row" data-href="/admin/products/{{$product['id']}}">
                			<th scope="row">
							    <div class="img-block mr-0" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',strtoupper($product['product_code'])) @endphp/@php echo str_replace('.jpg','-270px.jpg',$product['product_pic1']) @endphp');"></div>
							</th>
                			<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    <a href="/admin/products/{{$product['id']}}" style="color:black">{{$product['product_name']}}</a>
								</td></tr></table>
							</td>
							<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    @if($product->product_status == "Active")
										<div class="block3">{{$product['product_status']}}</div>
									@else
										<div class="block4">{{$product['product_status']}}</div>
									@endif
								</td></tr></table>
							</td>
                			<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    {{$product['product_category']}}
								</td></tr></table>
							</td>
							<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    {{$product['product_subCategory']}}
								</td></tr></table>
							</td>
							@php
					            if($product->product_hasVariants == "Yes"){
					        		$pprice = $product['product_variant1cost'];
									$pmrp = $product['product_variant1mrp'];
									for($i = 5; $i > 0; $i--){
					        			$variantQtyCounter = 'product_variant'.$i.'qty';
					        			if($product[$variantQtyCounter] > 0){
					        				$variantCostCounter = 'product_variant'.$i.'cost';
					        				
					        				$pprice = number_format($product[$variantCostCounter]);
					        			}
					        		}
					        	}else{
					        		$pprice = number_format($product->product_price);
					        	}
					        @endphp
							<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    INR {{$pprice}}
								</td></tr></table>
							</td>
							<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    @php echo date_format($product['created_at'], "d M") @endphp
								</td></tr></table>
							</td>
                		</tr>
		        		@endforeach
                	</tbody>
                </table>
				<div class="container pagination-cont">
				    {{$products->links()}}
				</div>
        	</div>
        	<div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="pills-profile-tab">
			    <table class="table">
                	<thead>
                		<tr>
                			<th scope="col" style="width:100px"></th>
                			<th scope="col">Product</th>
                			<th scope="col">Status</th>
                			<th scope="col">Category</th>
                			<th scope="col">Sub Category</th>
                			<th scope="col">Price</th>
                			<th scope="col">Date</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($activeProducts as $product)
		        		    @if($product->product_status == "Active")
						        <tr class="table-row" data-href="/admin/products/{{$product['id']}}">
                		        	<th scope="row">
						        	    <div class="img-block mr-0" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',strtoupper($product['product_code'])) @endphp/@php echo str_replace('.jpg','-270px.jpg',$product['product_pic1']) @endphp');"></div>
						        	</th>
                		        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    <a href="/admin/products/{{$product['id']}}" style="color:black">{{$product['product_name']}}</a>
						        		</td></tr></table>
						        	</td>
						        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    @if($product->product_status == "Active")
						        				<div class="block3">{{$product['product_status']}}</div>
						        			@else
						        				<div class="block4">{{$product['product_status']}}</div>
						        			@endif
						        		</td></tr></table>
						        	</td>
                		        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    {{$product['product_category']}}
						        		</td></tr></table>
						        	</td>
									<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    {{$product['product_subCategory']}}
						        		</td></tr></table>
						        	</td>
							        @php
					                    if($product->product_hasVariants == "Yes"){
					                		$pprice = $product['product_variant1cost'];
											$pmrp = $product['product_variant1mrp'];
											for($i = 5; $i > 0; $i--){
					                			$variantQtyCounter = 'product_variant'.$i.'qty';
					                			if($product[$variantQtyCounter] > 0){
					                				$variantCostCounter = 'product_variant'.$i.'cost';
					                				
					                				$pprice = number_format($product[$variantCostCounter]);
					                			}
					                		}
					                	}else{
					                		$pprice = number_format($product->product_price);
					                	}
					                @endphp
						        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    INR {{$pprice}}
						        		</td></tr></table>
						        	</td>
						        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    @php echo date_format($product['created_at'], "d M") @endphp
						        		</td></tr></table>
						        	</td>
                		        </tr>
						    @endif
		        		@endforeach
                	</tbody>
                </table>
				<div class="container pagination-cont">
				    {{$activeProducts->links()}}
				</div>
        	</div>
        	<div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="pills-contact-tab">
			    <table class="table">
                	<thead>
                		<tr>
                			<th scope="col" style="width:100px"></th>
                			<th scope="col">Product</th>
                			<th scope="col">Status</th>
                			<th scope="col">Category</th>
                			<th scope="col">Sub Category</th>
                			<th scope="col">Price</th>
                			<th scope="col">Date</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($draftProducts as $product)
		        		    @if($product->product_status == "Draft")
						        <tr class="table-row" data-href="/admin/products/{{$product['id']}}">
                		        	<th scope="row">
						        	    <div class="img-block mr-0" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',strtoupper($product['product_code'])) @endphp/@php echo str_replace('.jpg','-270px.jpg',$product['product_pic1']) @endphp');"></div>
						        	</th>
                		        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    <a href="/admin/products/{{$product['id']}}" style="color:black">{{$product['product_name']}}</a>
						        		</td></tr></table>
						        	</td>
						        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    @if($product->product_status == "Active")
						        				<div class="block3">{{$product['product_status']}}</div>
						        			@else
						        				<div class="block4">{{$product['product_status']}}</div>
						        			@endif
						        		</td></tr></table>
						        	</td>
                		        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    {{$product['product_category']}}
						        		</td></tr></table>
						        	</td>
									<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    {{$product['product_subCategory']}}
						        		</td></tr></table>
						        	</td>
							        @php
					                    if($product->product_hasVariants == "Yes"){
					                		$pprice = $product['product_variant1cost'];
											$pmrp = $product['product_variant1mrp'];
					                		for($i = 5; $i > 0; $i--){
					                			$variantQtyCounter = 'product_variant'.$i.'qty';
					                			if($product[$variantQtyCounter] > 0){
					                				$variantCostCounter = 'product_variant'.$i.'cost';
					                				
					                				$pprice = number_format($product[$variantCostCounter]);
					                			}
					                		}
					                	}else{
					                		$pprice = number_format($product->product_price);
					                	}
					                @endphp
						        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    INR {{$pprice}}
						        		</td></tr></table>
						        	</td>
						        	<td>
						        	    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
						        		    @php echo date_format($product['created_at'], "d M") @endphp
						        		</td></tr></table>
						        	</td>
                		        </tr>
						    @endif
		        		@endforeach
                	</tbody>
                </table>
				<div class="container pagination-cont">
				    {{$draftProducts->links()}}
				</div>
        	</div>
        </div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#productsCollapse').collapse('show');
	
	$(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
</script>
@endsection