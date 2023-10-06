@extends('layouts.app')
@section('title')<?php echo ($type == 'Buy products') ? 'Buy Immunity Building Products Online | Superfoods, Teas and More' : str_replace(['shop', 'buy'],['Shop','Buy'],ucwords($type)).' Online' ?> | Vitality Club @endsection
@section('description')@endsection
@section('canonical'){{$url}}@endsection
@section('style')@if($breadCrumbType == 2 && $categoryInfo['category'] == 'Gifts')#gifting{color:black;} @else #shop{color:black;} @endif @endsection
@section('content')
@if($breadCrumbType == 2)
<div class="container-fluid categoriesBanner-block">
    <div class="row">
	    <div class="col-md-7 categoriesBanner-imgBlock">
		    <img src="/storage/categories/{{$categoryInfo['banner']}}" alt="{{$categoryInfo['category']}} | Vitality Club" />
		</div>
	    <div class="col-md-5 categoriesBanner-textBlock">
		    <table class="textBCK" style="width:100%;height:100%"><tr><td class="align-middle textBCKTD" style="width:100%;height:100%">
			    <h2 class="heading2 @if($categoryInfo['description'] == "")mb-0 @endif">{{$categoryInfo['category']}}</h2>
				@if($categoryInfo['description'] != "")<p class="text1 mb-0">{{$categoryInfo['description']}}</p>@endif
			</td></tr></table>
		</div>
	</div>
</div>
@endif
@if($breadCrumbType == 3)
<div class="container-fluid categoriesBanner-block">
    <div class="row">
	    <div class="col-md-7 categoriesBanner-imgBlock">
		    <img src="/storage/sub-categories/{{$subCategoryInfo['banner']}}" alt="{{$subCategoryInfo['subCategory']}} | Vitality Club" />
		</div>
	    <div class="col-md-5 categoriesBanner-textBlock">
		    <table class="textBCK" style="width:100%;height:100%"><tr><td class="align-middle textBCKTD" style="width:100%;height:100%">
			    <h2 class="heading2 @if($subCategoryInfo['description'] == "")mb-0 @endif">{{$subCategoryInfo['subCategory']}}</h2>
				@if($subCategoryInfo['description'] != "")<p class="text1 mb-0">{{$subCategoryInfo['description']}}</p>@endif
			</td></tr></table>
		</div>
	</div>
</div>
@endif
<div class="container-fluid">
    <div class="container containerLimit">
    	<div class="row breadcrubs-main-cont">
    		<div class="col-md-6">
    			<nav aria-label="breadcrumb">
					@if($breadCrumbType == 3)
					    <ol class="breadcrumb">
    				    	<li class="breadcrumb-item"><a href="/">Home</a></li>
    				    	<li class="breadcrumb-item"><a href="/shop">Shop</a></li>
    				    	<li class="breadcrumb-item"><a href="/shop/@php echo str_replace(' ','-',strtolower($mainCategory)) @endphp">{{$mainCategory}}</a></li>
    				    	<li class="breadcrumb-item active" aria-current="page">@php echo str_replace(['Buy ','for'],['','-'],$type); @endphp</li>
    				    </ol>
					@elseif($breadCrumbType == 2)
					    <ol class="breadcrumb">
    				    	<li class="breadcrumb-item"><a href="/">Home</a></li>
    				    	<li class="breadcrumb-item"><a href="/shop">Shop</a></li>
    				    	<li class="breadcrumb-item active" aria-current="page">@php echo str_replace(['Buy ','for'],['','-'],$type); @endphp</li>
    				    </ol>
					@else
					    <ol class="breadcrumb">
    				    	<li class="breadcrumb-item"><a href="/">Home</a></li>
    				    	<li class="breadcrumb-item active" aria-current="page">@if($type == "Buy products") Shop @else @php echo str_replace(['Buy ',' products'],['Shop - ',''],$type); @endphp @endif</li>
    				    </ol>
					@endif
    			</nav>
    		</div>
    		<div class="col-md-6 text-right">
                <div class="btn-group sorting-dropdown">
                	<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By</button>
                	<div class="dropdown-menu dropdown-menu-right">
                		<button class="dropdown-item" type="button" id="newest" value="newest" name="sortRadios" onclick="applySorting(this)">NEWEST</button>
                		<button class="dropdown-item" type="button" id="price-lowest" value="price-lowest" name="sortRadios" onclick="applySorting(this)">PRICE LOWEST</button>
                		<button class="dropdown-item" type="button" id="price-highest" value="price-highest" name="sortRadios" onclick="applySorting(this)">PRICE HIGHEST</button>
                	</div>
                </div>
    		</div>
    	</div>
	</div>
</div>
<div class="container-fluid product_display-main-cont">
    <div class="container containerLimit">
    	<div class="row m-0">
    		<div class="col-lg-2 col-md-3 filter-cont">
			    <div id="filters" class="filter-form-cont">
                    <table style="width:100%;height:100%;"><tr>
					<td class="align-top tablecellOnOnlyMobile" style="width:20%;height:100%;background-color:rgba(0,0,0,0.33);"></td>
					<td class="align-top" style="width:80%;height:100%;background-color:white;padding:10px 0 20px 0;">
					<p class="filterCloseBtnCont text-right onlyOnMobile"><button class="btn btn-link closebtn" onclick="closeFilter()">&times;</button></p>
    		    	@if(count($products))
			    	<form class="needs-validation" novalidate>
			    		<fieldset class="form-group">
                        	<legend class="col-form-label col-12 pt-0">CATEGORIES</legend>
                        	<div class="col-12 p-0">
			    				@foreach ($categories as $category)
			    	    		    <a href="/shop/@php echo str_replace(' ','-',strtolower($category['category'])) @endphp" class="category-item" id="@php echo str_replace(' ','-',strtolower($category['category']))@endphp">{{$category->category}}</a>
									<ul class="subcategory-ul">
										@if($breadCrumbType == 2)
										    @if($category['category'] == $categoryInfo['category'])
										    @foreach ($subCategories->where('parentCategory',$categoryInfo['category']) as $subCategorie)
										    <li class="subcategory-li"><a href="/shop/@php echo str_replace(' ','-',strtolower($subCategorie['parentCategory'])) @endphp/@php echo str_replace(' ','-',strtolower($subCategorie['subCategory'])) @endphp" class="subcategory-item" id="{{str_replace(' ','-',strtolower($subCategorie['subCategory']))}}">{{$subCategorie['subCategory']}}</a></li>
										    @endforeach
										    @endif
										@elseif($breadCrumbType == 3)
										    @if($category['category'] == $subCategoryInfo['parentCategory'])
										    @foreach ($subCategories->where('parentCategory',$subCategoryInfo['parentCategory']) as $subCategorie)
										    <li class="subcategory-li"><a href="/shop/@php echo str_replace(' ','-',strtolower($subCategorie['parentCategory'])) @endphp/@php echo str_replace(' ','-',strtolower($subCategorie['subCategory'])) @endphp" class="subcategory-item" id="{{str_replace(' ','-',strtolower($subCategorie['subCategory']))}}">{{$subCategorie['subCategory']}}</a></li>
										    @endforeach
										    @endif
										@else
										@endif
									</ul>
			    	    		@endforeach
                        	</div>
                        </fieldset>
			    		<fieldset class="form-group">
                        	<legend class="col-form-label col-12 pt-0">HEALTH BENEFITS</legend>
                        	<div class="col-12 p-0">
			    	    		@foreach ($healthBenefits->unique() as $healthBenefit)
			    	    		    <div class="custom-control custom-radio">
                        		    	<input type="radio" class="custom-control-input" name="benefitRadios" id="<?php echo strtolower(str_replace(' ','-',$healthBenefit->product_healthBenefit)) ?>" value="<?php echo strtolower(str_replace(' ','-',$healthBenefit->product_healthBenefit)) ?>" onchange="applyFilter(this)">
                        		    	<label class="custom-control-label" for="<?php echo strtolower(str_replace(' ','-',$healthBenefit->product_healthBenefit)) ?>">{{$healthBenefit->product_healthBenefit}}</label>
                        		    </div>
			    	    		@endforeach
                        	</div>
                        </fieldset>
			    		<fieldset class="form-group">
                        	<legend class="col-form-label col-12 pt-0">PRICE</legend>
                        	<div class="col-12 p-0">
                        		@foreach ($prices as $price)
			    	    		    <div class="custom-control custom-radio">
                        		    	<input type="radio" class="custom-control-input" name="priceRadios" id="<?php echo strtolower(str_replace(' ','-',$price->price_filter)) ?>" value="<?php echo strtolower(str_replace(' ','-',$price->price_filter)) ?>" onchange="applyFilter(this)">
                        		    	<label class="custom-control-label" for="<?php echo strtolower(str_replace(' ','-',$price->price_filter)) ?>">@php $priceArray = explode(' ',$price->price_filter); if($priceArray[0] == 'Above' || $priceArray[0] == 'Below'){echo $priceArray[0].' - '.number_format($priceArray[1]);}else{echo number_format($priceArray[0]).' - '.number_format($priceArray[1]);} @endphp</label>
                        		    </div>
			    	    		@endforeach
                        	</div>
                        </fieldset>
			    	</form>
			    	@endif
					</td></tr></table>
    		    </div>
				<div class="container onlyOnMobile mob-filterSortCont">
				    <div class="row">
				    	<div class="col-6 p-0" style="border-right:1px solid black;">
				    	    <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SORT BY</button>
                    	    <div class="dropdown-menu dropdown-menu-right">
                    	    	<button class="dropdown-item" type="button" id="newest" value="newest" name="sortRadios" onclick="applySorting(this)">NEWEST</button>
                    	    	<button class="dropdown-item" type="button" id="price-lowest" value="price-lowest" name="sortRadios" onclick="applySorting(this)">PRICE LOWEST</button>
                    	    	<button class="dropdown-item" type="button" id="price-highest" value="price-highest" name="sortRadios" onclick="applySorting(this)">PRICE HIGHEST</button>
                    	    </div>
				    	</div>
				        <div class="col-6 p-0">
				    	    <button class="btn btn-link" onclick="showFilter()">CHOOSE FILTERS</button>
				    	</div>
				    </div>
				</div>
    		</div>
    		<div class="col-lg-10 col-md-9 product_display">
    			<div class="row ml-0">
					<div class="col-12 appliedFilters-cont">
				    	<p class="mb-0">
				    		@if($breadCrumbType >= 2)<button class="btn btn-primary appliedFilter" onclick="location.href='/shop';"><i class="fas fa-long-arrow-alt-left"></i> Back to Shop</button>@endif
							<button id="clearAllBtn" class="btn btn-primary btn-link clearAllBtn" onclick="clearAllFilter()">Remove Filters <i class="fas fa-times"></i></button>
				    	</p>
				    </div>
					@if(count($products))
					    @php $typeArray = explode(' - ',$type); @endphp
					    @foreach($products as $product)
						@php $maxQty = $product['product_quantity']; @endphp
					    <div class="col-lg-4 col-md-6 col-12 product-block">
					    	<a class="proLink" href="/shop/@php echo str_replace(' ','-',strtolower($product['product_category'])) @endphp/{{$product['product_url']}}">
					    	    <img class="proImage1" src="/storage/shop/@php echo str_replace(' ','-',str_replace('/','',$product['product_code'])) @endphp/@php echo str_replace('.jpg','-540px.jpg',$product['product_pic1']) @endphp" alt="{{$product->product_name}} | Vitality Club" title="{{$product->product_name}} | Vitality Club"/>
					    	    @if($product->product_pic2 != "null")
					    		<img class="proImage2" src="/storage/shop/@php echo str_replace(' ','-',str_replace('/','',$product['product_code'])) @endphp/@php echo str_replace('.jpg','-540px.jpg',$product['product_pic2']) @endphp" alt="{{$product->product_name}} | Vitality Club"/>
					    		@else
					    		<img class="proImage2" src="/storage/shop/@php echo str_replace(' ','-',str_replace('/','',$product['product_code'])) @endphp/@php echo str_replace('.jpg','-540px.jpg',$product['product_pic1']) @endphp" alt="{{$product->product_name}} | Vitality Club"/>
					    	    @endif
							</a>
					    	<div class="container product-info-block">
					    		<p id="proName{{$product['id']}}" class="mb-0 proName">{{$product['product_name']}}</p>
					    		@if($product->product_hasVariants == "No")<p class="mb-0 proPrice">@if($product['product_totalPrice'] > $product['product_price'])<span class="total-price">INR <?php echo number_format($product['product_totalPrice']) ?></span>@endif INR <?php echo number_format($product['product_price']) ?></p>@endif
								
								<input type="hidden" id="productCode{{$product['id']}}" name="productCode" value="{{$product['product_code']}}" />
								<input type="hidden" id="productVariant{{$product['id']}}" name="productVariant" value="{{$product['product_hasVariants']}}" />
								<input type="hidden" id="noVariantProQTY{{$product['id']}}" name="noVariantProQTY" value="{{$product['product_quantity']}}" />
								<input type="hidden" id="proCategory{{$product['id']}}" name="proCategory" value="{{$product['product_category']}}" />
								<input type="hidden" id="proBasePrice{{$product['id']}}" name="proBasePrice" value="{{$product['product_price']}}" />
								@if($product->product_hasVariants == "Yes")
								@php
									$proVariantsQtys = [];
								    for($i = 1; $i <=5; $i++){
										$variantQtyCounter = 'product_variant'.$i.'qty';
										array_push($proVariantsQtys, $product[$variantQtyCounter]);
										$maxQty = max($proVariantsQtys);
									}
								@endphp
								
								@if($maxQty > 0)
								<select id="proVariant{{$product['id']}}" class="custom-select variantDropdown" name="proVariant">
							        @for($i = 1; $i <=5; $i++)
							    		@php $variantCount = 'product_variant'.$i; $variantQtyCounter = 'product_variant'.$i.'qty'; $variantPrice = 'product_variant'.$i.'cost'; @endphp
							    		@if($product[$variantCount] != "" && $product[$variantQtyCounter] > 0)<option value="{{$i}}" data-qty="{{$product[$variantQtyCounter]}}">{{$product[$variantCount]}} - Rs.{{$product[$variantPrice]}}</option>@endif
							    	@endfor
							    </select>
								@endif
							    @endif
								
								@if(($product->product_hasVariants == "No" && $product['product_quantity'] <= 0) || ($maxQty <= 0))
									<button class="btn btn-primary addBtn disabled">Out of Stock</button>
								@else
								<div class="row qtyBoxRow">
									<div class="col-7">
									    <label class="sr-only" for="proQuantity{{$product['id']}}">Quantity</label>
										<div class="input-group mb-2">
										    <div class="input-group-prepend">
											    <div class="input-group-text">QTY</div>
											</div>
											<select id="proQuantity{{$product['id']}}" class="custom-select qtyBox" name="proQuantity">
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
								    <div class="col-5 pl-0 noMobPad">
									    <button class="btn btn-primary addBtn" onclick="checkStock('{{$product['id']}}');">ADD</button>
									</div>
								</div>
								<p id="stockWarning{{$product['id']}}" class="stockWarning mb-0"></p>
								@endif
					    	</div>
					    </div>
					    @endforeach
					@else
					    <p class="w-100 my-5 text-center" style="z-index:1">No products available</p>
					@endif
    			</div>
				<div class="container pagination-cont">
			        {{$products->links()}}
			    </div>
    		</div>
    	</div>
    </div>
</div>
<div class="container onlyOnMobile mob-filterSortCont mobActionsBtns-cont">
    <div class="row">
    	<div class="col-6 p-0" style="border-right:1px solid black;">
    	    <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SORT BY</button>
    	    <div class="dropdown-menu dropdown-menu-right">
    	    	<button class="dropdown-item" type="button" id="newest" value="newest" name="sortRadios" onclick="applySorting(this)">NEWEST</button>
    	    	<button class="dropdown-item" type="button" id="price-lowest" value="price-lowest" name="sortRadios" onclick="applySorting(this)">PRICE LOWEST</button>
    	    	<button class="dropdown-item" type="button" id="price-highest" value="price-highest" name="sortRadios" onclick="applySorting(this)">PRICE HIGHEST</button>
    	    </div>
    	</div>
        <div class="col-6 p-0">
    	    <button class="btn btn-link" onclick="showFilter()">CHOOSE FILTERS</button>
    	</div>
    </div>
	<div class="row" style="border:0">
	    @if($breadCrumbType >= 2)
			<button class="btn btn-primary appliedFilter custBtn" onclick="location.href='/shop';"><i class="fas fa-long-arrow-alt-left"></i> Back to Shop</button>
		@endif
			<button id="clearAllBtnMob" class="btn btn-primary btn-link clearAllBtn custBtn" onclick="clearAllFilter()">Remove Filters <i class="fas fa-times"></i></button>
    </div>
</div>
<div id="addToCartAlert" class="alert alert-success addToCartAlert fade" role="alert">
    <p class="text1 mb-0 text-center" id="addToCartMessage"></p>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
<script>
	var utmLink = window.location.href.split("?")[0];
	var currentURL = utmLink.split("/");
	var fullURL = "/";
	for(var i=3; i<(currentURL.length - 1); i++){
		fullURL += currentURL[i]+"/";
	}
	
	currentURL = currentURL[currentURL.length - 1];
	currentURL = currentURL.split("+");
	if(currentURL.length >= 1){
		document.getElementById("newest").classList.add("active");
		var i;
		for(i=0; i<currentURL.length; i++){
			var filterValue = currentURL[i];
			if(filterValue == "shop"){
			}
			else if(filterValue == "newest" || filterValue == "price-lowest" || filterValue == "price-highest"){
				document.getElementById("newest").classList.remove("active");
				document.getElementById(filterValue).classList.add("active");
			}
			else{
				document.getElementById(filterValue).checked = true;
				document.getElementById(filterValue).style.fontWeight = "900";
			}
		}
	}
	if(currentURL.length > 1){
		document.getElementById("clearAllBtn").style.display = "inline-block";
		document.getElementById("clearAllBtnMob").style.display = "inline-block";
	}
		
	function applyFilter(newFilter){
		var variantValue = newFilter.value;
		variantValue = variantValue.replace(" ","-");
		variantValue = variantValue.toLowerCase();
		var indexOfrecord = [];
		
		var allradios = document.getElementsByName(newFilter.name);
		for(i=0; i<allradios.length; i++){
			if(currentURL.includes(allradios[i].value)){
				var indeOf = currentURL.indexOf(allradios[i].value);
				currentURL[indeOf] = variantValue;
				indexOfrecord.push(1);
			}else{
				indexOfrecord.push(0);
			}
		}
		indexOfrecord.sort(function(a, b){return b-a});
		if(indexOfrecord[0] == 0){
			currentURL.push(variantValue);
		}
		
		for(var i=0; i<currentURL.length; i++){
			(i == 0) ? fullURL = fullURL+"" : fullURL = fullURL+"+";
			fullURL = fullURL+currentURL[i];
			window.location.assign(fullURL);
		}
	}
	
	function applySorting(newFilter){
		var variantValue = newFilter.value;

		if(currentURL.length > 1){
			var i;
			var allSorting = document.getElementsByName("sortRadios");
			var allSortingValues = [];
			for(i=0; i<allSorting.length; i++){
				var result = allSorting[i].value;
				allSortingValues.push(result); 
			}
			
			for(i=1; i<currentURL.length; i++){
				if(allSortingValues.includes(currentURL[i])){
					var newURL = window.location.href;
					newURL = newURL.replace(currentURL[i], variantValue);
					window.location.assign(newURL);
					break;
				}
				else{
					var newURL = window.location.href+"+"+variantValue;
					window.location.assign(newURL);
				}
			}
		}
		else{
			var newURL = window.location.href+"+"+variantValue;
			window.location.assign(newURL);
		}
	}
	
	function clearAllFilter(){
		var newURL = fullURL+currentURL[0];
		window.location.assign(newURL);
	}
	
	function showFilter(){
		document.getElementById("filters").style.width = "100%";
		$('body').css('overflow', 'hidden');
	}
	
	function closeFilter(){
		document.getElementById("filters").style.width = "0";
		$('body').css('overflow', 'auto');
	}
	
	var addToCartAlert = document.getElementById("addToCartAlert");
	
	function checkStock(proID){
		var proVariant = document.getElementById("productVariant"+proID).value;
		if(proVariant == "Yes"){
			var e = document.getElementById("proVariant"+proID);
			var option= e.options[e.selectedIndex];
			var text = e.options[e.selectedIndex].text;
			const myArr = text.split(" - ");
			var selectedVariant = myArr[0];
			var selectedVariantPrice = myArr[1].replace("Rs.","");
			var availableStock = parseInt(option.getAttribute("data-qty"));
		}else{
			var selectedVariant = "";
			var selectedVariantPrice = document.getElementById("proBasePrice"+proID).innerHTML;
			var availableStock = parseInt(document.getElementById("noVariantProQTY"+proID).value);
		}
		
		var proQty = parseInt(document.getElementById("proQuantity"+proID).value);
		
		if(proQty > availableStock){
			if(availableStock > 1){
				document.getElementById("stockWarning"+proID).innerHTML = "Only "+availableStock+" Pcs. In Stock";
			}else{
				document.getElementById("stockWarning"+proID).innerHTML = "Only "+availableStock+" Pc. In Stock";
			}
			document.getElementById("stockWarning"+proID).style.display = "block";
		}else{
			document.getElementById("stockWarning"+proID).style.display = "none";
			addToCart(proID, selectedVariant, selectedVariantPrice);
		}
	}
	
	function addToCart(proID, selectedVariant, selectedVariantPrice){
		var proCode = document.getElementById("productCode"+proID).value;
		var proVariant = document.getElementById("productVariant"+proID).value;
		var choosedVariant = 0;
		if(proVariant == "Yes"){
			choosedVariant = document.getElementById("proVariant"+proID).value;
		}
		var proQty = document.getElementById("proQuantity"+proID).value;
		
		$.ajax({
			url: '/cart',
			method: "POST",
			data: {_token: '{{ csrf_token() }}', productCode: proCode, productVariant: proVariant, proVariant: choosedVariant, proQuantity: proQty},
			success: function (response) {
				$('#addToCartMessage').html("Added to Cart");
				addToCartAlert.classList.toggle("show");
				$.ajax({
                    url: "/cart-count",
					type: "get",
                    success: function (count) {
						if(screen.width > 767){
							document.getElementById("cartCount").innerHTML = count;
						}else{
							document.getElementById("cartCountMob").innerHTML = count;
						}
                    }
                });
				
				setTimeout(function(){
					addToCartAlert.classList.toggle("show");
				},3000);
				
				if(screen.width > 767){
					$.ajax({
                        url: "/cart-update",
				    	type: "get",
                        success: function (output) {
				    		$('#cartProduct').html(output);
                        }
                    });
				}
				
				fbq('track', 'AddToCart');
				
				gtag('event', 'add_to_cart', {
					"items": [
					{
						"name": document.getElementById("proName"+proID).innerHTML,
						"category": document.getElementById("proCategory"+proID).innerHTML,
						"variant": selectedVariant,
						"quantity": document.getElementById("proQuantity"+proID).value,
						"price": selectedVariantPrice
					}
					]
				});
			}
		});
	}
</script>
@endsection