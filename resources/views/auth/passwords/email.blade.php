@extends('layouts.auth')

@section('title', 'Reset Password')

@push('head-preload')
    <link rel="preload" href="{{ mix('/css/buttons.css') }}" as="style" type="text/css">
    <link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
@endpush

@section('alert-content')
    @if (session('status'))
        @push('head-preload')
            <link rel="preload" href="{{ mix('/css/alert.css') }}" as="style" type="text/css">
        @endpush

        <link rel="stylesheet" href="{{ mix('/css/alert.css') }}">
        @component('partials.alert')
            {{ session('status') }}
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

    <form method="POST" action="{{ route('password.email') }}" class="o-form">
        @csrf

        <fieldset>
            <legend>Password Reset Information</legend>

            <div class="o-form__group {{ $errors->has('email') ? ' is-error' : '' }}">
                <label for="reset-email">{{ __('Email Address') }}</label>
                <input id="reset-email" type="email" class="{{ $errors->has('email') ? ' is-error' : '' }}" name="email" placeholder="e.g. wile.e.coyote@acme.com" value="{{ $email ?? old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <p class="o-form__error-text" role="alert">
                        <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('email') }}</span>
                    </p>
                @endif
            </div>
    
            <link rel="stylesheet" href="{{ mix('/css/buttons.css') }}">
            <button type="submit" class="c-btn c-btn--primary c-btn--block">{{ __('Send Reset Link') }}</button>
        </fieldset>
    </form>
@endsection
