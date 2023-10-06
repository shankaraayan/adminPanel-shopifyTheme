@extends('admin.layout')
@section('title','Settings | Vitality Club')
@section('style','.admin-menu.settings{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
    <h1 class="heading1">Settings</h1>
	<div class="container info-cont p-5">
		<div class="row">
			<div class="col-4 settings-block">
			    <a href="/admin/settings/payments" style="color:#626262;text-decoration:none;">
				    <div class="row">
				        <div class="col-2">
				    	    <i class="fas fa-credit-card"></i>
				    	</div>
				    	<div class="col-10">
				    	    <h3 class="info-cont-heading" style="margin-bottom:4px;">Payments</h3>
				    		<p>Enable and manage your store's payment providers</p>
				    	</div>
				    </div>
				</a>
			</div>
			<div class="col-4 settings-block">
			    <a href="/admin/settings/shipping" style="color:#626262;text-decoration:none;">
			    	<div class="row">
			    	    <div class="col-2">
			    		    <i class="fas fa-truck"></i>
			    		</div>
			    		<div class="col-10">
			    		    <h3 class="info-cont-heading" style="margin-bottom:4px;">Shipping and delivery</h3>
			    			<p>Manage how you ship orders to customers</p>
			    		</div>
			    	</div>
			    </a>
			</div>
			<div class="col-4 settings-block">
			    <a href="/admin/settings/taxes" style="color:#626262;text-decoration:none;">
			    	<div class="row">
			    	    <div class="col-2">
			    		    <i class="fas fa-receipt"></i>
			    		</div>
			    		<div class="col-10">
			    		    <h3 class="info-cont-heading" style="margin-bottom:4px;">Taxes</h3>
			    			<p>Manage how you store charges taxes</p>
			    		</div>
			    	</div>
			    </a>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scriptContent')
@endsection