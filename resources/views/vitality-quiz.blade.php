@extends('layouts.app')
@section('title','Vitality Quiz | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','https://www.vitalityclub.in/vitality-quiz')
@section('style','#more{color:black;}')
@section('content')
@if(session('status'))
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
         <div class="modal-body">
            <p class="modal-content py-4 text-center">Your Vitality Score is {{ session('status') }}/100</p>
			<div class="row quizResult">
			    <div class="col-md-6">
				    <button class="btn btn-primary checkout-btn" onclick="location.href='/shop+immunity-boost'">Boost Your Immunity</button>
				</div>
				<div class="col-md-6">
				    <button class="btn btn-primary checkout-btn" onclick="location.href='/shop+bp-&-energy'">Increase Your Energy</button>
				</div>
				<div class="col-md-6">
				    <button class="btn btn-primary checkout-btn" onclick="location.href='/shop+digestion-&-weight'">Improve Your Metabolism</button>
				</div>
				<div class="col-md-6">
				    <button class="btn btn-primary checkout-btn" onclick="location.href='/shop+stress-relief'">Lower Your Stress</button>
				</div>
				<div class="col-md-6">
				    <button class="btn btn-primary checkout-btn" onclick="location.href='/shop+holistic-health'">Improve Overall Health</button>
				</div>
				<div class="col-md-6">
				    <button class="btn btn-primary checkout-btn" onclick="location.href='/shop'">View Our Shop</button>
				</div>
			</div>
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
						<li class="breadcrumb-item active" aria-current="page">Vitality Quiz</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid aboutUs-bckgd">
    <div class="container containerLimit aboutUs-cont">
		<div class="aboutUs-heading">Vitality Quiz</div>
		<img src="{{asset('images/about-us/vitality-club-quiz-01.jpg')}}" class="aboutUs-banner"/>
	</div>
</div>
<div class="container-fluid vision-bckgd vision-backgrounds">
    <div class="container containerLimit vision-cont">
	    <div class="row justify-content-center">
			<div class="col-md-9">
			    <p class="heading2 text-center">VITALITY QUIZ</p>
				<p class="text1"><b>Take this short quiz to find out your Vitality Score! Try to be as honest as possible :)</b></p>
				<p class="text1">(Please note that this quiz is not meant to diagnose, treat, or cure any illnesses, nor is it a replacement for professional medical opinion. Team Vitality Club strongly recommends that you visit your healthcare specialist in case you need medical consultation. This quiz is simply a quick tool for understanding how you are currently feeling.)</p>
				<form class="needs-validation" action="{{url('/vitality-quiz')}}" method="post" novalidate>
				@csrf
				<div class="owl-carousel quizCaro">
				    <div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q1: Generally, how often do you fall sick? (seasonal flu/cold & cough etc.)</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que1" id="que1option1" value="1" required>
                        			<label class="custom-control-label" for="que1option1">Rarely (a few times a year at most)</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que1" id="que1option2" value="2" required>
                        			<label class="custom-control-label" for="que1option2">Sometimes (every few months)</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que1" id="que1option3" value="3" required>
                        			<label class="custom-control-label" for="que1option3">Often (close to once a month)</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q2: How would you describe your general energy levels?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que2" id="que2option1" value="1" required>
                        			<label class="custom-control-label" for="que2option1">I am always full of energy!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que2" id="que2option2" value="2" required>
                        			<label class="custom-control-label" for="que2option2">Not bad, but I feel tired sometimes.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que2" id="que2option3" value="3" required>
                        			<label class="custom-control-label" for="que2option3">I am often tired or fatigued.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q3: Generally, how stressed out do you feel?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que3" id="que3option1" value="1" required>
                        			<label class="custom-control-label" for="que3option1">I am rarely stressed!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que3" id="que3option2" value="2" required>
                        			<label class="custom-control-label" for="que3option2">Sometimes, but I don’t think about it too much.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que3" id="que3option3" value="3" required>
                        			<label class="custom-control-label" for="que3option3">I often feel stress or anxiety.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q4: How would you describe your digestion and metabolism?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que4" id="que4option1" value="1" required>
                        			<label class="custom-control-label" for="que4option1">I have excellent digestion and a fast metabolism! </label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que4" id="que4option2" value="2" required>
                        			<label class="custom-control-label" for="que4option2">Not bad, but it could be better.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que4" id="que4option3" value="3" required>
                        			<label class="custom-control-label" for="que4option3">I have poor digestion/a slow metabolism.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q5: Holistically, how do you view your general health and wellbeing?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que5" id="que5option1" value="1" required>
                        			<label class="custom-control-label" for="que5option1">I am blessed with good overall health!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que5" id="que5option2" value="2" required>
                        			<label class="custom-control-label" for="que5option2">Not too bad, but I have a few issues just like everyone else.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que5" id="que5option3" value="3" required>
                        			<label class="custom-control-label" for="que5option3">I have a number of health issues or concerns (including minor ones).</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q6: Do you feel that your immune system is strong enough to protect you from illnesses?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que6" id="que6option1" value="1" required>
                        			<label class="custom-control-label" for="que6option1">Yes – I have an excellent immune system!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que6" id="que6option2" value="2" required>
                        			<label class="custom-control-label" for="que6option2">More or less, but I am worried about some illnesses.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que6" id="que6option3" value="3" required>
                        			<label class="custom-control-label" for="que6option3">No – I often fall sick and this worries me.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q7: Do your energy levels stop you from living your best life?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que7" id="que7option1" value="1" required>
                        			<label class="custom-control-label" for="que7option1">No – I feel nothing can stop me from achieving my dreams!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que7" id="que7option2" value="2" required>
                        			<label class="custom-control-label" for="que7option2">Sometimes.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que7" id="que7option3" value="3" required>
                        			<label class="custom-control-label" for="que7option3">Yes – I feel lethargic and need a lot of motivation just to get out of bed.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q8: Is your lifestyle causing you unnecessary stress and anxiety?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que8" id="que8option1" value="1" required>
                        			<label class="custom-control-label" for="que8option1">No – I am very content with my lifestyle and have no stress or anxiety!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que8" id="que8option2" value="2" required>
                        			<label class="custom-control-label" for="que8option2">A little bit, but it’s nothing out of the ordinary.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que8" id="que8option3" value="3" required>
                        			<label class="custom-control-label" for="que8option3">Yes – I feel like I need a radical change in my lifestyle.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q9: Do you feel that your metabolism gets in the way of your social life, especially when it comes to going out to eat with friends or relatives?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que9" id="que9option1" value="1" required>
                        			<label class="custom-control-label" for="que9option1">Never – I feel no such thing!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que9" id="que9option2" value="2" required>
                        			<label class="custom-control-label" for="que9option2">Not really, but I would enjoy outside food a lot more if I had a better metabolism.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que9" id="que9option3" value="3" required>
                        			<label class="custom-control-label" for="que9option3">Yes – I often hold myself back when I go out for dinners or social gatherings.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
					<div class="item">
                        <fieldset class="form-group row">
                        	<legend class="col-form-label col-12 pt-0">Q10: Are there any other issues with your general health, such as skin & hair issues, inflammation, lack of appetite, joint pains etc.?</legend>
                        	<div class="col-12">
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que10" id="que10option1" value="1" required>
                        			<label class="custom-control-label" for="que10option1">No – I am absolutely healthy and grateful!</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que10" id="que10option2" value="2" required>
                        			<label class="custom-control-label" for="que10option2">A few, but nothing that worries me too much.</label>
                        		</div>
                        		<div class="custom-control custom-radio">
                        			<input class="custom-control-input" type="radio" name="que10" id="que10option3" value="3" required>
                        			<label class="custom-control-label" for="que10option3">Yes – I have a few issues that I would love to resolve.</label>
                        		</div>
                        	</div>
                        </fieldset>
					</div>
				</div>
				<p id="quizNotice" class="text2">Please select your answer.</p>
				<div class="row quizBtns">
				    <div class="col-4">
					    <a id="customPrevBtn" class="btn prevBtn customPrevBtn">Previous</a>
					</div>
				    <div class="col-4 text-center">
					    <button id="quizSubmit" type="submit" class="btn submitBtn">Finish</button>
					</div>
				    <div class="col-4 text-right">
					    <a id="customNextBtn" class="btn nextBtn customNextBtn">Next</a>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
<script>
	$('#statusModal').modal('show');
	
	$(document).ready(function () {
		var itemNo = 1;
		var quizCaro = $('.quizCaro');
		quizCaro.owlCarousel({
			loop: false,
			items: 1,
			mouseDrag: false,
			touchDrag: false,
			pullDrag: false,
			freeDrag: false,
			dots: false,
			animateOut: 'fadeOut',
	    	animateIn: 'fadeIn',
			onTranslated: callback
		});
		
		function callback(event){
			itemNo = event.item.index;
			itemNo+=1;
			
			if(itemNo == 1){
				document.getElementById("customPrevBtn").style.visibility = "hidden";
			}else{
				document.getElementById("customPrevBtn").style.visibility = "visible";
			}
			
			if(itemNo == 10){
				document.getElementById("customNextBtn").style.visibility = "hidden";
				document.getElementById("quizSubmit").style.visibility = "visible";
			}else{
				document.getElementById("customNextBtn").style.visibility = "visible";
				document.getElementById("quizSubmit").style.visibility = "hidden";
			}
		}
		
		$('.customPrevBtn').click(function() {
			quizCaro.trigger('prev.owl.carousel');
		});
		
		$('.customNextBtn').click(function() {
			if ($("input[name='que"+itemNo+"']:checked").length > 0) {
				document.getElementById("quizNotice").style.visibility = "hidden";
				quizCaro.trigger('next.owl.carousel');
			}else{
				document.getElementById("quizNotice").style.visibility = "visible";
			}
		});
	});
	
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