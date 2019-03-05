@extends('layouts.auth')

@section('title', 'Reset Password')

@push('head-preload')
    <link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
@endpush


@section('content')
    @if (session('status'))
        @component('partials.alert', ['type' => 'info'])
            {{ session('status') }}
        @endcomponent
    @endif
    
    <link rel="stylesheet" href="{{ mix('/css/section.css') }}">
    <div class="c-section d-none d-md-block">
        <h3>Reset Password</h3>
    </div>
    <div class="c-section c-section--center d-md-none">
        <h2>Reset Password</h2>
    </div>

    <p>Please contact us at <a href="tel:216-749-6030">216-749-6030</a> to reset your password.</p>

    {{-- <form method="POST" action="{{ route('password.email') }}" class="o-form">
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
    
            <button type="submit" class="c-btn c-btn--primary c-btn--block">{{ __('Send Reset Link') }}</button>
        </fieldset>
    </form> --}}
@endsection
