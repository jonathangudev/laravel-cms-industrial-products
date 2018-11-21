@component('mail::message')
# Welcome to your {{ config('app.name') }} account.

@isset ($companyName, $companyLogo)
You have been added to the "{{ $companyName }}" company catalog.
![alt text]({{ $companyLogo }} "Logo Title Text")
@endisset

You can log in at {{ $loginUrl }}

With the email __{{ $userEmail }}__

Please use the buttons below to reset, or create your password, and verify your email.

{{-- Action Buttons --}}
@component('mail::button', ['url' => $passwordResetLink])
Reset / Create Password
@endcomponent

@component('mail::button', ['url' => $verificationLink])
Verify Your Email
@endcomponent

{{-- Salutation --}}
Thanks,<br>
{{ config('app.name') }}

{{-- Subcopy --}}
@component('mail::subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser: [:actionURL](:actionURL)',
    [
        'actionText' => 'Reset / Create Password',
        'actionURL' => $passwordResetLink,
    ]
)
@endcomponent


@component('mail::subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser: [:actionURL](:actionURL)',
    [
        'actionText' => 'Verify Your Email',
        'actionURL' => $verificationLink,
    ]
)
@endcomponent
@endcomponent
