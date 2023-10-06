@component('mail::message')
#{{$orders['id']}} Order has been shipped!

Hi {{$Orders_customers['first_name']}}, We have shipped your order successfully via {{$orders['shipping_carrier']}} and the tracking number is {{$orders['shipping_tracking_number']}}.
@php $url = $orders['shipping_tracking_link'] @endphp
@component('mail::button', ['url' => $url])
Track your order
@endcomponent

If you have any questions, please contact us at<br>
<a href="mailto:{{config('app.email')}}">{{config('app.email')}}</a>
@endcomponent
