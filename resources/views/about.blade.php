@extends('layouts.default')

@section('title', 'About Us | JMP')

@section('content')
	<section class="c-subheader c-home-about">
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
					@include('partials.breadcrumbs')
				</div>
			</div>
		</div>
	</section>

	<section class="c-about-content">
		<div class="container">
			<div class="row">
				<div class="col-24 col-lg-13">
					<div class="c-section">
						<h2 class="c-section__title">Our Company</h2>
						<p class="c-section__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate.</p>
						<p class="c-section__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate.</p>
	
						<h2 class="c-section__title">Our Expertise</h2>
						<p class="c-section__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate.</p>
						<a href="{{ route('products-services') }}" class="c-btn c-btn--primary c-btn--ghost">View Products &amp; Services</a>
					</div>
				</div>
				<div class="col-24 col-md-14 col-lg-8 offset-lg-2">
					<div class="c-about-content__img">
						<img src="https://via.placeholder.com/900x1600" alt="Image">
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="c-about-testimonial"></section>
	
	<section class="c-about-team">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="c-section c-section--center">
						<h2>Meet Our Senior Leadership</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection