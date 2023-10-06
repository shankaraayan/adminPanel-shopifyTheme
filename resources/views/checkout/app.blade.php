<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
	
	<meta name="robots" content="no-follow" />
	
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
	
	<div id="app">
	    <main id="mainContent">@yield('content')</main>
    </div>
	<script src="{{ asset('js/vc-jQuery-popper-bootstrap-owl-photoswipe.js') }}"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	@yield('scriptContent')
	<script>
    	if(screen.width > 991){
			$('#cartSummaryCollapse').collapse('show');
		}else{
			$('#cartSummaryCollapse').collapse('hide');
			var totalAmt = document.getElementById("totalCost").innerHTML;
			document.getElementById("orderSummaryAmt").innerHTML = totalAmt;
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
	@yield('endscripts')
</body>
</html>
