@component('mail::message')
Hi,{{ $employee->name }}
<br>
<P>Email id : {{ $employee->email }}
</P>


@component('mail::button', ['url' => ''])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
