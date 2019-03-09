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

@section('breadcrumbs')
	@include('partials.breadcrumbs', ['name' => 'Categories', 'type' => 'catalog'])
@endsection

@section('content')
	<div class="row">

		<link rel="stylesheet" href="{{ mix('/css/panel.css') }}">
		@for ($i = 1; $i < 9; $i++)			
			<div class="col-24 col-sm-12 col-md-8 col-xl-6">
				<div class="c-panel">
					<div class="c-panel__img">
						<a href="#">
							<img src="https://via.placeholder.com/600x600" alt="Image" title="Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit">
						</a>
					</div>
					<div class="c-panel__footer">
						<div class="c-panel__title" title="Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit">
							<strong>Category {{ $i }} - Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit</strong>
						</div>
						<div class="c-panel__action">
							<a href="#">View</a>
						</div>
					</div>
				</div>
			</div>
		@endfor
	</div>
@endsection
