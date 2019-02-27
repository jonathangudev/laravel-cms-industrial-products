@extends('layouts.default')

@section('title', 'Contact Us')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/contact.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/subheader.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ asset('images/contact-map.jpg') }}" as="image" type="image/jpeg">
@endpush

@section('content')
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
					<p>Fill out the form below and we'll get back to you.</p>
				</div>
				<form action="#" class="c-contact-form__form o-form">
					@csrf
					<fieldset>
						<legend>Contact Information</legend>
						<div class="row">
							<div class="col-24 col-md-12">
								<div class="o-form__group">
									<label for="contact-fullname">Full Name</label>
									<input id="contact-fullname" type="text" placeholder="e.g. Wile E. Coyote" required>
								</div>
							</div>
							<div class="col-24 col-md-12">
								<div class="o-form__group">
									<label for="contact-company">Company</label>
									<input id="contact-company" type="text" placeholder="e.g. Acme Co." required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-24 col-md-12">
								<div class="o-form__group">
									<label for="contact-email">Email Address</label>
									<input id="contact-email" type="email" placeholder="e.g. wile.e.coyote@acme.com" required>
								</div>
							</div>
							<div class="col-24 col-md-12">
								<div class="o-form__group">
									<label for="contact-phone">Phone</label>
									<input id="contact-phone" type="text" placeholder="e.g. 123-456-7890" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="o-form__group">
									<label for="contact-message">Add a Message</label>
									<textarea name="contact-message" id="contact-message" rows="5" placeholder="e.g. Add your message here."></textarea>
								</div>
							</div>
						</div>
						<div class="row justify-content-end">
							<div class="col-24 col-md-6 col-lg-6">
								<button type="submit" class="c-btn c-btn--primary c-btn--block">Submit</button>
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