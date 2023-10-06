@extends('layouts.app')
@section('title','Your Shopping Cart | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','https://www.vitalityclub.in/cart')
@section('style','.table thead th{border:none;} .table td{border:none;}#mainContent{background-color:#f5f1ec;}.ecom-actions .cartdropbtn:hover .dropdown-menu{display:none;}')
@section('content')
<div class="container-fluid bckgd-color1">
    <div class="container containerLimit cart-summary-cont">
        @if(count((array) session('cart')) > 0)
    	<p class="cart-heading">Shopping Cart</p>
    	<div class="row m-0">
    		<div class="col-xl-9 col-lg-8 pl-0 left-cont">
    			<table id="cart" class="table mb-lg-5 mb-4">
    				<thead>
    					<tr>
    						<th class="cart-proLabel" style="width:45%">Product</th>
    						<th class="cart-proLabel text-center notOnMobile" style="width:20%">Unit Price</th>
    						<th class="cart-proLabel text-center" style="width:15%">Quantity</th>
    						<th class="cart-proLabel text-center notOnIpad" style="width:20%">Total</th>
    					</tr>
    				</thead>
    				<tbody class="align-middle" style="border-top:1px solid #c9c9c9;">
    					<?php $total=0 ?>
    					@if(session('cart'))
    					    @foreach(session('cart') as $products => $product)
    					        <?php $total += $product['price'] * $product['quantity'] ?>
    					        <tr style="border-bottom:1px solid #c9c9c9;">
    					        	<td class="align-middle" data-th="Product">
    					        		<div class="row">
    					        			<div class="col-3">
        			        			        <div class="img-block" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',strtoupper($product['code'])) @endphp/{{$product['image']}}');"></div>
    					        			</div>
    					        			<div class="col-9">
    					        				<p class="productName"><a href="/shop/<?php echo strtolower(str_replace(' ', '-', $product['category'])); ?>/{{$product['url']}}">{{$product['name']}}</a></p>
    					        				@if($product['variantValue'] != "")
    											    <p class="mb-0 productColor">{{$product['variantType']}}: {{$product['variantValue']}}</p>
    											@endif
    					        				<p class="mb-0"><button class="btn productRemove" onclick="updateModalContent('{{$product['id']}}','{{$product['category']}}','{{$product['code']}}','{{$product['image']}}','{{$product['name']}}')">REMOVE ITEM</button></p>
												<p class="productPrice mb-0 onlyOnMobile">Unit Price: INR <?php echo number_format($product['price']) ?></p>
												<p class="stock-warning mb-0">{{$product['error']}}</p>
    					        			</div>
    					        		</div>
    					        	</td>
    					        	<td class="align-middle text-center notOnMobile" data-th="Unit Price"><p class="productPrice mb-0">INR <?php echo number_format($product['price']) ?></p></td>
    					        	<td class="align-middle" data-th="Quantity">
    									<div class="quantityBox" @if($product['error'] !="")style="border:1px solid red" @endif>
    									    <button class="btn quantityMinus" onclick="updateQuantity('{{$product['id']}}',{{$product['quantity']}},'minus')">-</button>
    									    <button class="btn quantityNumber" disabled>{{$product['quantity']}}</button>
    									    <button class="btn quantityPlus" onclick="updateQuantity('{{$product['id']}}',{{$product['quantity']}},'plus')">+</button>
    									</div>
    					        	</td>
									<td class="align-middle text-center notOnIpad" data-th="Total"><p class="productPrice mb-0">INR <?php echo number_format($product['price'] * $product['quantity']) ?></p></td>
    					        </tr>
    					    @endforeach
    					@endif
    				</tbody>
    			</table>
    			<p><a class="continueShopping-btn" href="/shop">Continue Shopping</a></p>
    		</div>
    		<div class="col-xl-3 col-lg-4 checkBtn-cont pr-0 right-cont">
    			@if(count((array) session('autoDiscount')) > 0)
			    <p class="checkout-subtotal">Subtotal: INR <?php echo number_format($total) ?></p>
			    @if(Session::get('autoDiscount')['discountType'] == "Percentage")
			    <p class="checkout-subtotal">Discount: - INR <?php echo number_format($total * (Session::get('autoDiscount')['discountValue'] / 100)) ?></p>
			    @else
			    <p class="checkout-subtotal">Discount: - INR <?php echo number_format(Session::get('autoDiscount')['discountValue']) ?></p>
			    @endif
			    <p>({{Session::get('autoDiscount')['discountTitle']}})</p>
			    @else
			    <p class="checkout-subtotal">Subtotal: INR <?php echo number_format($total) ?></p>
			    @endif
    			<p class="text-center"><button class="btn checkout-button" onclick="location.href='{{ route('checkout.check-stock') }}'">Check Out</button></p>
    			<p class="beforeTax">before taxes and shipping costs</p>
				
				<p class="onlyOnMobile text-center mb-0"><a class="continueShopping-btn" href="/shop">Continue Shopping</a></p>
    		</div>
    	</div>
    	@else
        <h1 class="heading2 text-center">Shopping Cart</h1>
    	<p class="text-center text1">Your shopping cart is currently empty.</p>
    	<p class="text-center mt-lg-5 mt-4">
    	    <button class="btn continueShopping-button" onclick="location.href='/shop'">Continue Shopping</button>
    	</p>
    	@endif
    </div>
</div>
<div class="modal fade" id="productRemovefromCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header" style="border:none;">
				<h6 class="modal-title" id="exampleModalLabel">You really want to remove this product? :(</h6>
			</div>
			<div class="modal-body text-center">
			    <img id="ModalProImage" class="modal-ProImage" src="" />
				<p id="ModalProName" class="text-center modal-ProName"></p>
			</div>
			<div class="modal-footer text-center" style="border:none;">
				<button type="button" class="btn modalYes" onclick="yesRemove()">Yes</button>
				<button type="button" class="btn modalNo" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
<script type="text/javascript">
    var proId = "";
    function updateModalContent(id, category, code, image, name){
		proId = id;
		code = code.toUpperCase();
		code = code.replaceAll(" ","-");
		var folder = "shop";
		
		document.getElementById("ModalProImage").src = "/storage/"+folder+"/"+code+"/"+image;
		document.getElementById("ModalProName").innerHTML = name;
		
		$('#productRemovefromCart').modal('show');
	}
	
	function yesRemove(){
		$.ajax({
            url: 'cart/'+proId,
            method: "DELETE",
            data: {_token: '{{ csrf_token() }}'},
            success: function (response) {
                window.location.reload();
            }
        });
	}
	
	function updateQuantity(id, quantity, operator){
		var productId = id;
		
		if(operator == "plus"){
			quantity+=1;
			$.ajax({
               url: 'cart/'+productId,
		    	method: "PATCH",
		    	data: {_token: '{{ csrf_token() }}', quantity: quantity},
               success: function (response) {
                   window.location.reload();
               }
            });
		}
		else if(operator == "minus"){
			if(quantity > 1){
				quantity-=1;
			    $.ajax({
                   url: 'cart/'+productId,
		        	method: "PATCH",
		        	data: {_token: '{{ csrf_token() }}', quantity: quantity},
                   success: function (response) {
                       window.location.reload();
                   }
                });
			}
			else{
				$.ajax({
                    url: 'cart/'+productId,
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        window.location.reload();
                    }
                });
			}
		}
		else{
		}
	}
</script>
@endsection