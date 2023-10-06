@component('mail::message')
#{{$orders['id']}} Order has been cancelled!

Hi {{$Orders_customers['first_name']}}, We have cancelled your order as per your request. @if($orders['payment_status'] == "Paid")The total amount INR @php echo number_format($orders['total_amount'],2) @endphp will be refund within 15 working days. @endif
<br/>
<br/>
Thank you for choosing us!
@php $url = config('app.url').'/myorders/'.$orders['id']; @endphp
@component('mail::button', ['url' => $url])
View your order
@endcomponent

If you have any questions, please contact us at<br>
<a href="mailto:{{config('app.email')}}">{{config('app.email')}}</a>
@endcomponent