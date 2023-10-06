@extends('admin.layout')
@section('title','Announcement | Vitality Club')
@section('style','.admin-menu.store i{color:black;}.admin-menu1.announcement{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-md-1">
			    <button class="btn btn-secondary" onclick="window.location.href='/admin'"><i class="fas fa-long-arrow-alt-left"></i></button>
			</div>
		    <div class="col-md-9 p-0">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <div class="heading2">Announcement</div>
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
        <form class="needs-validation" action="/admin/homepage/announcement" method="POST" novalidate>
		@csrf
		<div class="row">
		    <div class="col-md-8">
			    <div class="container info-cont">
				    <div class="form-row">
					    <div class="col-12 mb-3">
						    <label for="validationCustom01">Heading</label>
							<textarea rows="4" class="form-control" id="validationCustom01" name="heading">{{$announcement['heading']}}</textarea>
						</div>
						<div class="col-12 mb-3">
                            <label for="validationCustom02">Description</label>
                            <textarea rows="6" class="form-control" id="validationCustom02" name="description">{{$announcement['description']}}</textarea>
                        </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Background color (Hex code)</h3>
					<div class="row">
					    <div class="col-12">
						    <input type="text" class="form-control" id="validationCustom03" name="background_color" placeholder="e.g. #faebd7" value="{{$announcement['background_color']}}" />
		                </div>
		            </div>
				</div>
				<div class="container info-cont">
				    <h3 class="info-cont-heading">Text colour (Hex code)</h3>
					<div class="row">
					    <div class="col-12">
						    <input type="text" class="form-control" id="validationCustom04" name="text_color" placeholder="e.g. #4c4c4c" value="{{$announcement['text_color']}}" />
		                </div>
		            </div>
				</div>
			</div>
		</div>
		<div class="container proButtons">
		    <div class="row">
			    <div class="col-6 p-0">
			    </div>
			    <div class="col-6 text-right p-0">
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