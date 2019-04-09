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

	@foreach ($pageRows as $row)
		@if ($loop->index % 2)
			<section class="c-ps-section c-ps-section--gray">
		@else
			<section class="c-ps-section">
		@endif
			<div class="container">
				<div class="row">
					<div class="col-24 col-lg-7">
						<div class="c-ps-section__title c-section">
							<h2>{{ $row->title }}</h2>
						</div>
					</div>
					<div class="col-24 col-lg-17 col-xl-16 offset-xl-1">
						<div class="row">
							@foreach ($row->contents as $item)
								<div class="col-24 col-md-12">
									<div class="c-ps-section__item">
										@if ($item->hasMedia('products-and-services-content-image'))
											<div class="c-ps-section__img">
												<img src="{{ $item->getFirstMediaUrl('products-and-services-content-image') }}" alt="{{ $item->name }} Image">
											</div>
										@endif
										<div class="c-ps-section__text">
											<h3>{{ $item->name }}</h3>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
	@endforeach
@endsection