<!doctype html>
<html lang="{{ app()->getLocale() }}">

	<head>
		@prepend('head-preload')
			<link rel="preload" href="{{ mix('/css/header.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/category-menu.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/section.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/breadcrumbs.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/footer.css') }}" as="style" type="text/css">
		@endprepend

		@push('head-scripts')
			<script src="{{ mix('/js/category-menu-toggle.js') }}" defer></script>
			<script src="{{ mix('/js/category-menu-accordian.js') }}" defer></script>
		@endpush

		@include('partials.head')
	</head>

	<body>
		{{-- Google Tag Manager (noscript) --}}
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		{{-- End Google Tag Manager (noscript) --}}

		<div id="back-to-top"></div>
		@include('partials.header-logged-in')

		<main class="o-main">
			<div class="o-dashboard">
				<div class="o-dashboard__menu">
					<link rel="stylesheet" href="{{ mix('/css/category-menu.css') }}">
					<link rel="stylesheet" href="{{ mix('/css/section.css') }}">
					@include('partials.category-menu')
				</div>

				<div class="o-dashboard__content">
					<div class="container">
						{{-- Do not display breadcrumbs on first page of catalog --}}
						@if (!Route::currentRouteNamed('catalog'))
							<div class="row">
								<div class="col">
									@include('partials.breadcrumbs')
								</div>
							</div>
						@endif

						{{-- Display company welcome message only on home dashboard --}}
						@if (Route::currentRouteNamed('catalog'))
							<div class="row">
								<div class="col">
									<div class="o-dashboard__message">
										<h3>Welcome, {{ Auth::user()->company->name }}</h3>
									</div>
								</div>
							</div>
						@endif

						<div class="row">
							<div class="col">
								@yield('content')
							</div>
						</div>

						<div class="row">
							<div class="col">
								<div class="o-dashboard__disclaimer">
									One or more of the above items are protected by U.S. and/or foreign patents, patent applications, trademarks, trade secrets, and/or secrecy agreements with JMP that are owned by JMP Industries, Inc.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

		@include('partials.footer')
	</body>

</html>