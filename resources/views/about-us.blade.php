@extends('layouts.app')
@section('title','About Us | Vitality Club')
@section('description','')
@section('keywords','')
@section('canonical','https://www.vitalityclub.in/about-us')
@section('style','#aboutUs{color:black;}')
@section('content')
<div class="container-fluid">
    <div class="container containerLimit">
    	<div class="row breadcrubs-main-cont">
    		<div class="col-12">
    			<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">About us</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid aboutUs-bckgd">
    <div class="container containerLimit aboutUs-cont">
		<div class="aboutUs-heading">About Us</div>
		<img src="{{asset('images/about-us/vitality-club-about-us-01.jpg')}}" class="aboutUs-banner"/>
	</div>
</div>
<div class="container-fluid vision-bckgd vision-backgrounds">
    <div class="container containerLimit vision-cont">
	    <div class="row justify-content-center">
			<div class="col-md-9 text-center">
			    <p class="heading2">Our Vision</p>
				<p class="text1"><i>Enabling Vitality: The Root of Wellness</i><br/><br/>Vitality, also known as ‘Ojas’, is the bright aura of radiant health and youthful energy that stems from a life of wellness. This energy is universally appealing and is at the centre of a balanced life filled with enthusiasm, joy, abundance, and confidence!</p>
				<p class="text1">At Vitality Club, we believe that a person with good Ojas is calm and content, and has clarity of thought and confidence in action. Such a person also has the willingness required to manifest and sustain a life of prosperity for him/herself.</p>
				<p class="text1 mb-0">Our vision, thus, is to enable this radiant energy, and to create a community of vibrant individuals who cherish, desire and celebrate it!</p>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="container containerLimit mission-cont">
	    <div class="row">
			<div class="col-md-6 order-md-2">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <img src="{{asset('images/about-us/vitality-club-about-us-02.jpg')}}" class="mission-banner"/>
				</td></tr></table>
			</div>
		    <div class="col-md-6 order-md-1">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <p class="heading2">Our Mission</p>
					<p class="text1">At Vitality Club, it is our endeavour to provide you with a wide range of holistic superfoods, wellness services, as well as life experience enhancing mentorship and coaching, all of which lead to good Ojas – which, itself, ultimately results in strong immunity, a peaceful mind, a sense of belonging, as well as the confidence and self-worth required for living a balanced and healthy life!</p>
					<p class="text1 mb-0">We believe in providing you with a one-stop-shop for a holistic lifestyle which will help you in taking care of your entire self – mind, body, and spirit.</p>
				</td></tr></table>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid vision-bckgd">
    <div class="container containerLimit vision-cont Philosophy">
	    <div class="row">
			<div class="col-md-7 Philosophy1">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <img src="{{asset('images/about-us/vitality-club-about-us-03.jpg')}}" class="vision-banner"/>
				</td></tr></table>
			</div>
			<div class="col-md-5 Philosophy2">
			    <table style="width:100%;height:100%"><tr><td class="align-middle" style="width:100%;height:100%">
				    <p class="heading2">Our Philosophy</p>
				    <p class="text1">Our philosophy is based on the yogic concept of the ‘Mooladhara Chakra’, also known as the Root, or ‘Beej’ Chakra.</p>
				    <p class="text1">The chakras are subtle energy centres in the human body associated with specific needs and purposes. The mooladhara chakra, which is the first (or the base) chakra in the traditional yogic system, is associated with food and nutrition, safety and wellbeing, and the earth and vitality.</p>
				    <p class="text1">A balanced and fulfilled root chakra is at the core of good health and wellbeing, a structured and stable life, a strong connection to family and community, a sense of leadership and responsibility, and a feeling of completeness and oneness with all living beings. When the root chakra is aligned, it enables one to look beyond their base needs and towards their true calling, or their higher purpose in life.</p>
				    <p class="text1 mb-0">We believe that, through high quality superfoods, therapeutic and life experience enhancing services, we can help you meet and exceed these basic needs, which will help you to live a life of balance, stability and abundance – ultimately enabling you to pursue your more ambitious goals in life!</p>
				</td></tr></table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
@endsection
@section('endscripts')
@endsection