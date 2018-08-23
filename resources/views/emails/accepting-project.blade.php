@component('mail::message')
# Introduction

Hello {{$user_name}},
<br>
Congratulation!!! Your project named <b>{{$project_name}}</b> has accepted.

<br>
<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
