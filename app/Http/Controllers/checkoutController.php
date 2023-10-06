<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customers;
use App\Models\Checkouts;
use App\Models\Shipping;
use App\Models\Tax;
use App\Models\Payments;
use App\Models\Orders;
use App\Models\Orders_customers;
use App\Models\Orders_items;
use App\Models\Products;
use App\Models\Moodboards;
use App\Models\discountCodes;
use App\Models\automaticDiscounts;

use App\Jobs\OrderMails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Razorpay\Api\Api;

class checkoutController extends Controller
{	
    public function checkStock(){
		$cart = session()->get('cart');
		
		foreach(session('cart') as $products => $product){
			$pro = Products::where('product_code', $product['code'])->first();
			
			if($product['variantValue'] == ""){
				$size = "product_quantity";
			}else{
				$size = "product_variant".$product['variantNum']."qty";
			}
			
			if($product['quantity'] > $pro[$size]){
				$cart[$product['id']]['error'] = "Only ".$pro[$size]." Pcs. In Stock";
		    	session()->put('cart', $cart);
			}else{
				$cart[$product['id']]['error'] = "";
		    	session()->put('cart', $cart);
			}
		}
		
		$totalCount = count((array) session('cart'));
		$counter = 1;
		
		foreach(session('cart') as $products => $product){
			if($product['error'] != ""){
				return back();
			}else{
				if($counter == $totalCount){
					return redirect()->route('checkout.contact-information');
				}
			}
			$counter++;
		}
	}
	
    public function information(){
		if(count((array) session('cart')) > 0){
			$shippings = Shipping::where('country', 'India')->orderBy('state')->get();
			
			if(Auth::user()){
				$user_id = Auth::user()->id;
				$user_email = Auth::user()->email;
				$user_info = Customers::where('users_id', $user_id)->orderBy('id', 'desc')->first();
		        if($user_info == null){
		        	$user_info = Orders_customers::where('email', $user_email)->orderBy('id', 'desc')->first();
		        }

			    $customer = session()->get('customer');
		        if(!$customer)
		        {
		        	if($user_info != null){
					    $customer = [
		        	    	"checkout" => '',
		        	    	"email" => $user_email,
		        	    	"subscribed_status" => $user_info['subscribed_status'],
		        	    	"first_name" => $user_info['first_name'],
		        	    	"last_name" => $user_info['last_name'],
		        	    	"address" => $user_info['shipping_address'],
		        	    	"city" => $user_info['shipping_city'],
		        	    	"country" => $user_info['shipping_country'],
		        	    	"state" => $user_info['shipping_state'],
		        	    	"pincode" => $user_info['shipping_pincode'],
		        	    	"phone" => $user_info['phone'],
		        	    	"shipping_name" => '',
		        	    	"shipping_cost" => 0,
		        	    	"tax" => 0,
		        	    	"chargeable" => '',
		        	    	"payment_mode" => 'Online',
		        	    	"discount" => '',
		        	    	"discount_name" => '',
		        	    	"discount_type" => '',
		        	    	"discount_value" => 0,
		        	        "billing_checkbox" => $user_info['billing_status'],
		        	        "billing_first_name" => $user_info['billing_first_name'],
		                    "billing_last_name" => $user_info['billing_last_name'],
		        	        "billing_address" => $user_info['billing_address'],
		                    "billing_city" => $user_info['billing_city'],
		                    "billing_country" => $user_info['billing_country'],
		                    "billing_state" => $user_info['billing_state'],
		                    "billing_pincode" => $user_info['billing_pincode'],
		        	        "billing_phone" => $user_info['billing_phone'],
							"CODcharges" => 0
		        	    ];
					}else{
					    $customer = [
		        	    	"checkout" => '',
		        	    	"email" => $user_email,
		        	    	"subscribed_status" => '',
		        	    	"first_name" => '',
		        	    	"last_name" => '',
		        	    	"address" => '',
		        	    	"city" => '',
		        	    	"country" => '',
		        	    	"state" => '',
		        	    	"pincode" => '',
		        	    	"phone" => '',
		        	    	"shipping_name" => '',
		        	    	"shipping_cost" => 0,
		        	    	"tax" => 0,
		        	    	"chargeable" => '',
		        	    	"payment_mode" => '',
		        	    	"discount" => '',
							"discount_name" => '',
							"discount_type" => '',
		        	    	"discount_value" => 0,
		        	        "billing_checkbox" => '',
		        	        "billing_first_name" => '',
		                    "billing_last_name" => '',
		        	        "billing_address" => '',
		                    "billing_city" => '',
		                    "billing_country" => '',
		                    "billing_state" => '',
		                    "billing_pincode" => '',
		        	        "billing_phone" => '',
							"CODcharges" => 0
		        	    ];
						
					}
		        	session()->put('customer', $customer);
					if(count((array) session('autoDiscount')) > 0){
						session()->put('customer.discount', 'automatic');
						session()->put('customer.discount_name', Session::get('autoDiscount')['discountTitle']);
						session()->put('customer.discount_type', Session::get('autoDiscount')['discountType']);
						session()->put('customer.discount_value', Session::get('autoDiscount')['discountValue']);
					}
                }
			}
			return view('checkout.contact-information', ['shippings'=>$shippings]);
		}else{
			return redirect('/cart');
		}
	}
	public function contact_information(Request $request){
		$validator = Validator::make($request->all(), [
		    'email' => 'bail|required',
		    'firstname' => 'bail|required',
		    'lastname' => 'bail|required',
		    'address' => 'bail|required',
		    'city' => 'bail|required',
		    'pincode' => 'bail|required',
		    'phone' => 'bail|required',
		    'billingFirstname' => 'bail|required',
		    'billingLastname' => 'bail|required',
		    'billingAddress' => 'bail|required',
		    'billingCity' => 'bail|required',
		    'billingPincode' => 'bail|required',
		    'billingPhone' => 'bail|required',
		]);
		
		if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }		
		
		$user = User::where('email', $request->email)->get();
		(count($user) == 0) ? $user_id = 0 : $user_id = $user[0]['id'];
		(isset($_POST['subscribed'])) ? $subscribed_status = 'Yes' : $subscribed_status = 'No';
		(isset($_POST['billingCheckbox'])) ? $billingCheckbox = 'Yes' : $billingCheckbox = 'No';
		
		$customer = Customers::where('email', $request->email)->get();
		$cust_id = 0;
		if(count($customer) > 0){
			Customers::where('email', $request->email)
		    ->update([
		    	'subscribed_status' => $subscribed_status,
		    	'first_name' => $request->firstname,
		    	'last_name' => $request->lastname,
		    	'shipping_address' => $request->address,
		    	'shipping_city' => $request->city,
		    	'shipping_state' => $request->state,
		    	'shipping_country' => $request->country,
		    	'shipping_pincode' => $request->pincode,
		        'phone' => $request->phone,
		    	'billing_status' => $billingCheckbox,
		    	'billing_first_name' => $request->billingFirstname,
		    	'billing_last_name' => $request->billingLastname,
		    	'billing_address' => $request->billingAddress,
		        'billing_city' => $request->billingCity,
		        'billing_state' => $request->billingState,
		        'billing_country' => $request->billingCountry,
		        'billing_pincode' => $request->billingPincode,
				'billing_phone' => $request->billingPhone
			]);
			$cust_id = $customer[0]['id'];
		}
		else{
			$customer = Customers::create([
		    	'users_id' => $user_id,
		    	'email' => $request->email,
		    	'subscribed_status' => $subscribed_status,
		    	'first_name' => $request->firstname,
		    	'last_name' => $request->lastname,
		    	'shipping_address' => $request->address,
		    	'shipping_city' => $request->city,
		    	'shipping_state' => $request->state,
		    	'shipping_country' => $request->country,
		    	'shipping_pincode' => $request->pincode,
		        'phone' => $request->phone,
		    	'billing_status' => $billingCheckbox,
		    	'billing_first_name' => $request->billingFirstname,
		    	'billing_last_name' => $request->billingLastname,
		    	'billing_address' => $request->billingAddress,
		        'billing_city' => $request->billingCity,
		        'billing_state' => $request->billingState,
		        'billing_country' => $request->billingCountry,
		        'billing_pincode' => $request->billingPincode,
				'billing_phone' => $request->billingPhone
		    ]);
			$cust_id = $customer->id;
		}
		
		$total = 0;
		$i = 0;
		foreach(session('cart') as $products => $product){
			if($i == 0){
				$productQuantities = $product['quantity'];
				$productCodes = $product['code'];
			}else{
				$productQuantities = $productQuantities.','.$product['quantity'];
				$productCodes = $productCodes.','.$product['code'];
			}
			$i++;
			$total += ($product['quantity'] * $product['price']);
		}
		
		$checkouts = Checkouts::where('id', Session::get('customer')['checkout'])->get();
		$checkout_id = 0;
		if(count($checkouts) > 0){
			Checkouts::where('id', Session::get('customer')['checkout'])
		    ->update([
		       'customers_id' => $cust_id,
			   'customers_name' => $request->firstname.' '.$request->lastname,
		       'email_status' => 'Not Sent',
		       'recovery_status' => 'Not Recovered',
		       'product_quantities' => $productQuantities,
		       'product_codes' => $productCodes,
			   'total' => $total
		    ]);
			$checkout_id = $checkouts[0]['id'];
		}
		else{
			$checkout = Checkouts::create([
		       'customers_id' => $cust_id,
			   'customers_name' => $request->firstname.' '.$request->lastname,
		       'email_status' => 'Not Sent',
		       'recovery_status' => 'Not Recovered',
		       'product_quantities' => $productQuantities,
		       'product_codes' => $productCodes,
			   'total' => $total
			]);
			$checkout_id = $checkout->id;
		}
		
		$customer = session()->get('customer');
		if(!$customer)
		{
			$customer = [
				"checkout" => $checkout_id,
				"email" => $request->email,
				"subscribed_status" => $subscribed_status,
				"first_name" => $request->firstname,
				"last_name" => $request->lastname,
				"address" => $request->address,
				"city" => $request->city,
				"country" => $request->country,
				"state" => $request->state,
				"pincode" => $request->pincode,
				"phone" => $request->phone,
				"shipping_name" => '',
				"shipping_cost" => 0,
				"tax" => 0,
		        "chargeable" => '',
				"payment_mode" => 'Online',
				"discount" => '',
				"discount_name" => '',
				"discount_type" => '',
				"discount_value" => 0,
			    "billing_checkbox" => $billingCheckbox,
			    "billing_first_name" => $request->billingFirstname,
		        "billing_last_name" => $request->billingLastname,
			    "billing_address" => $request->billingAddress,
		        "billing_city" => $request->billingCity,
		        "billing_country" => $request->billingCountry,
		        "billing_state" => $request->billingState,
		        "billing_pincode" => $request->billingPincode,
			    "billing_phone" => $request->billingPhone,
				"CODcharges" => 0
			];
			session()->put('customer', $customer);
			if(count((array) session('autoDiscount')) > 0){
		    	session()->put('customer.discount', 'automatic');
				session()->put('customer.discount_name', Session::get('autoDiscount')['discountTitle']);
				session()->put('customer.discount_type', Session::get('autoDiscount')['discountType']);
		    	session()->put('customer.discount_value', Session::get('autoDiscount')['discountValue']);
		    }
			return redirect('/checkout/shipping-method');
        }
		
		$customer = [
			"checkout" => $checkout_id,
			"email" => $request->email,
			"subscribed_status" => $subscribed_status,
			"first_name" => $request->firstname,
			"last_name" => $request->lastname,
			"address" => $request->address,
			"city" => $request->city,
			"state" => $request->state,
			"country" => $request->country,
			"pincode" => $request->pincode,
			"phone" => $request->phone,
			"shipping_name" => Session::get('customer')['shipping_name'],
			"shipping_cost" => Session::get('customer')['shipping_cost'],
			"tax" => Session::get('customer')['tax'],
			"chargeable" => Session::get('customer')['chargeable'],
			"payment_mode" => '',
			"discount" => Session::get('customer')['discount'],
			"discount_name" => Session::get('customer')['discount_name'],
			"discount_type" => Session::get('customer')['discount_type'],
			"discount_value" => Session::get('customer')['discount_value'],
			"billing_checkbox" => $billingCheckbox,
			"billing_first_name" => $request->billingFirstname,
		    "billing_last_name" => $request->billingLastname,
			"billing_address" => $request->billingAddress,
		    "billing_city" => $request->billingCity,
		    "billing_country" => $request->billingCountry,
		    "billing_state" => $request->billingState,
		    "billing_pincode" => $request->billingPincode,
			"billing_phone" => $request->billingPhone,
			"CODcharges" => 0
		];
		session()->put('customer', $customer);
		if(count((array) session('autoDiscount')) > 0){
			session()->put('customer.discount', 'automatic');
			session()->put('customer.discount_name', Session::get('autoDiscount')['discountTitle']);
			session()->put('customer.discount_type', Session::get('autoDiscount')['discountType']);
			session()->put('customer.discount_value', Session::get('autoDiscount')['discountValue']);
		}
		return redirect('/checkout/shipping-method');
	}
	
	public function login(){
		return view('checkout-login');
	}
    public function loggedIn(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
			return redirect()->intended('/checkout/contact-information');
        }
		else{
			$request->session()->flash('warning', 'Email ID or Password does not match our records.');
			return back();
		}
    }
	
	public function shipping(){
		if(count((array) session('cart')) > 0){
			$shippings = Shipping::where([['country', Session::get('customer')['country']], ['state', Session::get('customer')['state']]])->get();
			$tax = Tax::where('country', Session::get('customer')['country'])->get();
			session()->put('customer.tax', $tax[0]['tax']);
			session()->put('customer.chargeable', $tax[0]['charge']);
			
			return view('checkout.shipping-method', ['shippings' => $shippings]);
		}else{
			return redirect('/cart');
		}
	}
	public function shipping_method(Request $request){
		if(count((array) session('cart')) > 0){
			$shippings = Shipping::where([['country', Session::get('customer')['country']], ['state', Session::get('customer')['state']], ['cost', $request->shippingRadio]])->get();
			session()->put('customer.shipping_name', $shippings[0]['name']);
			session()->put('customer.shipping_cost', $shippings[0]['cost']);
			return redirect('/checkout/payment-method');
		}else{
			return redirect('/cart');
		}
	}
	
	public function payment(){
		if(count((array) session('cart')) > 0){
			$total = 0; $discount = 0; $tax = 0;
			foreach(session('cart') as $products => $product){
				$total += $product['price'] * $product['quantity'];
			}
			if(Session::get('customer')['discount_value'] > 0){
				if(Session::get('customer')['discount_type'] == "Percentage"){
					$discount = (($total * Session::get('customer')['discount_value']) / 100);
				}else{
					$discount = Session::get('customer')['discount_value'];
				}
				$total -= $discount;
			}
			if(Session::get('customer')['chargeable'] == "Yes"){
				$tax = (($total * Session::get('customer')['tax']) / 100);
				$total += $tax;
			}
			$total = $total + Session::get('customer')['shipping_cost'] + Session::get('customer')['CODcharges'];
			
			$payments = [];
			$applicableMethods = [];
			$applicableMethods[0] = "All";
			$applicableMethods[1] = Session::get('customer')['state'];
			$allpayments = Payments::where('country',Session::get('customer')['country'])->whereIn('state', $applicableMethods)->get();
			foreach($allpayments as $allpayment){
				if($allpayment['payment_mode'] == 'Online'){
					array_push($payments,'Online');
				}
				elseif($allpayment['payment_mode'] == 'COD'){
					if($allpayment['max_order_value'] == 0){
						if($total >= $allpayment['min_order_value']){
							array_push($payments,'COD');
						}
					}else{
						if($total >= $allpayment['min_order_value'] && $total < $allpayment['max_order_value']){
							array_push($payments,'COD');
						}
					}
				}
				else{
					array_push($payments,$allpayment['payment_mode']);
				}
			}
			
			return view('checkout.payment-method', ['payments' => $payments]);
		}else{
			return redirect('/cart');
		}
	}
	public function payment_method(Request $request){
		if(count((array) session('cart')) > 0){
			session()->put('customer.payment_mode', $request->paymentRadio);
			if($request->paymentRadio == "COD"){
				session()->put('customer.CODcharges', 50);
			}else{
				session()->put('customer.CODcharges', 0);
			}
			return redirect('/checkout/review');
		}else{
			return redirect('/cart');
		}
	}
	
	public function apply_discountCode(Request $request){
		$discount = discountCodes::where('discountCode',strtoupper($request->discountCode))->first();
		$now = date("Y-m-d");
		$total = 0;
		foreach(session('cart') as $products => $product){
			$total += $product['price'] * $product['quantity'];
		}
			
		if($discount){
			if($discount['discountStatus'] == "Active"){
				if($discount['discountMinPurchaseAmt'] <= $total){
		    		if($discount['discountStartDate'] <= $now){
		    			if($discount['discountEndDate'] >= $now || $discount['discountEndDate'] == ""){
							if($discount['discountOncePerUser'] != "Yes"){
								session()->put('customer.discount', 'code');
								session()->put('customer.discount_name', strtoupper($request->discountCode));
								session()->put('customer.discount_type', $discount['discountType']);
								session()->put('customer.discount_value', $discount['discountValue']);
								$total -= (($total * $discount['discountValue'])/100);
								
								$shippings = Shipping::where([['country', Session::get('customer')['country']], ['state', Session::get('customer')['state']]])->orderBy('min_order_value','desc')->get();
								foreach($shippings as $shipping){
									if($total >= $shipping['min_order_value']){
										session()->put('customer.shipping_name', $shipping['name']);
										session()->put('customer.shipping_cost', $shipping['cost']);
									}
								}
								
								return back();
							}else{
								$orders = Orders::where('discount_name', strtoupper($request->discountCode))->get();
								if(count($orders) > 0){
									$messages = [
			                            'discountCode' => 'This discount code has been already used.',
			                        ];
			                        return back()->withErrors($messages)->withInput();
								}else{
									session()->put('customer.discount', 'code');
								    session()->put('customer.discount_name', strtoupper($request->discountCode));
								    session()->put('customer.discount_type', $discount['discountType']);
								    session()->put('customer.discount_value', $discount['discountValue']);
									$total -= (($total * $discount['discountValue'])/100);
									
									$shippings = Shipping::where([['country', Session::get('customer')['country']], ['state', Session::get('customer')['state']]])->orderBy('min_order_value','asc')->get();
									foreach($shippings as $shipping){
										if($total >= $shipping['min_order_value']){
											session()->put('customer.shipping_name', $shipping['name']);
											session()->put('customer.shipping_cost', $shipping['cost']);
										}
									}
									
									return back();
								}
							}
						}else{
							$messages = [
			                    'discountCode' => 'This discount code has been expired.',
			                ];
			                return back()->withErrors($messages)->withInput();
						}
					}else{
						$messages = [
			                'discountCode' => 'This discount code is not activated.',
			            ];
			            return back()->withErrors($messages)->withInput();
					}
				}else{
					$messages = [
			            'discountCode' => 'Minimum purchase amount should be INR '.number_format($discount['discountMinPurchaseAmt'],2).'.',
			        ];
			        return back()->withErrors($messages)->withInput();
				}
			}else{
				$messages = [
			        'discountCode' => 'This discount code has expired.',
			    ];
			    return back()->withErrors($messages)->withInput();
			}
		}else{
			$messages = [
			    'discountCode' => 'This discount code is not valid.',
			];
			return back()->withErrors($messages)->withInput();
		}
	}
	public function remove_discountCode(){
		session()->put('customer.discount', '');
		session()->put('customer.discount_name', '');
		session()->put('customer.discount_type', '');
		session()->put('customer.discount_value', 0);
		
		$total = 0;
		foreach(session('cart') as $products => $product){
			$total += $product['price'] * $product['quantity'];
		}
		
		$shippings = Shipping::where([['country', Session::get('customer')['country']], ['state', Session::get('customer')['state']]])->orderBy('min_order_value','asc')->get();
		foreach($shippings as $shipping){
			if($total >= $shipping['min_order_value']){
				session()->put('customer.shipping_name', $shipping['name']);
				session()->put('customer.shipping_cost', $shipping['cost']);
			}
		}
		return;
	}
	
	public function review(){
		if(count((array) session('cart')) > 0){
			$receipt = "#vc".Session::get('customer')['checkout'];
			$total = 0; $discount = 0; $tax = 0;
			foreach(session('cart') as $products => $product){
				$total += $product['price'] * $product['quantity'];
			}
			if(Session::get('customer')['discount_value'] != "" || Session::get('customer')['discount_value'] != 0){
				if(Session::get('customer')['discount_type'] == "Percentage"){
					$discount = (($total * Session::get('customer')['discount_value']) / 100);
				}else{
					$discount = Session::get('customer')['discount_value'];
				}
				$total -= $discount;
			}
			if(Session::get('customer')['chargeable'] == "Yes"){
				$tax = (($total * Session::get('customer')['tax']) / 100);
				$total += $tax;
			}
			$total = $total + Session::get('customer')['shipping_cost'] + Session::get('customer')['CODcharges'];
			$total = filter_var(number_format($total,2), FILTER_SANITIZE_NUMBER_INT);
			
			if(Session::get('customer')['payment_mode'] == "COD"){
				$callbackUrl = "/orders";
				return view('checkout.review', ['callbackUrl'=>$callbackUrl]);
			}
			else{
		    	$api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
			    $razorpayOrder  = $api->order->create([
			        'receipt' => $receipt,
			    	'amount' => $total,
			    	'currency' => 'INR'
			    ]);
			    
			    $description = "";
			    $i=0;
			    foreach(session('cart') as $products => $product){
			    	if($i == 0){
			    		$description = $product['name'];
			    	}else{
			    		$description += ",".$product['name'];
			    	}
			    }
			    return view('checkout.review', ['key_id'=>env('RAZOR_KEY'), 'razorpayOrder'=>$razorpayOrder, 'description'=>$description]);
			}
		}else{
			return redirect('/cart');
		}
	}
	
	public function order(Request $request){
		if(count((array) session('cart')) > 0){
		    if(Session::get('customer')['payment_mode'] == "COD"){
				$payment_status = "Pending";
		        
		        $subtotal = 0; $total = 0; $discount = 0; $tax = 0;
		        foreach(session('cart') as $products => $product){
		        	$total += $product['price'] * $product['quantity'];
		        }
			    $subtotal = $total;
			    if(Session::get('customer')['discount_value'] != ""){
			    	if(Session::get('customer')['discount_type'] == "Percentage"){
			    		$discount = (($total * Session::get('customer')['discount_value']) / 100);
			    	}else{
			    		$discount = Session::get('customer')['discount_value'];
			    	}
			    	$total -= $discount;
			    }
			    if(Session::get('customer')['chargeable'] == "Yes"){
			    	$tax = (($total * Session::get('customer')['tax']) / 100);
			    	$total += $tax;
			    }
		        
		        $total = $total + Session::get('customer')['shipping_cost'] + Session::get('customer')['CODcharges'];
		        
		        $orders = Orders::create([
		           'custom_order_id' => 0,
			       'cust_email' => Session::get('customer')['email'],
			       'subtotal' => $subtotal,
			       'discount_category' => Session::get('customer')['discount'],
			       'discount_name' => Session::get('customer')['discount_name'],
			       'discount_type' => Session::get('customer')['discount_type'],
			       'discount_value' => Session::get('customer')['discount_value'],
		           'discount' => $discount,
		           'shipping_name' => Session::get('customer')['shipping_name'],
		           'shipping_cost' => Session::get('customer')['shipping_cost'],
		           'cod_charges' => Session::get('customer')['CODcharges'],
		           'tax' => $tax,
		           'total_amount' => $total,
		           'payment_mode' => Session::get('customer')['payment_mode'],
		           'payment_status' => $payment_status,
				   'razorpay_orderID' => "",
				   'razorpay_paymentID' => "",
				   'razorpay_signature' => "",
		           'order_status' => 'Reviewed',
				   'event_trigger' => 'true'
		        ]);
		        $orders_id = $orders->id;
		        $custom_order_id1 = decoct(ord(Session::get('customer')['first_name']));
		        $custom_order_id2 = decoct(ord(Session::get('customer')['last_name']));
		        $custom_order_id = $custom_order_id1.$orders_id.$custom_order_id2;
		        Orders::where('id', $orders_id)
		        ->update([
		            'custom_order_id' => $custom_order_id
		        ]);
		        
		        Orders_customers::create([
		           'orders_id' => $orders_id,
		           'email' => Session::get('customer')['email'],
		           'subscribed_status' => Session::get('customer')['subscribed_status'],
		           'first_name' => Session::get('customer')['first_name'],
		           'last_name' => Session::get('customer')['last_name'],
		           'shipping_address' => Session::get('customer')['address'],
		           'shipping_city' => Session::get('customer')['city'],
		           'shipping_state' => Session::get('customer')['state'],
		           'shipping_country' => Session::get('customer')['country'],
		           'shipping_pincode' => Session::get('customer')['pincode'],
		           'phone' => Session::get('customer')['phone'],
		           'billing_status' => Session::get('customer')['billing_checkbox'],
		           'billing_first_name' => Session::get('customer')['billing_first_name'],
		           'billing_last_name' => Session::get('customer')['billing_last_name'],
		           'billing_address' => Session::get('customer')['billing_address'],
		           'billing_city' => Session::get('customer')['billing_city'],
		           'billing_state' => Session::get('customer')['billing_state'],
		           'billing_country' => Session::get('customer')['billing_country'],
		           'billing_pincode' => Session::get('customer')['billing_pincode'],
		           'billing_phone' => Session::get('customer')['billing_phone']
		        ]);
		        
		        foreach(session('cart') as $products => $product){
		        	Orders_items::create([
		               'orders_id' => $orders_id,
		               'product_category' => $product['category'],
		               'product_subCategory' => $product['subCategory'],
		               'product_name' => $product['name'],
		               'product_url' => $product['url'],
		               'product_pic1' => $product['image'],
		               'product_discountedPrice' => $product['price'],
		               'product_modelNo' => $product['code'],
		               'product_quantity' => $product['quantity'],
		               'product_isVariant' => $product['hasVariant'],
		               'product_variationType' => $product['variantType'],
		               'product_variationNumber' => $product['variantNum'],
		               'product_variationValue' => $product['variantValue'],
		               'product_variationSKU' => $product['variantSKU']
		            ]);
					
			        if($product['hasVariant'] == 'No'){
			        	$qty = "product_quantity";
			        }else{
			        	$qty = "product_variant".$product['variantNum']."qty";
			        }
					Products::where('product_code', $product['code'])->decrement($qty, $product['quantity']);
		        }
			    
			    Checkouts::where('id', Session::get('customer')['checkout'])->delete();
			    
			    OrderMails::dispatchAfterResponse($orders_id, $custom_order_id, Session::get('customer')['email']);
			    
		        return redirect('/order-confirmation/'.$custom_order_id);
			}
			else{
			    $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
				$payment_status = "";
			    try{
					$attributes  = array('razorpay_signature' => $request->razorpay_signature, 'razorpay_payment_id' => $request->razorpay_payment_id, 'razorpay_order_id' => $request->razorpay_order_id);
					$order  = $api->utility->verifyPaymentSignature($attributes);
					$payment_status = "Paid";
		        	
		        	$subtotal = 0; $total = 0; $discount = 0; $tax = 0;
		        	foreach(session('cart') as $products => $product){
		        		$total += $product['price'] * $product['quantity'];
		        	}
			    	$subtotal = $total;
			    	if(Session::get('customer')['discount_value'] != ""){
			        	if(Session::get('customer')['discount_type'] == "Percentage"){
			        		$discount = (($total * Session::get('customer')['discount_value']) / 100);
			        	}else{
			        		$discount = Session::get('customer')['discount_value'];
			        	}
			        	$total -= $discount;
			        }
			    	if(Session::get('customer')['chargeable'] == "Yes"){
			        	$tax = (($total * Session::get('customer')['tax']) / 100);
			    		$total += $tax;
			        }
		        	
		        	$total = $total + Session::get('customer')['shipping_cost'] + Session::get('customer')['CODcharges'];
		        	
		        	$orders = Orders::create([
		               'custom_order_id' => 0,
			    	   'cust_email' => Session::get('customer')['email'],
			    	   'subtotal' => $subtotal,
			    	   'discount_category' => Session::get('customer')['discount'],
			    	   'discount_name' => Session::get('customer')['discount_name'],
			    	   'discount_type' => Session::get('customer')['discount_type'],
			    	   'discount_value' => Session::get('customer')['discount_value'],
		               'discount' => $discount,
		               'shipping_name' => Session::get('customer')['shipping_name'],
		               'shipping_cost' => Session::get('customer')['shipping_cost'],
		               'cod_charges' => Session::get('customer')['CODcharges'],
		               'tax' => $tax,
		               'total_amount' => $total,
		               'payment_mode' => Session::get('customer')['payment_mode'],
		               'payment_status' => $payment_status,
					   'razorpay_orderID' => $request->razorpay_order_id,
					   'razorpay_paymentID' => $request->razorpay_payment_id,
					   'razorpay_signature' => $request->razorpay_signature,
		               'order_status' => 'Reviewed',
					   'event_trigger' => 'true'
		        	]);
		        	$orders_id = $orders->id;
		        	$custom_order_id1 = decoct(ord(Session::get('customer')['first_name']));
		        	$custom_order_id2 = decoct(ord(Session::get('customer')['last_name']));
		        	$custom_order_id = $custom_order_id1.$orders_id.$custom_order_id2;
		        	Orders::where('id', $orders_id)
		            ->update([
		        	    'custom_order_id' => $custom_order_id
		        	]);
		        	
		        	Orders_customers::create([
		               'orders_id' => $orders_id,
		               'email' => Session::get('customer')['email'],
		               'subscribed_status' => Session::get('customer')['subscribed_status'],
		               'first_name' => Session::get('customer')['first_name'],
		               'last_name' => Session::get('customer')['last_name'],
		               'shipping_address' => Session::get('customer')['address'],
		               'shipping_city' => Session::get('customer')['city'],
		               'shipping_state' => Session::get('customer')['state'],
		               'shipping_country' => Session::get('customer')['country'],
		               'shipping_pincode' => Session::get('customer')['pincode'],
		               'phone' => Session::get('customer')['phone'],
		               'billing_status' => Session::get('customer')['billing_checkbox'],
		               'billing_first_name' => Session::get('customer')['billing_first_name'],
		               'billing_last_name' => Session::get('customer')['billing_last_name'],
		               'billing_address' => Session::get('customer')['billing_address'],
		               'billing_city' => Session::get('customer')['billing_city'],
		               'billing_state' => Session::get('customer')['billing_state'],
		               'billing_country' => Session::get('customer')['billing_country'],
		               'billing_pincode' => Session::get('customer')['billing_pincode'],
		               'billing_phone' => Session::get('customer')['billing_phone']
		        	]);
		        	
		        	foreach(session('cart') as $products => $product){
		            	Orders_items::create([
		                   'orders_id' => $orders_id,
		                   'product_category' => $product['category'],
		                   'product_subCategory' => $product['subCategory'],
		                   'product_name' => $product['name'],
		                   'product_url' => $product['url'],
		                   'product_pic1' => $product['image'],
		                   'product_discountedPrice' => $product['price'],
		                   'product_modelNo' => $product['code'],
		                   'product_quantity' => $product['quantity'],
		                   'product_isVariant' => $product['hasVariant'],
		                   'product_variationType' => $product['variantType'],
		                   'product_variationNumber' => $product['variantNum'],
		                   'product_variationValue' => $product['variantValue'],
		                   'product_variationSKU' => $product['variantSKU']
		                ]);
				    	
			            if($product['hasVariant'] == 'No'){
			            	$qty = "product_quantity";
			            }else{
			            	$qty = "product_variant".$product['variantNum']."qty";
			            }
				    	Products::where('product_code', $product['code'])->decrement($qty, $product['quantity']);
		            }
			    	
			    	Checkouts::where('id', Session::get('customer')['checkout'])->delete();
			    	
			    	OrderMails::dispatchAfterResponse($orders_id, $custom_order_id, Session::get('customer')['email']);
			    	
		        	return redirect('/order-confirmation/'.$custom_order_id);
		        }
		        catch(SignatureVerificationError $e)
		        {
		        	$payment_status = "failed";
		        	$error = 'Razorpay Error : ' . $e->getMessage();
			     	return back()->with(['error' => $error]);
		        }
			}
		}else{
			return redirect('/cart');
		}
	}
	public function order_confirmation($order_number){
		Session::flush('cart');
		Session::flush('customer');
		
		$orders = Orders::where('custom_order_id', $order_number)->firstOrFail();
		if($orders['event_trigger'] == "true"){
			$orders_customers = Orders_customers::where('orders_id', $orders->id)->get();
			$orders_items = Orders_items::where('orders_id', $orders->id)->get();
			return view('checkout.order-confirmation', ['orders'=> $orders, 'orders_customers' => $orders_customers, 'orders_items' => $orders_items]);
		}else{
			return redirect('/orders/'.$order_number);
		}
	}
	public function thank_you_page($order_number){
		$orders = Orders::where('custom_order_id', $order_number)->firstOrFail();
		$orders_customers = Orders_customers::where('orders_id', $orders->id)->get();
		$orders_items = Orders_items::where('orders_id', $orders->id)->get();
		return view('checkout.order-confirmation', ['orders'=> $orders, 'orders_customers' => $orders_customers, 'orders_items' => $orders_items]);
	}
	public function order_eventTrigger($order_number){
		if($order_number){
			Orders::where('custom_order_id',$order_number)->update([
		    	'event_trigger' => 'false'
		    ]);
		}
	}
}
