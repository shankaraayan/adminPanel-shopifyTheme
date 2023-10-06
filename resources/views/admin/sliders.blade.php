@extends('admin.layout')
@section('title','Image Slider | Vitality Club')
@section('style','.admin-menu.store i{color:black;}.admin-menu1.slider{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
	<div class="container p-0 mb-4">
	    <div class="row">
		    <div class="col-6">
			    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
					<h1 class="heading1">Image Slider</h1>
				</td></tr></table>
			</div>
			<div class="col-6 text-right">
			    <button class="btn btn-primary" onclick="window.location.href='/admin/homepage/slider/new'">Add slider</button>
			</div>
		</div>
	</div>
	<div class="container info-cont">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        	<li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
        	</li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        	<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-home-tab">
	            <table class="table">
                	<thead>
                		<tr>
                			<th scope="col" style="width:120px"></th>
                			<th scope="col" style="width:60%">Description</th>
                			<th scope="col">Button Label</th>
                			<th scope="col">Button Link</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($banners as $banner)
		        		<tr class="table-row" data-href="/admin/homepage/slider/{{$banner['id']}}">
                			<td>
							    @php $parts = explode(".",$banner['banner_img']); @endphp
								@if($parts[1] == "mp4")
									<video autoplay loop muted width="120px" height="auto">
									    <source src="/storage/sliders/{{$banner['banner_img']}}" type="video/mp4">
									</video>
								@else
									<img class="img-fluid" src="/storage/sliders/{{$banner['banner_img']}}" />
								@endif
							</td>
                			<td style="width:50%">
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    {{$banner['banner_text']}}
								</td></tr></table>
							</td>
                			<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    {{$banner['bannerBtn_text']}}
								</td></tr></table>
							</td>
							<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    {{$banner['bannerBtn_link']}}
								</td></tr></table>
							</td>
                		</tr>
		        		@endforeach
                	</tbody>
                </table>
        	</div>
        </div>
	</div>
</div>
@endsection
@section('scriptContent')
<script>
    $('#storeCollapse').collapse('show');
	
	$(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
</script>
@endsection