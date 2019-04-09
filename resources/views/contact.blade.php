@extends('layouts.default')

@section('title', 'Contact Us')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/contact.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/subheader.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ asset('images/contact-map.jpg') }}" as="image" type="image/jpeg">
@endpush

@section('content')
	@if ($errors->any())
		@component('partials.alert', ['type' => 'danger'])
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		@endcomponent
	@endif

	<link rel="stylesheet" href="{{ mix('/css/contact.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/subheader.css') }}">
	<section class="c-subheader c-contact-hero">
		<div class="container">
			<div class="row">
				<div class="col">
					<h1>Contact Us</h1>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col">
					@include('partials.breadcrumbs', ['name' => 'Contact Us'])
				</div>
			</div>
		</div>
	</section>

	<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
	<div class="container">
		<div class="row">
			<div class="col-24 col-lg-14">
				<section class="c-contact-form">
					<div class="c-section">
						<h2>Get In Touch</h2>
						<div class="c-section__content">Fill out the form below and we'll get back to you.</div>
					</div>
					<form action="{{route('contact')}}" class="c-contact-form__form o-form" method="POST">
						@csrf
						<fieldset>
							<legend>Contact Information</legend>

							<div class="row">
								<div class="col-24 col-md-12">
									<div class="o-form__group {{ $errors->has('contact-fullname') ? ' is-error' : '' }}">
										<label for="contact-fullname">{{ __('Full Name') }}</label>
										<input name="contact-fullname" id="contact-fullname" type="text" class="{{ $errors->has('contact-fullname') ? ' is-error' : '' }}" placeholder="e.g. Wile E. Coyote" value="{{ old('contact-fullname') }}" required>
										@if ($errors->has('contact-fullname'))
											<p class="o-form__error-text" role="alert">
												<i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-fullname') }}</span>
											</p>
										@endif
									</div>
								</div>

								<div class="col-24 col-md-12">
									<div class="o-form__group {{ $errors->has('contact-company') ? ' is-error' : '' }}">
										<label for="contact-company">{{ __('Company') }}</label>
										<input name="contact-company" id="contact-company" type="text" class="{{ $errors->has('contact-company') ? ' is-error' : '' }}" placeholder="e.g. Acme Co." value="{{ old('contact-company') }}" required>
										@if ($errors->has('contact-company'))
											<p class="o-form__error-text" role="alert">
												<i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-company') }}</span>
											</p>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-24 col-md-12">
									<div class="o-form__group {{ $errors->has('contact-email') ? ' is-error' : '' }}">
										<label for="contact-email">{{ __('Email Address') }}</label>
										<input name="contact-email" id="contact-email" type="email" class="{{ $errors->has('contact-email') ? ' is-error' : '' }}" placeholder="e.g. wile.e.coyote@acme.com" value="{{ old('contact-email') }}" required>
										@if ($errors->has('contact-email'))
											<p class="o-form__error-text" role="alert">
												<i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-email') }}</span>
											</p>
										@endif
									</div>
								</div>

								<div class="col-24 col-md-12">
									<div class="o-form__group {{ $errors->has('contact-phone') ? ' is-error' : '' }}">
										<label for="contact-phone">{{ __('Phone') }}</label>
										<input name="contact-phone" id="contact-phone" type="text" class="{{ $errors->has('contact-email') ? ' is-error' : '' }}" placeholder="e.g. 123-456-7890" value="{{ old('contact-phone') }}" required>
										@if ($errors->has('contact-phone'))
											<p class="o-form__error-text" role="alert">
												<i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-phone') }}</span>
											</p>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="o-form__group {{ $errors->has('contact-message') ? ' is-error' : '' }}">
										<label for="contact-message">{{ __('Add a Message') }}</label>
										<textarea name="contact-message" id="contact-message" rows="5" class="{{ $errors->has('contact-message') ? ' is-error' : '' }}" placeholder="e.g. Add your message here." value="{{ old('contact-message') }}"></textarea>
										@if ($errors->has('contact-message'))
											<p class="o-form__error-text" role="alert">
												<i class="fas fa-times"></i>&nbsp;&nbsp;<span>{{ $errors->first('contact-message') }}</span>
											</p>
										@endif
									</div>
								</div>
							</div>

							<div class="row justify-content-end">
								<div class="col-24 col-md-6 col-lg-6">
									<button type="submit" class="c-btn c-btn--primary c-btn--block">{{ __('Submit') }}</button>
								</div>
							</div>
						</fieldset>
					</form>
				</section>
			</div>
			<div class="col-24 col-lg-8 offset-lg-2">
				<aside class="c-contact-aside">
					<div class="row">
						<div class="col">
							<div class="c-contact-aside__img">
								<a href="https://goo.gl/maps/hEfrpDSy6G92" target="_blank" rel="noopener">
									<img src="{{ asset('images/contact-map.jpg') }}" alt="Map">
								</a>
							</div>
						</div>
					</div>
					<div class="row justify-content-between">
						<div class="col-24 col-md col-lg-24">
							<div class="c-contact-aside__info">
								<div class="c-contact-aside__info-icon">
									<i class="fas fa-map-marker-alt"></i>
								</div>
								<address>
									JMP Industries Inc.
									<br/>2779 Rockefeller Ave.
									<br/>Cleveland, OH 44115
									<br/><a href="https://goo.gl/maps/hEfrpDSy6G92" target="_blank" rel="noopener">View on Google Maps&nbsp;&nbsp;<i class="fas fa-external-link-alt"></i></a>
								</address>
							</div>
						</div>
						<div class="col-24 col-md col-lg-24">
							<div class="c-contact-aside__info c-contact-aside__info--phone">
								<div class="c-contact-aside__info-icon">
									<i class="fas fa-phone"></i>
								</div>
								<address>
									<a href="tel:216-749-6030" target="_blank" rel="noopener">(216) 749-6030</a>
									<br/><span class="text-muted">Hours: 8am - 5pm EST</span>
								</address>
							</div>
						</div>
						<div class="col-24 col-md col-lg-24">
							<div class="c-contact-aside__info c-contact-aside__info--email">
								<div class="c-contact-aside__info-icon">
									<i class="fas fa-envelope"></i>
								</div>
								<address>
									<a href="mailto:support@jmpind.com" target="_blank" rel="noopener">support@jmpind.com</a>
								</address>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
@endsection
