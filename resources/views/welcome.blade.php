<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>JMP</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,400i,600,700" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ mix('/css/index.css') }}">

	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/images/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="/images/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/images/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="/images/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/images/favicons/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="/images/favicons/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="/images/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/images/favicons/favicon-128.png" sizes="128x128">
	<meta name="theme-color" content="#ffffff">
	<meta name="application-name" content="JMP Industries Inc.">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/images/favicons/mstile-144x144.png">
	<meta name="msapplication-square70x70logo" content="/images/favicons/mstile-70x70.png">
	<meta name="msapplication-square150x150logo" content="/images/favicons/mstile-150x150.png">
	<meta name="msapplication-wide310x150logo" content="/images/favicons/mstile-310x150.png">
	<meta name="msapplication-square310x310logo" content="/images/favicons/mstile-310x310.png">
</head>

<body style="background-color: gray;">
    <header id="js-header" class="c-header c-header--logged-out">
        <div class="c-header__menu">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-9">
                        <div class="c-header__logo">
                            <a href="/"><img src="/images/logo/JMP_Logo_white.svg" alt="JMP Logo"></a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-15">
                        <div class="row">
                            <div class="col">
                                <div class="c-header__phone d-none d-lg-block">
                                    <i class="fas fa-phone"></i>&nbsp;&nbsp;<a href="tel:216-749-6030">(216) 749-6030</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <nav class="c-header__nav">
                                    <ul class="c-header__list">
                                        <li class="c-header__item d-none d-lg-block"><a href="#" class="c-header__link">Home</a></li>
                                        <li class="c-header__item d-none d-lg-block"><a href="#" class="c-header__link">About Us</a></li>
                                        <li class="c-header__item d-none d-lg-block"><a href="#" class="c-header__link">Our Products &amp; Services</a></li>
                                        <li class="c-header__item d-none d-lg-block"><a href="#" class="c-header__link">Contact Us</a></li>
                                        <li class="c-header__item d-none d-sm-block"><a href="#" class="c-btn c-btn--primary">Log In</a></li>
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
    
        <div class="c-header__mobile-menu">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav class="c-header__nav">
                            <ul class="c-header__mobile-list">
                                <li class="c-header__item"><a href="#" class="c-header__link">Home</a></li>
                                <li class="c-header__item"><a href="#" class="c-header__link">About Us</a></li>
                                <li class="c-header__item"><a href="#" class="c-header__link">Our Products &amp; Services</a></li>
                                <li class="c-header__item"><a href="#" class="c-header__link">Contact Us</a></li>
                                <li class="c-header__item d-block d-sm-none"><a href="#" class="c-btn c-btn--primary">Log In</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="c-header__phone">
                            <i class="fas fa-phone"></i>&nbsp;&nbsp;<a href="tel:216-749-6030">(216) 749-6030</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="c-header__background"></div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="c-breadcrumbs">
                        <ul class="c-breadcrumbs__list">
                            <li class="c-breadcrumbs__item"><a href="/">Home</a></li>
                            <li class="c-breadcrumbs__item"><a href="/">Previous Page</a></li>
                            <li class="c-breadcrumbs__item"><strong>Current Page</strong></li>
                        </ul>
                    </nav>
                </div>
            </div>
    
            <div class="row">
                <div class="col">
                    <h2 class="c-section-title">Section Title</h2>
                    <h1>Heading 1</h1>
                    <h2>Heading 2</h2>
                    <h3>Heading 3</h3>
                    <h4>Heading 4</h4>
                    <h5>Heading 5</h5>
                    <h6>Heading 6</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut euismod tortor, vel fermentum ante.
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut eget lectus vitae
                        libero commodo bibendum molestie nec felis. Aenean scelerisque nulla felis, a lobortis ligula tempor sit amet.
                        Integer in imperdiet justo. Maecenas tempor sagittis elementum. Fusce sit amet eros lectus. Sed mollis sodales
                        orci, vel porta sapien iaculis quis. Nullam tincidunt augue nec justo efficitur blandit. Aliquam vulputate ex ac
                        justo rhoncus hendrerit. Morbi pharetra fringilla euismod.</p>
    
                    <p><a href="#">Link</a></p>
    
                    <p>
                        <a href="#" class="c-btn c-btn--primary">Button</a>
                        <a href="#" class="c-btn c-btn--primary c-btn--ghost">Button</a>
                    </p>
    
                    <form action="/" class="o-form">
                        <div class="o-form__group">
                            <div class="o-form__search">
                                <label for="vf-search">Search Products</label>
                                <input type="search" id="vf-search" placeholder="Search products...">
                                <button type="submit" class="c-btn" ><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
    
                    <form action="/" class="o-form">
                        <div class="o-form__group">
                            <label for="vf-text">Label</label>
                            <input type="text" id="vf-text" placeholder="e.g. Placeholder text">
                        </div>
    
                        <div class="o-form__group">
                            <label for="vf-text">Label</label>
                            <input type="text" id="vf-text" placeholder="e.g. Placeholder text" value="This has text entered.">
                        </div>
    
                        <div class="o-form__group is-disabled">
                            <label for="vf-text">Label - Disabled</label>
                            <input type="text" id="vf-text" placeholder="e.g. Placeholder text" disabled>
                        </div>
    
                        <div class="o-form__group is-error">
                            <label for="vf-text">Label - Error</label>
                            <input class="is-error" type="text" id="vf-text" placeholder="e.g. Placeholder text" value="This text has errors.">
                            <p class="o-form__error-text"><i class="fas fa-times"></i>&nbsp;&nbsp;<span>This is some error text.</strong></p>
                        </div>
    
                        <div class="o-form__group">
                            <label for="vf-textare">Label</label>
                            <textarea name="textarea" id="vf-textarea" rows="5" placeholder="e.g. Placeholder text"></textarea>
                        </div>
    
                        <div class="o-form__group">
                            <input type="checkbox" name="checkbox" id="vf-check">
                            <label for="vf-check"><strong>Checkbox</strong> - Label with text<br />that goes onto second line</label>
                        </div>
        
                        <div class="o-form__group is-error">
                            <input class="is-error" type="checkbox" name="checkbox" id="vf-check">
                            <label for="vf-check"><strong>Checkbox</strong> - Label with text<br />that goes onto second line</label>
                            <p class="o-form__error-text"><i class="fas fa-times"></i>&nbsp;&nbsp;<span>This is some error text.</strong></p>
                        </div>
    
                        <div class="o-form__group">
                            <input type="radio" name="radio" id="vf-radio">
                            <label for="vf-radio"><strong>Radio</strong> - Label with text that<br />goes onto second line</label>
                        </div>
                        
                        <div class="o-form__group is-error">
                            <input class="is-error" type="radio" name="radio" id="vf-radio">
                            <label for="vf-radio"><strong>Radio</strong> - Label with text that<br />goes onto second line</label>
                            <p class="o-form__error-text"><i class="fas fa-times"></i>&nbsp;&nbsp;<span>This is some error text.</strong></p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="c-panel">
                        <div class="c-panel__content">
                            <div class="c-panel__img">
                                <img src="https://via.placeholder.com/600x600" alt="Image">
                            </div>
                            <div class="c-panel__footer">
                                <div class="c-panel__title" title="Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit">
                                    <strong>Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit</strong>
                                </div>
                                <div class="c-panel__action">
                                    <a href="#">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="c-footer">
        <div class="container">
            <div class="row">
                <div class="col-24 col-lg-10">
                    <div class="row">
                        <div class="col-12"></div>
                        <div class="col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                    </div>
                </div>
                <div class="col-24 col-lg-14">
                    <div class="c-footer__copyright">
                        <p>&copy; 2018 JMP Industries, Inc. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    

	@if (Route::has('login'))
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    @endif
    
    <script>
        // Toggle mobile menu
        var headerEl = document.getElementById('js-header');
        document.getElementById('js-header-menu-btn-open').addEventListener('click', function () {
            headerEl.classList.add('is-open');
        });
        document.getElementById('js-header-menu-btn-close').addEventListener('click', function () {
            headerEl.classList.remove('is-open');
        });
    </script>
</body>

</html>