@extends('layouts.default')

@section('title', 'Home')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/home.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/card.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ asset('images/technical-drawing.svg') }}" as="image" type="image/svg+xml">
@endpush

@push('head-prefetch')
	<link rel="prefetch" href="{{ mix('/css/breadcrumbs.css') }}">
	<link rel="prefetch" href="{{ mix('/css/subheader.css') }}">
@endpush

@section('content')
	<link rel="stylesheet" href="{{ mix('/css/home.css') }}">
	<section class="c-home-hero">
		<div class="container h-100">
			<div class="row align-items-center justify-content-center h-100">
				<div class="col">
					<div class="row">
						<div class="col-12 col-md-8 col-lg-6 offset-6 offset-md-8 offset-lg-9">
							<div class="c-home-hero__logo d-none d-sm-block">
								<img src="{{ asset('images/logo/JMP_Logo_white.svg') }}" alt="JMP Logo">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-24 col-md-22 col-lg-16 offset-md-1 offset-lg-4">
							<div class="c-home-hero__content">
								<h1>Certified craftsmanship.
									<br/>World-class <span class="c-home-hero__highlight"><span>componentry.</span></span>
								</h1>
								<h3>{{ $homePage->subheading }}</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-24">
							<div class="c-home-hero__cta">
								<a href="{{ route('about') }}" class="c-btn c-btn--primary c-btn--ghost c-btn--reverse">Learn More</a>
							</div>
							<img src="/images/arrow.svg" alt="Arrow" class="c-home-hero__arrow">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<link rel="stylesheet" href="{{ mix('/css/card.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
	<section class="c-home-cards">
		<div class="container">
			<div class="row">
				<div class="col-24 col-md-12 col-lg-8 col-xl-6 offset-xl-2">
					<div class="c-card c-home-cards__card text-center">
						<div class="c-section c-section--center">
							<h3>{{ $homePage->about_us_title }}</h3>
						</div>
						<div class="c-home-cards__content">{!! $homePage->about_us_text !!}</div>
						<div class="c-home-cards__cta">
							<a href="{{ route('about') }}" class="c-btn c-btn--primary c-btn--ghost">Learn More</a>
						</div>
					</div>
				</div>
				<div class="col-24 col-md-12 col-lg-8 col-xl-6 offset-xl-1">
					<div class="c-card c-home-cards__card text-center">
						<div class="c-section c-section--center">
							<h3>{{ $homePage->our_products_title }}</h3>
						</div>
						<div class="c-home-cards__content">{!! $homePage->our_products_text !!}</div>
						<div class="c-home-cards__cta">
							<a href="{{ route('products-services') }}" class="c-btn c-btn--primary c-btn--ghost">Learn More</a>
						</div>
					</div>
				</div>
				<div class="col-24 col-md-12 col-lg-8 col-xl-6 offset-md-6 offset-lg-0 offset-xl-1">
					<div class="c-card c-home-cards__card text-center">
						<div class="c-section c-section--center">
							<h3>{{ $homePage->contact_us_title }}</h3>
						</div>
						<div class="c-home-cards__content">{!! $homePage->contact_us_text !!}</div>
						<div class="c-home-cards__cta">
							<a href="{{ route('contact') }}" class="c-btn c-btn--primary c-btn--ghost">Contact Us</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="c-home-content">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-12">
					<div class="c-home-content__img">
						<img src="{{ $homePage->getFirstMediaUrl('footer-image') }}" alt="Home Image">
					</div>
				</div>
				<div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-2">
					<div class="c-section c-home-content__text d-none d-lg-block">
						<h2>{{ $homePage->footer_title }}</h2>
						<div class="c-section__content">{!! $homePage->footer_text !!}</div>
					</div>
					<div class="c-section c-section--center c-home-content__text d-lg-none">
						<h2>{{ $homePage->footer_title }}</h2>
						<div class="c-section__content">{!! $homePage->footer_text !!}</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
