@extends('admin.layout')
@section('title','Categories | Vitality Club')
@section('style','.admin-menu.products i{color:black;}.admin-menu1.categories{background-color:#eaeaea;border-left:5px solid black;color:black;}')
@section('content')
<div class="container">
	<div class="container p-0 mb-4">
	    <div class="row">
		    <div class="col-6">
			    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
					<h1 class="heading1">Categories</h1>
				</td></tr></table>
			</div>
			<div class="col-6 text-right">
			    <button class="btn btn-primary" onclick="window.location.href='/admin/categories/new'">Add category</button>
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
                			<th scope="col" style="width:100px"></th>
                			<th scope="col">Title</th>
                			<th scope="col">Product conditions</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($categories as $categorie)
		        		<tr class="table-row" data-href="/admin/categories/{{$categorie['id']}}">
                			<td>
							    <div class="img-block mr-0" style="background-image:url('/storage/categories/{{$categorie['categoryImage']}}');"></div>
							</td>
                			<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    {{$categorie['category']}}
								</td></tr></table>
							</td>
                			<td>
							    <table class="table-borderless" style="width:100%;height:100%"><tr><td class="align-middle pl-0" style="width:100%;height:100%">
								    Product category is equal to @php echo strtolower($categorie['category']) @endphp
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
    $('#productsCollapse').collapse('show');
	
	$(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
</script>
@endsection