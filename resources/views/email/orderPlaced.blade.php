@component('mail::message')
{{Session::get('customer')['first_name']}} {{Session::get('customer')['last_name']}} placed a new order with your store.

Order summary
@component('mail::table')
| Product | Price |
| ------------- | --------:|
@foreach(session('cart') as $products => $product)
| <b>{{$product['name']}} </b>X <b>{{$product['quantity']}}</b> | <b>INR @php echo number_format($product['price']) @endphp each</b> |
@endforeach
@endcomponent

<b>Payment processing method:</b>
{{Session::get('customer')['payment_mode']}}

<b>Delivery method:</b>
{{Session::get('customer')['shipping_name']}}

<b>Shipping address:</b>
{{Session::get('customer')['address']}}, {{Session::get('customer')['city']}},
{{Session::get('customer')['state']}} - {{Session::get('customer')['pincode']}},
{{Session::get('customer')['country']}}
{{Session::get('customer')['phone']}}

@endcomponent
