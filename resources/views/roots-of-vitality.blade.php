@extends('layouts.app')
@section('title','Roots of Vitality | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','https://www.vitalityclub.in/roots-of-vitality')
@section('style','#more{color:black;}')
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
						<li class="breadcrumb-item active" aria-current="page">Roots of Vitality</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid contactUs-mainCont root-mainCont">
    <div class="container containerLimit contactUs-cont">
	    <h1 class="project-heading roots-heading">Roots of Vitality</h1>
		<div class="row">
		    <div class="col-lg-8 col-md-7 contactUs-left">
                <table style="width:100%;height:100%;"><tr><td class="align-middle" style="width:100%;height:100%">
				    <img src="/images/roots/roots-of-vitality.png" class="respImg" />
				</td></tr></table>
			</div>
			<div class="col-lg-4 col-md-5 contactUs-right">
				<p class="text1">ENQUIRE ABOUT OUR SERVICES</p>
				<form class="needs-validation contactUs-form" action="/contact-us" method="post" novalidate>
				@csrf
                	<div class="form-row">
                		<div class="col-12 mb-3">
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
                		<div class="col-12 mb-3">
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
                		<div class="col-12 mb-3">
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
                		<div class="col-12 mb-3">
                			<label for="validationCustom03">First name<span style="color:red">*</span></label>
                			<input type="text" class="form-control @error('firstName') is-invalid @enderror" id="validationCustom03" name="firstName" value="{{old('firstName')}}" required>
							@error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                		</div>
						<div class="col-12 mb-3">
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
                		<div class="col-12 mb-3">
                			<label for="validationCustom05">Service<span style="color:red">*</span></label>
							<select class="custom-select" id="validationCustom05" name="category" required>
							    <option selected disabled value="">Choose an option</option>
								<option value="Physical Wellbeing (Yoga & Nutrition Consultation)">Physical Wellbeing (Yoga & Nutrition Consultation)</option>
								<option value="Mental Wellbeing (Meditation & Mindfulness)">Mental Wellbeing (Meditation & Mindfulness)</option>
								<option value="Emotional Wellbeing (Life Coaching)">Emotional Wellbeing (Life Coaching)</option>
								<option value="Social Wellbeing (Events & Networking)">Social Wellbeing (Events & Networking)</option>
								<option value="Spiritual Wellbeing (Retreats & Self-Care)">Spiritual Wellbeing (Retreats & Self-Care)</option>
							</select>
                		</div>
                	</div>
					<div class="form-row">
                		<div class="col-12 mb-3">
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
		</div>
	</div>
</div>
<div class="container containerLimit leftRightPad5">
    <p class="subheading1 text-center my-5 mb-0"><i>At Vitality Club, we believe that a life of balance is a prerequisite for developing vitality a.k.a. Ojas – i.e. the bright aura of radiant health and youthful energy associated with wellness! It is, therefore, a part of our mission to help you achieve this balance by aligning your mind, body, and spirit! We do this by focusing on ‘5 Roots of Vitality’.</i></p>
</div>
<div class="container-fluid py-5 leftRightPad20" style="background-color:#f5f1ec;">
    <div class="container containerLimit">
	    <p class="subheading1 mb-0"><b>Root 1: Physical Wellbeing</b></p>
		<p class="text1">We help you look after your physical body through movement training and exercises including yoga asanas, breathwork etc., along with proper nutrition, holistic health consultations etc.!</p>
		<p class="subheading1 mb-0"><b>Root 2: Mental Wellbeing</b></p>
		<p class="text1">Taking care of the physical body alone is not sufficient to create a sense of balance and calmness. Therefore, we help you look after your mind through meditation and mindfulness!</p>
		<p class="subheading1 mb-0"><b>Root 3: Emotional Wellbeing</b></p>
		<p class="text1">Everyone needs a little support sometimes, as well as some guidance in the right direction. We offer life coaching and mentorship services to help you meet this need!</p>
		<p class="subheading1 mb-0"><b>Root 4: Social Wellbeing</b></p>
		<p class="text1">Humans are social animals and, as such, require meaningful interactions along with a sense of community. We fulfil this through live social events as well as digital networking and learning opportunities!</p>
		<p class="subheading1 mb-0"><b>Root 5: Spiritual Wellbeing</b></p>
		<p class="text1 mb-0">We offer self-care protocols, wellness getaways, retreats, as well as opportunities to take part in various forms of community service as a way to help you meet your higher needs in life!</p>
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