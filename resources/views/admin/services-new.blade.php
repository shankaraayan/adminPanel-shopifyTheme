@extends('admin.layout')
@section('title','Services | Vitality Club')
@section('style','.admin-menu.store i{color:black;}.admin-menu1.services{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin/homepage/services'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-9 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <div class="heading2">Create slider</div>
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
        <form class="needs-validation" action="/admin/homepage/services/new" method="POST" enctype="multipart/form-data" novalidate>
		@csrf
		<div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <div class="form-row">
					    <div class="col-6 mb-3">
						    <label for="validationCustom01">Button Text</label>
							<input type="text" class="form-control @error('text') is-invalid @enderror" id="validationCustom01" name="text" placeholder="e.g. Shop Now" value="{{old('text')}}" >
							@error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-6 mb-3">
						    <label for="validationCustom01">Button Link</label>
							<input type="text" class="form-control @error('btnlink') is-invalid @enderror" id="validationCustom02" name="btnlink" placeholder="e.g. /shop/tea" value="{{old('btnlink')}}" >
							@error('btnlink')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-12 mb-3">
                            <label for="validationCustom02">Description</label>
                            <textarea rows="10" class="form-control @error('description') is-invalid @enderror" id="validationCustom03" name="description" required>{{old('description')}}</textarea>
							@error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Banner (1920*1280 px)</h3>
					<div class="row">
					    <div class="col-12 text-center">
					        <div class="custom-file pt-5" style="border:2px solid #dddddd;border-style:dashed;padding-bottom:150px;">
                                <p class="text-center"><i style="font-size:40px;" class="fas fa-arrow-circle-up"></i></p>
					        	<input type="file" class="inputMedia inputfile" id="validationCustom04" accept="video/mp4,.jpg" name="banner[]" required>
                                <label class="inputMediaLabel" for="validationCustom04">Add</label>
		                    </div>
		                </div>
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
		</form>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#storeCollapse').collapse('show');
	
	$('.inputMedia').change(function(e){
        if(e.target.files.length > 1){
			var fileName = e.target.files.length;
			fileName += " files selected";
		}else{
			var fileName = e.target.files[0].name;
		}
        $('.inputMediaLabel').html(fileName);
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