@extends('layouts.default')

@section('title', 'Thank You')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/thank-you.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/subheader.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
@endpush

@section('content')
	<link rel="stylesheet" href="{{ mix('/css/thank-you.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/subheader.css') }}">
	<section class="c-subheader">
		<div class="container">
			<div class="row">
				<div class="col">
					<h1>Thank You</h1>
				</div>
			</div>
		</div>
	</section>

	<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
	<section class="c-thank-you-content">
		<div class="container">
			<div class="row">
				<div class="col-24">
					<div class="c-section">
						<h2>Thank You</h2>
						<div class="c-section__content">Your information has been submitted successfully! We'll be in touch with you shortly.</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection