@extends('layouts.app')
@section('title')@php echo $product['product_name'] @endphp | Vitality Club @endsection
@section('description'){{$product['product_description']}} @endsection
@section('canonical'){{$url}}@endsection
@section('style','')
@section('content')
@if(session('status'))
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
         <div class="modal-body">
            <p class="success_icon text-center pb-2"><i class="fas fa-check-circle"></i></p>
            <p class="modal-content pb-4 text-center">{{ session('status') }}</p>
			<p class="text-center mb-1">
			    <button class="btn btn-link continueShopping-btn mt-0" data-dismiss="modal">Continue Shopping</button>
			    <button class="btn btn-primary checkout-btn" onclick="location.href='/cart'">Checkout</button>
			</p>
          </div>
        </div>
      </div>
    </div>
@endif
<div class="container-fluid">
    <div class="container containerLimit breadcrubs-main-cont">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/">Home</a></li>
                <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/shop">Shop</a></li>
                <li class="breadcrumb-item" aria-label="breadcrumb"><a href="/shop/@php echo str_replace(' ','-',strtolower($type)) @endphp">{{$type}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product['product_name']}}</li>
            </ol>
        </nav>
	</div>
</div>

<div class="container-fluid bckgd7">
    <div class="container productDetails-cont containerLimit">
	    <div class="row noMarginMob">
			<div class="col-lg-5 col-md-6 productDetails-cont-left">
			    <div id="product_slide" class="owl-carousel">
				@for ($i = 1; $i <= 4; $i++)
			    	@php $picNum = 'product_pic'.$i; @endphp
			            @if($product[$picNum] != "null")
			                <div class="item">
                                <img class="owl-lazy" data-src="/storage/shop/@php echo str_replace(' ','-',$product['product_code']) @endphp/{{$product[$picNum]}}" alt="{{$product['product_name']}} | Vitality Club"/>
			                </div>
			    	    @endif
			    @endfor
				</div>
			</div>
			<div class="col-lg-7 col-md-6 productDetails-cont-right">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%;">
			    <div class="container bckgd8">
			        <p class="product-name dark-grey">{{$product->product_name}}</p>
				    @if($product->product_benefits != "")<p class="product-benefit">{{$product->product_benefits}}</p>@endif
					@php
					    $maxQty = $product['product_quantity'];
						if($product->product_hasVariants == "Yes"){
							$pprice = $product['product_variant1cost'];
							$pmrp = $product['product_variant1mrp'];
							$psku = $product['product_variant1sku'];
							$proVariantsQtys = [];
							
							for($i = 5; $i > 0; $i--){
								$variantQtyCounter = 'product_variant'.$i.'qty';
								if($product[$variantQtyCounter] > 0){
									$variantCostCounter = 'product_variant'.$i.'cost';
									$variantMRPCounter = 'product_variant'.$i.'mrp';
									$variantSKUCounter = 'product_variant'.$i.'sku';
									
									$pprice = $product[$variantCostCounter];
									$pmrp = $product[$variantMRPCounter];
									$psku = $product[$variantSKUCounter];
								}
								array_push($proVariantsQtys, $product[$variantQtyCounter]);
								$maxQty = max($proVariantsQtys);
							}
						}else{
							$pprice = $product->product_price;
							$pmrp = $product->product_totalPrice;
							$psku = $product['product_code'];
						}
					@endphp
					<!--<p class="product-sku">SKU: <span id="proNewSKU">{{$psku}}</span></p>-->
					<p class="product-price">INR @if($pmrp > $pprice)<span id="proMaxPrice" style="text-decoration:line-through;">@php echo number_format($pmrp); @endphp</span> @endif <span id="proNewPrice">@php echo number_format($pprice); @endphp</span></p>
				    <form class="add-to-bag" method="post" action="/cart" onsubmit="return eventTrigger()">
					@csrf
					<input type="hidden" name="productCode" value="{{$product['product_code']}}" />
					<input type="hidden" name="productVariant" value="{{$product['product_hasVariants']}}" />
					
                        <div class="form-group row mb-0">
						    @if($product->product_hasVariants == "Yes" && $maxQty > 0)
							<label class="col-lg-3 col-4 mb-3 col-form-label" for="proVariants">{{$product->product_variantType}}</label>
							<div class="col-lg-9 col-8 mb-3 pl-0">
							    <select id="proVariant" class="custom-select variantDropdown" name="proVariant" onChange="checkStock()">
							        @for($i = 1; $i <=5; $i++)
							    		@php $variantCount = 'product_variant'.$i; $variantQtyCounter = 'product_variant'.$i.'qty'; $variantSkuCounter = 'product_variant'.$i.'sku'; $variantCostCounter = 'product_variant'.$i.'cost'; $variantMRPCounter = 'product_variant'.$i.'mrp'; @endphp
							    		@if($product[$variantCount] != "" && $product[$variantQtyCounter] > 0)<option value="{{$i}}" data-qty="{{$product[$variantQtyCounter]}}" data-sku="{{$product[$variantSkuCounter]}}" data-cost="{{$product[$variantCostCounter]}}" data-mrp="{{$product[$variantMRPCounter]}}">{{$product[$variantCount]}}</option>@endif
							    	@endfor
							    </select>
							</div>
							@else
								<input type="hidden" id="noVariantProQTY" name="noVariantProQTY" value="{{$product['product_quantity']}}" />
							@endif
						</div>
						@if(($product['product_quantity']<=0 && $product['product_hasVariants']=="No") || ($maxQty <= 0))
							<a class="btn btn-primary out-of-stock-btn" style="cursor:pointer">Out of Stock</a>
						    <a class="btn btn-primary add-to-bag-btn back-to-products" href="/shop">Back to Shop</a>
				        @else
						<div class="form-group row">
				    	    <label for="quantity" class="col-lg-3 col-4 col-form-label">Quantity</label>
						    <div class="col-lg-9 col-8 pl-0">
                                <select class="custom-select qtyBtn" id="proQuantity" name="proQuantity" onChange="checkStock()" @if($product['product_quantity']<=0 && $product['product_hasVariants']=="No")disabled @endif>
						    	    <option value="1" selected>1</option>
						    		<option value="2">2</option>
						    		<option value="3">3</option>
						    		<option value="4">4</option>
						    		<option value="5">5</option>
						    		<option value="6">6</option>
						    		<option value="7">7</option>
						    		<option value="8">8</option>
						    		<option value="9">9</option>
						    		<option value="10">10</option>
                                </select>
                            </div>
                        </div>
						<button type="submit" id="addToBagBtn" class="btn btn-primary add-to-bag-btn">Add to Cart</button>
						<a class="btn btn-primary add-to-bag-btn back-to-products" href="/shop">Back to Shop</a>
					    @endif
				    </form>
					<p id="stockWarning" class="stockWarning"></p>
				</div>
				</td></tr></table>
			</div>
		</div>
	</div>
</div>
<div class="container containerLimit productExtraDetails-cont">
    <div class="row">
    	<div class="col-md-4">
    		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			    <a class="nav-link active" id="v-pills-description-tab" data-toggle="pill" href="#v-pills-description" role="tab" aria-controls="v-pills-description" aria-selected="true">Description</a>
    			<a class="nav-link" id="v-pills-ingredients-tab" data-toggle="pill" href="#v-pills-ingredients" role="tab" aria-controls="v-pills-ingredients" aria-selected="false">Ingredients</a>
    			<a class="nav-link" id="v-pills-nutritional-tab" data-toggle="pill" href="#v-pills-nutritional" role="tab" aria-controls="v-pills-nutritional" aria-selected="false">Additional Info</a>
    		</div>
    	</div>
    	<div class="col-md-8">
    		<div class="tab-content" id="v-pills-tabContent">
    			<div class="tab-pane fade show active" id="v-pills-description" role="tabpanel" aria-labelledby="v-pills-description-tab">@php echo str_replace('&lt;br/&gt;','<br/>',$product->product_description); @endphp</div>
    			<div class="tab-pane fade" id="v-pills-ingredients" role="tabpanel" aria-labelledby="v-pills-ingredients-tab">@php echo str_replace('&lt;br/&gt;','<br/>',$product->product_ingredients); @endphp</div>
    			<div class="tab-pane fade" id="v-pills-nutritional" role="tabpanel" aria-labelledby="v-pills-nutritional-tab">@php echo str_replace('&lt;br/&gt;','<br/>',$product->product_nutritionalFacts); @endphp</div>
    		</div>
    	</div>
    </div>
</div>
<div class="container-fluid related-products">
	<div class="container containerLimit">
		<p class="heading1 text-center">You may also like</p>
		<div id="relatedProducts" class="owl-carousel">
		    @foreach($relatedProducts as $relatedProduct)
			    @if($relatedProduct['id'] != "")
			    @php
				    if($relatedProduct->product_hasVariants == "Yes"){
						for($i = 5; $i > 0; $i--){
							$variantQtyCounter = 'product_variant'.$i.'qty';
							if($relatedProduct[$variantQtyCounter] > 0){
								$variantCostCounter = 'product_variant'.$i.'cost';
								$variantMRPCounter = 'product_variant'.$i.'mrp';
								
								$pprice = number_format($relatedProduct[$variantCostCounter]);
								$pmrp = number_format($relatedProduct[$variantMRPCounter]);
							}
							else{
								$pprice = number_format($relatedProduct->product_price);
								$pmrp = number_format($relatedProduct->product_totalPrice);
							}
						}
					}else{
						$pprice = number_format($relatedProduct->product_price);
						$pmrp = number_format($relatedProduct->product_totalPrice);
					}
				@endphp
				<div class="item">
				    <a href="/shop/<?php echo strtolower(str_replace(' ', '-', $relatedProduct['product_category'])); ?>/<?php echo strtolower(str_replace(' ', '-', $relatedProduct['product_url'])) ?>">
					    <img class="resp-img" src="/storage/shop/{{$relatedProduct['product_code']}}/@php echo str_replace('.jpg','-540px.jpg',$relatedProduct['product_pic1']) @endphp" alt="{{$relatedProduct['product_name']}} | Vitality Club"/>
					</a>
					<p class="productName text-center">{{$relatedProduct['product_name']}}</p>
					<p class="productPrice text-center mb-0">INR @if($pmrp > $pprice)<span class="totalPrice" style="text-decoration:line-through;">{{$pmrp}}</span>@endif {{$pprice}}</p>
				</div>
				@endif
			@endforeach
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#statusModal').modal('show');
	
	$(document).ready(function () {
		$('#product_slide').owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			dots: true,
			lazyLoad: true,
			smartSpeed: 1000
	    });
		
		$("#relatedProducts").owlCarousel({
			loop: true,
	    	lazyLoad: true,
	    	autoplay: true,
			autoplayHoverPause: true,
			smartSpeed: 1000,
			responsive:{
                0:{
					margin: 15,
					dots: true,
					nav: false,
					items: 2
                },
                768:{
                    margin: 10,
					dots: false,
					nav: true,
					items: 3
                },
				1024:{
					margin: 20,
					dots: false,
					nav: true,
					items: 3
				},
				1350:{
					margin: 30,
					dots: false,
					nav: true,
					items: 4
				}
			}
	    });
	});

	function checkStock(){
		if("{{$product->product_hasVariants}}" == "Yes"){
			var e = document.getElementById("proVariant");
			var option= e.options[e.selectedIndex];
			var availableStock = parseInt(option.getAttribute("data-qty"));
			
			document.getElementById("proNewPrice").innerHTML = Number(parseFloat(option.getAttribute("data-cost")).toFixed(2)).toLocaleString();

			if(parseInt(option.getAttribute("data-mrp")) > parseInt(option.getAttribute("data-cost"))){
			    var myEle = document.getElementById("proMaxPrice");
				if(myEle){
					myEle.style.display = "inline-block";
				}
				document.getElementById("proMaxPrice").innerHTML = Number(parseFloat(option.getAttribute("data-mrp")).toFixed(2)).toLocaleString();
			}else{
				var myEle = document.getElementById("proMaxPrice");
				if(myEle){
					myEle.style.display = "none";
				}
			}
		}else{
			var availableStock = parseInt(document.getElementById("noVariantProQTY").value);
		}
		
		var selectedQuantity = parseInt(document.getElementById("proQuantity").value);
		if(selectedQuantity > availableStock){
			if(availableStock > 1){
				document.getElementById("stockWarning").innerHTML = "Only "+availableStock+" Pcs. In Stock";
			}else{
				document.getElementById('stockWarning').innerHTML = "Only "+availableStock+" Pc. In Stock";
			}
			document.getElementById('stockWarning').style.display = "block";
			document.getElementById('addToBagBtn').disabled = true;
		}else{
			document.getElementById('stockWarning').style.display = "none";
			document.getElementById('addToBagBtn').disabled = false;
		}
	}
	
	function eventTrigger(){
		gtag('event', 'add_to_cart', {
			"items": [
			{
				"name": "{{$product['product_name']}}",
				"category": "{{$product['product_category']}}",
				"variant": document.getElementById("proVariant").value,
				"quantity": document.getElementById("proQuantity").value,
				"price": document.getElementById("proNewPrice").innerHTML
			}
			]
		});
		
		fbq('track', 'AddToCart');
	}
</script>
@endsection
@section('endscripts')
@endsection