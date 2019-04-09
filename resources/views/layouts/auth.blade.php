<!doctype html>
<html lang="{{ app()->getLocale() }}">

	<head>
		@prepend('head-preload')
			<link rel="preload" href="{{ mix('/css/auth.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ asset('images/technical-drawing.svg') }}" as="image" type="image/svg+xml">
		@endprepend

		@include('partials.head')
	</head>

	<body>
		{{-- Google Tag Manager (noscript) --}}
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		{{-- End Google Tag Manager (noscript) --}}

		<link rel="stylesheet" href="{{ mix('/css/auth.css') }}">
		<main class="o-main">
			<div class="c-auth">
				<div class="container-fluid">
					<div class="row">
						<div class="col-24 col-sm-18 col-md-14 col-lg-10 col-xl-8 offset-sm-3 offset-md-1">
							<div class="row h-100">
								<div class="col-24 align-self-start">
									<div class="c-auth__logo">
										<a href="{{ route('home') }}">
											<img src="{{ asset('images/logo/JMP_Logo.svg') }}" alt="Logo">
										</a>
									</div>
								</div>
								<div class="col-24">
									<div class="c-auth__content">
										@yield('content')
									</div>
								</div>
								<div class="col-24 align-self-end">
									<div class="c-auth__links">
										<div class="row justify-content-between">
											<div class="col-24 col-sm-auto">
												<p class="text-center"><a href="{{ route('home') }}">Home</a></p>
											</div>
											<div class="col-24 col-sm-auto">
												<p class="text-center"><a href="{{ route('about') }}">About Us</a></p>
											</div>
											<div class="col-24 col-sm-auto">
												<p class="text-center"><a href="{{ route('products-services') }}">Our Products &amp; Services</a></p>
											</div>
											<div class="col-24 col-sm-auto">
												<p class="text-center"><a href="{{ route('contact') }}">Contact Us</a></p>
											</div>
										</div>
									</div>
									<p class="text-center text-md-left">This access is protected by a DOD encryption system through VeriSign SSL. Due to our involvement with the United States Department of Defense, all access is logged.</p>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-8 col-lg-12 col-xl-14 offset-md-1">
							<div class="c-auth__background d-none d-md-block"></div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</body>

</html>