@extends('layouts.app')
@section('title', 'Page not found | Vitality Club')
@section('description','')
@section('canonical','')
@section('style','#mainContent{background-color:#f5f1ec}')
@section('content')
<div id="errorCont" class="container-fluid">
    <div class="container text-center">
        <h3 class="heading1" style="font-family:'Gotham Rounded Book';margin-bottom:25px;">The page you requested was not found.</h3>
        <p class="text1">If you typed the URL directly, please make sure the spelling is correct.</p>
        <p class="text1 gap1">If you clicked on a link to get here, the link is outdated.</p>
        <a class="btn btn-primary" style="margin:23px;" href="/">Continue to Homepage</a>
        <input type="button" value="Go Back" onclick="window.history.back()" class="btn btn-link" style="display:block;margin:0 auto;"/>
    </div>
</div>
@endsection
@section('endscripts')
<script>
    var $nav = $(".fixed-top").height();
	$nav += 15;
	$nav = $nav+"px";
	document.getElementById("errorCont").style.marginTop = $nav;
</script>
@endsection