<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title', 'Vitality Club')</title>
	<meta name="description" content="@yield('description')"/>
	<meta name="keywords" content=""/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="facebook-domain-verification" content="6c8f5q9rss6przago6vc41myxc9xsx" />
	
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
	
	<meta property="og:locale" content="en" />
	<meta property="og:type" content="Website" />
	<meta property="og:url" content="" />
	<meta property="og:title" content="@yield('title', 'Vitality Club')" />
	<meta property="og:description" content="@yield('description')" />
	<meta property="og:image" content="{{asset('images/vitality-club-main-logo.jpg')}}" />
	<meta property="og:site_name" content="Vitality Club" />
	<meta name="robots" content="index,follow" />
	<meta name="robots" content="All" />
	<link rel="canonical" href="@yield('canonical')">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vc-owl-bootstrap-photoswipe.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vc-30-11-1.css') }}" />
	
	<style>@yield('style')</style>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-198133641-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-198133641-1');
	  gtag('config', 'AW-360341349');
	  gtag('event', 'page_view', {
		  page_title: '@yield("title")',
		  page_location: '@yield("canonical")',
		  page_path: '@yield("canonical")',
		  send_to: '<UA-198133641-1>'
		});
    </script>
	
	<!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '554121345772950');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=554121345772950&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->

</head>

<body>
	<div id="app" style="position:relative;">
	    <header>
	        <nav id="navbar" class="navbar fixed-top navbar-expand-md navbar-light">
	        	@foreach($data['announcement'] as $announce)
				@if($announce['heading'] != "" || $announce['description'] != "")
				<div id="announcementBar" class="container-fluid announcementBar" @if($announce['background_color'] != "")style="background-color:{{$announce['background_color']}}" @endif>
				    <div class="container containerLimit" style="flex-direction:column;">
					    <p class="heading mb-0" @if($announce['text_color'] != "")style="color:{{$announce['text_color']}}" @endif>@php echo str_replace(['&lt;','&gt;'],['<','>'],$announce['heading']); @endphp</p>
						<p class="description mb-0" @if($announce['text_color'] != "")style="color:{{$announce['text_color']}}" @endif>@php echo str_replace(['&lt;','&gt;'],['<','>'],$announce['description']); @endphp</p>
					</div>
				</div>
				@endif
				@endforeach
				<div class="container containerLimit menuBar">
				    <a class="navbar-brand" href="/">
	        	    	<img class="logo" src="{{asset('images/vitality-club-main-logo.jpg')}}" alt="Vitality Club" title="Vitality Club" />
	        	    </a>
	        	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
	        	    </button>
	        	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	        	    	<ul class="navbar-nav ml-auto mr-auto">
	        	    		<li class="nav-item"> <a id="home" class="nav-link" href="/">Home</a></li>
	        	    		<li class="nav-item dropdown">
								<a id="shop" class="nav-link dropbtn" style="cursor:pointer;" id="navbardrop1" data-toggle="dropdown">Shop</a>
								<ul class="dropdown-content">
								    <li class="shopMenu-subheading"><a href="/shop" class="menu-item">All Products</a></li>
									@foreach($data['categories'] as $categorie)
									    @if(count($data['subCategories']->where('parentCategory', $categorie['category'])) > 0)
									    <li class="shopMenu-subheading dropright"><a href="/shop/@php echo str_replace(' ','-',strtolower($categorie['category'])) @endphp" class="menu-item">{{$categorie['category']}} <span class="caret"></span></a>
									        <ul class="dropdown-menu">
									    	    @foreach($data['subCategories']->where('parentCategory', $categorie['category']) as $subCategorie)
									    		<li class="shopMenu-subheading1"><a href="/shop/@php echo str_replace(' ','-',strtolower($subCategorie['parentCategory'])) @endphp/@php echo str_replace(' ','-',strtolower($subCategorie['subCategory'])) @endphp" class="menu-item">{{$subCategorie['subCategory']}}</a></li>
									    		@endforeach
									    	</ul>
									    </li>
										@else
										<li class="shopMenu-subheading"><a href="/shop/@php echo str_replace(' ','-',strtolower($categorie['category'])) @endphp" class="menu-item">{{$categorie['category']}}</a></li>
										@endif
									@endforeach
								</ul>
							</li>
							<li class="nav-item"> <a id="gifting" class="nav-link" href="/shop/gifts">Gifting</a></li>
							<li class="nav-item"> <a id="aboutUs" class="nav-link" href="/about-us">About Us</a></li>
	        	    		<li class="nav-item"> <a id="contactUs" class="nav-link" href="/contact-us">Contact Us</a></li>
							<li class="nav-item dropdown">
								<a id="more" class="nav-link dropbtn" style="cursor:pointer;" id="navbardrop1" data-toggle="dropdown">More</a>
								<ul class="dropdown-content">
								    <li class="shopMenu-subheading"><a href="/vitality-quiz" class="menu-item">Vitality Quiz</a></li>
								    <li class="shopMenu-subheading"><a href="/roots-of-vitality" class="menu-item">Roots of Vitality</a></li>
								    <li class="shopMenu-subheading"><a href="/blog" class="menu-item" target="_blank">Blog</a></li>
								</ul>
							</li>
	        	    	</ul>
	        	    	<div class="ecom-actions">
							<button id="accountBtn" class="accountBtn" onclick="window.location='/login'" title="Account"><i class="fas fa-user"></i></button>
					        <button id="searchBtn" class="searchBtn" onclick="showSearchBar()" title="Search"><i class="fas fa-search"></i></button>
					        <div class="cartdropbtn" style="position:relative">
							    <button id="shoppingBagBtn" class="shoppingBagBtn" onclick="window.location='/cart'" title="Shopping Cart" data-toggle="dropdown"><i class="fas fa-shopping-cart"></i><span id="cartCount" class="cartCount">@php echo count((array) session('cart')) @endphp</span></button>
							    <div class="dropdown-menu dropdown-menu-right m-0">
									<div id="cartProduct" class="cartProduct">
									    @if(count((array) session('cart')) > 0)
										    @foreach(session('cart') as $products => $product)
										    <div class="row cart-row">
										        <img class="img-block" src="/storage/shop/@php echo str_replace(' ','-',strtoupper($product['code'])) @endphp/{{$product['image']}}" />
										    	<div class="info-block">
										    	    <p><a href="/shop/<?php echo strtolower(str_replace(' ', '-', $product['category'])); ?>/{{$product['url']}}">{{$product['name']}}</a></p>
										    		@if($product['variantValue'] != "")
										    			<p>{{$product['variantValue']}}</p>
										    		@endif
										    		<p>Quantity: {{$product['quantity']}}</p>
										    		<p class="mb-0">INR <?php echo number_format($product['price'] * $product['quantity']) ?></p>
										    	</div>
										    </div>
										    @endforeach
										    <button class="btn viewCartBtn" onclick="window.location='/cart'">View Cart</button>
									    @else
									    	<p class="emptyCart text-center mb-0">Your shopping cart is currently empty.</p>
									    @endif
									</div>
                                </div>
                            </div>
	        	    	</div>
	        	    </div>
	        	</div>
	        </nav>
		</header>
		<div id="mobNav" class="mobileNav onlyOnMobile">
		    <div class="container-fluid topPart p-0">
			    @foreach($data['announcement'] as $announce)
				@if($announce['heading'] != "" || $announce['description'] != "")
				<div id="announcementBar" class="container-fluid announcementBar" @if($announce['background_color'] != "")style="background-color:{{$announce['background_color']}}" @endif>
				    <div class="container containerLimit" style="flex-direction:column;">
					    <p class="heading mb-0" @if($announce['text_color'] != "")style="color:{{$announce['text_color']}}" @endif>@php echo str_replace(['&lt;','&gt;'],['<','>'],$announce['heading']); @endphp</p>
						<p class="description mb-0" @if($announce['text_color'] != "")style="color:{{$announce['text_color']}}" @endif>@php echo str_replace(['&lt;','&gt;'],['<','>'],$announce['description']); @endphp</p>
					</div>
				</div>
				@endif
				@endforeach
			</div>
			<div class="container-fluid bottomPart">
		        <div class="brandLogo">
			        <p class="text-center mb-0"><a href="/"><img class="brandLogo-img" src="{{asset('images/vitality-club-main-logo.jpg')}}" alt="Vitality Club" title="Vitality Club" /></a></p>
			    </div>
		        <div class="ecom-actions text-right">
			        <button class="searchBtn" onclick="showSearchBar()" title="Search"><i class="fas fa-search"></i></button>
					<button class="accountBtn" onclick="window.location='/login'" title="Account"><i class="fas fa-user"></i></button>
			    	<button class="shoppingBagBtn" onclick="window.location='/cart'" title="Shopping Bag"><i class="fas fa-shopping-cart"></i><span id="cartCountMob" class="cartCount">@php echo count((array) session('cart')) @endphp</span></button>
			    </div>
				<div class="hamburger">
			        <button class="btn btn-link" onclick="openSideNav()">
			    	    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			    	        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
			    	    </svg>
			    	</button>
			    </div>
			</div>
		</div>
        <div id="mySidenav" class="sidenav onlyOnMobile">
			<table style="width:100%;height:100%;"><tr>
			<td class="align-top" style="width:20%;height:100%;background-color:rgba(0,0,0,0.33);">
			</td>
			<td class="align-top" style="width:80%;height:100%;background-color:white;padding:10px 0 20px 0;">
			    <p class="navCloseBtnCont text-right"><button class="btn btn-link closebtn" onclick="closeSideNav()">&times;</button></p>
                <div class="sidenav-cont">
			        <p class="menu-hading"><i>Vitality</i> <b>Club</b></p>
			    	<a class="btn btn-link" href="/" style="border-top:1px solid #4c4c4c">HOME</a>
                    <div class="accordion" id="shopAccordion">
                    	<div class="card">
                    		<div class="card-header" id="headingOne">
                    			<h2 class="mb-0"><button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">SHOP</button></h2>
                    		</div>
                    		<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#shopAccordion">
                    			<div class="card-body">
			    					<a href="/shop" class="btn-link text-left mainShop">All Products</a>
			    					@foreach($data['categories'] as $categorie)
			    					    @if(count($data['subCategories']->where('parentCategory', $categorie['category'])) > 0)
			    						<div class="accordion" id="categoryAccordion">
                                        	<div class="card">
                                        		<div class="card-header" id="heading{{$categorie['id']}}">
                                        			<h2 class="mb-0"><button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$categorie['id']}}" aria-expanded="false" aria-controls="collapse{{$categorie['id']}}">{{$categorie['category']}}</button></h2>
                                        		</div>
                                        		<div id="collapse{{$categorie['id']}}" class="collapse" aria-labelledby="heading{{$categorie['id']}}" data-parent="#categoryAccordion">
                                        			<div class="card-body">
			    					    				<a href="/shop/@php echo str_replace(' ','-',strtolower($categorie['category'])) @endphp" class="sidsidenav-link">All {{$categorie['category']}}</a>
			    										@foreach($data['subCategories']->where('parentCategory', $categorie['category']) as $subCategorie)
			    					    			    <a href="/shop/@php echo str_replace(' ','-',strtolower($subCategorie['parentCategory'])) @endphp/@php echo str_replace(' ','-',strtolower($subCategorie['subCategory'])) @endphp" class="sidsidenav-link">{{$subCategorie['subCategory']}}</a>
			    					    				@endforeach
			    	                    			</div>
                                        		</div>
                                        	</div>
                                        </div>
			    						@else
			    						<a href="/shop/@php echo str_replace(' ','-',strtolower($categorie['category'])) @endphp" class="btn-link text-left mainShop">{{$categorie['category']}}</a>
			    						@endif
			    					@endforeach
			    				</div>
                    		</div>
                    	</div>
                    </div>
			    	<a class="btn btn-link" href="/shop/gifts">GIFTING</a>
			    	<a class="btn btn-link" href="/about-us">ABOUT US</a>
			    	<a class="btn btn-link" href="/contact-us">CONTACT US</a>
					<div class="accordion" id="moreAccordion">
                    	<div class="card">
                    		<div class="card-header" id="heading1">
                    			<h2 class="mb-0"><button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">MORE</button></h2>
                    		</div>
                    		<div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#moreAccordion">
                    			<div class="card-body">
			    					<a href="/vitality-quiz" class="btn-link text-left mainShop">Vitality Quiz</a>
			    					<a href="/roots-of-vitality" class="btn-link text-left mainShop">Roots of Vitality</a>
			    					<a href="/blog" class="btn-link text-left mainShop" target="_blank">Blog</a>
			    				</div>
                    		</div>
                    	</div>
                    </div>
			    </div>
			    @guest
			    <button class="btn btn-primary loginBtn" onclick="window.location='/login'">LOGIN / SIGN UP</button>
			    @endguest
			    @auth
			    <button class="btn btn-primary loginBtn" onclick="window.location='/myaccount'">MY ACCOUNT</button>
			    @endauth
			</td></tr></table>
        </div>
		@if(session('status') == "Thank you for subscribing!")
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            	<div class="modal-dialog modal-dialog-centered" role="document">
            		<div class="modal-content">
            			<div class="modal-body">
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
            				</button>
            				<p class="success_icon text-center pt-3 pb-2"><i class="fas fa-check-circle"></i>
            				</p>
            				<p class="modal-content text-center pb-4">{{ session('status') }}</p>
            			</div>
            		</div>
            	</div>
            </div>
        @endif
		<main id="mainContent">@yield('content')</main>
	    <footer>
	    	<div class="container containerLimit">
	    		<div class="row">
	    			<div class="col-md-3">
	    				<p class="footer-heading">Vitality Club</p>
	    				<p class="footer-link"><a href="/about-us">About Us</a></p>
	    				<p class="footer-link"><a href="/privacy-policy">Privacy Policy</a></p>
	    				<p class="footer-link"><a href="/terms-of-service">Terms of Service</a></p>
						<p class="footer-link"><a href="/faqs">FAQs</a></p>
	    				<p class="footer-link"><a href="/contact-us">Contact Us</a></p>
	    			</div>
	    			<div class="col-md-3">
	    				<p class="footer-heading">Customer Care</p>
	    				<p class="footer-link"><a href="/shipping-policy">Shipping Policy</a></p>
	    				<p class="footer-link"><a href="/cancellation-policy">Cancellation Policy</a></p>
	    				<p class="footer-link"><a href="/return-policy">Return Policy</a></p>
	    				<p class="footer-text"><img style="width:33.33%;height:auto;" src="/images/fssai.png" /></p>
						<p class="footer-text">FSSAI License: <span style="color:black;text-decoration:none;">10020011008074</span></p>
	    			</div>
	    			<div class="col-md-3">
	    				<p class="footer-heading">Stay in touch</p>
						<p class="footer-text">Follow us to know more about the latest products and offers.</p>
	    				<p class="footer-link"><a href="mailto:hello@vitalityclub.in" style="color:black">hello@vitalityclub.in</a></p>
						<p class="footer-link"><a href="https://www.instagram.com/vitalityclub.in" target="_blank"><i class="fab fa-instagram"></i></a> <a href="https://www.facebook.com/vitalityclub.in" target="_blank"><i class="fab fa-facebook-square"></i></a></p>
	    			</div>
					<div class="col-md-3">
					    <p class="footer-heading">Newsletter</p>
						<p class="footer-text">Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
						<form id="signUp-form" action="/sign-up" method="post" class="footer-signupForm">
				            @csrf
    	                	<div class="form-row">
    	                		<div class="col-12">
    	                			<input type="email" class="form-control email_field" id="validationCustom01" name="email" value="{{old('email')}}" placeholder="Your email address" required>
    	                		</div>
    	                		<div class="col-12">
    	                			<button class="btn btn-primary signup_btn" type="submit">Subscribe</button>
    	                		</div>
    	                	</div>
    	                </form>
	    			</div>
	    		</div>
				<div class="row last-row">
				    <div class="col-md-12">
					    <p class="footer-text mb-0">© 'Vitality Club' and its logo and likeness are a trademark of Candid India. Any unauthorised use or imitation may result in legal action. All Rights Reserved.</p>
					</div>
				</div>
	    	</div>
	    </footer>
	    <div class="back-to-top-box"><a class="back-to-top"><i class="fas fa-chevron-up"></i></a></div>
	</div>
	<div id="searchBar" class="searchBar">
        <form class="searchForm">
    	    <div class="form-group">
    	        <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search our store" autocomplete="off" autofocus>
    	    </div>
    	</form>
    	<button class="btn btn-link closeSearchBtn" onclick="closeSearchBar()">&times;</button>
    	<div class="container">
    	    <div id="searchRow" class="row"></div>
    	</div>
    </div>
	<script src="{{ asset('js/vc-jQuery-popper-bootstrap-owl-photoswipe.js') }}"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	@yield('scriptContent')
	<script>
		$(document).ready(function () {
	        if(screen.width > 767){
		        var nav1 = $(".fixed-top");
				var nav2 = $(".menuBar");
				var navHeight1 = nav1.height();
				var navHeight2 = nav2.height();
				
		        $(function(){$(document).scroll(function(){nav1.toggleClass('scrolled', $(this).scrollTop() > navHeight1);});});
				
				var navbarHeight = navHeight1+'px';
				var menuItemHeight = navHeight2+'px';
		        
		        var navLinksCont = document.getElementById("navbar");
		        var navLinks = navLinksCont.getElementsByClassName("nav-link");
		        var navLinksCounter;
		        for (navLinksCounter = 0; navLinksCounter < navLinks.length; navLinksCounter++) {
		        	navLinks[navLinksCounter].style.lineHeight = menuItemHeight;
		        }
		    	document.getElementById("accountBtn").style.height = menuItemHeight;
		    	document.getElementById("searchBtn").style.height = menuItemHeight;
		    	document.getElementById("shoppingBagBtn").style.height = menuItemHeight;
				document.getElementById("mainContent").style.paddingTop = navbarHeight;
		    	
		    }else{
		    	var nav = $(".mobileNav");
				var navHeight = nav.height();
				
				$(document).scroll(function () {
                	$nav.toggleClass('scrolled', $(this).scrollTop() > 0);
		    	});
				var menuItemHeight = navHeight+'px';
		        document.getElementById("mainContent").style.paddingTop = menuItemHeight;
		    }
		});
		
		function openSideNav(){
			document.getElementById("mySidenav").style.width = "100%";
			$('body').css('overflow', 'hidden');
		}
		function closeSideNav(){
			document.getElementById("mySidenav").style.width = "0";
			$('body').css('overflow', 'auto');
		}
		function showSearchBar(){
			document.getElementById("searchBar").style.height = "100vh";
			$('body').css('overflow', 'hidden');
		}
		function closeSearchBar(){
			document.getElementById("searchBar").style.height = "0";
			$('body').css('overflow', 'auto');
			document.getElementById("searchInput").value = "";
			$('#searchRow').html('');
		}
		
		var amountScrolled = 250;
		$(window).scroll(function(){$(window).scrollTop()>amountScrolled?$(".back-to-top").fadeIn("slow"):$(".back-to-top").fadeOut("slow")}),$(".back-to-top").click(function(){return $("html, body").animate({scrollTop:0},700),!1})
	</script>
	@yield('endscripts')
	<script type="text/javascript">
        $('#searchInput').on('keyup',function(){
    		$value=$(this).val();
    		$.ajax({
    			type : 'get',
    			url : '{{URL::to('search')}}',
    			data:{'search':$value},
    			success:function(data){
    				$('#searchRow').html(data);
    			}
    		});
    	});
    </script>
</body>

</html>