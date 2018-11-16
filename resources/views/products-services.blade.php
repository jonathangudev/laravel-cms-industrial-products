@extends('layouts.default')

@section('title', 'Our Products & Services')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/products-services.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/subheader.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ asset('images/products-services-hero.jpg') }}" as="image" type="image/jpeg">
@endpush

@section('content')
	<link rel="stylesheet" href="{{ mix('/css/products-services.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/subheader.css') }}">
	<section class="c-subheader c-ps-hero">
		<div class="container">
			<div class="row">
				<div class="col">
					<h1>Our Products &amp; Services</h1>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col">
					@include('partials.breadcrumbs')
				</div>
			</div>
		</div>
	</section>

	<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
	<section class="c-ps-section c-ps-section--products">
		<div class="container">
			<div class="row">
				<div class="col-24 col-lg-7">
					<div class="c-ps-section__title c-section">
						<h2>Our Products</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros.</p>
					</div>
				</div>
				<div class="col-24 col-lg-17 col-xl-16 offset-xl-1">
					<div class="row">
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="https://via.placeholder.com/300x300" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Product Name</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida.</p>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="https://via.placeholder.com/300x300" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Product Name</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida.</p>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="https://via.placeholder.com/300x300" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Product Name</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="c-ps-section c-ps-section--services">
		<img src="{{ asset('images/products-services-border-top.svg') }}" alt="Border Top" class="c-ps-section__border c-ps-section__border--top">
		<div class="container">
			<div class="row">
				<div class="col-24 col-lg-7">
					<div class="c-ps-section__title c-section">
						<h2>Our Services</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros.</p>
					</div>
				</div>
				<div class="col-24 col-lg-17 col-xl-16 offset-xl-1">
					<div class="row">
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="https://via.placeholder.com/300x300" alt="Service">
								</div>
								<div class="c-ps-section__text">
									<h3>Service Name</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida.</p>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="https://via.placeholder.com/300x300" alt="Service">
								</div>
								<div class="c-ps-section__text">
									<h3>Service Name</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida.</p>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="https://via.placeholder.com/300x300" alt="Service">
								</div>
								<div class="c-ps-section__text">
									<h3>Service Name</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<img src="{{ asset('images/products-services-border-bottom.svg') }}" alt="Border Bottom" class="c-ps-section__border c-ps-section__border--bottom">
	</section>

@endsection