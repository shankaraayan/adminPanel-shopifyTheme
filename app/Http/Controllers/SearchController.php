<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
		if($request->ajax())
		{
			$query = $request->search;
			$output = "";
			$products = Products::where('product_category', 'like', '%'.$query.'%')
			    ->orWhere('product_subCategory', 'like', '%'.$query.'%')
				->orWhere('product_name', 'like', '%'.$query.'%')
				->orWhere('product_description', 'like', '%'.$query.'%')
				->orWhere('product_ingredients', 'like', '%'.$query.'%')
				->orWhere('product_nutritionalFacts', 'like', '%'.$query.'%')
				->orWhere('product_benefits', 'like', '%'.$query.'%')
				->orWhere('product_otherInfo', 'like', '%'.$query.'%')
				->get();
				
			$products = $products->where('product_status', 'Active');
				
			if($query != ""){
			    if(count($products) > 0)
			    {
			    	$output.='<p class="text-center w-100 text1">Your search for "'.$query.'" revealed the following:</p>';
			    	foreach($products as $product){
			    		$output.='<div class="col-md-3 col-6 product-block">'.
			    		'<a class="proLink" href="/shop/'.strtolower(str_replace(' ', '-', $product->product_category)).'/'.strtolower(str_replace(' ', '-', $product->product_url )).'">'.
						'<img class="proImage" src="/storage/shop/'.str_replace(' ','-',strtoupper($product->product_code)).'/'.str_replace('.jpg','-540px.jpg',$product['product_pic1']).'" />'.
			    		'</a>'.
			    		'<p class="mb-0 proName text-center">'.$product->product_name.'</p>'.
                        '</div>';
			    	}
			    	return Response($output);
			    }else{
			    	$output.='<p class="text-center w-100 text1">Your search for "'.$query.'" did not yield any results.</p>';
			    	return Response($output);
			    }
			}else{
				$output = "";
				return Response($output);
			}
		}
	}
}
