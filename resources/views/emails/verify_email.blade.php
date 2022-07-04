@component('mail::message')
# Verify your email address
You have registered to the Notion-Widgets website. In order to login and use the feature of the website, you need to verify your email address.

Please click the button below to verify your email address.

@component('mail::button', ['url' => $verify_url])
Verify Email Address
@endcomponent


If you did not create an account, just ignore this email.

Thanks,<br>
{{ config('app.name') }}


<hr> 
<h5> If you are having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: {{$verify_url}}</h5>

@endcomponent
