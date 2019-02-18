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
                            &copy; {{ __('2018 JMP Industries, Inc. All Rights Reserved.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-24 col-lg-14">
                <div class="row">
                    <div class="col-24">
                        <h3>{{ __('Get In Touch') }}</h3>
                        <form action="#" class="c-footer__form o-form o-form--reverse">
                            @csrf
                            <fieldset>
                                <legend>{{ __('Contact Information') }}</legend>
                                <div class="row">
                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group">
                                            <label for="footer-fullname">{{ __('Full Name') }}</label>
                                            <input id="footer-fullname" type="text" placeholder="e.g. Wile E. Coyote" name="full_name" required>
                                        </div>
                                    </div>
                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group">
                                            <label for="footer-company">{{ __('Company') }}</label>
                                            <input id="footer-company" type="text" placeholder="e.g. Acme Co." name="company" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group">
                                            <label for="footer-email">{{ __('Email Address') }}</label>
                                            <input id="footer-email" type="email" placeholder="e.g. wile.e.coyote@acme.com" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-24 col-md-12">
                                        <div class="o-form__group">
                                            <label for="footer-phone">{{ __('Phone') }}</label>
                                            <input id="footer-phone" type="text" placeholder="e.g. 123-456-7890" name="phone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="o-form__group">
                                            <label for="footer-message">{{ __('Add a Message') }}</label>
                                            <textarea name="footer-message" id="footer-message" rows="5" placeholder="e.g. Add your message here." name="message"></textarea>
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
                            &copy; 2018 JMP Industries, Inc. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>