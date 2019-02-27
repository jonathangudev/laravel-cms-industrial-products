@push('head-preload')
	<link rel="preload" href="{{ mix('/css/breadcrumbs.css') }}" as="style" type="text/css">
@endpush

<link rel="stylesheet" href="{{ mix('/css/breadcrumbs.css') }}">
<nav class="c-breadcrumbs">
	<ol class="c-breadcrumbs__list">

		@if (isset($type) && $type === 'catalog')
			<li class="c-breadcrumbs__item"><a href="{{ route('catalog') }}">Home</a></li>
		@else
			<li class="c-breadcrumbs__item"><a href="{{ route('home') }}">Home</a></li>
		@endif

		@isset($categories)
			@foreach ($categories as $category)
				<li class="c-breadcrumbs__item"><a href="/">{{ $category }}</a></li>
			@endforeach
		@endisset

		@isset($name)
			<li class="c-breadcrumbs__item"><strong>{{ $name }}</strong></li>
		@endif

	</ol>
</nav>