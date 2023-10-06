@extends('admin.layout')
@section('title','Products | Vitality Club')
@section('style','.admin-menu.products i{color:black;}.admin-menu1.products{background-color:#eaeaea;border-left:5px solid black;color:black;}#VariantForm{display:none;}')
@section('content')
<div class="container">
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/products'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-9 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <div class="heading2">New product</div>
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
        <form class="needs-validation" action="/admin/products/new" method="POST" enctype="multipart/form-data" novalidate>
		@csrf
		<div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <div class="form-row">
					    <div class="col-12 mb-3">
						    <label for="validationCustom01">Title</label>
							<input type="text" class="form-control" id="validationCustom01" name="productName" placeholder="Darjeeling Tea" value="{{old('productName')}}" required>
						</div>
						<div class="col-12">
                            <label for="validationCustom02">Description</label>
                            <textarea rows="8" class="form-control" id="validationCustom02" name="productDescription" required>{{old('productDescription')}}</textarea>
                        </div>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Media</h3>
					<div class="row">
					    <div class="col-12 text-center">
						    <div class="custom-file pt-5" style="border:2px solid #dddddd;border-style:dashed;padding-bottom:150px;">
                                <p class="text-center"><i style="font-size:40px;" class="fas fa-arrow-circle-up"></i></p>
								<input type="file" class="inputMedia inputfile" id="validationCustom03" accept=".jpg, .png, .jpeg" name="productImage[]" multiple>
                                <label class="inputMediaLabel" for="validationCustom03">Add image</label>
		            	    </div>
						</div>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Pricing</h3>
					<div class="form-row">
                        <div class="col-6">
                            <label for="validationCustom04">Price</label>
                            <input type="number" class="form-control priceInput" id="validationCustom04" name="productDiscountPrice" placeholder="0.00" value="{{old('productDiscountPrice')}}" required>
							<i class="fas fa-rupee-sign rupeeIcon"></i>
                        </div>
					    <div class="col-6">
                            <label for="validationCustom05">Compare at price</label>
                            <input type="number" class="form-control priceInput" id="validationCustom05" name="productTotalPrice" placeholder="0.00" value="{{old('productTotalPrice')}}">
							<i class="fas fa-rupee-sign rupeeIcon"></i>
                        </div>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Inventory</h3>
					<div class="form-row">
                        <div class="col-6 mb-3">
                            <label for="validationCustom06">SKU (Stock Keeping Unit)</label>
                            <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="validationCustom06" name="product_code" value="{{old('product_code')}}" required>
							@error('product_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
					    <div class="col-6 mb-3">
                            <label for="validationCustom07">Quantity</label>
                            <input type="number" class="form-control" id="validationCustom07" name="productQuantity" value="{{old('productQuantity', 0)}}">
                        </div>
						<div class="col-12 mb-3">
                            <div class="custom-control custom-checkbox">
                            	<input type="checkbox" class="custom-control-input" id="customCheck1" name="track_quantity" checked disabled>
                            	<label class="custom-control-label" for="customCheck1">Track quantity</label>
                            </div>
						</div>
						<div class="col-12">
                            <div class="custom-control custom-checkbox">
                            	<input type="checkbox" class="custom-control-input" id="setVariant" name="setVariant" onclick="showVariant(this)">
                            	<label class="custom-control-label" for="setVariant">Has variant?</label>
                            </div>
					    </div>
					</div>
				</div>
				<div id="VariantForm" class="container info-cont">
				    <h3 class="info-cont-heading">Variants</h3>
					<div class="col-6 mb-3 p-0">
                        <label for="validationCustom08">Variant Type (Size, Colour)</label>
                        <input type="text" class="form-control @error('product_variantType') is-invalid @enderror" id="validationCustom08" name="product_variantType" value="{{old('product_variantType')}}">
						@error('product_variantType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
					<div class="row">
					    <div class="col-3">
						    <p class="mb-0">Variant</p>
						</div>
					    <div class="col-3">
						    <p class="mb-0">SKU</p>
						</div>
					    <div class="col-2">
						    <p class="mb-0">Quantity</p>
						</div>
					    <div class="col-2">
						    <p class="mb-0">Price</p>
						</div>
						<div class="col-2">
						    <p class="mb-0">MRP</p>
						</div>
					</div>
					<div class="form-group row">
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom09" name="variant1">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom32" name="variant1SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom10" value="0" name="variant1Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom11" value="0" name="variant1Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom37" value="0" name="variant1MRP">
                        	</div>
                        </div>
						<div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom12" name="variant2">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom33" name="variant2SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom13" value="0" name="variant2Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom14" value="0" name="variant2Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom38" value="0" name="variant2MRP">
                        	</div>
                        </div>
						<div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom15" name="variant3">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom34" name="variant3SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom16" value="0" name="variant3Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom17" value="0" name="variant3Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom39" value="0" name="variant3MRP">
                        	</div>
                        </div>
						<div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom18" name="variant4">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom35" name="variant4SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom19" value="0" name="variant4Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom20" value="0" name="variant4Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom40" value="0" name="variant4MRP">
                        	</div>
                        </div>
						<div class="col-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom21" name="variant5">
                        	</div>
                        </div>
                        <div class="col-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom36" name="variant5SKU">
                        	</div>
                        </div>
                        <div class="col-2">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom22" value="0" name="variant5Qty">
                        	</div>
                        </div>
						<div class="col-2">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom23" value="0" name="variant5Price">
                        	</div>
                        </div>
						<div class="col-2">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom41" value="0" name="variant5MRP">
                        	</div>
                        </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
			    <div class="container info-cont">
				    <h3 class="info-cont-heading">Product Status</h3>
					<select class="custom-select" id="validationCustom24" name="product_status">
					    <option value="Active" @if(old('product_status') == "Active") selected @endif>Active</option>
					    <option value="Draft" @if(old('product_status') == "Draft" || old('product_status') == "") selected @endif>Draft</option>
					</select>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Organization</h3>
					<label for="validationCustom25">Product Category</label>
                    <select class="custom-select mb-3" id="validationCustom25" name="productCategory" required>
					    <option value="" selected disabled>e.g. Tea</option>
                    	@foreach($categories as $category)
			        	<option value="{{$category['category']}}" @if(old('productCategory') == $category['category']) selected @endif>{{$category['category']}}</option>
			        	@endforeach
                    </select>
					<label for="validationCustom26">Product Sub category</label>
                    <select class="custom-select" id="validationCustom26" name="productSubCategory" required>
					    <option value="" selected disabled>e.g. Organic Tea</option>
                    	@foreach($subCategories as $subCategory)
			        	<option value="{{$subCategory['subCategory']}}" @if(old('productSubCategory') == $subCategory['subCategory']) selected @endif>{{$subCategory['subCategory']}}</option>
			        	@endforeach
						<option value="Not Applicable">Not Applicable</option>
                    </select>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Information</h3>
					<div class="mb-3">
					    <label for="validationCustom27">Ingredients</label>
						<textarea class="form-control" id="validationCustom27" name="product_ingredients">{{old('product_ingredients')}}</textarea>
					</div>
					<div class="mb-3">
					    <label for="validationCustom28">Additional Info</label>
						<textarea class="form-control" id="validationCustom28" name="product_nutritionalFacts">{{old('product_nutritionalFacts')}}</textarea>
					</div>
					<div class="mb-3">
					    <label for="validationCustom29">Sub-Heading</label>
						<textarea class="form-control" id="validationCustom29" name="product_benefits">{{old('product_benefits')}}</textarea>
					</div>
					<div class="">
					    <label for="validationCustom30">Product Tags (Use comma for multiple tags)</label>
						<textarea class="form-control" id="validationCustom30" name="product_otherInfo">{{old('product_otherInfo')}}</textarea>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Health Benefit</h3>
					<div>
						<input type="text" class="form-control" id="validationCustom31" name="product_healthBenefit" placeholder="e.g. Skin Care" value="{{old('product_healthBenefit')}}" required>
					</div>
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
<script>
	$('#productsCollapse').collapse('show');
	
	$('.inputMedia').change(function(e){
        if(e.target.files.length > 1){
			var fileName = e.target.files.length;
			fileName += " files selected";
		}else{
			var fileName = e.target.files[0].name;
		}
        $('.inputMediaLabel').html(fileName);
    });
	
	function showVariant(showVariantCheckbox){
		var VariantForm = document.getElementById("VariantForm");
        VariantForm.style.display = showVariantCheckbox.checked ? "block" : "none";
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