@extends('admin.layout')
@section('title','Discounts | Vitality Club')
@section('style','.admin-menu.discounts{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    @if($discount['discountEndDate'] != null)
    	<style>#endDate{display:block;}</style>
    @else
    	<style>#endDate{display:none;}</style>
    @endif
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/discounts'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-11 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <div class="heading2">{{$discount['discountTitle']}}</div>
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
        <form class="needs-validation" action="/admin/discounts/automatic/{{$discount['id']}}" method="POST" onsubmit="return validateForm()" novalidate>
		@csrf
		    <div class="row">
		        <div class="col-md-8">
		    	    <div class="container info-cont">
		    		    <h3 class="info-cont-heading">Automatic discount title</h3>
		    		    <div class="form-row">
		    			    <div class="col-12">
		    					<input type="text" class="form-control mb-2" id="validationCustom01" name="discountTitle" placeholder="e.g. New year promotion" value="{{$discount['discountTitle']}}" required>
		    					<label for="validationCustom01">Customers will see this in cart and at checkout.</label>
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
		    					<input type="number" class="form-control percentageInput" id="validationCustom03" name="discountValue" value="{{$discount['discountValue']}}" required>
		    					<i class="fas fa-percent percentIcon"></i>
                            </div>
		    			</div>
		    			<div class="info-cont-divider"></div>
		    			<h3 class="info-cont-subheading">Applies to</h3>
		    			<div class="form-row">
		    			    <div class="custom-control custom-radio">
		    			        <input type="radio" id="validationCustom04" name="discountAppliesTo" class="custom-control-input" value="All products" checked>
		    			    	<label class="custom-control-label" for="validationCustom04">All products</label>
		    			    </div>
		    			</div>
		    		</div>
		    		<div class="container info-cont">
		    		    <h3 class="info-cont-heading">Minimum requirements</h3>
		    			<div class="form-row">
                            <div class="col-12">
		    				    <label for="validationCustom05">Minimum purchase amount (INR)</label>
		    				</div>
                            <div class="col-4">
		    					<input type="number" class="form-control priceInput" id="validationCustom05" name="discountMinPurchaseAmt" value="{{$discount['discountMinPurchaseAmt']}}" required>
		    					<i class="fas fa-rupee-sign rupeeIcon"></i>
                            </div>
		    				<div class="col-12 mt-1">
		    				    <p class="mb-0">Applies to all products.</p>
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
		    					<input type="button" value="@php $startDate=date_create($discount['discountStartDate']); echo date_format($startDate, 'Y-m-d'); @endphp" id="datepicker1" class="dateBtn" />
		    			    	<input type="hidden" value="" name="discountStartDate" id="widget_date" required />
		    			    	<i class="far fa-calendar-alt calenderIcon"></i>
		    			    </div>
		    			    <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                	<input type="checkbox" class="custom-control-input" id="setEndDate" name="discountSetDateCheckbox" onclick="showSetDate(this)" @if($discount['discountEndDate'] != null) checked @endif>
                                	<label class="custom-control-label" for="setEndDate">Set end date</label>
                                </div>
							</div>
		    			    <div id="endDate" class="col-12 mt-3">
		    			    	<label for="validationCustom07">End date</label>
		    					<input type="button" value="@php $endDate=date_create($discount['discountEndDate']); echo date_format($endDate, 'Y-m-d'); @endphp" id="datepicker2" class="dateBtn">
		    			    	<input type="hidden" value="" name="discountEndDate" id="widget_date_to" required />
		    			    	<i class="far fa-calendar-alt calenderIcon"></i>
		    			    </div>
		    			</div>
		    		</div>
		    		<div class="container info-cont info-cont1">
		    		    <h3 class="info-cont-subheading">Can't combine with others discounts</h3>
		    			<p class="mb-0">Customers won’t be able to enter a code if this discount is applied at checkout.</p>
		    		</div>
		    	</div>
		    </div>
		    <div class="container proButtons">
		        <div class="row">
		    	    <div class="col-6 p-0">
					    <a onclick="deleteCode()" class="btn btn-danger">Delete</a>
					</div>
		    	    <div class="col-6 text-right p-0">
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
	});
	
	function validateForm() {
	  document.getElementById("widget_date").value = document.getElementById("datepicker1").value;
	  document.getElementById("widget_date_to").value = document.getElementById("datepicker2").value;
	}
	
	function showSetDate(setEndDateCheckbox){
		var EndDateForm = document.getElementById("endDate");
        EndDateForm.style.display = setEndDateCheckbox.checked ? "block" : "none";
	}
	
	function deleteCode(){
		$.ajax({
            url: '/admin/discounts/automatic/{{$discount["id"]}}',
            method: "DELETE",
            data: {_token: '{{ csrf_token() }}'},
            success: function (response) {
                window.location.href = "/admin/discounts";
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