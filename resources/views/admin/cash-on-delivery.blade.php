@extends('admin.layout')
@section('title','Settings | Vitality Club')
@section('style','.admin-menu.settings{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container mb-4">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/settings/payments'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-5 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <h2 class="heading2">Cash on Delivery</h2>
				</td></tr></table>
			</div>
			<div class="col-md-6 text-right">
			    <button class="btn btn-primary" data-toggle="modal" data-target="#shippingModal">Add new</button>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Available in</h3>
					<table class="table">
                	    <thead>
                	    	<tr>
                	    		<th scope="col">Country</th>
                	    		<th scope="col">State</th>
                	    		<th scope="col" class="text-center">Payment mode</th>
                	    		<th scope="col" class="text-center">Condition</th>
                	    		<th scope="col" class="text-center"></th>
                	    	</tr>
                	    </thead>
                	    <tbody>
						    @foreach($payments as $payment)
							    <tr class="table-row1">
								    <th scope="row" class="align-middle">{{$payment['country']}}</th>
								    <th class="align-middle">{{$payment['state']}}</th>
								    <th class="align-middle text-center">{{$payment['payment_mode']}}</th>
								    <th class="align-middle text-center">@if($payment['min_order_value'] == 0) Below INR {{$payment['max_order_value']}} @elseif($payment['max_order_value'] == 0) Above INR {{$payment['min_order_value']}} @else INR {{$payment['min_order_value']}} - INR {{$payment['max_order_value']}} @endif</th>
									<th class="align-middle text-right">
									    <button class="btn btn-secondary mr-3" onclick="updatepayment({{$payment['id']}}, '{{$payment['state']}}', {{$payment['min_order_value']}}, {{$payment['max_order_value']}});" >Edit</button>
										<button class="btn btn-secondary" onclick="deletepayment({{$payment['id']}})">Delete</button>
									</th>
								</tr>
							@endforeach
                	    </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="shippingModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Add new location for COD</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			    <form class="needs-validation" action="/admin/settings/payments/cash-on-delivery/new" method="POST" novalidate>
				@csrf
				    <input type="hidden" name="country" value="India" />
				    <input type="hidden" name="mode" value="COD" />
					
					<div class="form-row mb-3">
                		<div class="col-md-12 mb-3">
                			<label for="validationCustom01">State</label>
							<select class="custom-select" id="validationCustom01" name="state" required>
            			    	<option selected disabled value="">Choose state</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
            			    </select>
                		</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-6 mb-3">
                			<label for="validationCustom02">Min. order value</label>
							<input type="number" class="form-control" id="validationCustom02" name="min_order_value" required />
                		</div>
                		<div class="col-md-6 mb-3">
                			<label for="validationCustom03">Max. order value</label>
							<input type="number" class="form-control" id="validationCustom03" name="max_order_value" required />
                		</div>
                	</div>
					<p class="text-right"><button type="submit" class="btn btn-primary">Save</button></p>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="shippingUpdateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Update details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			    <form class="needs-validation" action="/admin/settings/payments/cash-on-delivery/update" method="POST" novalidate>
				@csrf
				    <input type="hidden" name="id" id="validationCustom101" />
				    <input type="hidden" name="country" value="India" />
				    <input type="hidden" name="mode" value="COD" />
					
					<div class="form-row mb-3">
                		<div class="col-md-12 mb-3">
                			<label for="validationCustom102">State</label>
							<select class="custom-select" id="validationCustom102" name="state" required>
            			    	<option selected disabled value="">Choose state</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
            			    </select>
                		</div>
                	</div>
                	<div class="form-row">
                		<div class="col-md-6 mb-3">
                			<label for="validationCustom103">Min. order value</label>
							<input type="number" class="form-control" id="validationCustom103" name="min_order_value" required />
                		</div>
                		<div class="col-md-6 mb-3">
                			<label for="validationCustom104">Max. order value</label>
							<input type="number" class="form-control" id="validationCustom104" name="max_order_value" required />
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
	function updatepayment(id, state, orderMinValue, orderMaxValue){
		document.getElementById("validationCustom101").value = id;
		document.getElementById("validationCustom102").value = state;
		document.getElementById("validationCustom103").value = orderMinValue;
		document.getElementById("validationCustom104").value = orderMaxValue;
		
		$('#shippingUpdateModal').modal('show');
	}
	
	function deletepayment(id){
		$.ajax({
            url: '/admin/settings/payments/cash-on-delivery/delete',
            method: "DELETE",
            data: {_token: '{{ csrf_token() }}', id: id},
            success: function (response) {
                window.location.reload();
            }
        });
	}
	
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
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
@endsection