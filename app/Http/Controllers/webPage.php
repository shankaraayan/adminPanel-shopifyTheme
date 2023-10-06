<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use App\Models\subCategories;
use App\Models\Filters;
use App\Models\User;
use App\Models\Customers;
use App\Models\Enquiries;
use App\Models\banners;
use App\Models\image_with_text_overlay;
use App\Models\services;

use App\Mail\Support;
use App\Jobs\processEnquiry;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class webPage extends Controller
{
	public function home(){
		$banners = banners::get();
		$imageTextOverlay = image_with_text_overlay::get();
		$categories = Categories::get();
		$combos = Products::where([['product_category','Combos & Offers'],['product_status','Active']])->orderBy('product_most-viewed', 'desc')->limit(8)->get();
		$services = services::get();
		$giftings = Products::where([['product_category','Gifts'],['product_status','Active']])->orderBy('product_most-viewed', 'desc')->limit(8)->get();
		$bestsellers = Products::where('product_status','Active')->orderBy('product_most-viewed', 'desc')->limit(8)->get();
		return view('home', ['banners'=>$banners, 'imageTextOverlay'=>$imageTextOverlay, 'categories'=>$categories, 'combos'=>$combos, 'services'=>$services, 'giftings'=>$giftings, 'bestsellers'=>$bestsellers]);
	}
	
	public function shop1($type){
		$type_array = explode("+",$type);
		$filters = collect();
		$orderBy = ['id', 'desc'];
		
		for($i=1;$i<count($type_array);$i++){
			$type_array[$i] = ucwords(str_replace('-',' ',$type_array[$i]));
			$filterInfo = Filters::where('filter_value', $type_array[$i])->get();
			
			if($filterInfo[0]['filter_type'] == "sorting"){
				if($filterInfo[0]['filter_value'] == "Price Lowest"){
		        	$orderBy = ['product_price', 'asc'];
		        }elseif($filterInfo[0]['filter_value'] == "Price Highest"){
		        	$orderBy = ['product_price', 'desc'];
		        }else{}
			}else{
				$filters->push([$filterInfo[0]['filter_type'], $filterInfo[0]['filter_value']]);
			}
		}
		$title = 'Buy';
		$i = 0;
		foreach($filters as $filter){
			if($filter[1] == "Below 250" || $filter[1] == "250 500" || $filter[1] ==  "500 750" || $filter[1] == "750 1000" || $filter[1] == "Above 1000"){
				
			}else{
				$title = $title.' '.$filter[1];
			}
		}
		$title = $title.' products';
		$filters->push(['product_status', 'Active']);
		
		$products = Products::where($filters->toArray())->orderBy($orderBy[0], $orderBy[1])->paginate(18);
		
		$allProducts = Products::where("product_status","Active")->orderBy($orderBy[0], $orderBy[1])->get();
		$categories = Categories::get()->sortBy('category');
		$subCategories = $allProducts->unique('product_subCategory')->sortBy('product_subCategory');
		$prices = $allProducts->unique('price_filter')->sortBy('product_price');
		$healthBenefits = $allProducts->unique('product_healthBenefit')->sortBy('product_healthBenefit');
		
		$url = URL::current();
		
		return view('collection', ['products'=>$products, 'type'=>$title, 'categories'=>$categories, 'subCategories'=>$subCategories, 'prices'=>$prices, 'healthBenefits'=>$healthBenefits, 'breadCrumbType'=>1, 'url'=>$url]);
	}
	
	public function shop2($type){
		$type_array = explode("+",$type);
		$filters = collect();
		$orderBy = ['id', 'desc'];
		$productCategory;
		
		for($i=0;$i<count($type_array);$i++){
			$type_array[$i] = ucwords(str_replace('-',' ',$type_array[$i]));
			$filterInfo = Filters::where('filter_value', $type_array[$i])->get();
			
			if($filterInfo[0]['filter_type'] == "sorting"){
				if($filterInfo[0]['filter_value'] == "Price Lowest"){
		        	$orderBy = ['product_price', 'asc'];
		        }elseif($filterInfo[0]['filter_value'] == "Price Highest"){
		        	$orderBy = ['product_price', 'desc'];
		        }else{}
			}else{
				$filters->push([$filterInfo[0]['filter_type'], $filterInfo[0]['filter_value']]);
				if($filterInfo[0]['filter_type'] == 'product_category'){
					$productCategory = $filterInfo[0]['filter_value'];
				}
			}
		}
		$title = 'Buy';
		$i = 0;
		foreach($filters as $filter){
			if($filter[1] == "Below 250" || $filter[1] == "250 500" || $filter[1] ==  "500 750" || $filter[1] == "750 1000" || $filter[1] == "Above 1000"){
				
			}else{
				($i ==0 ) ? $title = $title.' '.$filter[1] : $title = $title.' for '.$filter[1];
				$i++;
			}
		}
		$filters->push(['product_status', 'Active']);
		
		$products = Products::where($filters->toArray())->orderBy($orderBy[0], $orderBy[1])->paginate(18);
		
		$allProducts = Products::where([["product_category",$productCategory],["product_status","Active"]])->orderBy($orderBy[0], $orderBy[1])->get();
		$categories = Categories::get()->sortBy('category');
		$subCategories = subCategories::get()->sortBy('subCategory');
		$healthBenefits = $allProducts->unique('product_healthBenefit')->sortBy('product_healthBenefit');
		$prices = $allProducts->unique('price_filter')->sortBy('product_price');
		
		$categoryInfo = Categories::where('category',$productCategory)->first();
		
		$url = URL::current();
		
		return view('collection', ['categoryInfo'=>$categoryInfo, 'products'=>$products, 'type'=>$title, 'categories'=>$categories, 'subCategories'=>$subCategories, 'prices'=>$prices, 'healthBenefits'=>$healthBenefits, 'breadCrumbType'=>2, 'url'=>$url]);
	}
	
	public function product($type, $product_url){
		$type_array = explode("+",$product_url);
		$isItSubCategory = subCategories::where('subCategory', ucwords(str_replace('-',' ',$type_array[0])))->get();
		
		if(count($isItSubCategory) > 0){
		    $filters = collect();
		    $orderBy = ['id', 'desc'];
			$productsubCategory;
		    
		    for($i=0;$i<count($type_array);$i++){
		    	$type_array[$i] = ucwords(str_replace('-',' ',$type_array[$i]));
		    	$filterInfo = Filters::where('filter_value', $type_array[$i])->get();
		    	
		    	if($filterInfo[0]['filter_type'] == "sorting"){
		    		if($filterInfo[0]['filter_value'] == "Price Lowest"){
		            	$orderBy = ['product_price', 'asc'];
		            }elseif($filterInfo[0]['filter_value'] == "Price Highest"){
		            	$orderBy = ['product_price', 'desc'];
		            }else{}
		    	}else{
		    		$filters->push([$filterInfo[0]['filter_type'], $filterInfo[0]['filter_value']]);
					if($filterInfo[0]['filter_type'] == 'product_subCategory'){
						$productsubCategory = $filterInfo[0]['filter_value'];
					}
		    	}
		    }
		    $title = 'Buy ';
		    $i = 0;
		    foreach($filters as $filter){
				if($filter[1] == "Below 250" || $filter[1] == "250 500" || $filter[1] ==  "500 750" || $filter[1] == "750 1000" || $filter[1] == "Above 1000"){
					
				}else{
					($i ==0 ) ? $title = $title.' '.$filter[1] : $title = $title.' for '.$filter[1];
					$i++;
				}
		    }
		    $filters->push(['product_status', 'Active']);
		    
		    $products = Products::where($filters->toArray())->orderBy($orderBy[0], $orderBy[1])->paginate(18);
		    
		    $allProducts = Products::where([["product_subCategory",$productsubCategory],["product_status","Active"]])->orderBy($orderBy[0], $orderBy[1])->get();		
		    $categories = Categories::get()->sortBy('category');
		    $subCategories = subCategories::get()->sortBy('subCategory');
			$healthBenefits = $allProducts->unique('product_healthBenefit')->sortBy('product_healthBenefit');
		    $prices = $allProducts->unique('price_filter')->sortBy('product_price');
		    
		    $url = URL::current();
			$subCategoryInfo = subCategories::where('subCategory',$productsubCategory)->first();
		    
			return view('collection', ['subCategoryInfo'=>$subCategoryInfo, 'products'=>$products, 'type'=>$title, 'categories'=>$categories, 'subCategories'=>$subCategories, 'prices'=>$prices, 'healthBenefits'=>$healthBenefits, 'breadCrumbType'=>3, 'url'=>$url, 'mainCategory'=>$type]);
		}
		else{
		    $type = ucwords(str_replace('-',' ',$type));
		    $filterInfo = Filters::where('filter_value', $type)->get();
		    
		    $filters = collect();
		    $filters->push([$filterInfo[0]['filter_type'], $filterInfo[0]['filter_value']]);
		    $filters->push(['product_url', $product_url]);
		    $product = Products::where($filters->toArray())->first();
		    
		    $relatedProducts = Products::where([['product_url', '!=', $product_url], ['product_status', 'Active']])->orderBy('product_most-viewed','desc')->take(6)->get();
		    Products::where('product_url', $product['product_url'])->increment('product_most-viewed');
		    
		    $url = URL::current();
		    
		    return view('product', ['type'=>$type, 'product'=>$product, 'relatedProducts'=>$relatedProducts, 'url'=>$url]);
		}
	}
	
	public function about_us(){
		return view('about-us');
	}
	public function privacy(){
		return view('privacy');
	}
	public function terms(){
		return view('terms');
	}
	public function contact_us(){
		return view('contact-us');
	}
	public function faqs(){
		return view('faqs');
	}
	public function shipping(){
		return view('shipping');
	}
	public function cancellation(){
		return view('cancellation');
	}
	public function return_policy(){
		return view('return');
	}
	
	public function support_process(Request $request){
		$validator = Validator::make($request->all(), [
		    'email' => 'bail|required',
		    'phone' => 'bail|required',
		    'subject' => 'bail|required',
		    'firstName' => 'bail|required',
		    'lastName' => 'bail|required',
		    'description' => 'bail|required',
		]);
		
		if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		$user = User::where('email', $request->email)->get();
		(count($user) == 0) ? $user_id = 0 : $user_id = $user[0]['id'];
		
		Enquiries::Insert([
		    'users_id' => $user_id,
		    'email' => $request->email,
		    'phone' => $request->phone,
		    'subject' => $request->subject,
		    'firstName' => $request->firstName,
		    'lastName' => $request->lastName,
		    'category' => $request->category,
		    'description' => $request->description
		]);
		
		$data = request()->all();
		processEnquiry::dispatchAfterResponse($data);
		
		return back()->with('status', 'Thank you for contacting us! We will get back to you soon.');
	}
	
	public function new_subscribers(Request $request){
		$validator = Validator::make($request->all(), [
		    'email' => 'bail|required',
		]);
		
		if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		$user = User::where('email', $request->email)->get();
		(count($user) == 0) ? $user_id = 0 : $user_id = $user[0]['id'];
		
		Customers::updateOrCreate(
			['email' => $request->email],
			['users_id' => $user_id, 'subscribed_status' => 'Yes']
		);
		return back()->with('status', 'Thank you for subscribing!');
	}
	
	public function getCount(){
		return count((array) session('cart'));
	}
	
	public function cartUpdate(){
		$output = "";
		foreach(session('cart') as $products => $product){
			$output.='<div class="row cart-row">'.
			'<img class="img-block" src="/storage/shop/'.str_replace(' ','-',strtoupper($product['code'])).'/'.$product['image'].'" />'.
			'<div class="info-block">'.
			'<p><a href="/shop/'.strtolower(str_replace(' ', '-', $product['category'])).'/'.$product['url'].'">'.$product['name'].'</a></p>'.
			'<p>'.$product['variantValue'].'</p>'.
			'<p>Quantity: '.$product['quantity'].'</p>'.
			'<p class="mb-0">INR '.number_format($product['price'] * $product['quantity']).'</p>'.
			'</div>'.
			'</div>';
		}
		$output.='<button class="btn viewCartBtn" onclick="window.location=\'/cart\'">View Cart</button>';
		return Response($output);
	}
	
	public function get_quiz(){
		return view('vitality-quiz');
	}
	public function post_quiz(Request $request){
		$totalCount = 0;
		for($i=1; $i<=11; $i++){
			$queNo = "que".$i;
			if($request->$queNo == 1){
				$totalCount+=10;
			}
			elseif($request->$queNo == 2){
				$totalCount+=6;
			}
			elseif($request->$queNo == 3){
				$totalCount+=2;
			}
			else{}
		}
		return back()->with('status',$totalCount);
	}
	
	public function roots_vitality(){
		return view('roots-of-vitality');
	}
}
