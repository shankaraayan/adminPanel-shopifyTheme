<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Moodboards;
use App\Models\automaticDiscounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(count((array) session('cart')) > 0){
		    $automaticDiscounts = automaticDiscounts::where('discountStatus', 'Active')->orderBy('discountValue','asc')->get();
		    $now = date("Y-m-d");
			$total = 0;
			foreach(session('cart') as $products => $product){
				$total += $product['price'] * $product['quantity'];
			}
			$autoDiscount = session()->get('autoDiscount');
			
		    foreach($automaticDiscounts as $automaticDiscount){
				if($automaticDiscount['discountMinPurchaseAmt'] <= $total){
		    		if($automaticDiscount['discountStartDate'] <= $now){
		    			if($automaticDiscount['discountEndDate'] >= $now || $automaticDiscount['discountEndDate'] == ""){
							$autoDiscount = [
							    "id" => $automaticDiscount['id'],
							    "discountTitle" => $automaticDiscount['discountTitle'],
							    "discountType" => $automaticDiscount['discountType'],
							    "discountValue" => $automaticDiscount['discountValue']
							];
							session()->put('autoDiscount', $autoDiscount);
		    			}
		    		}
		    	}
		    }
		}
		return view('cart-summary');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
		    'productCode' => 'required',
		]);
		
		$cart = session()->get('cart');

		$product = Products::where('product_code', $request->productCode)->first();
		if($request->productVariant == 'Yes'){
			$hasVariant = "Yes";
			$variantType = $product['product_variantType'];
			$variantNum = $request->proVariant;
			$variantValue = $product["product_variant".$request->proVariant];
			$variantSKU = $product["product_variant".$request->proVariant."sku"];
			$variantPrice = $product["product_variant".$request->proVariant."cost"];
			
			$product_id = $variantSKU;
		}else{
			$hasVariant = "No";
			$variantType = "";
			$variantNum = 0;
			$variantValue = "";
			$variantSKU = "";
			$variantPrice = $product->product_price;
			
			$product_id = $request->productCode;
		}
		
		// if cart is empty then this the first product
		if(!$cart)
		{
			$cart = [
			    $product_id => [
					"id" => $product_id,
					"category" => $product->product_category,
					"subCategory" => $product->product_subCategory,
					"name" => $product->product_name,
					"url" => $product->product_url,
					"image" => str_replace('.jpg','-270px.jpg',$product->product_pic1),
					"price" => $variantPrice,
					"code" => $product->product_code,
					"quantity" => $request->proQuantity,
					"hasVariant" => $hasVariant,
					"variantType" => $variantType,
					"variantNum" => $variantNum,
					"variantValue" => $variantValue,
					"variantSKU" => $variantSKU,
					"error" => ""
				]
			];
			session()->put('cart', $cart);
			return redirect()->back()->with('status', $product->product_name.' was added to your cart');
        }
		
		// if cart not empty then check if this product exist then increment quantity
		if(isset($cart[$product_id]))
		{
			$cart[$product_id]['quantity'] += $request->proQuantity;
			
			session()->put('cart', $cart);
			return redirect()->back()->with('status', $product->product_name.' was added to your cart');
		}
		
		// if item not exist in cart then add to cart
		$cart[$product_id] = [
			"id" => $product_id,
			"category" => $product->product_category,
			"subCategory" => $product->product_subCategory,
			"name" => $product->product_name,
			"url" => $product->product_url,
			"image" => str_replace('.jpg','-270px.jpg',$product->product_pic1),
			"price" => $variantPrice,
			"code" => $product->product_code,
			"quantity" => $request->proQuantity,
			"hasVariant" => $hasVariant,
			"variantType" => $variantType,
			"variantNum" => $variantNum,
			"variantValue" => $variantValue,
			"variantSKU" => $variantSKU,
			"error" => ""
		];
		session()->put('cart', $cart);
		return redirect()->back()->with('status', $product->product_name.' was added to your cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
		    'quantity' => 'bail|required',
		]);
		
		if($id)
        {
			$cart = session()->get('cart');
			$cart[$id]["quantity"] = $request->quantity;
			session()->put('cart', $cart);
		}
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id){
			$cart = session()->get('cart');
			if(isset($cart[$id])){
				unset($cart[$id]);
				session()->put('cart', $cart);
			}
        }
		
		if(count((array) session('cart')) == 0){
			$customer = session()->get('customer');
			if($customer)
		    {
				session()->put('customer.discount', '');
				session()->put('customer.discount_name', '');
				session()->put('customer.discount_type', '');
				session()->put('customer.discount_value', 0);
			}
		}
    }
}
