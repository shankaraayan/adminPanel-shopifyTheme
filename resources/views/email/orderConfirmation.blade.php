@component('mail::message')
#{{$orders_id}} Thank you for your purchase!

Hi {{Session::get('customer')['first_name']}}, we're getting your order ready to be shipped. We will notify you when it has been sent.
@php $url = config('app.url')."/orders/".$custom_order_id; @endphp
@component('mail::button', ['url' => $url])
View your order
@endcomponent

Order summary
@php $subtotal = 0; $tax = 0; @endphp
@component('mail::table')
| Product | Price |
| ------------- | --------:|
@foreach(session('cart') as $products => $product)
| <b>{{$product['name']}} </b>X <b>{{$product['quantity']}}</b> | <b>INR @php echo number_format($product['price']) @endphp</b> |
@php $subtotal +=  $product['quantity'] * $product['price']; @endphp
@endforeach
| Subtotal: | INR @php echo number_format($subtotal) @endphp |
@if(Session::get('customer')['discount_value'] > 0)| Discount: {{Session::get('customer')['discount_name']}}| @if(Session::get('customer')['discount_type'] == "Percentage") @php $discount = (($subtotal * Session::get('customer')['discount_value']) / 100) @endphp @else @php $discount = Session::get('customer')['discount_value'] @endphp @endif - INR @php echo number_format($discount, 2) @endphp |@else @php $discount = 0 @endphp @endif
| Shipping: | @if(Session::get('customer')['shipping_cost'] > 0)INR {{Session::get('customer')['shipping_cost']}} @else Free @endif |
@if(Session::get('customer')['CODcharges'] > 0)| COD charges: | INR {{Session::get('customer')['CODcharges']}} |@endif
| Taxes: | @if(Session::get('customer')['chargeable'] == "Yes")INR @php $tax = money_format((($subtotal - $discount) * Session::get('customer')['tax']) / 100) @endphp {{$tax}} @else inclusive of all taxes @endif |
| <b>Total:</b> | <b>INR @php echo number_format($subtotal - $discount + Session::get('customer')['shipping_cost'] + Session::get('customer')['CODcharges'] + $tax) @endphp</b> |
| ------------- | ------------- |
Customer information
| <b>Shipping address</b> | <b>Billing address</b> |
| {{Session::get('customer')['first_name']}} {{Session::get('customer')['last_name']}} | {{Session::get('customer')['billing_first_name']}} {{Session::get('customer')['billing_last_name']}} |
| {{Session::get('customer')['address']}} {{Session::get('customer')['city']}} {{Session::get('customer')['state']}} {{Session::get('customer')['pincode']}} {{Session::get('customer')['country']}} | {{Session::get('customer')['billing_address']}} {{Session::get('customer')['billing_city']}} {{Session::get('customer')['billing_state']}} {{Session::get('customer')['billing_pincode']}} {{Session::get('customer')['billing_country']}} |
| {{Session::get('customer')['phone']}} | {{Session::get('customer')['billing_phone']}} |
| <b>Shipping method</b> | <b>Payment method</b> |
| {{Session::get('customer')['shipping_name']}} | {{Session::get('customer')['payment_mode']}} - INR @php echo number_format($subtotal - $discount + Session::get('customer')['shipping_cost'] + Session::get('customer')['CODcharges'] + $tax) @endphp |
@endcomponent

If you have any questions, please contact us at<br>
<a href="mailto:{{config('app.email')}}">{{config('app.email')}}</a>
@endcomponent
