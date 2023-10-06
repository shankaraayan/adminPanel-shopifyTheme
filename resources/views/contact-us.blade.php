@extends('layouts.app')
@section('title','Contact Us | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','https://www.vitalityclub.in/contact-us')
@section('style','#contactUs{color:black;}')
@section('content')
@if(session('status'))
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
         <div class="modal-body">
            <p class="success_icon text-center pb-2"><i class="fas fa-check-circle"></i></p>
            <p class="modal-content text-center">{{ session('status') }}</p>
          </div>
        </div>
      </div>
    </div>
@endif
<div class="container-fluid">
    <div class="container containerLimit">
    	<div class="row breadcrubs-main-cont">
    		<div class="col-12">
    			<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Contact us</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid contactUs-mainCont">
    <div class="container containerLimit contactUs-cont">
	    <h1 class="project-heading">Contact Us</h1>
		<div class="row">
		    <div class="col-lg-8 col-md-7 contactUs-left">
                <p class="subheading1">SUBMIT YOUR QUERY</p>
				<form class="needs-validation contactUs-form" action="/contact-us" method="post" novalidate>
				@csrf
                	<div class="form-row">
                		<div class="col-12 mb-xl-4 mb-3">
                			<label for="validationCustom01">Your email address<span style="color:red">*</span></label>
                			<input type="email" class="form-control @error('email') is-invalid @enderror" id="validationCustom01" name="email" value="{{old('email')}}" required>
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                	</div>
					<div class="form-row">
                		<div class="col-12 mb-xl-4 mb-3">
                			<label for="validationCustom02">Your phone number<span style="color:red">*</span></label>
                			<input type="number" class="form-control @error('phone') is-invalid @enderror" id="validationCustom02" name="phone" value="{{old('phone')}}" required>
							@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                	</div>
					<div class="form-row">
                		<div class="col-12 mb-xl-4 mb-3">
                			<label for="validationCustom02">Subject<span style="color:red">*</span></label>
                			<input type="text" class="form-control @error('subject') is-invalid @enderror" id="validationCustom02" name="subject" value="{{old('subject')}}" required>
							@error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                	</div>
					<div class="form-row">
                		<div class="col-md-6 mb-xl-4 mb-3">
                			<label for="validationCustom03">First name<span style="color:red">*</span></label>
                			<input type="text" class="form-control @error('firstName') is-invalid @enderror" id="validationCustom03" name="firstName" value="{{old('firstName')}}" required>
							@error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
						<div class="col-md-6 mb-xl-4 mb-3">
                			<label for="validationCustom04">Last name<span style="color:red">*</span></label>
                			<input type="text" class="form-control @error('lastName') is-invalid @enderror" id="validationCustom04" name="lastName" value="{{old('lastName')}}" required>
							@error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
                	</div>
					<div class="form-row">
                		<div class="col-12 mb-xl-4 mb-3">
                			<label for="validationCustom05">Category<span style="color:red">*</span></label>
							<select class="custom-select" id="validationCustom05" name="category" required>
							    <option selected disabled value="">Choose an option</option>
								<option value="My Order">My Order</option>
								<option value="Cancellation, Refund or Exchange">Cancellation, Refund or Exchange</option>
								<option value="General Enquiry">General Enquiry</option>
								<option value="Gifting">Gifting</option>
								<option value="Custom Order">Custom Order</option>
								<option value="Yoga and Life Coaching">Yoga and Life Coaching</option>
								<option value="Other">Other</option>
							</select>
                		</div>
                	</div>
					<div class="form-row">
                		<div class="col-12 mb-xl-4 mb-3">
						    <label for="validationCustom06">Your message<span style="color:red">*</span></label>
							<textarea class="form-control @error('description') is-invalid @enderror" id="validationCustom06" name="description" rows="4" required>{{old('description')}}</textarea>
							@error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<button class="btn btn-primary" type="submit">Submit</button>
				</form>
			</div>
			<div class="col-lg-4 col-md-5 contactUs-right">
			    <table style="width:100%;height:100%;"><tr><td class="align-middle" style="width:100%;height:100%">
				<p class="subheading1">INFO</p>
				<p class="text2 email intagram mb-0"><i class="fas fa-phone"></i> <a class="link2" href="tel:918595764867">+91 85957 64867</a></p>
				<p class="text2 email intagram"><i class="far fa-envelope"></i> <a class="link2" href="mailto:hello@vitalityclub.in">hello@vitalityclub.in</a></p>
				<p class="text2 facebook"><i class="fab fa-facebook-square"></i> <a class="link2" href="https://www.facebook.com/vitalityclub.in" target="_blank">@vitalityclub.in</a></p>
				<p class="text2 intagram"><i class="fab fa-instagram"></i> <a class="link2" href="https://www.instagram.com/vitalityclub.in" target="_blank">@vitalityclub.in</a></p>
				<div class="row address">
				    <div class="col-1 noleftPadOnMob">
					    <p class="text2 intagram"><i class="fas fa-map-marker-alt"></i></p>
					</div>
					<div class="col-10 noleftPadOnMob">
					    <p class="text2 intagram">A1/76, 1st Floor, Safdarjung Enclave, New Delhi - 110029, India</p>
					</div>
				</div>
				</td></tr></table>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid insta-bckgd">
	<div class="container containerLimit" style="position:relative;">
	    <p class="instaTitle">Instagram</p>
	    <p class="text-md-right text-center instalink-cont"><a href="https://www.instagram.com/vitalityclub.in/" target="_blank" class="instalink">@vitalityclub.in</a></p>
		<!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="https://cdn.lightwidget.com/widgets/9b3ef1dbb5ef5404ad00017acf58becb.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
	</div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
<script>
    $('#statusModal').modal('show');
	
	if(screen.width > 991){
		var breadcrumbsCont = $("#breadcrumbsCont");
		var contactUsContHeight = (screen.height - nav.height() - breadcrumbsCont.height());
		contactUsContHeight = contactUsContHeight+"px";
		document.getElementById("contactUsCont").style.minHeight = contactUsContHeight;
	}else{
		var breadcrumbsCont = $("#breadcrumbsCont");
		var contactUsContHeight = (screen.height - nav.height() - breadcrumbsCont.height());
		contactUsContHeight = contactUsContHeight+"px";
		document.getElementById("contactUsMainCont").style.minHeight = contactUsContHeight;
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