<!doctype html>
<html lang="{{ app()->getLocale() }}">

	<head>
		@prepend('head-preload')
			<link rel="preload" href="{{ mix('/css/header.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/buttons.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/category-menu.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/footer.css') }}" as="style" type="text/css">
		@endprepend

		@push('head-scripts')
			<script src="{{ mix('/js/category-menu-accordian.js') }}" defer></script>
		@endpush

		@include('partials.head')
	</head>

	<body>
		<link rel="stylesheet" href="{{ mix('/css/header.css') }}">
		<link rel="stylesheet" href="{{ mix('/css/buttons.css') }}">
		@include('partials.header-logged-in')

		<main class="o-main">
			<div class="o-dashboard">
				<div class="o-dashboard__menu">
					<link rel="stylesheet" href="{{ mix('/css/category-menu.css') }}">
					<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
					@include('partials.category-menu')
				</div>
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="o-dashboard__content">
								@yield('content')
								<div class="o-dashboard__disclaimer">
									One or more of the above items are protected by U.S. and/or foreign patents, patent applications, trademarks, trade secrets, and/or secrecy agreements with JMP that are owned by JMP Industries, Inc.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

		<link rel="stylesheet" href="{{ mix('/css/footer.css') }}">
		@include('partials.footer')
		
		@stack('body-scripts')
	</body>

</html>