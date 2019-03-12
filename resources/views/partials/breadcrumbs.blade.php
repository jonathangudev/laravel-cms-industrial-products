@push('head-preload')
	<link rel="preload" href="{{ mix('/css/breadcrumbs.css') }}" as="style" type="text/css">
@endpush

<link rel="stylesheet" href="{{ mix('/css/breadcrumbs.css') }}">
<nav class="c-breadcrumbs">
	<ol class="c-breadcrumbs__list">

		@isset($categoryAncestors)
			<li class="c-breadcrumbs__item"><a href="{{ route('catalog') }}">Home</a></li>

			@foreach ($categoryAncestors as $category)
				@if ($loop->last)
					<li class="c-breadcrumbs__item"><strong>{{ $category->name }}</strong></li>
				@else
					<li class="c-breadcrumbs__item"><a href="{{ route('catalog.category', ['id' => $category]) }}">{{ $category->name }}</a></li>
				@endif
			@endforeach
		@endisset
		
		@isset($name)
			<li class="c-breadcrumbs__item"><a href="{{ route('home') }}">Home</a></li>
			<li class="c-breadcrumbs__item"><strong>{{ $name }}</strong></li>
		@endif

	</ol>
</nav>