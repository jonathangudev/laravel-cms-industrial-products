@extends('layouts.auth')

@section('title', 'Reset Password')

@push('head-preload')
    <link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
@endpush

@section('content')
    <link rel="stylesheet" href="{{ mix('/css/section.css') }}">
    <div class="c-section d-none d-md-block">
        <h3>Reset Password</h3>
    </div>
    <div class="c-section c-section--center d-md-none">
        <h2>Reset Password</h2>
    </div>

    <form method="POST" action="{{ route('password.update') }}" class="o-form">
        @csrf

        <fieldset>
            <legend>Reset Password Information</legend>
            <input type="hidden" name="token" value="{{ $token }}">
    
            <div class="o-form__group {{ $errors->has('email') ? ' is-error' : '' }}">
                <label for="reset-email">{{ __('Email Address') }}</label>
                <input id="reset-email" type="email" class="{{ $errors->has('email') ? ' is-error' : '' }}" name="email" placeholder="e.g. wile.e.coyote@acme.com" value="{{ $email ?? old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <p class="o-form__error-text" role="alert">
                        <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('email') }}</span>
                    </p>
                @endif
            </div>
    
            <div class="o-form__group {{ $errors->has('password') ? ' is-error' : '' }}">
                <label for="reset-password">{{ __('Password') }}</label>
                <input id="reset-password" type="password" class="{{ $errors->has('password') ? ' is-error' : '' }}" placeholder="e.g. **********"" name="password" required>
    
                @if ($errors->has('password'))
                    <p class="o-form__error-text" role="alert">
                        <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('password') }}</span>
                    </p>
                @endif
            </div>
    
            <div class="o-form__group">
                <label for="reset-password-confirm">{{ __('Confirm Password') }}</label>
                <input id="reset-password-confirm" type="password" name="password_confirmation" required>
            </div>
    
            <button type="submit" class="c-btn c-btn--primary c-btn--block">{{ __('Reset Password') }}</button>
        </fieldset>
    </form>
@endsection
