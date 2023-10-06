@component('mail::message')
#{{$data['category']}}

{{$data['subject']}}

<b>Email: </b> {{$data['email']}}<br/>
<b>Phone: </b> {{$data['phone']}}<br/>
<b>Name: </b> {{$data['firstName']}} {{$data['lastName']}}<br/>
<b>Message: </b>
{{$data['description']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
