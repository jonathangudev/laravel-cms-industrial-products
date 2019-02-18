@extends('layouts.auth')

@section('title', 'Login')

@push('head-preload')
    <link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
@endpush

@push('head-prefetch')
    <link rel="prefetch" href="{{ mix('/css/category-menu.css') }}">
    <link rel="prefetch" href="{{ mix('/css/panel.css') }}">
    <link rel="prefetch" href="{{ mix('/js/category-menu-toggle.js') }}">
    <link rel="prefetch" href="{{ mix('/js/category-menu-accordian.js') }}">
@endpush

@section('content')
    @if ($errors->any())
        @component('partials.alert', ['type' => 'danger'])
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endcomponent
    @endif
    
    <link rel="stylesheet" href="{{ mix('/css/section.css') }}">
    <div class="c-section d-none d-md-block">
        <h3>Welcome Back</h3>
    </div>
    <div class="c-section c-section--center d-md-none">
        <h2>Welcome Back</h2>
    </div>

    <form method="POST" action="{{ route('login') }}" class="o-form">
        @csrf

        <fieldset>
            <legend>Login Information</legend>
            <div class="o-form__group {{ $errors->has('email') ? ' is-error' : '' }}">
                <label for="login-email">{{ __('Email Address') }}</label>
                <input id="login-email" type="email" class="{{ $errors->has('email') ? ' is-error' : '' }}" placeholder="e.g. wile.e.coyote@acme.com" value="{{ old('email') }}" name="email" required autofocus>
                @if ($errors->has('email'))
                    <p class="o-form__error-text" role="alert">
                        <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('email') }}</span>
                    </p>
                @endif
            </div>

            <div class="o-form__group {{ $errors->has('password') ? ' is-error' : '' }}">
                <label for="login-password">{{ __('Password') }}</label>
                <input id="login-password" type="password" class="{{ $errors->has('password') ? ' is-error' : '' }}" placeholder="e.g. **********" name="password" required>
                @if ($errors->has('password'))
                    <p class="o-form__error-text" role="alert">
                        <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('password') }}</span>
                    </p>
                @endif
                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            </div>

            <div class="o-form__group">
                <input type="checkbox" name="remember" id="login-remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="login-remember">{{ __('Remember Me') }}</label>
            </div>

            <button type="submit" class="c-btn c-btn--primary c-btn--block">{{ __('Log In') }}</button>
        </fieldset>
    </form>
@endsection
