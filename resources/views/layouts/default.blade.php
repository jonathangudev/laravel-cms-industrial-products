<!doctype html>
<html lang="{{ app()->getLocale() }}">

	<head>
		@prepend('head-preload')
			<link rel="preload" href="{{ mix('/css/header.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/buttons.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/footer.css') }}" as="style" type="text/css">
		@endprepend

		@push('head-scripts')
			<script src="{{ mix('/js/menu-toggle.js') }}" defer></script>
		@endpush

		@include('partials.head')
	</head>

	<body>
		<link rel="stylesheet" href="{{ mix('/css/header.css') }}">
		<link rel="stylesheet" href="{{ mix('/css/buttons.css') }}">
		@include('partials.header-logged-out')
		
		<main class="o-main">
			@yield('content')
		</main>
		
		<link rel="stylesheet" href="{{ mix('/css/footer.css') }}">
		@include('partials.footer')

		@stack('body-scripts')
	</body>

</html>

{{-- Styleguide Stuff --}}
{{-- <div class="container">
	<div class="row">
		<div class="col">
			<h2 class="c-section-title">Section Title</h2>
			<h1>Heading 1</h1>
			<h2>Heading 2</h2>
			<h3>Heading 3</h3>
			<h4>Heading 4</h4>
			<h5>Heading 5</h5>
			<h6>Heading 6</h6>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut euismod tortor, vel fermentum ante.
				Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut eget
				lectus vitae
				libero commodo bibendum molestie nec felis. Aenean scelerisque nulla felis, a lobortis ligula tempor
				sit amet.
				Integer in imperdiet justo. Maecenas tempor sagittis elementum. Fusce sit amet eros lectus. Sed mollis
				sodales
				orci, vel porta sapien iaculis quis. Nullam tincidunt augue nec justo efficitur blandit. Aliquam
				vulputate ex ac
				justo rhoncus hendrerit. Morbi pharetra fringilla euismod.</p>

			<p><a href="#">Link</a></p>

			<p>
				<a href="#" class="c-btn c-btn--primary">Button</a>
				<a href="#" class="c-btn c-btn--primary c-btn--ghost">Button</a>
			</p>

			<form action="/" class="o-form">
				<div class="o-form__group">
					<div class="o-form__search">
						<label for="vf-search">Search Products</label>
						<input type="search" id="vf-search" placeholder="Search products...">
						<button type="submit" class="c-btn"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</form>

			<form action="/" class="o-form">
				<div class="o-form__group">
					<label for="vf-text">Label</label>
					<input type="text" id="vf-text" placeholder="e.g. Placeholder text">
				</div>

				<div class="o-form__group">
					<label for="vf-text">Label</label>
					<input type="text" id="vf-text" placeholder="e.g. Placeholder text" value="This has text entered.">
				</div>

				<div class="o-form__group is-disabled">
					<label for="vf-text">Label - Disabled</label>
					<input type="text" id="vf-text" placeholder="e.g. Placeholder text" disabled>
				</div>

				<div class="o-form__group is-error">
					<label for="vf-text">Label - Error</label>
					<input class="is-error" type="text" id="vf-text" placeholder="e.g. Placeholder text" value="This text has errors.">
					<p class="o-form__error-text"><i class="fas fa-times"></i>&nbsp;&nbsp;<span>This is some error text.</strong></p>
				</div>

				<div class="o-form__group">
					<label for="vf-textare">Label</label>
					<textarea name="textarea" id="vf-textarea" rows="5" placeholder="e.g. Placeholder text"></textarea>
				</div>

				<div class="o-form__group">
					<input type="checkbox" name="checkbox" id="vf-check">
					<label for="vf-check"><strong>Checkbox</strong> - Label with text<br />that goes onto second line</label>
				</div>

				<div class="o-form__group is-error">
					<input class="is-error" type="checkbox" name="checkbox" id="vf-check">
					<label for="vf-check"><strong>Checkbox</strong> - Label with text<br />that goes onto second line</label>
					<p class="o-form__error-text"><i class="fas fa-times"></i>&nbsp;&nbsp;<span>This is some error text.</strong></p>
				</div>

				<div class="o-form__group">
					<input type="radio" name="radio" id="vf-radio">
					<label for="vf-radio"><strong>Radio</strong> - Label with text that<br />goes onto second line</label>
				</div>

				<div class="o-form__group is-error">
					<input class="is-error" type="radio" name="radio" id="vf-radio">
					<label for="vf-radio"><strong>Radio</strong> - Label with text that<br />goes onto second line</label>
					<p class="o-form__error-text"><i class="fas fa-times"></i>&nbsp;&nbsp;<span>This is some error text.</strong></p>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-24 col-sm-12 col-md-8 col-lg-6">
			<div class="c-panel">
				<div class="c-panel__content">
					<div class="c-panel__img">
						<img src="https://via.placeholder.com/600x600" alt="Image">
					</div>
					<div class="c-panel__footer">
						<div class="c-panel__title" title="Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit">
							<strong>Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit</strong>
						</div>
						<div class="c-panel__action">
							<a href="#">View</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> --}}