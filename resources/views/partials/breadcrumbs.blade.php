@push('head-preload')
	<link rel="preload" href="{{ mix('/css/breadcrumbs.css') }}" as="style" type="text/css">
@endpush

<link rel="stylesheet" href="{{ mix('/css/breadcrumbs.css') }}">
<nav class="c-breadcrumbs">
	<ul class="c-breadcrumbs__list">
		<li class="c-breadcrumbs__item"><a href="/">Home</a></li>
		<li class="c-breadcrumbs__item"><a href="/">Previous Page</a></li>
		<li class="c-breadcrumbs__item"><strong>Current Page</strong></li>
	</ul>
</nav>