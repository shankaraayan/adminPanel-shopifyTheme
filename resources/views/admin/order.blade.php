@extends('admin.layout')
@section('title','Orders | Vitality Club')
@section('style','.admin-menu.orders i{color:black;}.admin-menu1.orders{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container mb-4">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/orders'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-1 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <h2 class="heading2">#{{$orders->id}}</h2>
				</td></tr></table>
			</div>
			<div class="col-md-4 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    @if($orders['payment_status'] == "Paid")
						<div class="block1"><i class="fas fa-circle"></i>{{$orders['payment_status']}}</div>
					@else
						<div class="block2"><i class="far fa-circle"></i>{{$orders['payment_status']}}</div>
					@endif
					@if($orders['order_status'] == "Fulfilled")
						<div class="block1"><i class="fas fa-circle"></i>{{$orders['order_status']}}</div>
					@elseif($orders['order_status'] == "Shipped")
						<div class="block3"><i class="far fa-circle"></i>{{$orders['order_status']}}</div>
					@elseif($orders['order_status'] == "Cancelled")
					    <div class="block5"><i class="fas fa-circle"></i>{{$orders['order_status']}}</div>
					@else
						<div class="block2"><i class="far fa-circle"></i>{{$orders['order_status']}}</div>
					@endif
				</td></tr></table>
			</div>
			<div class="col-md-6 text-right">
			    <p class="mb-0"><button class="btn btn-link" onclick="window.open('/admin/orders/{{$orders['id']}}/invoice')">Print Invoice</button></p>
			</div>
		</div>
		<div class="row">
		    <div class="col-md-1"></div>
		    <div class="col-md-11 pl-0">
			    <p class="subtext1 mb-0">@php echo date_format($orders['created_at'], "d F Y"); echo " at "; echo date_format($orders['created_at'], "h:i a"); @endphp</p>
			</div>
		</div>
	</div>
	<div class="container">
        <div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <h3 class="info-cont-heading">
					    @if($orders['order_status'] == "Fulfilled")
							<i class="far fa-check-circle tick"></i>{{$orders['order_status']}}
						@elseif($orders['order_status'] == "Shipped")
						    <i class="far fa-circle round"></i>{{$orders['order_status']}} (@php echo count($orders_items) @endphp)
						@elseif($orders['order_status'] == "Cancelled")
					        <i class="far fa-times-circle cross"></i>{{$orders['order_status']}}
					    @else
							<i class="far fa-circle untick"></i>{{$orders['order_status']}} (@php echo count($orders_items) @endphp)
						@endif
					</h3>
					@php $totalItems = 0 @endphp
					@foreach($orders_items as $orders_item)
    			        <div class="row m-0 mb-4">
    			        	<div class="col-6 pro-flex p-0">
								<div class="img-block" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',$orders_item['product_modelNo']) @endphp/{{$orders_item['product_pic1']}}');">
				                	<div class="item-count">{{$orders_item['product_quantity']}}</div>
				                </div>
    			        		<div class="text-block">
								    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
									    <p class="mb-0"><a href="/shop/@php echo str_replace(' ','-',strtolower($orders_item['product_category'])) @endphp/{{$orders_item['product_url']}}" target="_blank">{{$orders_item['product_name']}}</a></p>
										<p class="mb-0">SKU: @if($orders_item['product_isVariant'] == "No"){{$orders_item['product_modelNo']}} @else {{$orders_item['product_variationSKU']}} @endif</p>
										@if($orders_item['product_variationValue'] != '')
										    <p class="mb-0">{{$orders_item['product_variationType']}}: {{$orders_item['product_variationValue']}}</p>
										@endif
									</td></tr></table>
								</div>
    			        	</div>
							<div class="col-3 p-0">
							    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
								    <p class="mb-0">INR <?php echo number_format($orders_item['product_discountedPrice']) ?> x {{$orders_item['product_quantity']}}</p>
								</td></tr></table>
							</div>
							<div class="col-3 p-0">
							    <table style="width:100%;height:100%"><tr><td class="text-right align-middle" style="width:100%;height:100%">
								    <p class="mb-0">INR <?php echo number_format($orders_item['product_discountedPrice'] * $orders_item['product_quantity']) ?></p>
								</td></tr></table>
							</div>
    			        </div>
						@php $totalItems += $orders_item['product_quantity'] @endphp
    			    @endforeach
					@if($orders['order_status'] == "Shipped" || $orders['order_status'] == "Fulfilled")
						<div class="row m-0 pt-3" style="border-top:1px solid #dddddd;">
					        <div class="col-6">
							    <p class="info-cont-subheading mb-1">Shipping carrier</p>
								<p>{{$orders['shipping_carrier']}}</p>
							</div>
					        <div class="col-6">
							    <p class="info-cont-subheading mb-1">Tracking number</p>
								<p>{{$orders['shipping_tracking_number']}}</p>
							</div>
					        <div class="col-12">
							    <p class="info-cont-subheading mb-1">Tracking link</p>
								<p><a href="{{$orders['shipping_tracking_link']}}" target="_blank">{{$orders['shipping_tracking_link']}}</a></p>
							</div>
					    </div>
					@endif
					<div class="text-right pt-3 mb-0" style="border-top:1px solid #dddddd;">
					    <div class="dropdown mr-3" style="display:inline-block;">
                        	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</button>
                        	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        		<a class="dropdown-item @if($orders['order_status'] != 'Reviewed') disabled @endif" href="/admin/orders/{{$orders->id}}/cancelled">Cancel the order</a>
                        	</div>
                        </div>
						@if($orders['order_status'] == "Reviewed")
							<button class="btn btn-primary" data-toggle="modal" data-target="#markAsShippedModal" data-whatever="#{{$orders->id}}">Mark as shipped</button>
						@elseif($orders['order_status'] == "Shipped")
						    <button class="btn btn-primary" onclick="window.location.href='/admin/orders/{{$orders->id}}/fulfilled'">Mark as fulfilled</button>
						@else
							<button class="btn btn-primary" disabled>Fulfilled</button>
						@endif
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">@if($orders['payment_status'] == "Paid")<i class="far fa-check-circle tick"></i>@endif{{$orders['payment_status']}}</h3>
					<div class="row m-0 mb-2">
					    <div class="col-3 p-0"><p class="mb-0">Subtotal</p></div>
					    <div class="col-3 p-0"><p class="mb-0">{{$totalItems}} item</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR @php echo number_format($orders['subtotal'],2) @endphp</p></div>
					</div>
					@if($orders['discount'] > 0)
					<div class="row m-0 mb-2">
					    <div class="col-3 p-0"><p class="mb-0">Discount</p></div>
					    <div class="col-3 p-0"><p class="mb-0">@if($orders['discount_type'] == "Percentage") {{$orders['discount_value']}}% @else INR {{$orders['discount_value']}} @endif - {{$orders['discount_name']}} </p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">- INR @php echo number_format($orders['discount'],2) @endphp</p></div>
					</div>
					@endif
					<div class="row m-0 mb-2">
					    <div class="col-3 p-0"><p class="mb-0">Shipping</p></div>
					    <div class="col-3 p-0"><p class="mb-0">{{$orders['shipping_name']}}</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR @php echo number_format($orders['shipping_cost'], 2) @endphp</p></div>
					</div>
					@if($orders['cod_charges'] > 0)
					<div class="row m-0 mb-2">
					    <div class="col-6 p-0"><p class="mb-0">COD charges</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR @php echo number_format($orders['cod_charges'], 2) @endphp</p></div>
					</div>
					@endif
					<div class="row m-0 mb-2">
					    <div class="col-3 p-0"><p class="mb-0">Taxes</p></div>
					    <div class="col-3 p-0"><p class="mb-0">@if($orders['tax'] == 0)Inclusive of all taxes @endif</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR @php echo number_format($orders['tax'],2) @endphp</p></div>
					</div>
					<div class="row m-0 mb-2 pb-2">
					    <div class="col-6 p-0"><p class="mb-0"><b>Total</b></p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0"><b>INR @php echo number_format($orders['total_amount'],2) @endphp</b></p></div>
					</div>
					<div class="row pt-3 pb-2 m-0" style="border-top:1px solid #dddddd;">
					    <div class="col-6 p-0"><p class="mb-0">Paid by customer</p></div>
					    <div class="col-6 p-0 text-right"><p class="mb-0">INR @php echo number_format($orders['total_amount'],2) @endphp</p></div>
					</div>
				</div>
			</div>
		    <div class="col-md-4">
			    <div class="container info-cont">
				    <h3 class="info-cont-heading">Customer</h3>
					<p class="mb-0">{{$orders_customers['first_name']}} {{$orders_customers['last_name']}}</p>
					<div class="info-cont-divider"></div>
					<h3 class="info-cont-subheading">Contact Information</h3>
					<p class="mb-0">{{$orders_customers['email']}}</p>
					<div class="info-cont-divider"></div>
					<div class="row">
					    <div class="col-9">
						    <h3 class="info-cont-subheading">Shipping Information</h3>
						</div>
						<div class="col-3 text-right">
						    @if($orders['order_status'] == "Reviewed")
								<a data-toggle="modal" data-target="#shippingModal" style="cursor:pointer;color:blue;text-decoration:underline;">Edit</a>
							@endif
						</div>
					</div>
					<p class="mb-0">{{$orders_customers['first_name']}} {{$orders_customers['last_name']}}</p>
					<p class="mb-0">{{$orders_customers['shipping_address']}}</p>
					<p class="mb-0">{{$orders_customers['shipping_city']}}, {{$orders_customers['shipping_state']}} - {{$orders_customers['shipping_pincode']}}</p>
					<p class="mb-0">{{$orders_customers['shipping_country']}}</p>
					<p class="mb-0">{{$orders_customers['phone']}}</p>
					<div class="info-cont-divider"></div>
					<div class="row">
					    <div class="col-9">
						    <h3 class="info-cont-subheading">Billing Information</h3>
						</div>
						<div class="col-3 text-right">
						    @if($orders['order_status'] == "Reviewed")
								<a data-toggle="modal" data-target="#billingModal" style="cursor:pointer;color:blue;text-decoration:underline;">Edit</a>
							@endif
						</div>
					</div>
					@if($orders_customers['billing_status'] == "Yes")
						<p class="mb-0">Same as Shipping address</p>
					@else
					    <p class="mb-0">{{$orders_customers['billing_first_name']}} {{$orders_customers['billing_last_name']}}</p>
					    <p class="mb-0">{{$orders_customers['billing_address']}}</p>
					    <p class="mb-0">{{$orders_customers['billing_city']}}, {{$orders_customers['billing_state']}} - {{$orders_customers['billing_pincode']}}</p>
					    <p class="mb-0">{{$orders_customers['billing_country']}}</p>
					    <p class="mb-0">{{$orders_customers['billing_phone']}}</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="markAsShippedModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Mark as fulfilled</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			    <form class="needs-validation" action="/admin/orders/{{$orders->id}}/shipped" method="POST" name="shipped" onsubmit="return validateForm()" novalidate>
				@csrf
				<input type="hidden" name="status" value="Shipped"/>
				<input type="hidden" name="billingStatus" value="{{$orders_customers['billing_status']}}"/>
				    <div class="form-row">
					    <div class="col-md-6 mb-3">
						    <label for="validationCustom01">Shipping carrier</label>
							<input type="text" class="form-control" id="validationCustom01" name="carrier" required>
						</div>
					    <div class="col-md-6 mb-3">
						    <label for="validationCustom02">Tracking number</label>
							<input type="text" class="form-control" id="validationCustom02" name="trackingNumber" required>
						</div>
					    <div class="col-md-12 mb-4">
						    <label for="validationCustom03">Tracking link</label>
							<textarea class="form-control" id="validationCustom03" name="trackingLink" required></textarea>
						</div>
					</div>
					<p class="text-right"><button type="submit" class="btn btn-primary">Save</button></p>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="shippingModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Shipping information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			    <form class="needs-validation" action="/admin/orders/{{$orders->id}}/update" method="POST" name="shipped" novalidate>
				@csrf
				    <input type="hidden" name="updateType" value="Shipping" />
					<input type="hidden" name="billingStatus" value="{{$orders_customers['billing_status']}}"/>
					<div class="form-row">
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control" id="validationCustom01" name="firstname" placeholder="First Name" value="{{$orders_customers['first_name']}}" required />
                		</div>
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control" id="validationCustom02" name="lastname" placeholder="Last Name" value="{{$orders_customers['last_name']}}" required />
                		</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="text" class="form-control" id="validationCustom03" name="address" placeholder="Address" value="{{$orders_customers['shipping_address']}}" required />
    					</div>
                		<div class="col-md-12 mb-3">
                			<input type="text" class="form-control" id="validationCustom04" name="city" placeholder="City" value="{{$orders_customers['shipping_city']}}" required />
                		</div>
                		<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom05" name="country" required>
                				<option disabled value="">Country/Region</option>
                				<option value="India" selected>India</option>
                			</select>
                		</div>
    					<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom06" name="state" required>
                				<option selected disabled value="">State</option>
                				@foreach ($shippings->unique('state') as $shipping)
								    <option value="{{$shipping->state}}" @if($orders_customers['shipping_state'] == $shipping->state) selected @endif>{{$shipping->state}}</option>
								@endforeach
                			</select>
                		</div>
                		<div class="col-md-4 mb-3">
                			<input type="number" class="form-control" id="validationCustom07" name="pincode" placeholder="Pincode" value="{{$orders_customers['shipping_pincode']}}" required />
                		</div>
                	</div>
    				<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="number" class="form-control" id="validationCustom08" name="phone" placeholder="Phone" value="{{$orders_customers['phone']}}" required />
    					</div>
    				</div>
					<p class="text-right"><button type="submit" class="btn btn-primary">Save</button></p>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="billingModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Billing information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			    <form class="needs-validation" action="/admin/orders/{{$orders->id}}/update" method="POST" name="shipped" novalidate>
				@csrf
				    <input type="hidden" name="updateType" value="Billing" />
					<input type="hidden" name="billingStatus" value="{{$orders_customers['billing_status']}}"/>
				    <div class="form-row">
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control" id="validationCustom01" name="firstname" placeholder="First Name" value="{{$orders_customers['billing_first_name']}}" required />
                		</div>
                		<div class="col-md-6 mb-3">
                			<input type="text" class="form-control" id="validationCustom02" name="lastname" placeholder="Last Name" value="{{$orders_customers['billing_last_name']}}" required />
                		</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="text" class="form-control" id="validationCustom03" name="address" placeholder="Address" value="{{$orders_customers['billing_address']}}" required />
    					</div>
                		<div class="col-md-12 mb-3">
                			<input type="text" class="form-control" id="validationCustom04" name="city" placeholder="City" value="{{$orders_customers['billing_city']}}" required />
                		</div>
                		<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom05" name="country" required>
                				<option disabled value="">Country/Region</option>
                				<option value="India" selected>India</option>
                			</select>
                		</div>
    					<div class="col-md-4 mb-3">
                			<select class="custom-select" id="validationCustom06" name="state" required>
                				<option selected disabled value="">State</option>
                				@foreach ($shippings->unique('state') as $shipping)
								    <option value="{{$shipping->state}}" @if($orders_customers['billing_state'] == $shipping->state) selected @endif>{{$shipping->state}}</option>
								@endforeach
                			</select>
                		</div>
                		<div class="col-md-4 mb-3">
                			<input type="number" class="form-control" id="validationCustom07" name="pincode" placeholder="Pincode" value="{{$orders_customers['billing_pincode']}}" required />
                		</div>
                	</div>
    				<div class="form-row">
                		<div class="col-md-12 mb-3">
    					    <input type="number" class="form-control" id="validationCustom08" name="phone" placeholder="Phone" value="{{$orders_customers['billing_phone']}}" required />
    					</div>
    				</div>
					<p class="text-right"><button type="submit" class="btn btn-primary">Save</button></p>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#ordersCollapse').collapse('show');
	
    $('#markAsShippedModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-title').text(recipient + ' mark as shipped')
    });
	
	function validateForm(){
        var a = document.forms["shipped"]["carrier"].value.trim();
        var b = document.forms["shipped"]["trackingNumber"].value.trim();
        var c = document.forms["shipped"]["trackingLink"].value.trim();
        if (a == "") {
          document.getElementById("validationCustom01").style.border = "1px solid red";
          return false;
        }
        else if (b == "") {
			document.getElementById("validationCustom01").style.border = "1px solid #ced4da";
			document.getElementById("validationCustom02").style.border = "1px solid red";
			return false;
        }
        else if (c == "") {
			document.getElementById("validationCustom02").style.border = "1px solid #ced4da";
			document.getElementById("validationCustom03").style.border = "1px solid red";
			return false;
        }
        else {
        }
	}
	
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</script>
@endsection