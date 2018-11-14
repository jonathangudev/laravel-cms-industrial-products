<header id="js-header" class="c-header c-header--logged-out">
    <div class="c-header__menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-10 col-lg-8 col-xl-9">
                    <div class="c-header__logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('images/logo/JMP_Logo_white.svg') }}" alt="JMP Logo"></a>
                    </div>
                </div>
                <div class="col-14 col-lg-16 col-xl-15">
                    <div class="row">
                        <div class="col">
                            <div class="c-header__phone d-none d-lg-block">
                                <i class="fas fa-phone"></i>&nbsp;&nbsp;<a href="tel:216-749-6030" target="_blank" rel="noopener">(216) 749-6030</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <nav class="c-header__nav">
                                <ul class="c-header__list">
                                    <li class="c-header__item d-none d-lg-block">
                                        <a href="{{ route('home') }}" class="c-header__link {{ Route::currentRouteNamed('home') ? 'is-active' : '' }}">Home</a>
                                    </li>
                                    <li class="c-header__item d-none d-lg-block">
                                        <a href="{{ route('about') }}" class="c-header__link {{ Route::currentRouteNamed('about') ? 'is-active' : '' }}">About Us</a>
                                    </li>
                                    <li class="c-header__item d-none d-lg-block">
                                        <a href="{{ route('products-services') }}" class="c-header__link {{ Route::currentRouteNamed('products-services') ? 'is-active' : '' }}">Our Products &amp; Services</a>
                                    </li>
                                    <li class="c-header__item d-none d-lg-block">
                                        <a href="{{ route('contact') }}" class="c-header__link {{ Route::currentRouteNamed('contact') ? 'is-active' : '' }}">Contact Us</a>
                                    </li>
                                    <li class="c-header__item "><a href="#" class="c-btn c-btn--primary">Log In</a></li>
                                    <li class="c-header__item d-block d-lg-none">
                                        <button id="js-header-menu-btn-open" type="button" class="c-btn c-header__menu-btn"><i class="fas fa-fw fa-bars"></i></button>
                                        <button id="js-header-menu-btn-close" type="button" class="c-btn c-header__menu-btn c-header__menu-btn--close"><i class="fas fa-fw fa-times"></i></button>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="c-header__mobile-menu d-lg-none">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="c-header__nav">
                        <ul class="c-header__mobile-list">
                            <li class="c-header__mobile-item">
                                <a href="{{ route('home') }}" class="c-header__link {{ Route::currentRouteNamed('home') ? 'is-active' : '' }}">Home</a>
                            </li>
                            <li class="c-header__mobile-item">
                                <a href="{{ route('about') }}" class="c-header__link {{ Route::currentRouteNamed('about') ? 'is-active' : '' }}">About Us</a>
                            </li>
                            <li class="c-header__mobile-item">
                                <a href="{{ route('products-services') }}" class="c-header__link {{ Route::currentRouteNamed('products-services') ? 'is-active' : '' }}">Our Products &amp; Services</a>
                            </li>
                            <li class="c-header__mobile-item">
                                <a href="{{ route('contact') }}" class="c-header__link {{ Route::currentRouteNamed('contact') ? 'is-active' : '' }}">Contact Us</a>
                            </li>
                            <li class="c-header__mobile-item">
                                <div class="c-header__phone">
                                    <i class="fas fa-phone"></i>&nbsp;&nbsp;<a href="tel:216-749-6030">(216) 749-6030</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="c-header__background d-lg-none"></div>
</header>

@push('body-scripts')
    <script src="{{ mix('/js/menu-toggle.js') }}" defer></script>
@endpush