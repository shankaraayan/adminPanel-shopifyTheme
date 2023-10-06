@component('mail::message')
#{{$orders['id']}} Order has been fulfilled!

Hi {{$Orders_customers['first_name']}}, We have delivered your order successfully via {{$orders['shipping_carrier']}}.
Thank you for choosing us!
@php $url = config('app.url').'/myorders/'.$orders['id']; @endphp
@component('mail::button', ['url' => $url])
View your order
@endcomponent

If you have any questions, please contact us at<br>
<a href="mailto:{{config('app.email')}}">{{config('app.email')}}</a>
@endcomponent
