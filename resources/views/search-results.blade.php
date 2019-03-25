@extends('layouts.dashboard')

@section('title', 'Search Results')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/search-results.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/product-table.css') }}" as="style" type="text/css">
@endpush

@push('head-scripts')
	<script src="{{ mix('/js/sort-table.js') }}" defer></script>
@endpush

@section('breadcrumbs')
	@include('partials.breadcrumbs', ['name' => 'Search Results', 'type' => 'catalog'])
@endsection

@section('content')
	<div class="row">
		<div class="col-24">
			<h1>Search Results</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-24 col-md-12 col-lg-10">
			<form action="/" class="o-form">
				@csrf
				<div class="o-form__group">
					<div class="o-form__search">
						<label for="jmp-results-search">{{ __('Search Products') }}</label>
						<input type="search" id="jmp-results-search" placeholder="Search products..." aria-label="Search Products">
						<button type="submit" class="c-btn" aria-label="Search"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-24">
			{{-- GET SEARCH STATS HERE --}}
			<p><strong>## Search Results for: "XXXXXXXXXX"</strong></p>
		</div>
	</div>

	<link rel="stylesheet" href="{{ mix('/css/search-results.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/product-table.css') }}">
	<section class="c-search-results">
		{{-- BEGIN LOOPING OVER PRODUCT GROUPS HERE --}}
		<div class="row">
			<div class="col-24">
				<div class="c-search-results__group">
					<h3>Example Product Group Name 1</h3>

					{{-- CREATE PRODUCT TABLES HERE --}}
					<div class="c-product-table c-product-table--desktop d-none d-md-block"></div>
					<div class="c-product-table c-product-table--mobile d-md-none">
				</div>
			</div>
		</div>
	</section>
@endsection