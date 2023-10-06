@extends('admin.layout')
@section('title','Products | Vitality Club')
@section('style','.admin-menu.products i{color:black;}.admin-menu1.products{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    @if($product['product_hasVariants'] == 'Yes')
    	<style>#VariantForm{display:block;}</style>
    @else
    	<style>#VariantForm{display:none;}</style>
    @endif
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/products'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-9 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <div class="heading2" style="display:inline-block;margin-right:10px;">{{$product->product_name}}</div>
				    @if($product->product_status == "Active")
						<div class="block3">{{$product->product_status}}</div>
					@else
						<div class="block4">{{$product->product_status}}</div>
					@endif
				</td></tr></table>
			</div>
			<div class="col-md-2 text-right">
			    <p class="mb-0"><a class="btn btn-link" href="/shop/@php echo strtolower(str_replace(' ','-',$product->product_category)) @endphp/{{$product->product_url}}" target="_blank">View</a></p>
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
        <form class="needs-validation" action="/admin/products/{{$product->id}}/edit" method="POST" enctype="multipart/form-data" novalidate>
		@csrf
		<div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <div class="form-row">
					    <div class="col-12 mb-3">
						    <label for="validationCustom01">Title</label>
							<input type="text" class="form-control" id="validationCustom01" name="productName" value="{{$product->product_name}}" required>
						</div>
						<div class="col-12">
                            <label for="validationCustom02">Description</label>
                            <textarea rows="8" class="form-control" id="validationCustom02" name="productDescription" required>{{$product->product_description}}</textarea>
                        </div>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Media</h3>
					<div class="row">
					    <div class="col-6">
						    <img class="media-img" src="/storage/shop/@php echo str_replace(' ','-',strtoupper($product->product_code)) @endphp/{{$product->product_pic1}}" data-toggle="modal" data-target="#deleteImage" data-whatever="{{$product->product_pic1}}" />
						</div>
					    <div class="col-6">
						    <div class="row">
								@php $counter = 1 @endphp
								@for ($i = 2; $i <= 4; $i++)
					            	@php $picNum = 'product_pic'.$i; @endphp
    				                    @if($product->$picNum != "null")
					                        <div class="col-6 pl-2 mb-3">
    				                        	<img class="media-img" src="/storage/shop/@php echo str_replace(' ','-',strtoupper($product->product_code)) @endphp/{{$product[$picNum]}}" data-toggle="modal" data-target="#deleteImage" data-whatever="{{$product->$picNum}}" />
    				                        </div>
											@php $counter++ @endphp
					            	    @endif
    				            @endfor
								@if($counter == 4)
									<div class="col-6 pl-2">
								        <img class="media-max" src="/backgrounds/max-limit-reached.png" />
								    </div>
								@else
									<div class="col-6 pl-2">
								        <img class="media-max" src="/backgrounds/add-media.png" data-toggle="modal" data-target="#addImage" />
								    </div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Pricing</h3>
					<div class="form-row">
                        <div class="col-6">
                            <label for="validationCustom04">Price</label>
                            <input type="number" class="form-control priceInput" id="validationCustom04" name="productDiscountPrice" value="{{$product->product_price}}" required>
							<i class="fas fa-rupee-sign rupeeIcon"></i>
                        </div>
					    <div class="col-6">
                            <label for="validationCustom05">Compare at price</label>
                            <input type="number" class="form-control priceInput" id="validationCustom05" name="productTotalPrice" placeholder="0.00" value="@if($product->product_totalPrice > 0){{$product->product_totalPrice}}@endif">
							<i class="fas fa-rupee-sign rupeeIcon"></i>
                        </div>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Inventory</h3>
					<div class="form-row">
                        <div class="col-6 mb-3">
                            <label for="validationCustom06">SKU (Stock Keeping Unit)</label>
							<input type="text" class="form-control @error('product_code') is-invalid @enderror" id="validationCustom06" name="product_code" value="{{$product->product_code}}" required>
							@error('product_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
					    <div class="col-6 mb-3">
                            <label for="validationCustom07">Quantity</label>
                            <input type="number" class="form-control" id="validationCustom07" name="productQuantity" value="{{$product->product_quantity}}">
                        </div>
						<div class="col-12">
                            <div class="custom-control custom-checkbox">
                            	<input type="checkbox" class="custom-control-input" id="customCheck1" name="track_quantity" checked disabled>
                            	<label class="custom-control-label" for="customCheck1">Track quantity</label>
                            </div>
						</div>
						<div class="col-12">
                            <div class="custom-control custom-checkbox">
                            	<input type="checkbox" class="custom-control-input" id="setVariant" name="setVariant" onclick="showVariant(this)" @if($product['product_hasVariants'] == 'Yes') checked @endif>
                            	<label class="custom-control-label" for="setVariant">Has variant?</label>
                            </div>
					    </div>
					</div>
				</div>
				<div id="VariantForm" class="container info-cont">
				    <h3 class="info-cont-heading">Variants</h3>
					<div class="col-6 mb-3 p-0">
                        <label for="validationCustom08">Variant Type (Size, Colour)</label>
                        <input type="text" class="form-control @error('product_variantType') is-invalid @enderror" id="validationCustom08" name="product_variantType" value="{{$product['product_variantType']}}">
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
                        		<input type="text" class="form-control" id="validationCustom09" value="{{$product->product_variant1}}" name="variant1">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom32" value="{{$product->product_variant1sku}}" name="variant1SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom10" value="{{$product->product_variant1qty}}" name="variant1Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom11" value="{{$product->product_variant1cost}}" name="variant1Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom37" value="{{$product->product_variant1mrp}}" name="variant1MRP">
                        	</div>
                        </div>
						<div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom12" value="{{$product->product_variant2}}" name="variant2">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom33" value="{{$product->product_variant2sku}}" name="variant2SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom13" value="{{$product->product_variant2qty}}" name="variant2Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom14" value="{{$product->product_variant2cost}}" name="variant2Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom38" value="{{$product->product_variant2mrp}}" name="variant2MRP">
                        	</div>
                        </div>
						<div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom15" value="{{$product->product_variant3}}" name="variant3">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom34" value="{{$product->product_variant3sku}}" name="variant3SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom16" value="{{$product->product_variant3qty}}" name="variant3Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom17" value="{{$product->product_variant3cost}}" name="variant3Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom39" value="{{$product->product_variant3mrp}}" name="variant3MRP">
                        	</div>
                        </div>
						<div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom18" value="{{$product->product_variant4}}" name="variant4">
                        	</div>
                        </div>
                        <div class="col-3 mb-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom35" value="{{$product->product_variant4sku}}" name="variant4SKU">
                        	</div>
                        </div>
                        <div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom19" value="{{$product->product_variant4qty}}" name="variant4Qty">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom20" value="{{$product->product_variant4cost}}" name="variant4Price">
                        	</div>
                        </div>
						<div class="col-2 mb-3">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom40" value="{{$product->product_variant4mrp}}" name="variant4MRP">
                        	</div>
                        </div>
						<div class="col-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom21" value="{{$product->product_variant5}}" name="variant5">
                        	</div>
                        </div>
                        <div class="col-3">
                        	<div class="input-group">
                        		<input type="text" class="form-control" id="validationCustom36" value="{{$product->product_variant5sku}}" name="variant5SKU">
                        	</div>
                        </div>
                        <div class="col-2">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom22" value="{{$product->product_variant5qty}}" name="variant5Qty">
                        	</div>
                        </div>
						<div class="col-2">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom23" value="{{$product->product_variant5cost}}" name="variant5Price">
                        	</div>
                        </div>
						<div class="col-2">
                        	<div class="input-group">
                        		<input type="number" class="form-control" id="validationCustom41" value="{{$product->product_variant5mrp}}" name="variant5MRP">
                        	</div>
                        </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
			    <div class="container info-cont">
				    <h3 class="info-cont-heading">Product Status</h3>
					<select class="custom-select" id="validationCustom24" name="product_status">
					    <option value="Active" @if($product->product_status == "Active") selected @endif>Active</option>
					    <option value="Draft" @if($product->product_status == "Draft") selected @endif>Draft</option>
					</select>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Organization</h3>
					<label for="validationCustom25">Product Category</label>
                    <select class="custom-select mb-3" id="validationCustom25" name="productCategory" required>
                    	@foreach($categories as $category)
			        	    <option value="{{$category['category']}}" @if($product->product_category == $category['category']) selected @endif>{{$category['category']}}</option>
			        	@endforeach
                    </select>
					<label for="validationCustom26">Product Sub Category</label>
                    <select class="custom-select" id="validationCustom26" name="productSubCategory" required>
                    	@foreach($subCategories as $subCategorie)
			        	    <option value="{{$subCategorie['subCategory']}}" @if($product->product_subCategory == $subCategorie['subCategory']) selected @endif>{{$subCategorie['subCategory']}}</option>
			        	@endforeach
						<option value="Not Applicable" @if($product->product_subCategory == "Not Applicable") selected @endif>Not Applicable</option>
                    </select>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Information</h3>
					<div class="mb-3">
					    <label for="validationCustom27">Ingredients</label>
						<textarea class="form-control" id="validationCustom27" name="product_ingredients">{{$product['product_ingredients']}}</textarea>
					</div>
					<div class="mb-3">
					    <label for="validationCustom28">Additional Info</label>
						<textarea class="form-control" id="validationCustom28" name="product_nutritionalFacts">{{$product['product_nutritionalFacts']}}</textarea>
					</div>
					<div class="mb-3">
					    <label for="validationCustom29">Sub-Heading</label>
						<textarea class="form-control" id="validationCustom29" name="product_benefits">{{$product['product_benefits']}}</textarea>
					</div>
					<div class="">
					    <label for="validationCustom30">Product Tags (Use comma for multiple tags)</label>
						<textarea class="form-control" id="validationCustom30" name="product_otherInfo">{{$product['product_otherInfo']}}</textarea>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Health Benefit</h3>
					<div>
						<input type="text" class="form-control" id="validationCustom31" name="product_healthBenefit" placeholder="e.g. Skin Care" value="{{$product['product_healthBenefit']}}" required>
					</div>
				</div>
			</div>
		</div>
		<div class="container proButtons">
		    <div class="row">
			    <div class="col-6 p-0">
			        <a onclick="deleteProduct()" class="btn btn-danger">Delete product</a>
			    </div>
			    <div class="col-6 text-right p-0">
			        <button class="btn btn-primary" type="submit">Save</button>
			    </div>
			</div>
		</div>
		</form>
	</div>
</div>

<div class="modal fade" id="deleteImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">New message</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<img id="modalImage" style="width:66%;height:auto;margin-left:17%;" src="" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="deleteMedia();">Delete</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">New media</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="needs-validation" action="/image/{{$product->id}}" method="POST" enctype="multipart/form-data" novalidate>
				@csrf
				<div class="form-row">
                    <div class="col-12 mb-3">
		            	<div class="custom-file">
                            <input type="file" class="custom-file-input picInput1" id="validationCustom01" accept="image/*" name="productImage[]" required>
                            <label class="custom-file-label picLabel1" for="validationCustom01">Choose an image</label>
		            	</div>
                    </div>
                </div>
				<button class="btn btn-primary" type="submit">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#productsCollapse').collapse('show');
	
	var productModel = "{{$product->product_code}}";
	var picName = "";
	
    $('#deleteImage').on('show.bs.modal', function (event) {
    	var button = $(event.relatedTarget);
    	var recipient = button.data('whatever');
    	picName = recipient;
		var modal = $(this);
    	modal.find('.modal-title').text(recipient);
    	document.getElementById("modalImage").src = "/storage/shop/@php echo str_replace(' ','-',strtoupper($product->product_code)) @endphp/"+recipient;
    });
	
	function deleteMedia(){
		$.ajax({
            url: '/image',
            method: "DELETE",
            data: {_token: '{{ csrf_token() }}', sku: productModel, imgName: picName},
            success: function (response) {
                window.location.reload();
            }
        });
	}
	
	function deleteProduct(){
		$.ajax({
            url: '/product',
            method: "DELETE",
            data: {_token: '{{ csrf_token() }}', sku: productModel},
            success: function (response) {
                window.location.href = "/admin/products";
            }
        });
	}
	
	$('.picInput1').change(function(e){
        var fileName = e.target.files[0].name;
        $('.picLabel1').html(fileName);
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