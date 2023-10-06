@extends('layouts.app')
@section('title','Vitality Club | Superfoods, Tea, Yoga, Life Coaching, Travel etc.')
@section('description','At Vitality Club, we believe in the power of a balanced life. With our superfoods, teas, and life coaching services, in addition to yoga and therapeutic travel, we aim to become your one-stop shop for all things related to vitality, also known as Ojas!')
@section('canonical','https://www.vitalityclub.in/')
@section('style','#home{color:black;}')
@section('content')
<div id="home_banner" class="carousel slide carousel-fade" data-interval="5000">
	<ul class="carousel-indicators">
		@php $bannerCounter = 1; @endphp
		@foreach($banners as $banner)
		<li data-target="#home_banner" data-slide-to="{{$bannerCounter-1}}" @if($bannerCounter == 1) class="active" @endif>0{{$bannerCounter}}</li>
		@php $bannerCounter += 1; @endphp
		@endforeach
	</ul>
	<div class="carousel-inner">
		@php $bannerCounter = 1; @endphp
		@foreach($banners as $banner)
		<div class="carousel-item @if($bannerCounter == 1)active @endif">
			<div class="container containerLimit">
				<div class="row">
					<div class="col-md-6 img-cont">
						@php $parts = explode(".",$banner['banner_img']); @endphp
						@if($parts[1] == "mp4")
							<video autoplay muted loop width="100%" height="auto">
							    <source src="/storage/sliders/{{$banner['banner_img']}}" type="video/mp4">
							</video>
						@else
							<img class="img-fluid" src="/storage/sliders/{{$banner['banner_img']}}" alt="Vitality Club" />
						@endif
					</div>
					<div class="col-md-6 text-cont">
					    <table style="width:100%;height:100%;"><tr><td class="align-middle" style="width:100%;height:100%;">
						    <div class="banner_text">
						    	<h3 class="text1">@php echo str_replace(['&lt;','&gt;'],['<','>'],$banner['banner_text']); @endphp</h3>
						    	<p class="mb-0"><a class="btn btn-primary" href="{{$banner['bannerBtn_link']}}">{{$banner['bannerBtn_text']}}</a></p>
						    </div>
						</td></tr></table>
					</div>
				</div>
			</div>
		</div>
		@php $bannerCounter += 1; @endphp
		@endforeach
	</div>
</div>
<div class="container-fluid p-0">
    <div id="textOverlayCaro" class="carousel slide carousel-fade bsCaro" data-ride="carousel">
    	<ol class="carousel-indicators">
    		@php $bannerCounter = 1; @endphp
    		@foreach($imageTextOverlay as $overlay)
    		<li data-target="#textOverlayCaro" data-slide-to="{{$bannerCounter-1}}" @if($bannerCounter == 1) class="active" @endif></li>
    		@php $bannerCounter += 1; @endphp
    		@endforeach
    	</ol>
    	<div class="carousel-inner">
    		@php $bannerCounter = 1; @endphp
			@foreach($imageTextOverlay as $overlay)
			<div class="carousel-item bckgd2 @if($bannerCounter == 1)active @endif" style="background-image:url('/storage/imageWithText/{{$overlay['banner_img']}}')">
    			<div class="container containerLimit home-projects-cont">
	                <div class="row">
	            	    <div class="col-md-5 info-box">
	            		    <p class="heading2" style="text-transform:initial">{{$overlay['banner_text']}}</p>
	            			@if($overlay['bannerBtn_text'] != "")<p class="mb-0"><a class="btn btn-primary link1" href="{{$overlay['bannerBtn_link']}}">{{$overlay['bannerBtn_text']}}</a></p>@endif
	            		</div>
	            	</div>
	            </div>
    		</div>
			@php $bannerCounter += 1; @endphp
			@endforeach
    	</div>
    	<a class="carousel-control-prev" href="#textOverlayCaro" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    		<span class="sr-only">Previous</span>
    	</a>
    	<a class="carousel-control-next" href="#textOverlayCaro" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
    		<span class="sr-only">Next</span>
    	</a>
    </div>
</div>
<div class="container-fluid home-categories-main-cont">
	<div class="container containerLimit">
		<div class="heading_sec">
			<h3>CATEGORIES</h3>
		</div>
		<div class="owl-carousel category_slide">
			@foreach($categories as $category)
			    <a href="/shop/<?php echo strtolower(str_replace(' ', '-', $category['category'])); ?>">
			        <div class="item">
						<img class="img-fluid" src="/storage/categories/{{$category['categoryImage']}}" alt="{{$category['category']}} | Vitality Club"/>
			        	<p class="category_name">{{$category['category']}}</p>
			        	<p class="discoverMore">Shop now</p>
			        </div>
			    </a>
			@endforeach
		</div>
		<div class="last-border"></div>
	</div>
</div>
<div class="container-fluid home-collections-main-cont">
	<h3 class="section-heading">COMBOS & OFFERS</h3>
	<div id="combos_slide" class="owl-carousel combos_slide">
		@php $i = 1; @endphp
		@foreach($combos as $combo)
		    <div class="item">
		    	<div class="row flex_center m-0">
		    		<div class="col-md-6 p-0">
		    			<img class="owl-lazy" data-src="/storage/shop/{{$combo['product_code']}}/@php echo str_replace('.jpg','-540px.jpg',$combo['product_pic1']) @endphp" alt="{{$combo['product_name']}} | Vitality Club" />
		    		</div>
		    		<div class="col-md-6 text-cont">
		    			<div class="collection_detail">	<span class="collection_number"><img src="{{asset('icons/left-pointer.png')}}"></span>
		    				<h3>{{$combo['product_name']}}</h3>
		    				<p class="discoverMore"><a href="/shop/<?php echo strtolower(str_replace(' ', '-', $combo['product_category'])); ?>/<?php echo strtolower(str_replace(' ', '-', $combo['product_url'])) ?>">Shop Now</a></p>
		    			</div>
		    		</div>
		    	</div>
		    </div>
			@php $i++; @endphp
		@endforeach
	</div>
</div>
<div class="container-fluid p-0">
    <div id="servicesCaro" class="carousel slide carousel-fade bsCaro" data-ride="carousel">
    	<ol class="carousel-indicators">
    		@php $bannerCounter = 1; @endphp
    		@foreach($services as $service)
    		<li data-target="#servicesCaro" data-slide-to="{{$bannerCounter-1}}" @if($bannerCounter == 1) class="active" @endif></li>
    		@php $bannerCounter += 1; @endphp
    		@endforeach
    	</ol>
    	<div class="carousel-inner">
    		@php $bannerCounter = 1; @endphp
			@foreach($services as $service)
			<div class="carousel-item bckgd2 @if($bannerCounter == 1)active @endif" style="background-image:url('/storage/services/{{$service['banner_img']}}')">
    			<div class="container containerLimit home-projects-cont">
	                <div class="row">
	            	    <div class="col-md-5 info-box">
	            		    <p class="heading2" style="text-transform:initial">{{$service['banner_text']}}</p>
	            			@if($service['bannerBtn_text'] != "")<p class="mb-0"><a class="btn btn-primary link1" href="{{$service['bannerBtn_link']}}">{{$service['bannerBtn_text']}}</a></p>@endif
	            		</div>
	            	</div>
	            </div>
    		</div>
			@php $bannerCounter += 1; @endphp
			@endforeach
    	</div>
    	<a class="carousel-control-prev" href="#servicesCaro" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    		<span class="sr-only">Previous</span>
    	</a>
    	<a class="carousel-control-next" href="#servicesCaro" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
    		<span class="sr-only">Next</span>
    	</a>
    </div>
</div>
<div class="container-fluid home-collections-main-cont">
	<h3 class="section-heading">GIFTING</h3>
	<div id="gifting_slide" class="owl-carousel combos_slide">
		@php $i = 1; @endphp
		@foreach($giftings as $gifting)
		    <div class="item">
		    	<div class="row flex_center m-0">
		    		<div class="col-md-6 p-0">
		    			<img class="owl-lazy" data-src="/storage/shop/{{$gifting['product_code']}}/@php echo str_replace('.jpg','-540px.jpg',$gifting['product_pic1']) @endphp" alt="{{$gifting['product_name']}} | Vitality Club" />
		    		</div>
		    		<div class="col-md-6 text-cont">
		    			<div class="collection_detail">	<span class="collection_number"><img src="{{asset('icons/left-pointer.png')}}"></span>
		    				<h3>{{$gifting['product_name']}}</h3>
		    				<p class="discoverMore"><a href="/shop/<?php echo strtolower(str_replace(' ', '-', $gifting['product_category'])); ?>/<?php echo strtolower(str_replace(' ', '-', $gifting['product_url'])) ?>">Shop Now</a></p>
		    			</div>
		    		</div>
		    	</div>
		    </div>
			@php $i++; @endphp
		@endforeach
	</div>
</div>
<div class="container-fluid home-categories-main-cont">
	<div class="container containerLimit">
		<div class="heading_sec">
			<h3>BESTSELLERS</h3>
		</div>
		<div id="bestsellers_caro" class="owl-carousel category_slide">
			@foreach($bestsellers as $bestseller)
			    <a href="/shop/<?php echo strtolower(str_replace(' ', '-', $bestseller['product_category'])); ?>/<?php echo strtolower(str_replace(' ', '-', $bestseller['product_url'])) ?>">
			        <div class="item">
						<img class="img-fluid" src="/storage/shop/{{$bestseller['product_code']}}/@php echo str_replace('.jpg','-540px.jpg',$bestseller['product_pic1']) @endphp" alt="{{$bestseller['product_name']}} | Vitality Club"/>
			        	<p class="category_name">{{$bestseller['product_name']}}</p>
			        	<p class="discoverMore">Shop now</p>
			        </div>
			    </a>
			@endforeach
		</div>
		<div class="last-border"></div>
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
	$(document).ready(function () {
		$('#home_banner').carousel('cycle');
		
		var categoryCaro = $('.category_slide');
		categoryCaro.owlCarousel({
			loop: false,
			nav: true,
			responsive: {
				0: {
					items: 2
				},
				768: {
					items: 3
				},
				1024: {
					items: 4
				}
			}
		});
		categoryCaro.on('changed.owl.carousel', function (event) {
			$(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last');
		});
		
		$('#combos_slide').owlCarousel({
			lazyLoad:true,
			margin:0,
			loop:true,
			dots:true,
			smartSpeed: 1000,
			autoplay: false,
			nav: true,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				}
			}
		});
		
		$('#gifting_slide').owlCarousel({
			lazyLoad:true,
			margin:0,
			loop:true,
			dots:true,
			smartSpeed: 1000,
			autoplay: false,
			nav: true,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				}
			}
		});
		
		var bestsellersCaro = $('#bestsellers_caro');
		bestsellersCaro.owlCarousel({
			loop: false,
			nav: true,
			responsive: {
				0: {
					items: 2
				},
				768: {
					items: 3
				},
				1024: {
					items: 4
				}
			}
		});
		bestsellersCaro.on('changed.owl.carousel', function (event) {
			$(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last');
		});
	});
</script>
@endsection