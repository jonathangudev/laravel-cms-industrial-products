@extends('layouts.auth')

@section('title', 'Verify Email')

@push('head-preload')
    <link rel="preload" href="{{ mix('/css/buttons.css') }}" as="style" type="text/css">
    <link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
@endpush

@section('alert-content')
    @if (session('resent'))
        @push('head-preload')
            <link rel="preload" href="{{ mix('/css/alert.css') }}" as="style" type="text/css">
        @endpush

        <link rel="stylesheet" href="{{ mix('/css/alert.css') }}">
        @component('partials.alert')
            {{ __('A fresh verification link has been sent to your email address.') }}
        @endcomponent
    @endif
@endsection

@section('content')
    <link rel="stylesheet" href="{{ mix('/css/section.css') }}">
    <div class="c-section d-none d-md-block">
        <h3>Reset Password</h3>
    </div>
    <div class="c-section c-section--center d-md-none">
        <h2>Reset Password</h2>
    </div>

    <p>
        {{ __('Before proceeding, please check your email for a verification link.') }}
        <br/>{{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </p>
@endsection
