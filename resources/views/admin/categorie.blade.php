@extends('admin.layout')
@section('title','Categories | Vitality Club')
@section('style','.admin-menu.products i{color:black;}.admin-menu1.categories{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/categories'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-9 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <div class="heading2">{{$category->category}}</div>
				</td></tr></table>
			</div>
			<div class="col-md-2 text-right">
			    <p class="mb-0"><a class="btn btn-link" href="/shop/@php echo strtolower(str_replace(' ','-',$category->category)) @endphp" target="_blank">View</a></p>
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
        <form class="needs-validation" action="/admin/categories/{{$category->id}}/edit" method="POST" enctype="multipart/form-data" novalidate>
		@csrf
		<div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <div class="form-row">
					    <div class="col-12 mb-3">
						    <label for="validationCustom01">Title</label>
							<input type="text" class="form-control" id="validationCustom01 @error('category') is-invalid @enderror" name="category" value="{{$category['category']}}{{old('category')}}" required>
							@error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-12 mb-3">
                            <label for="validationCustom02">Description (optional)</label>
                            <textarea rows="6" class="form-control" id="validationCustom02" name="description">{{$category['description']}}{{old('description')}}</textarea>
                        </div>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Category type</h3>
					<div class="custom-control custom-radio" name="collectionType">
					    <input type="radio" id="customRadio1" name="collectionTypeRadio" class="custom-control-input" checked>
						<label class="custom-control-label" for="customRadio1">Automated</label>
						<p class="pt-1 mb-0">Existing and future products that match the conditions you set will automatically be added to this collection.</p>
					</div>
					<div class="info-cont-divider"></div>
					<h3 class="info-cont-subheading">Conditions</h3>
					<div class="custom-control custom-radio" name="collectionCondition">
					    <input type="radio" id="customRadio2" name="collectionConditionRadio" class="custom-control-input" checked>
						<label class="custom-control-label" for="customRadio2">Product category is equal to category name</label>
					</div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Products</h3>
					@if(count($products) > 0)
					    <table class="table">
					        <tbody>
					    	@foreach($products as $product)
					        <tr>
                	    		<th scope="row">
					    		    <div class="img-block mr-0" style="background-image:url('/storage/shop/@php echo str_replace(' ','-',$product['product_code']) @endphp/@php echo str_replace('.jpg','-270px.jpg',$product['product_pic1']) @endphp');"></div>
					    		</th>
                	    		<td class="align-middle">
					    		    {{$product['product_name']}}
					    		</td>
					    		<td class="align-middle text-right">
					    			@if($product->product_status == "Active")
					    				<div class="block3">{{$product['product_status']}}</div>
					    			@else
					    				<div class="block4">{{$product['product_status']}}</div>
					    			@endif
					    		</td>
                	    	</tr>
		        	    	@endforeach
                	        </tbody>
					    </table>
					@else
						<p class="mb-0">No products available</p>
					@endif
				</div>
			</div>
			<div class="col-md-4">
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Category image</h3>
					<div class="row">
					    <div class="col-12 text-center">
					        @if($category['categoryImage'] == "" || $category['categoryImage'] == "null")
							    <img class="img-fluid" src="/backgrounds/add-media.png" data-toggle="modal" data-target="#updateCollectionImage" data-whatever="{{$category['categoryImage']}}" style="cursor:pointer"/>
							@else
							    <img class="img-fluid" src="/storage/categories/{{$category['categoryImage']}}" data-toggle="modal" data-target="#updateCollectionImage" data-whatever="{{$category['categoryImage']}}" style="cursor:pointer"/>
							@endif
		                </div>
		            </div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Category banner</h3>
					<div class="row">
					    <div class="col-12 text-center">
					        @if($category['banner'] == "" || $category['banner'] == "null")
							    <img class="img-fluid" src="/backgrounds/add-media.png" data-toggle="modal" data-target="#updateCollectionBanner" data-whatever="{{$category['banner']}}" style="cursor:pointer"/>
							@else
							    <img class="img-fluid" src="/storage/categories/{{$category['banner']}}" data-toggle="modal" data-target="#updateCollectionBanner" data-whatever="{{$category['banner']}}" style="cursor:pointer"/>
							@endif
		                </div>
		            </div>
				</div>
			</div>
		</div>
		<div class="container proButtons">
		    <div class="row">
			    <div class="col-6 p-0">
			        <a href="/admin/categories/{{$category->id}}/delete" class="btn btn-danger">Delete category</a>
			    </div>
			    <div class="col-6 text-right p-0">
			        <button class="btn btn-primary" type="submit">Save</button>
			    </div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="updateCollectionImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">Update media</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="needs-validation" action="/admin/categorie/{{$category->id}}/image" method="POST" enctype="multipart/form-data" novalidate>
				@csrf
				<input type="hidden" name="type" value="Image" />
				<div class="form-row">
                    <div class="col-12 mb-3">
		            	<div class="custom-file">
                            <input type="file" class="custom-file-input picInput1" id="validationCustom01" accept="image/*" name="banner[]" required>
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

<div class="modal fade" id="updateCollectionBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">Update media</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="needs-validation" action="/admin/categorie/{{$category->id}}/image" method="POST" enctype="multipart/form-data" novalidate>
				@csrf
				<input type="hidden" name="type" value="Banner" />
				<div class="form-row">
                    <div class="col-12 mb-3">
		            	<div class="custom-file">
                            <input type="file" class="custom-file-input picInput1" id="validationCustom01" accept="image/*" name="banner[]" required>
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
	
	$('.picInput1').change(function(e){
        var fileName = e.target.files[0].name;
        $('.picLabel1').html(fileName);
    });
	
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