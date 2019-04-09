@unless (Route::currentRouteNamed('contact'))
    @if ($errors->any())
        @component('partials.alert', ['type' => 'danger'])
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endcomponent
    @endif
@endunless

<link rel="stylesheet" href="{{ mix('/css/footer.css') }}">
<footer class="c-footer">
    <div class="container">
        <div class="row">
            <div class="col-24 col-lg-10">
                <div class="row h-100">
                    <div class="col-12 col-sm-7 col-md-6 col-lg-10">
                        <div class="c-footer__logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/logo/JMP_Logo_white.svg') }}" alt="JMP Logo"></a>
                        </div>
                        <div class="c-footer__address d-none d-lg-block">
                            <address>
                                <p>
                                    JMP Industries Inc.
                                    <br/>2779 Rockefeller Ave.
                                    <br/>Cleveland, OH 44115
                                </p>
                                <p>
                                    <a href="tel:216-749-6030" target="_blank" rel="noopener">(216) 749-6030</a>
                                    <br/><a href="mailto:support@jmpind.com" target="_blank" rel="noopener">support@jmpind.com</a>
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="w-100 d-block d-sm-none"></div>
                    <div class="col-12 col-sm-8 col-md-6 offset-sm-1 offset-md-3 d-block d-lg-none">
                        <div class="c-footer__address">
                            <address>
                                <p>
                                    JMP Industries Inc.
                                    <br/>2779 Rockefeller Ave.
                                    <br/>Cleveland, OH 44115
                                </p>
                                <p>
                                    <a href="tel:216-749-6030">(216) 749-6030</a>
                                    <br/><a href="mailto:support@jmpind.com">support@jmpind.com</a>
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-md-6 col-lg-12 offset-md-3 offset-lg-2">
                        <nav class="c-footer__nav">
                            <ul class="c-footer__list">
                                <li class="c-footer__item"><a href="{{ route('home') }}" class="c-footer__link">{{ __('Home') }}</a></li>
                                <li class="c-footer__item"><a href="{{ route('about') }}" class="c-footer__link">{{ __('About Us') }}</a></li>
                                <li class="c-footer__item"><a href="{{ route('products-services') }}" class="c-footer__link">{{ __('Our Products & Services') }}</a></li>
                                <li class="c-footer__item"><a href="{{ route('contact') }}" class="c-footer__link">{{ __('Contact Us') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-24 align-self-end">
                        <div class="c-footer__copyright d-none d-lg-block">
                            &copy; {{ date('Y') }} JMP Industries, Inc. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-24 col-lg-14">
                <div class="row">
                    <div class="col-24">
                        <h3>{{ __('Get In Touch') }}</h3>
                        <form action="{{route('contact.footer')}}" method="POST" class="c-footer__form o-form o-form--reverse">
                            @csrf
                            <fieldset>
                                <legend>{{ __('Contact Information') }}</legend>

                                <div class="row">
                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group {{ $errors->has('contact-fullname') ? ' is-error' : '' }}">
                                            <label for="footer-fullname">{{ __('Full Name') }}</label>
                                            <input name="contact-fullname" id="footer-fullname" type="text" class="{{ $errors->has('contact-fullname') ? ' is-error' : '' }}" placeholder="e.g. Wile E. Coyote" value="{{ old('contact-fullname') }}" required>
                                            @if ($errors->has('contact-fullname'))
                                                <p class="o-form__error-text" role="alert">
                                                    <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-fullname') }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group {{ $errors->has('contact-company') ? ' is-error' : '' }}">
                                            <label for="footer-company">{{ __('Company') }}</label>
                                            <input name="contact-company" id="footer-company" type="text" class="{{ $errors->has('contact-company') ? ' is-error' : '' }}" placeholder="e.g. Acme Co." value="{{ old('contact-company') }}" required>
                                            @if ($errors->has('contact-company'))
                                                <p class="o-form__error-text" role="alert">
                                                    <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-company') }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group {{ $errors->has('contact-email') ? ' is-error' : '' }}">
                                            <label for="footer-email">{{ __('Email Address') }}</label>
                                            <input name="contact-email" id="footer-email" type="email" class="{{ $errors->has('contact-email') ? ' is-error' : '' }}" placeholder="e.g. wile.e.coyote@acme.com" value="{{ old('contact-email') }}" required>
                                            @if ($errors->has('contact-email'))
                                                <p class="o-form__error-text" role="alert">
                                                    <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-email') }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group {{ $errors->has('contact-phone') ? ' is-error' : '' }}">
                                            <label for="footer-phone">{{ __('Phone') }}</label>
                                            <input name="contact-phone" id="footer-phone" type="text" class="{{ $errors->has('contact-email') ? ' is-error' : '' }}" placeholder="e.g. 123-456-7890" value="{{ old('contact-phone') }}" required>
                                            @if ($errors->has('contact-phone'))
                                                <p class="o-form__error-text" role="alert">
                                                    <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-phone') }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="o-form__group {{ $errors->has('contact-message') ? ' is-error' : '' }}">
                                            <label for="footer-message">{{ __('Add a Message') }}</label>
                                            <textarea name="contact-message" id="footer-message" rows="5" class="{{ $errors->has('contact-message') ? ' is-error' : '' }}" placeholder="e.g. Add your message here." value="{{ old('contact-message') }}"></textarea>
                                            @if ($errors->has('contact-message'))
                                                <p class="o-form__error-text" role="alert">
                                                    <i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-message') }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-24 col-md-6 col-lg-6">
                                        <button type="submit" class="c-btn c-btn--primary c-btn--block">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-24">
                        <div class="c-footer__copyright d-block d-lg-none">
                            &copy; {{ date('Y') }} JMP Industries, Inc. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>