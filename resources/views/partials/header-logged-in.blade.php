<link rel="stylesheet" href="{{ mix('/css/header.css') }}">
<header class="c-header c-header--logged-in">
	<div class="c-header__menu">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-20 col-md-12 col-lg-9 col-xl-7">
					<div class="c-header__logo-group">
						<div class="c-header__logo">
							<a href="{{ route('catalog') }}"><img src="{{ asset('images/logo/JMP_Logo.svg') }}" alt="JMP Logo"></a>
						</div>
						<div class="c-header__company-logo">
							<img src="{{ Auth::user()->company->getLogoUrl() }}" alt="Company Logo">
						</div>
					</div>
				</div>
				<div class="col-4 col-md-12 col-lg-15 col-xl-16 offset-xl-1">
					<div class="row">
						<div class="col col-lg-12">
							<form action="{{ route('search') }}" method="POST" class="o-form d-none d-md-block">
								@csrf
								<div class="o-form__search">
									<label for="jmp-header-search">{{ __('Search Products') }}</label>
									<input type="search" id="jmp-header-search" name="query" placeholder="Search products..." aria-label="Search Products">
									<button type="submit" class="c-btn" aria-label="Search"><i class="fas fa-search"></i></button>
								</div>
							</form>
						</div>
						<div class="col-auto col-lg-12">
							<div class="c-header__phone d-none d-lg-block">
								<i class="fas fa-phone"></i>&nbsp;&nbsp;<a href="tel:216-749-6030" target="_blank" rel="noopener">(216) 749-6030</a>
							</div>
							<button id="js-header-menu-btn-open" type="button" class="c-btn c-header__menu-btn d-lg-none"><i class="fas fa-fw fa-bars"></i></button>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<nav class="c-header__nav d-none d-lg-block">
								<ul class="c-header__list">
									<li class="c-header__item"><a href="{{ route('catalog') }}" class="c-header__link">{{ __('Home') }}</a></li>
									<li class="c-header__item"><a href="{{ route('contact') }}" class="c-header__link">{{ __('Contact Us') }}</a></li>
									<li class="c-header__item">
										<a href="{{ route('logout') }}" class="c-header__link c-header__link--log-out" onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();">
											<i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;{{ __('Log Out') }}
										</a>
										<form id="header-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>