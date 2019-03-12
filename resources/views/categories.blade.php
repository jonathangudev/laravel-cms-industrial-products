@extends('layouts.dashboard')

@section('title', 'Catalog')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/panel.css') }}" as="style" type="text/css">
@endpush

@push('head-prefetch')
	<link rel="prefetch" href="{{ mix('/css/product-group.css') }}">
	<link rel="prefetch" href="{{ mix('/css/product-jumps.css') }}">
	<link rel="prefetch" href="{{ mix('/css/product-table.css') }}">
    <link rel="prefetch" href="{{ mix('/js/sort-table.js') }}">
@endpush

@section('content')
	<div class="row">

		<link rel="stylesheet" href="{{ mix('/css/panel.css') }}">
		@foreach ($categories as $category)
			<div class="col-24 col-sm-12 col-md-8 col-xl-6">
				<div class="c-panel">
					<div class="c-panel__img">
						<a href="{{ route('catalog.category', ['id' => $category]) }}">
							@if ($category->hasMedia('category-thumbnail'))
								<img src="{{ $category->getFirstMediaUrl('category-thumbnail', 'thumb') }}" alt="{{ $category->name }} Image" title="{{ $category->name }}">
							@else
								<img src="{{ asset('images/placeholder.png') }}" alt="{{ $category->name }} Image" title="{{ $category->name }}">
							@endif
						</a>
					</div>
					<div class="c-panel__footer">
						<div class="c-panel__title" title="{{ $category->name }}">
							<strong>{{ $category->name }}</strong>
						</div>
						<div class="c-panel__action">
							<a href="{{ route('catalog.category', ['id' => $category]) }}">{{ __('View') }}</a>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection
