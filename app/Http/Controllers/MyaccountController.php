<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Shipping;
use App\Models\Orders;
use App\Models\Orders_customers;
use App\Models\Orders_items;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyaccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
		$user_id = Auth::user()->id;
		$user_email = Auth::user()->email;
		
		Customers::updateOrCreate(
			['email' => Auth::user()->email],
			['users_id' => Auth::user()->id]
		);
		
		if($user_email === env('ADMIN_EMAIL')){
			return redirect('/admin');
		}else{
		    $customers = Customers::where('email', $user_email)->first();
		    if($customers == null){
		    	$customers = Orders_customers::where('email', $user_email)->orderBy('id', 'desc')->first();
		    }
		    $shippings = Shipping::where('country', 'India')->orderBy('state')->get();
		    ($customers == null) ? $billing_status = "Yes" : $billing_status = $customers->billing_status;
			
            return view('myaccount.home', ['user_info'=>$customers, 'shippings'=>$shippings, 'billing_status'=>$billing_status]);
		}
    }
	
	public function update_info(Request $request){
		$subscribed_status = "No";
		$billingCheckbox = "No";
		$billingFirstname = trim($request->billingFirstname);
		$billingLastname = trim($request->billingLastname);
		$billingAddress = trim($request->billingAddress);
		$billingCity = trim($request->billingCity);
		$billingState = trim($request->billingState);
		$billingCountry = trim($request->billingCountry);
		$billingPincode = trim($request->billingPincode);
		$billingPhone = trim($request->billingPhone);
		if($request->subscribed != ""){$subscribed_status = "Yes";}
		if($request->billingCheckbox != ""){
			$billingCheckbox = "Yes";
			$billingFirstname = trim($request->shippingFirstname);
		    $billingLastname = trim($request->shippingLastname);
		    $billingAddress = trim($request->shippingAddress);
		    $billingCity = trim($request->shippingCity);
		    $billingState = trim($request->shippingState);
		    $billingCountry = trim($request->shippingCountry);
		    $billingPincode = trim($request->shippingPincode);
		    $billingPhone = trim($request->shippingPhone);
		}
		
		Customers::where('email', Auth::user()->email)->update([
			'users_id' => Auth::user()->id,
			'subscribed_status' => $subscribed_status,
			'first_name' => trim($request->shippingFirstname),
			'last_name' => trim($request->shippingLastname),
			'shipping_address' => trim($request->shippingAddress),
			'shipping_city' => trim($request->shippingCity),
			'shipping_state' => $request->shippingState,
			'shipping_country' => $request->shippingCountry,
			'shipping_pincode' => trim($request->shippingPincode),
		    'phone' => trim($request->shippingPhone),
			'billing_status' => $billingCheckbox,
			'billing_first_name' => $billingFirstname,
			'billing_last_name' => $billingLastname,
			'billing_address' => $billingAddress,
		    'billing_city' => $billingCity,
		    'billing_state' => $billingState,
		    'billing_country' => $billingCountry,
		    'billing_pincode' => $billingPincode,
			'billing_phone' => $billingPhone
		]);
		
		return back();
	}
	
	public function myorders(){
		$orders_customers = Orders_customers::select('orders_id')->where('email', Auth::user()->email)->orderBy('id', 'desc')->get();
		$orderID = [];$i = 0;
		foreach($orders_customers as $orders_customer){
			$orderID[$i] = $orders_customer->orders_id;
			$i++;
		}
		$orders = Orders::whereIn('id', $orderID)->orderBy('id', 'desc')->get();
		return view('myaccount.myorders', ['orders'=>$orders]);
	}
	
	public function myorder($orderID){
		$orders = Orders::where('custom_order_id', $orderID)->orderBy('id', 'desc')->first();
		$orders_customers = Orders_customers::where('orders_id', $orders->id)->orderBy('id', 'desc')->first();
		$orders_items = Orders_items::where('orders_id', $orders->id)->get();
		return view('myaccount.myorder', ['orders'=>$orders, 'orders_customers'=>$orders_customers, 'orders_items'=>$orders_items]);
	}
}
