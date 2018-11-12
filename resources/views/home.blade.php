@extends('layouts.default')

@section('title', 'Home | JMP')

@section('content')

<section class="c-home-hero">
	<div class="container h-100">
		<div class="row align-items-center justify-content-center h-100">
			<div class="col">
				<div class="row">
					<div class="col-12 col-md-8 col-lg-6 offset-6 offset-md-8 offset-lg-9">
						<div class="c-home-hero__logo d-none d-sm-block">
							<img src="/images/logo/JMP_Logo_white.svg" alt="JMP Logo">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-24 col-md-22 col-lg-16 offset-md-1 offset-lg-4">
						<div class="c-home-hero__content">
							<h1>Certified craftsmanship.
								<br/>World-class <span class="c-home-hero__highlight"><span>componentry.</span></span>
							</h1>
							<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros.</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-24">
						<div class="c-home-hero__cta">
							<a href="#" class="c-btn c-btn--primary c-btn--ghost c-btn--reverse">Learn More</a>
						</div>
						<img src="/images/arrow.svg" alt="Arrow" class="c-home-hero__arrow">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="c-home-cards">
	<div class="container">
		<div class="row">
			<div class="col-24 col-md-12 col-lg-8 col-xl-6 offset-xl-2">
				<div class="c-card c-home-cards__card text-center">
					<h3 class="c-section-title c-section-title--center">Who We Are</h3>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida. Nulla id dignissim erat. Donec nec vulputate mi.</p>
					<a href="#" class="c-btn c-btn--primary c-btn--ghost">Learn More</a>
				</div>
			</div>
			<div class="col-24 col-md-12 col-lg-8 col-xl-6 offset-xl-1">
				<div class="c-card c-home-cards__card text-center">
					<h3 class="c-section-title c-section-title--center">What We Do</h3>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida. Nulla id dignissim erat. Donec nec vulputate mi.</p>
					<a href="#" class="c-btn c-btn--primary c-btn--ghost">Learn More</a>
				</div>
			</div>
			<div class="col-24 col-md-12 col-lg-8 col-xl-6 offset-md-6 offset-lg-0 offset-xl-1">
				<div class="c-card c-home-cards__card text-center">
					<h3 class="c-section-title c-section-title--center">Contact Us</h3>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis blandit gravida. Nulla id dignissim erat. Donec nec vulputate mi.</p>
					<a href="#" class="c-btn c-btn--primary c-btn--ghost">Contact Us</a>
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
					<img src="https://via.placeholder.com/1600x900" alt="Image">
				</div>
			</div>
			<div class="col-lg-11 col-xl-10 offset-lg-1 offset-xl-2">
				<div class="c-home-content__text">
					<h2 class="c-section-title d-none d-lg-block">
						Lorem ipsum dolor sit amet
					</h2>
					<h2 class="c-section-title c-section-title--center d-lg-none">
						Lorem ipsum dolor sit amet
					</h2>
					<p class="c-home-content__subtext">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dignissim nec est ac blandit. Ut sit amet enim eros. Vestibulum vel purus et diam consequat vulputate.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection