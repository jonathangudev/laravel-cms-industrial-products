<!doctype html>
<html lang="{{ app()->getLocale() }}">

	<head>
		@prepend('head-preload')
			<link rel="preload" href="{{ mix('/css/header.css') }}" as="style" type="text/css">
			<link rel="preload" href="{{ mix('/css/footer.css') }}" as="style" type="text/css">
		@endprepend

		@push('head-scripts')
			<script src="{{ mix('/js/menu-toggle.js') }}" defer></script>
		@endpush

		@push('head-prefetch')
			<link rel="prefetch" href="{{ asset('images/logo/JMP_Logo.svg') }}">
		@endpush

		@include('partials.head')
	</head>

	<body>
		{{-- Google Tag Manager (noscript) --}}
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		{{-- End Google Tag Manager (noscript) --}}

		@include('partials.header-logged-out')

		<main class="o-main">
			@yield('content')
		</main>

		@include('partials.footer')
	</body>
</html>
