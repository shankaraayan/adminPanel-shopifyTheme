<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Orders_customers;
use App\Models\Orders_items;
use App\Models\Checkouts;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Filters;
use App\Models\Categories;
use App\Models\subCategories;
use App\Models\Payments;
use App\Models\Shipping;
use App\Models\Tax;
use App\Models\User;
use App\Models\discountCodes;
use App\Models\automaticDiscounts;
use App\Models\Invoice;
use App\Models\Enquiries;
use App\Models\banners;
use App\Models\announcementBar;
use App\Models\image_with_text_overlay;
use App\Models\services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Mail\orderShipped;
use App\Mail\orderFulfilled;
use App\Mail\orderCancelled;
use Illuminate\Support\Facades\Mail;

use PDF;
use Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(){
		$orders = Orders::selectRaw('COUNT(id) AS noOfOrders, SUM(total_amount) AS totalSales')->get();
		$todayOrders = Orders::selectRaw('COUNT(id) AS noOfOrders, SUM(total_amount) AS totalSales')->whereDate('created_at', Carbon::today())->get();
		$checkouts = Checkouts::selectRaw('COUNT(id) AS noOfCheckouts, SUM(total) AS totalCheckouts')->get();
		$todayCheckouts = Checkouts::selectRaw('COUNT(id) AS noOfCheckouts, SUM(total) AS totalCheckouts')->whereDate('created_at', Carbon::today())->get();
		$UnfulfillOrders = Orders::whereIn('order_status', ['Reviewed', 'Shipped'])->get();
		
		return view('admin.home', ['orders'=>$orders ,'todayOrders'=>$todayOrders,'checkouts'=>$checkouts ,'todayCheckouts'=>$todayCheckouts, 'noOfUnfulfillOrders'=>count($UnfulfillOrders)]);
	}
	
	public function orders(){
		$orders = Orders::orderBy('id', 'desc')
		->join ('orders_customers', 'orders.id', '=', 'orders_customers.orders_id')
		->join ('orders_items', 'orders.id', '=', 'orders_items.orders_id')
		->selectRaw('orders.*, orders_customers.first_name, orders_customers.last_name, orders_items.product_quantity')
		->get();
		
		$orders = $orders->groupBy('id');
		return view('admin.orders', ['orders'=>$orders]);
	}
	
	public function order($orderID){
		$orders = Orders::where('id', $orderID)->first();
		$orders_customers = Orders_customers::where('orders_id', $orders->id)->orderBy('id', 'desc')->first();
		$orders_items = Orders_items::where('orders_id', $orders->id)->get();
		
		$shippings = Shipping::where('country', $orders_customers['shipping_country'])->orderBy('state', 'asc')->get();
		return view('admin.order', ['orders'=>$orders, 'orders_customers'=>$orders_customers, 'orders_items'=>$orders_items, 'shippings'=>$shippings]);
	}
	
	public function order_shipped($orderID, Request $request){
		Orders::where('id', $request->orderID)->update([
		    'order_status' => $request->status,
		    'shipping_carrier' => $request->carrier,
		    'shipping_tracking_number' => $request->trackingNumber,
		    'shipping_tracking_link' => $request->trackingLink
		]);
		
		$orders = Orders::where('id', $request->orderID)->first();
		$Orders_customers = Orders_customers::where('orders_id', $request->orderID)->first();
		Mail::to($Orders_customers->email)->send(new orderShipped($orders, $Orders_customers));
		
		return back();
	}
	
	public function order_cancelled($orderID){
		Orders::where('id', $orderID)->update([
		    'order_status' => "Cancelled"
		]);
		
		$orders = Orders::where('id', $orderID)->first();
		$Orders_customers = Orders_customers::where('orders_id', $orderID)->first();
		Mail::to($Orders_customers->email)->send(new orderCancelled($orders, $Orders_customers));
		
		return back();
	}
	
	public function order_fulfilled($orderID){
		Orders::where('id', $orderID)->update([
		    'order_status' => "Fulfilled"
		]);
		
		$orders = Orders::where('id', $orderID)->first();
		$Orders_customers = Orders_customers::where('orders_id', $orderID)->first();
		Mail::to($Orders_customers->email)->send(new orderFulfilled($orders, $Orders_customers));
		
		return back();
	}
	
	public function order_edit($orderID, Request $request){
		if($request->updateType == "Shipping"){
			if($request->billingStatus == "Yes"){
				Orders_customers::where('orders_id', $orderID)->update([
			        'first_name' => $request->firstname,
			        'last_name' => $request->lastname,
			        'shipping_address' => $request->address,
			        'shipping_city' => $request->city,
			        'shipping_country' => $request->country,
			        'shipping_state' => $request->state,
			        'shipping_pincode' => $request->pincode,
			        'phone' => $request->phone,
					'billing_first_name' => $request->firstname,
			        'billing_last_name' => $request->lastname,
			        'billing_address' => $request->address,
			        'billing_city' => $request->city,
			        'billing_country' => $request->country,
			        'billing_state' => $request->state,
			        'billing_pincode' => $request->pincode,
			        'billing_phone' => $request->phone
			    ]);
			}else{
				Orders_customers::where('orders_id', $orderID)->update([
			        'first_name' => $request->firstname,
			        'last_name' => $request->lastname,
			        'shipping_address' => $request->address,
			        'shipping_city' => $request->city,
			        'shipping_country' => $request->country,
			        'shipping_state' => $request->state,
			        'shipping_pincode' => $request->pincode,
			        'phone' => $request->phone
			    ]);
			}
		}else{
			if($request->billingStatus == "Yes"){
				Orders_customers::where('orders_id', $orderID)->update([
			        'billing_status' => 'No',
			        'billing_first_name' => $request->firstname,
			        'billing_last_name' => $request->lastname,
			        'billing_address' => $request->address,
			        'billing_city' => $request->city,
			        'billing_country' => $request->country,
			        'billing_state' => $request->state,
			        'billing_pincode' => $request->pincode,
			        'billing_phone' => $request->phone
			    ]);
			}else{
				Orders_customers::where('orders_id', $orderID)->update([
			        'billing_first_name' => $request->firstname,
			        'billing_last_name' => $request->lastname,
			        'billing_address' => $request->address,
			        'billing_city' => $request->city,
			        'billing_country' => $request->country,
			        'billing_state' => $request->state,
			        'billing_pincode' => $request->pincode,
			        'billing_phone' => $request->phone
			    ]);
			}
		}
		return back();
	}
	
	public function invoice($orderID){
		$invoice = Invoice::where('order_Number', $orderID)->first();
		
		if($invoice){
			$invoice_Number = str_pad($invoice['invoice_Number'], 4, '0', STR_PAD_LEFT);
		}else{
			$last_invoice = Invoice::orderBy('id','desc')->first();
			if($last_invoice){
				$invoice_Number = str_pad($last_invoice['invoice_Number']+1, 4, '0', STR_PAD_LEFT);
			}else{
				$invoice_Number = str_pad(1, 4, '0', STR_PAD_LEFT);
			}
			$invoice = Invoice::create(['invoice_Number' => $invoice_Number, 'order_Number' => $orderID]);
		}
		
		$orders = Orders::where('id', $orderID)->first();
		$orders_customers = Orders_customers::where('orders_id', $orders->id)->orderBy('id', 'desc')->first();
		$orders_items = Orders_items::where('orders_id', $orders->id)->get();
		$tax = Tax::where('country', $orders_customers['billing_country'])->first();
		
		set_time_limit(300);
		$pdf = PDF::loadView('admin.invoice', ['invoice'=>$invoice, 'invoice_Number'=>$invoice_Number ,'orders'=>$orders, 'orders_customers'=>$orders_customers, 'orders_items'=>$orders_items, 'tax'=>$tax]);
		return $pdf->stream('Invoice.pdf');
	}
	
	public function checkouts(){
		$checkouts = Checkouts::orderBy('id', 'desc')->get();
		return view('admin.checkouts', ['checkouts'=>$checkouts]);
	}
	
	public function checkout($checkoutID){
		$checkouts = Checkouts::where('id', $checkoutID)->first();
		$customers = Customers::where('id', $checkouts->customers_id)->first();
		
		$quantities = explode(',', $checkouts['product_quantities']);
		$skus = explode(',', $checkouts['product_codes']);
		$products = Products::whereIn('product_code', $skus)->get();
		
		return view('admin.checkout', ['checkouts'=>$checkouts, 'customers'=>$customers, 'quantities'=>$quantities, 'products'=>$products]);
	}
	
	public function products(){
		$products = Products::orderBy('id', 'desc')->simplePaginate(25);
		$activeProducts = Products::where('product_status','Active')->orderBy('id', 'desc')->simplePaginate(25);
		$draftProducts = Products::where('product_status','Draft')->orderBy('id', 'desc')->simplePaginate(25);
		return view('admin.products', ['products'=>$products, 'activeProducts'=>$activeProducts, 'draftProducts'=>$draftProducts]);
	}
	
	public function product_new(){
		$categories = Categories::orderBy('category','asc')->get();
		$subCategories = subCategories::orderBy('subCategory','asc')->get();
		return view('admin.product-new', ['categories'=>$categories, 'subCategories'=>$subCategories]);
	}
	
	public function product_store(Request $request){
		$request->validate([
		    'product_code' => 'required|unique:products',
		]);
		
		$product_name = ucwords($request->productName);
		$products = Products::where('product_name', $product_name)->get();
		
		$product_url = str_replace(' ','-',strtolower($request->productName));
		if(count($products)){
			$product_url = $product_url.'-'.count($products);
		}
		
		$product_url = str_replace(['(',')'],'',$product_url);
		
		if($request->hasFile('productImage'))
        {
			$names = [];
			$i=1;
			$allowedfileExtension=['jpg','png','jpeg'];
			$folder_name = "public/shop/".str_replace(' ','-',strtoupper($request->product_code));
			
			foreach($request->file('productImage') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				$filename = 'Vitality-club-'.str_replace(' ','-',strtolower($request->productName)).'-'.$i.'.'.$extension;
				
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					array_push($names, $filename);
					$image->storeAs($folder_name, $filename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
				
				$filename1 = 'Vitality-club-'.str_replace(' ','-',strtolower($request->productName)).'-'.$i.'-540px.'.$extension;
				$filename2 = 'Vitality-club-'.str_replace(' ','-',strtolower($request->productName)).'-'.$i.'-270px.'.$extension;
				
				$source = storage_path().'/app/'.$folder_name.'/'.$filename;
				$target1 = storage_path().'/app/'.$folder_name.'/'.$filename1;
				$target2 = storage_path().'/app/'.$folder_name.'/'.$filename2;
				
				Image::make($source)->widen(540)->save($target1);
				Image::make($source)->widen(270)->save($target2);
				
				$i++;
			}
			
			$namesCount = count($names);
			for($i=$namesCount; $i<4; $i++)
			{
				$names[$i] = "null";
			}
			
			if($request->productDiscountPrice < 250){
				$price_filter = "Below 250";
			}else if($request->productDiscountPrice > 250 && $request->productDiscountPrice < 500){
				$price_filter = "250 500";
			}else if($request->productDiscountPrice > 500 && $request->productDiscountPrice < 750){
				$price_filter = "500 750";
			}else if($request->productDiscountPrice > 750 && $request->productDiscountPrice < 1000){
				$price_filter = "750 1000";
			}else{
				$price_filter = "Above 1000";
			}
			
			if($request->setVariant){
				$setVariant = "Yes";
			}else{
				$setVariant = "No";
			}
			
			Products::create([
			'product_category' => $request->productCategory,
			'product_subCategory' => $request->productSubCategory,
			'product_name' => ucwords($request->productName),
			'product_url' => $product_url,
			'product_pic1' => $names[0],
			'product_pic2' => $names[1],
			'product_pic3' => $names[2],
			'product_pic4' => $names[3],
			'product_totalPrice' => $request->productTotalPrice,
		    'product_price' => $request->productDiscountPrice,
		    'price_filter' => $price_filter,
			'product_code' => $request->product_code,
			'product_quantity' => $request->productQuantity,
			'product_hasVariants' => $setVariant,
		    'product_variantType' => $request->product_variantType,
		    'product_variant1' => $request->variant1,
		    'product_variant1sku' => $request->variant1SKU,
		    'product_variant1qty' => $request->variant1Qty,
		    'product_variant1cost' => $request->variant1Price,
		    'product_variant1mrp' => $request->variant1MRP,
		    'product_variant2' => $request->variant2,
		    'product_variant2sku' => $request->variant2SKU,
		    'product_variant2qty' => $request->variant2Qty,
		    'product_variant2cost' => $request->variant2Price,
		    'product_variant2mrp' => $request->variant2MRP,
		    'product_variant3' => $request->variant3,
		    'product_variant3sku' => $request->variant3SKU,
		    'product_variant3qty' => $request->variant3Qty,
		    'product_variant3cost' => $request->variant3Price,
		    'product_variant3mrp' => $request->variant3MRP,
		    'product_variant4' => $request->variant4,
		    'product_variant4sku' => $request->variant4SKU,
		    'product_variant4qty' => $request->variant4Qty,
		    'product_variant4cost' => $request->variant4Price,
		    'product_variant4mrp' => $request->variant4MRP,
		    'product_variant5' => $request->variant5,
		    'product_variant5sku' => $request->variant5SKU,
		    'product_variant5qty' => $request->variant5Qty,
		    'product_variant5cost' => $request->variant5Price,
		    'product_variant5mrp' => $request->variant5MRP,
		    'product_description' => $request->productDescription,
		    'product_ingredients' => $request->product_ingredients,
		    'product_nutritionalFacts' => $request->product_nutritionalFacts,
		    'product_benefits' => $request->product_benefits,
		    'product_otherInfo' => $request->product_otherInfo,
		    'product_healthBenefit' => $request->product_healthBenefit,
		    'product_status' => $request->product_status,
		    'product_most-viewed' => 0,
		    'product_bestsellers' => 0
			]);
			
			Filters::updateOrInsert(
			    ['filter_value' => ucwords($request->productCategory)],
				['filter_type' => 'product_category']
			);
			Filters::updateOrInsert(
			    ['filter_value' => ucwords($request->productSubCategory)],
				['filter_type' => 'product_subCategory']
			);
			Filters::updateOrInsert(
			    ['filter_value' => $price_filter],
				['filter_type' => 'price_filter']
			);
			Filters::updateOrInsert(
			    ['filter_value' => ucwords($request->product_healthBenefit)],
				['filter_type' => 'product_healthBenefit']
			);
			
			return redirect('admin/products')->with('status', 'Product created successfully!');
		}
	}
	
	public function product($productID){
		$product = Products::where('id', $productID)->first();
		$categories = Categories::orderBy('category','asc')->get();
		$subCategories = subCategories::orderBy('subCategory','asc')->get();
		return view('admin.product', ['product'=>$product, 'categories'=>$categories, 'subCategories'=>$subCategories]);
	}
	
	public function product_edit($productID, Request $request){
		$products = Products::where('id', $productID)->first();
		if($request->product_code != $products['product_code'])
		{
			$request->validate([
			    'product_code' => 'required|unique:products',
			]);
			$oldDirectory = 'public/shop/'.str_replace(' ','-',strtoupper($products['product_code']));
			$NewDirectory = 'public/shop/'.str_replace(' ','-',strtoupper($request->product_code));
			Storage::rename($oldDirectory, $NewDirectory);
		}
		
		$product_name = ucwords($request->productName);
		$product_url = $products['product_url'];
		$Urls = [];
		
		if($product_name != $products['product_name']){
			$products = Products::where('product_name', $product_name)->get();
		    $product_url = str_replace(' ','-',strtolower($request->productName));
		    if(count($products)){
				for($i=0;$i<count($products);$i++){
					$Urls[$i] = str_replace($product_url,'',$products[$i]['product_url']);
					$Urls[$i] = str_replace('-','',$Urls[$i]);
				}
				if(count($Urls) == 1){
					if($Urls[0] == ""){
						$Urls[0] = 0;
					}
				}
				$product_url = $product_url.'-'.(max($Urls)+1);
		    }
		}
		
		$product_url = str_replace(['(',')'],'',$product_url);
		
		if($request->productDiscountPrice < 250){
			$price_filter = "Below 250";
		}else if($request->productDiscountPrice > 250 && $request->productDiscountPrice < 500){
			$price_filter = "250 500";
		}else if($request->productDiscountPrice > 500 && $request->productDiscountPrice < 750){
			$price_filter = "500 750";
		}else if($request->productDiscountPrice > 750 && $request->productDiscountPrice < 1000){
			$price_filter = "750 1000";
		}else{
			$price_filter = "Above 1000";
		}
		
		if($request->setVariant){
			$setVariant = "Yes";
		}else{
			$setVariant = "No";
		}
		
		Products::where('id', $productID)
		->update([
			'product_category' => $request->productCategory,
			'product_subCategory' => $request->productSubCategory,
			'product_name' => ucwords($request->productName),
			'product_url' => $product_url,
			'product_totalPrice' => $request->productTotalPrice,
		    'product_price' => $request->productDiscountPrice,
		    'price_filter' => $price_filter,
			'product_code' => $request->product_code,
			'product_quantity' => $request->productQuantity,
			'product_hasVariants' => $setVariant,
		    'product_variantType' => $request->product_variantType,
		    'product_variant1' => $request->variant1,
		    'product_variant1sku' => $request->variant1SKU,
		    'product_variant1qty' => $request->variant1Qty,
		    'product_variant1cost' => $request->variant1Price,
		    'product_variant1mrp' => $request->variant1MRP,
		    'product_variant2' => $request->variant2,
		    'product_variant2sku' => $request->variant2SKU,
		    'product_variant2qty' => $request->variant2Qty,
		    'product_variant2cost' => $request->variant2Price,
		    'product_variant2mrp' => $request->variant2MRP,
		    'product_variant3' => $request->variant3,
		    'product_variant3sku' => $request->variant3SKU,
		    'product_variant3qty' => $request->variant3Qty,
		    'product_variant3cost' => $request->variant3Price,
		    'product_variant3mrp' => $request->variant3MRP,
		    'product_variant4' => $request->variant4,
		    'product_variant4sku' => $request->variant4SKU,
		    'product_variant4qty' => $request->variant4Qty,
		    'product_variant4cost' => $request->variant4Price,
		    'product_variant4mrp' => $request->variant4MRP,
		    'product_variant5' => $request->variant5,
		    'product_variant5sku' => $request->variant5SKU,
		    'product_variant5qty' => $request->variant5Qty,
		    'product_variant5cost' => $request->variant5Price,
		    'product_variant5mrp' => $request->variant5MRP,
		    'product_description' => $request->productDescription,
		    'product_ingredients' => $request->product_ingredients,
		    'product_nutritionalFacts' => $request->product_nutritionalFacts,
		    'product_benefits' => $request->product_benefits,
		    'product_otherInfo' => $request->product_otherInfo,
		    'product_healthBenefit' => $request->product_healthBenefit,
		    'product_status' => $request->product_status
		]);
		
		Filters::updateOrInsert(
		    ['filter_value' => ucwords($request->productCategory)],
			['filter_type' => 'product_category']
		);
		Filters::updateOrInsert(
		    ['filter_value' => ucwords($request->productSubCategory)],
			['filter_type' => 'product_subCategory']
		);
		Filters::updateOrInsert(
		    ['filter_value' => $price_filter],
			['filter_type' => 'price_filter']
		);
		Filters::updateOrInsert(
		    ['filter_value' => ucwords($request->product_healthBenefit)],
			['filter_type' => 'product_healthBenefit']
		);

        return back()->with('status', 'Product updated!');
    }
	
	public function product_delete(Request $request){
		$request->validate([
		    'sku' => 'bail|required',
		]);
		
		$directory = 'public/shop/'.str_replace(' ','-',strtoupper($request->sku));
		Storage::deleteDirectory($directory);
		
		Products::where('product_code', $request->sku)->delete();
	}
	
	public function categories(){
		$categories = Categories::orderBy('category','asc')->get();
		return view('admin.categories', ['categories'=>$categories]);
	}
	
	public function categories_new(){
		return view('admin.categorie-new');
	}
	
	public function categories_store(Request $request){
		$request->validate([
		    'category' => 'required|unique:categories',
		]);
		
		$imageFilename = "null";
		if($request->hasFile('categoryImage'))
        {
			$allowedfileExtension=['jpg'];
			$folder_name = "public/categories";
			
			foreach($request->file('categoryImage') as $image)
			{	
				$extension = $image->getClientOriginalExtension();
				$imageFilename = 'Vitality-club-'.str_replace(' ','-',strtolower($request->category)).'-image.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $imageFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
		
		$bannerFilename = "null";
		if($request->hasFile('categoryBanner'))
        {
			$allowedfileExtension=['jpg'];
			$folder_name = "public/categories";
			
			foreach($request->file('categoryBanner') as $image)
			{	
				$extension = $image->getClientOriginalExtension();
				$bannerFilename = 'Vitality-club-'.str_replace(' ','-',strtolower($request->category)).'-banner.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $bannerFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		Categories::create([
		    'category' => $request->category,
		    'description' => $request->description,
		    'banner' => $bannerFilename,
		    'categoryImage' => $imageFilename
		]);
		
		Filters::updateOrInsert(
		    ['filter_value' => ucwords($request->category)],
			['filter_type' => 'product_category']
		);
		
		return redirect('/admin/categories')->with('status', 'Category created!');
	}
	
	public function categorie($categorieID){
		$category = Categories::where('id', $categorieID)->first();
		$products = Products::where('product_category', $category->category)->orderBy('id', 'desc')->get();
		return view('admin.categorie', ['category'=>$category, 'products'=>$products]);
	}
	
	public function categorie_edit($categorieID, Request $request){
		Categories::where('id', $categorieID)
		->update([
		    'category' => $request->category,
		    'description' => $request->description
		]);
		
		Filters::updateOrInsert(
		    ['filter_value' => ucwords($request->category)],
			['filter_type' => 'product_category']
		);
		
		return back()->with('status', 'Collection updated!');
	}
	
	public function categorie_image($categorieID, Request $request){
		$category = Categories::where('id', $categorieID)->first();
		$filename = "";
		
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg'];
			$folder_name = "public/categories";
			
			foreach($request->file('banner') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				if($request->type == "Banner"){
					$filename = 'Vitality-club-'.str_replace(' ','-',strtolower($category->category)).'-banner.'.$extension;
				}else{
					$filename = 'Vitality-club-'.str_replace(' ','-',strtolower($category->category)).'-image.'.$extension;
				}
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $filename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
		
		if($request->type == "Banner"){
		    Categories::where('id', $categorieID)->update([
		        'banner' => $filename
		    ]);
		}else{
			Categories::where('id', $categorieID)->update([
		        'categoryImage' => $filename
		    ]);
		}
		
		return back();
	}
	
	public function categorie_delete($categorieID){
		$category = Categories::where('id', $categorieID)->first();
		$oldImg = 'public/categories/'.$category->banner;
		$oldImg1 = 'public/categories/'.$category->categoryImage;
		Storage::delete($oldImg);
		Storage::delete($oldImg1);
		
		Categories::where('id', $categorieID)->delete();
		return redirect('admin/categories');
	}
	
	public function sub_categories(){
		$categories = subCategories::orderBy('subCategory','asc')->get();
		return view('admin.sub-categories', ['categories'=>$categories]);
	}
	
	public function sub_categories_new(){
		$categories = Categories::orderBy('category', 'asc')->get();
		return view('admin.sub-categorie-new', ['categories'=>$categories]);
	}
	
	public function sub_categories_store(Request $request){
		$request->validate([
		    'subCategory' => 'required|unique:sub_categories',
		]);
		
		$subCategoryImage = "null";
		if($request->hasFile('subCategoryImage'))
        {
			$allowedfileExtension=['jpg'];
			$folder_name = "public/sub-categories";
			
			foreach($request->file('subCategoryImage') as $image)
			{	
				$extension = $image->getClientOriginalExtension();
				$subCategoryImage = 'Vitality-club-'.str_replace(' ','-',strtolower($request->subCategory)).'-image.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $subCategoryImage);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
		
		$subCategoryBanner = "null";
		if($request->hasFile('subCategoryBanner'))
        {
			$allowedfileExtension=['jpg'];
			$folder_name = "public/sub-categories";
			
			foreach($request->file('subCategoryBanner') as $image)
			{	
				$extension = $image->getClientOriginalExtension();
				$subCategoryBanner = 'Vitality-club-'.str_replace(' ','-',strtolower($request->subCategory)).'-banner.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $subCategoryBanner);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		subCategories::create([
		    'subCategory' => $request->subCategory,
		    'parentCategory' => $request->parentCategory,
		    'description' => $request->description,
		    'banner' => $subCategoryBanner,
		    'subCategoryImage' => $subCategoryImage
		]);
		
		Filters::updateOrInsert(
		    ['filter_value' => ucwords($request->subCategory)],
			['filter_type' => 'product_subCategory']
		);
		
		return redirect('/admin/sub-categories')->with('status', 'Sub Category created!');
	}
	
	public function sub_categorie($categorieID){
		$category = subCategories::where('id', $categorieID)->first();
		$products = Products::where('product_subCategory', $category->subCategory)->orderBy('id', 'desc')->get();
		$categories = Categories::orderBy('category', 'asc')->get();
		return view('admin.sub-categorie', ['category'=>$category, 'products'=>$products, 'categories'=>$categories]);
	}
	
	public function sub_categorie_edit($categorieID, Request $request){
		subCategories::where('id', $categorieID)
		->update([
		    'subCategory' => $request->subCategory,
		    'parentCategory' => $request->parentCategory,
		    'description' => $request->description
		]);
		
		Filters::updateOrInsert(
		    ['filter_value' => ucwords($request->subCategory)],
			['filter_type' => 'product_subCategory']
		);
		
		return back()->with('status', 'Sub Category updated!');
	}
	
	public function sub_categorie_image($categorieID, Request $request){
		$subCategories = subCategories::where('id', $categorieID)->first();
		$filename = "";
		
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg'];
			$folder_name = "public/sub-categories";
			
			foreach($request->file('banner') as $image)
			{	
				$extension = $image->getClientOriginalExtension();
				if($request->type == "Banner"){
					$filename = 'Vitality-club-'.str_replace(' ','-',strtolower($subCategories->subCategory)).'-banner.'.$extension;
				}else{
					$filename = 'Vitality-club-'.str_replace(' ','-',strtolower($subCategories->subCategory)).'-image.'.$extension;
				}
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $filename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
		
		if($request->type == "Banner"){
			subCategories::where('id', $categorieID)->update([
			    'banner' => $filename
			]);
		}else{
			subCategories::where('id', $categorieID)->update([
			    'subCategoryImage' => $filename
			]);
		}
		
		return back();
	}
	
	public function sub_categorie_delete($categorieID){
		$category = subCategories::where('id', $categorieID)->first();
		$oldImg = 'public/sub-categories/'.$category->banner;
		$oldImg1 = 'public/sub-categories/'.$category->subCategoryImage;
		Storage::delete($oldImg);
		Storage::delete($oldImg1);
		
		subCategories::where('id', $categorieID)->delete();
		return redirect('admin/sub-categories');
	}
	
	public function customers(){
		$customers = Customers::selectRaw('customers.*, count(orders_customers.orders_id) as ordersCount, sum(orders.total_amount) as totalSpent')
		->leftJoin ('orders_customers', 'customers.email', '=', 'orders_customers.email')
		->leftJoin ('orders', 'orders_customers.orders_id', '=', 'orders.id')
		->groupBy('customers.email')
		->simplePaginate(50);
		
		return view('admin.customers', ['customers'=>$customers]);
	}
	
	public function customer($customerID){
		$customer = Customers::where('id', $customerID)->first();
		$user = User::where('email', $customer->email)->first();
		
		if(Orders_customers::where('email', '=', $customer->email)->exists()) {
		    $orders = orders_customers::where('email', $customer->email)
		    ->leftJoin ('orders', 'orders_customers.orders_id', '=', 'orders.id')
		    ->leftJoin ('orders_items', 'orders_customers.orders_id', '=', 'orders_items.orders_id')
		    ->orderBy('orders_customers.orders_id','desc')
		    ->get();
		}else{
		    $orders = collect();
		}
		
		return view('admin.customer', ['customer'=>$customer, 'user'=>$user, 'orders'=>$orders]);
	}
	
	public function users_edit(Request $request){
		if($request->id && $request->membership){
			User::where('id', $request->id)->update([
			    'membership' => $request->membership
			]);
		}
	}
	
	public function delete_image(Request $request){
		$request->validate([
		    'sku' => 'bail|required',
		    'imgName' => 'bail|required',
		]);
		
		$img = 'public/shop/'.str_replace(' ','-',str_replace('/','',$request->sku)).'/'.$request->imgName;
		Storage::delete($img);
		$img = 'public/shop/'.str_replace(' ','-',str_replace('/','',$request->sku)).'/'.str_replace('.jpg','-540px.jpg',$request->imgName);
		Storage::delete($img);
		$img = 'public/shop/'.str_replace(' ','-',str_replace('/','',$request->sku)).'/'.str_replace('.jpg','-270px.jpg',$request->imgName);
		Storage::delete($img);
		
		$product = Products::where('product_code', $request->sku)->first();
		
		if($product->product_pic1 == $request->imgName){
			Products::where('product_code', $request->sku)
			->update([
			    'product_pic1' => 'null'
			]);
		}
		elseif($product->product_pic2 == $request->imgName){
			Products::where('product_code', $request->sku)
			->update([
			    'product_pic2' => 'null'
			]);
		}
		elseif($product->product_pic3 == $request->imgName){
			Products::where('product_code', $request->sku)
			->update([
			    'product_pic3' => 'null'
			]);
		}
		else{
			Products::where('product_code', $request->sku)
			->update([
			    'product_pic4' => 'null'
			]);
		}
	}
	
	public function add_image($productID, Request $request){
		$product = Products::where('id', $productID)->first();
		
		if($request->hasFile('productImage'))
        {
			$allowedfileExtension=['jpg','png','jpeg'];
			$folder_name = "public/shop/".str_replace(' ','-',str_replace('/','',$product['product_code']));
			
			foreach($request->file('productImage') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				if($product->product_pic1 == 'null'){
					$i = 1;
					$picNum = 'product_pic1';
				}elseif($product->product_pic2 == 'null'){
					$i = 2;
					$picNum = 'product_pic2';
				}elseif($product->product_pic3 == 'null'){
					$i = 3;
					$picNum = 'product_pic3';
				}else{
					$i = 4;
					$picNum = 'product_pic4';
				}
				
				$filename = 'Vitality-club-'.str_replace(' ','-',strtolower($product->product_name)).'-'.$i.'.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check){
					$image->storeAs($folder_name, $filename);
				}
				
				$filename1 = 'Vitality-club-'.str_replace(' ','-',strtolower($product->product_name)).'-'.$i.'-540px.'.$extension;
				$filename2 = 'Vitality-club-'.str_replace(' ','-',strtolower($product->product_name)).'-'.$i.'-270px.'.$extension;
				
				$source = storage_path().'/app/'.$folder_name.'/'.$filename;
				$target1 = storage_path().'/app/'.$folder_name.'/'.$filename1;
				$target2 = storage_path().'/app/'.$folder_name.'/'.$filename2;
				
				Image::make($source)->widen(540)->save($target1);
				Image::make($source)->widen(270)->save($target2);
				
				Products::where('id', $productID)
			    ->update([
			        $picNum => $filename
			    ]);
			}
		}
		return back();
	}
	
	public function settings(){
		return view('admin.settings');
	}
	
	public function payments(){
		$payments = Payments::get();
		return view('admin.payments', ['payments'=>$payments]);
	}
	public function payments_cod(){
		$payments = Payments::where('payment_mode','COD')->get();
		return view('admin.cash-on-delivery', ['payments'=>$payments]);
	}
	public function payments_cod_new(Request $request){
		Payments::create([
		    'country' => $request->country,
		    'state' => $request->state,
		    'payment_mode' => $request->mode,
		    'min_order_value' => $request->min_order_value,
		    'max_order_value' => $request->max_order_value
		]);
		
		return back();
	}
	public function payments_cod_update(Request $request){
		Payments::where('id', $request->id)->update([
		    'country' => $request->country,
		    'state' => $request->state,
		    'payment_mode' => $request->mode,
		    'min_order_value' => $request->min_order_value,
		    'max_order_value' => $request->max_order_value
		]);
		
		return back();
	}
	public function payments_cod_delete(Request $request){
		Payments::where('id', $request->id)->delete();
	}
	
	public function shipping(){
		$payments = Payments::get();
		return view('admin.shippings', ['payments'=>$payments]);
	}
	public function shipping_manage($country){
		$shippings = Shipping::where('country', $country)->orderBy('state', 'asc')->get();
		return view('admin.shipping', ['shippings'=>$shippings]);
	}
	public function shipping_addNew(Request $request){
		Shipping::create([
		    'country' => $request->country,
		    'state' => $request->state,
		    'deliverable' => 'Yes',
		    'name' => $request->name,
		    'cost' => $request->cost,
		    'min_order_value' => $request->min_order_value,
		    'max_order_value' => $request->max_order_value
		]);
		
		return back();
	}
	public function shipping_delete(Request $request){
		if($request->id){
			Shipping::where('id', $request->id)->delete();
		}
	}
	public function shipping_update(Request $request){
		Shipping::where('id', $request->id)->update([
		    'country' => $request->country,
		    'state' => $request->state,
		    'name' => $request->name,
		    'cost' => $request->cost,
		    'min_order_value' => $request->min_order_value,
		    'max_order_value' => $request->max_order_value
		]);
		
		return back();
	}
	
	public function taxes(){
		$taxes = Tax::get();
		return view('admin.taxes', ['taxes'=>$taxes]);
	}
	public function taxes_edit($country){
		$taxes = Tax::where('country', $country)->first();
		return view('admin.tax', ['taxes'=>$taxes]);
	}
	public function taxes_store($country, Request $request){
		($request->charge) ? $charge="Yes" : $charge="No";
		
		Tax::where('country', $country)->update([
		    'tax' => $request->tax,
		    'charge' => $charge
		]);
		return redirect('/admin/settings/taxes');
	}
	
	public function discounts(){
		$discountCodes = discountCodes::orderBy('id', 'desc')->get();
		$automaticDiscounts = automaticDiscounts::orderBy('id', 'desc')->get();
		return view('admin.discounts', ['discountCodes'=>$discountCodes, 'automaticDiscounts'=>$automaticDiscounts]);
	}
	
	function generate_code($length = 6){
		$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code = '';
		for($i = 0; $i < $length; ++$i){
			$random = str_shuffle($chars);
			$code .= $random[0];
		}
		return $code;
	}
	public function discount_code_new(){
		return view('admin.discount-code-new');
	}
	public function discount_code_store(Request $request){
		$request->validate([
		    'discountCode' => 'required|unique:discount_codes',
		]);
		
		($request->discountOncePerUser) ? $oncePerUser = "Yes" : $oncePerUser = "No";
		
		if($request->discountSetDateCheckbox){
			discountCodes::create([
			    'discountCode' => $request->discountCode,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountEndDate' => $request->discountEndDate,
			    'discountStatus' => 'Active',
			    'discountOncePerUser' => $oncePerUser
			]);
			
			return redirect('admin/discounts');
		}
		else{
			discountCodes::create([
			    'discountCode' => $request->discountCode,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountStatus' => 'Active',
			    'discountOncePerUser' => $oncePerUser
			]);
			
			return redirect('admin/discounts');
		}
	}
	public function discount_code($discountID){
		$discountCode = discountCodes::where('id', $discountID)->first();
		return view('admin.discount-code', ['discountCode'=>$discountCode]);
	}
	public function discount_code_update($discountID, Request $request){
		$request->validate([
		    'discountCode' => 'required|unique:discount_codes',
		]);
		
		($request->discountOncePerUser) ? $oncePerUser = "Yes" : $oncePerUser = "No";
		
		if($request->discountSetDateCheckbox){
			discountCodes::where('id', $discountID)->update([
			    'discountCode' => $request->discountCode,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountEndDate' => $request->discountEndDate,
			    'discountStatus' => 'Active',
			    'discountOncePerUser' => $oncePerUser
			]);
			
			return redirect('admin/discounts');
		}
		else{
			discountCodes::where('id', $discountID)->update([
			    'discountCode' => $request->discountCode,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountStatus' => 'Active',
			    'discountOncePerUser' => $oncePerUser
			]);
			
			return redirect('admin/discounts');
		}
	}
	public function discount_code_delete($discountID){
		discountCodes::where('id', $discountID)->delete();
		return;
	}
	
	public function automatic_discount_new(){
		return view('admin.automatic-discount-new');
	}
	public function automatic_discount_store(Request $request){
		if($request->discountSetDateCheckbox){
			automaticDiscounts::create([
			    'discountTitle' => $request->discountTitle,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountEndDate' => $request->discountEndDate,
			    'discountStatus' => 'Active'
			]);
			
			return redirect('admin/discounts');
		}
		else{
			automaticDiscounts::create([
			    'discountTitle' => $request->discountTitle,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountStatus' => 'Active'
			]);
			
			return redirect('admin/discounts');
		}
	}
	public function automatic_discount($discountID){
		$discount = automaticDiscounts::where('id', $discountID)->first();
		return view('admin.automatic-discount', ['discount'=>$discount]);
	}
	public function automatic_discount_update($discountID, Request $request){
		if($request->discountSetDateCheckbox){
			automaticDiscounts::where('id', $discountID)->update([
			    'discountTitle' => $request->discountTitle,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountEndDate' => $request->discountEndDate,
			    'discountStatus' => 'Active'
			]);
			
			return redirect('admin/discounts');
		}
		else{
			automaticDiscounts::where('id', $discountID)->update([
			    'discountTitle' => $request->discountTitle,
			    'discountType' => $request->discountType,
			    'discountValue' => $request->discountValue,
			    'discountMinPurchaseAmt' => $request->discountMinPurchaseAmt,
			    'discountStartDate' => $request->discountStartDate,
			    'discountStatus' => 'Active'
			]);
			
			return redirect('admin/discounts');
		}
	}
	public function automatic_discount_delete($discountID){
		automaticDiscounts::where('id', $discountID)->delete();
		return;
	}
	
	public function slider(){
		$banners = banners::get();
		return view('admin.sliders', ['banners'=>$banners]);
	}
	public function slider_new(){
		return view('admin.slider-new');
	}
	public function slider_store(Request $request){
		$request->validate([
		    'text' => 'required',
		    'btnlink' => 'required',
		    'description' => 'required',
		]);
		
		$banner = banners::create([
		    'banner_text' => $request->description,
		    'bannerBtn_text' => $request->text,
		    'bannerBtn_link' => $request->btnlink,
			'banner_img' => 'null'
		]);
		
		$imageFilename = "";
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg','mp4'];
			$folder_name = "public/sliders";
			
			foreach($request->file('banner') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				$imageFilename = 'Vitality-club-banner-'.$banner['id'].'.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $imageFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		banners::where('id', $banner['id'])->update([
		    'banner_img' => $imageFilename
		]);
		
		return redirect('/admin/homepage/slider')->with('status', 'Banner created!');
	}
	public function slider_edit($id, Request $request){
		$banner = banners::where('id',$id)->first();
		return view('admin.slider', ['banner'=>$banner]);
	}
	public function slider_update($id, Request $request){
		$request->validate([
		    'text' => 'required',
		    'btnlink' => 'required',
		    'description' => 'required',
		]);
		
		$banner = banners::where('id', $id)->update([
		    'banner_text' => $request->description,
		    'bannerBtn_text' => $request->text,
		    'bannerBtn_link' => $request->btnlink
		]);
		
		return redirect('/admin/homepage/slider/'.$id)->with('status', 'Banner updated!');
	}
	public function slider_image($id, Request $request){
		$imageFilename = "";
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg','mp4'];
			$folder_name = "public/sliders";
			
			foreach($request->file('banner') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				$imageFilename = 'Vitality-club-banner-'.$id.'.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $imageFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		banners::where('id', $id)->update([
		    'banner_img' => $imageFilename
		]);
		
		return redirect('/admin/homepage/slider')->with('status', 'Banner created!');
	}
	public function slider_delete($id){
		$banner = banners::where('id', $id)->first();
		$oldImg = 'public/sliders/'.$banner->banner_img;
		Storage::delete($oldImg);
		
		banners::where('id', $id)->delete();
		return redirect('/admin/homepage/slider')->with('status', 'Banner deleted!');
	}
	
	public function announcement(Request $request){
		$announcement = announcementBar::first();
		return view('admin.announcement', ['announcement'=>$announcement]);
	}
	public function announcementBar(Request $request){
		announcementBar::where('id','1')->update([
		    'heading' => $request->heading,
		    'description' => $request->description,
		    'background_color' => $request->background_color,
		    'text_color' => $request->text_color,
		]);
		
		return back()->with('status', 'Announcement has been saved!');
	}
	
	public function image_with_text_overlay(){
		$banners = image_with_text_overlay::get();
		return view('admin.image-with-text-overlays', ['banners'=>$banners]);
	}
	public function image_with_text_overlay_new(){
		return view('admin.image-with-text-overlay-new');
	}
	public function image_with_text_overlay_store(Request $request){
		$request->validate([
		    'description' => 'required',
		]);
		
		$banner = image_with_text_overlay::create([
		    'banner_text' => $request->description,
		    'bannerBtn_text' => $request->text,
		    'bannerBtn_link' => $request->btnlink,
			'banner_img' => 'null'
		]);
		
		$imageFilename = "";
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg','mp4'];
			$folder_name = "public/imageWithText";
			
			foreach($request->file('banner') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				$imageFilename = 'Vitality-club-banner-'.$banner['id'].'.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $imageFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		image_with_text_overlay::where('id', $banner['id'])->update([
		    'banner_img' => $imageFilename
		]);
		
		return redirect('/admin/homepage/image-with-text-overlay')->with('status', 'Slider created!');
	}
	public function image_with_text_overlay_edit($id, Request $request){
		$banner = image_with_text_overlay::where('id',$id)->first();
		return view('admin.image-with-text-overlay', ['banner'=>$banner]);
	}
	public function image_with_text_overlay_update($id, Request $request){
		$request->validate([
		    'description' => 'required',
		]);
		
		$banner = image_with_text_overlay::where('id', $id)->update([
		    'banner_text' => $request->description,
		    'bannerBtn_text' => $request->text,
		    'bannerBtn_link' => $request->btnlink
		]);
		
		return redirect('/admin/homepage/image-with-text-overlay/'.$id)->with('status', 'Updated!');
	}
	public function image_with_text_overlay_image($id, Request $request){
		$imageFilename = "";
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg','mp4'];
			$folder_name = "public/imageWithText";
			
			foreach($request->file('banner') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				$imageFilename = 'Vitality-club-banner-'.$id.'.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $imageFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		image_with_text_overlay::where('id', $id)->update([
		    'banner_img' => $imageFilename
		]);
		
		return redirect('/admin/homepage/image-with-text-overlay')->with('status', 'Banner updated!');
	}
	public function image_with_text_overlay_delete($id){
		$banner = image_with_text_overlay::where('id', $id)->first();
		$oldImg = 'public/imageWithText/'.$banner->banner_img;
		Storage::delete($oldImg);
		
		image_with_text_overlay::where('id', $id)->delete();
		return redirect('/admin/homepage/image-with-text-overlay')->with('status', 'Deleted!');
	}
	
	public function services(){
		$banners = services::get();
		return view('admin.services', ['banners'=>$banners]);
	}
	public function services_new(){
		return view('admin.services-new');
	}
	public function services_store(Request $request){
		$request->validate([
		    'description' => 'required',
		]);
		
		$banner = services::create([
		    'banner_text' => $request->description,
		    'bannerBtn_text' => $request->text,
		    'bannerBtn_link' => $request->btnlink,
			'banner_img' => 'null'
		]);
		
		$imageFilename = "";
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg','mp4'];
			$folder_name = "public/services";
			
			foreach($request->file('banner') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				$imageFilename = 'Vitality-club-services-banner-'.$banner['id'].'.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $imageFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		services::where('id', $banner['id'])->update([
		    'banner_img' => $imageFilename
		]);
		
		return redirect('/admin/homepage/services')->with('status', 'Slider created!');
	}
	public function services_edit($id, Request $request){
		$banner = services::where('id',$id)->first();
		return view('admin.service', ['banner'=>$banner]);
	}
	public function services_update($id, Request $request){
		$request->validate([
		    'description' => 'required',
		]);
		
		$banner = services::where('id', $id)->update([
		    'banner_text' => $request->description,
		    'bannerBtn_text' => $request->text,
		    'bannerBtn_link' => $request->btnlink
		]);
		
		return redirect('/admin/homepage/services/'.$id)->with('status', 'Updated!');
	}
	public function services_image($id, Request $request){
		$imageFilename = "";
		if($request->hasFile('banner'))
        {
			$allowedfileExtension=['jpg','mp4'];
			$folder_name = "public/services";
			
			foreach($request->file('banner') as $image)
			{
				$extension = $image->getClientOriginalExtension();
				$imageFilename = 'Vitality-club-services-banner-'.$id.'.'.$extension;
				$check = in_array($extension,$allowedfileExtension);
				
				if($check)
				{
					$image->storeAs($folder_name, $imageFilename);
				}
				else
				{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
				}
			}
		}
			
		services::where('id', $id)->update([
		    'banner_img' => $imageFilename
		]);
		
		return redirect('/admin/homepage/services')->with('status', 'Banner updated!');
	}
	public function services_delete($id){
		$banner = services::where('id', $id)->first();
		$oldImg = 'public/services/'.$banner->banner_img;
		Storage::delete($oldImg);
		
		services::where('id', $id)->delete();
		return redirect('/admin/homepage/services')->with('status', 'Deleted!');
	}
}
