<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title', 'Home | Vitality Club')</title>
	<meta name="robots" content="noindex, follow">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vc-owl-bootstrap-photoswipe.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/vc-admin-18-11-01.css') }}" />
	<style>@yield('style')</style>
</head>

<body>
    @if(Auth::user()->email === env('ADMIN_EMAIL'))
	    <div id="app">
            <nav class="navbar navbar-fixed navbar-expand-md navbar-light shadow-sm">
                <div class="container-fluid">
                    <div class="row w-100">
	    			<div class="col-md-6">
	    			    <table style="width:100%;height:100%;"><tr><td class="align-middle" style="width:100%;height:100%;">
	    				    <a class="navbar-brand" href="{{ url('admin') }}"><img class="icon" src="{{asset('apple-touch-icon.png')}}"> {{ config('app.name') }}</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>
	    				</td></tr></table>
	    			</div>
	    			<div class="col-md-6 text-right">
	    			    <table style="width:100%;height:100%;"><tr><td class="align-middle" style="width:100%;height:100%;">
                            <div class="collapse navbar-collapse mb-0" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    @guest
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        @php $pic = 'https://ui-avatars.com/api/?name='.str_replace(' ','+',Auth::user()->name).'&color=34205c&background=eae8ee'; @endphp
	    							    <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="line-height:28px;">
                                                <img style="width:28px;height:auto;margin-right:5px;border-radius:50%;" src="{{$pic}}" />{{ Auth::user()->name }} <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
	    			        
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
	    				</td></tr></table>
                    </div>
                </div>
            </nav>
            <main>
                <div class="container-fluid">
                    <div class="row">
                	    <div class="col-md-2 admin-menu-cont">
                			<a href="/admin" class="admin-menu home"><i class="fas fa-home"></i>Home</a>
                			<a href="/admin/orders" class="admin-menu orders"><i class="fas fa-shopping-cart"></i>Orders</a>
	    					<div class="collapse" id="ordersCollapse">
	    					    <a href="/admin/orders" class="admin-menu1 orders">Orders</a>
	    					    <a href="/admin/checkouts" class="admin-menu1 checkouts">Abandoned checkouts</a>
	    					</div>
	    					<a href="/admin/products" class="admin-menu products"><i class="fas fa-tag"></i>Products</a>
	    					<div class="collapse" id="productsCollapse">
	    					    <a href="/admin/products" class="admin-menu1 products">All products</a>
	    					    <a href="/admin/categories" class="admin-menu1 categories">Categories</a>
	    					    <a href="/admin/sub-categories" class="admin-menu1 subcategories">Sub Categories</a>
	    					</div>
	    					<!--<a href="/admin/lookbooks" class="admin-menu lookbooks"><i class="fas fa-tags"></i>Lookbooks</a>-->
	    					<a href="/admin/customers" class="admin-menu customers"><i class="fas fa-user"></i>Customers</a>
	    					<a href="/admin/discounts" class="admin-menu discounts mb-4"><i class="fas fa-percentage"></i>Discounts</a>
							
	    					<a class="admin-subheading">SALES CHANNELS</a>
	    					<a class="admin-menu store" onclick="storeCollapse();"><i class="fas fa-store"></i>Online Store</a> <button class="btn btn-link storeBtn" onclick="window.open('{{config('app.url')}}', '_blank');"><i class="far fa-eye"></i></button>
							<div class="collapse" id="storeCollapse">
	    					    <a href="/admin/homepage/announcement" class="admin-menu1 announcement">Announcement</a>
	    					    <a href="/admin/homepage/slider" class="admin-menu1 slider">Image slider</a>
	    					    <a href="/admin/homepage/image-with-text-overlay" class="admin-menu1 imageWithText">Image with text</a>
	    					    <a href="/admin/homepage/services" class="admin-menu1 services">Image with text 2</a>
	    					</div>
							
	    					<a href="/admin/settings" class="admin-menu settings"><i class="fas fa-cog"></i>Settings</a>
                		</div>
                	    <div class="col-md-10 admin-main-cont">
	    				    @yield('content')
                		</div>
                	</div>
                </div>
            </main>
        </div>
	    <script src="{{ asset('js/vc-jQuery-popper-bootstrap-owl-photoswipe.js') }}"></script>
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	    @yield('scriptContent')
		<script>
		    function storeCollapse(){
				$('#storeCollapse').collapse('toggle');
			}
		</script>
	@else
		<script>window.location = "/myaccount";</script>
	@endif	
</body>

</html>