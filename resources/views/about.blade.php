@extends('layouts.default')

@section('title', 'About Us')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/about.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/subheader.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ asset('images/about-hero.jpg') }}" as="image" type="image/jpeg">
@endpush

@section('content')
	<div class="c-about-wrapper">
		<link rel="stylesheet" href="{{ mix('/css/about.css') }}">
		<link rel="stylesheet" href="{{ mix('/css/subheader.css') }}">
		<section class="c-subheader c-about-hero">
			<div class="container">
				<div class="row">
					<div class="col">
						<h1>About Us</h1>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="row">
					<div class="col">
						@include('partials.breadcrumbs', ['name' => 'About'])
					</div>
				</div>
			</div>
		</section>

		<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
		<section class="c-about-content">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-24 col-lg-12 col-xl-13">
						<div class="c-about-content__text c-section">
							<h2>{{ $aboutUs->content_block_1_title }}</h2>
							<div class="c-section__content">{!! $aboutUs->content_block_1_text !!}</div>
							<br/>
							<h2>{{ $aboutUs->content_block_2_title }}</h2>
							<div class="c-section__content">{!! $aboutUs->content_block_2_text !!}</div>
							<a href="{{ route('products-services') }}" class="c-btn c-btn--primary c-btn--ghost">View Products &amp; Services</a>
						</div>
					</div>
					<div class="col-24 col-md-14 col-lg-10 col-xl-9 offset-md-5 offset-lg-2">
						<div class="c-about-content__img">
							<img src="{{ $aboutUs->getFirstMediaUrl('about-us-image') }}" alt="About Us Image">
						</div>
					</div>
				</div>
			</div>
		</section>

		{{-- <section class="c-about-testimonial">
			<div class="c-about-testimonial__stripe-wrapper d-none d-sm-block">
				<div class="c-about-testimonial__stripe c-about-testimonial__stripe--gray"></div>
				<div class="c-about-testimonial__stripe c-about-testimonial__stripe--black"></div>
				<div class="c-about-testimonial__stripe c-about-testimonial__stripe--gray"></div>
				<div class="c-about-testimonial__stripe c-about-testimonial__stripe--black"></div>
				<div class="c-about-testimonial__stripe c-about-testimonial__stripe--black"></div>
				<div class="c-about-testimonial__stripe c-about-testimonial__stripe--gray"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-24 col-md-20 col-lg-14 offset-md-2 offset-lg-5">
						<div class="c-about-testimonial__text">
							<p>
								" Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ”
							</p>
							<h4>Firstname Lastname</h4>
						</div>
					</div>
				</div>
			</div>
		</section> --}}

		{{-- <section class="c-about-team">
			<div class="container">
				<div class="row">
					<div class="col-24 col-lg-18 offset-lg-3">
						<div class="c-about-team__title c-section c-section--center">
							<h2>Meet Our Senior Leadership</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-8 col-lg-5 offset-md-4 offset-lg-6">
						<div class="c-about-team__img">
							<img src="https://via.placeholder.com/300x300" alt="Sarah Viccarone">
						</div>
						<div class="c-about-team__text">
							<h4>Sarah Viccarone</h4>
							<p class="text-muted">President / CEO</p>
						</div>
					</div>
					<div class="col-12 col-md-8 col-lg-5 offset-lg-2">
						<div class="c-about-team__img">
							<img src="https://via.placeholder.com/300x300" alt="Dan Lempke">
						</div>
						<div class="c-about-team__text">
							<h4>Dan Lempke</h4>
							<p class="text-muted">Vice President / Engineering</p>
						</div>
					</div>
				</div>
			</div>
		</section> --}}
	</div>
@endsection