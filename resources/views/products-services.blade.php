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
					@include('partials.breadcrumbs', ['name' => 'Products & Services'])
				</div>
			</div>
		</div>
	</section>

	<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
	<section class="c-ps-section">
		<div class="container">
			<div class="row">
				<div class="col-24 col-lg-7">
					<div class="c-ps-section__title c-section">
						<h2>Space &amp; Defense Systems</h2>
					</div>
				</div>
				<div class="col-24 col-lg-17 col-xl-16 offset-xl-1">
					<div class="row">
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="{{ asset('images/008.jpg') }}" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Rocket Engine Systems &amp; Fuels</h3>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="{{ asset('images/mvc-503f.jpg') }}" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Combustion Chambers &amp; Heat Transfer</h3>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="{{ asset('images/005.jpg') }}" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Fuel Injectors</h3>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="{{ asset('images/006.jpg') }}" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Microgravity Systems</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="c-ps-section c-ps-section--gray">
		<div class="container">
			<div class="row">
				<div class="col-24 col-lg-7">
					<div class="c-ps-section__title c-section">
						<h2>Petrochemical Technologies</h2>
					</div>
				</div>
				<div class="col-24 col-lg-17 col-xl-16 offset-xl-1">
					<div class="row">
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="{{ asset('images/003.jpg') }}" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Systems &amp; Components Used in High Performance Catalyst Production</h3>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__img">
									<img src="{{ asset('images/mvc-862f.jpg') }}" alt="Product">
								</div>
								<div class="c-ps-section__text">
									<h3>Microreactor Systems &amp; Subsystems</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="c-ps-section">
		<div class="container">
			<div class="row">
				<div class="col-24 col-lg-7">
					<div class="c-ps-section__title c-section">
						<h2>Alternative Energy Systems</h2>
					</div>
				</div>
				<div class="col-24 col-lg-17 col-xl-16 offset-xl-1">
					<div class="row">
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__text">
									<h3>On-demand Methanol Synthesis</h3>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__text">
									<h3>Combustor/Electrolyzer Co-Generation</h3>
								</div>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-ps-section__item">
								<div class="c-ps-section__text">
									<h3>CO2 Absorption Sequestration</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection