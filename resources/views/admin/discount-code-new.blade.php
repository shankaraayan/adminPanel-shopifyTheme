@extends('admin.layout')
@section('title','Discounts | Vitality Club')
@section('style','.admin-menu.discounts{background-color:#eaeaea;border-left:5px solid black;color:black;}#endDate{display:none;}')
@section('content')
<div class="container">
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/discounts'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-9 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <div class="heading2">Create discount code</div>
				</td></tr></table>
			</div>
		</div>
	</div>
	@if (session('status'))
	<div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
        </div>
    </div>
	@endif
	<div class="container">
        <form class="needs-validation" action="/admin/discounts/code/new" method="POST" onsubmit="return validateForm()" novalidate>
		@csrf
		    <div class="row">
		        <div class="col-md-8">
		    	    <div class="container info-cont">
		    		    <div class="row pb-0">
						    <div class="col-6">
							    <h3 class="info-cont-heading">Discount code</h3>
							</div>
							<div class="col-6 text-right">
							    <a class="" style="cursor:pointer"  onclick="generateCode();">Generate code</a>
							</div>
						</div>
		    		    <div class="form-row">
		    			    <div class="col-12">
		    					<input type="text" class="form-control @error('discountCode') is-invalid @enderror mb-2" id="validationCustom01" name="discountCode" placeholder="e.g. MYFIRST10" value="{{old('discountCode')}}" autofocus required>
		    					<label for="validationCustom01">Customers will enter this discount code at checkout.</label>
								@error('discountCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		    				</div>
		    			</div>
		    		</div>
		    		<div class="container info-cont">
		    		    <h3 class="info-cont-heading">Types</h3>
		    			<div class="form-row">
		    			    <div class="custom-control custom-radio">
		    				    <input type="radio" id="validationCustom02" name="discountType" class="custom-control-input" value="Percentage" checked>
		    					<label class="custom-control-label" for="validationCustom02">Percentage</label>
		    				</div>
		    			</div>
		    		</div>
		    		<div class="container info-cont">
		    		    <h3 class="info-cont-heading">Value</h3>
		    			<div class="form-row">
                            <div class="col-4">
                                <label for="validationCustom03">Discount value</label>
		    					<input type="number" class="form-control percentageInput" id="validationCustom03" name="discountValue" value="{{old('discountValue')}}" required>
		    					<i class="fas fa-percent percentIcon"></i>
                            </div>
		    			</div>
		    			<div class="info-cont-divider"></div>
		    			<h3 class="info-cont-subheading">Minimum requirements</h3>
		    			<div class="form-row">
		    			    <div class="custom-control custom-radio">
		    			        <input type="radio" id="validationCustom04" name="discountMinPurchaseAmt" class="custom-control-input" value="0" checked>
		    			    	<label class="custom-control-label" for="validationCustom04">None</label>
		    			    </div>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-md-4">
		    		<div class="container info-cont">
		    		    <h3 class="info-cont-heading">Active dates</h3>
		    			<div class="form-row">
		    			    <input type="hidden" name="date_format" value="d-m-Y" />
		    			    <div class="col-12 mb-3">
		    			    	<label for="validationCustom06">Start date</label>
		    					<input type="button" value="<?php echo date('Y-m-d');?>" id="datepicker1" class="dateBtn">
		    			    	<input type="hidden" value="" name="discountStartDate" id="widget_date" required />
		    			    	<i class="far fa-calendar-alt calenderIcon"></i>
		    			    </div>
		    			    <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                	<input type="checkbox" class="custom-control-input" id="setEndDate" name="discountSetDateCheckbox" onclick="showSetDate(this)">
                                	<label class="custom-control-label" for="setEndDate">Set end date</label>
                                </div>
							</div>
		    			    <div id="endDate" class="col-12 mt-3">
		    			    	<label for="validationCustom07">End date</label>
		    					<input type="button" value="<?php $date = new DateTime();$date->add(new DateInterval('P1D'));echo $date->format('Y-m-d');?>" id="datepicker2" class="dateBtn">
		    			    	<input type="hidden" value="" name="discountEndDate" id="widget_date_to" required />
		    			    	<i class="far fa-calendar-alt calenderIcon"></i>
		    			    </div>
		    			</div>
		    		</div>
		    		<div class="container info-cont">
		    		    <h3 class="info-cont-heading">Usage limits</h3>
					    <div class="custom-control custom-checkbox">
						    <input type="checkbox" class="custom-control-input" id="validationCustom08" name="discountOncePerUser" value="Yes">
							<label class="custom-control-label" for="validationCustom08">Limit to one use per customer</label>
						</div>
					</div>
		    		<div class="container info-cont info-cont1">
		    		    <h3 class="info-cont-subheading">Can't combine with others automatic discounts</h3>
		    			<p class="mb-0">Customers won’t be able to enter a code if an automatic discount is already applied at checkout.</p>
		    		</div>
		    	</div>
		    </div>
		    <div class="container proButtons">
		        <div class="row">
		    	    <div class="col-12 text-right p-0">
		    	        <button class="btn btn-primary" type="submit">Save</button>
		    	    </div>
		    	</div>
		    </div>
		</form>
	</div>
</div>
@endsection
@section('scriptContent')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">
<script src="{{ asset('js/jquery-ui.min.js')}}"></script>
<script>
	$('#discountsCollapse').collapse('show');
	
	$(function(){
	    $("#datepicker2").datepicker({ minDate: +1, maxDate: "+1Y", dateFormat: "yy-mm-dd" });
	});
		
	$("#datepicker1").datepicker({ minDate: 0, maxDate: "+1Y", dateFormat: 'yy-mm-dd',
	    onSelect: function(){
			var newDate = $("#datepicker1").datepicker("getDate");
			newDate.setDate(newDate.getDate() + 1);
	        $('#datepicker2').datepicker('option', 'minDate', newDate);
	    }
	}).datepicker("setDate", new Date());
		
	function validateForm() {
	  document.getElementById("widget_date").value = document.getElementById("datepicker1").value;
	  document.getElementById("widget_date_to").value = document.getElementById("datepicker2").value;
	}
	
	function showSetDate(setEndDateCheckbox){
		var EndDateForm = document.getElementById("endDate");
        EndDateForm.style.display = setEndDateCheckbox.checked ? "block" : "none";
	}
	
	function generateCode(){
		$.ajax({
            url: '/admin/discounts/generate-code',
            method: "GET",
            data: {_token: '{{ csrf_token() }}'},
            success: function (data) {
                $('#validationCustom01').val(data);
            }
        });
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
@endsection