@component('mail::message')
# Introduction

Hello {{$user_name}},
<br>
Your project named <b>{{$project_name}}</b> has been rejected. The reason behind the rejection is given below:
<br>
<br>
<h2>Reason:</h2>
<hr>
{{$email_body}}

<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
