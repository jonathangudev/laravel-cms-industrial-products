@extends('layouts.dashboard')

@section('title', 'Product Group')

@push('head-preload')
	<link rel="preload" href="{{ mix('/css/product-group.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/product-jumps.css') }}" as="style" type="text/css">
	<link rel="preload" href="{{ mix('/css/product-table.css') }}" as="style" type="text/css">
@endpush

@push('head-scripts')
	<script src="{{ mix('/js/sort-table.js') }}" defer></script>
@endpush

@section('content')
	<hr>
	@foreach($results as $result)
		{{$result->category->name}} {{$result->category->content}}
		<p>
		<ul>
		@foreach($result->products as $product)
			<li>{{$product->name}}</li>
		@endforeach
		</ul>
		<hr>
	@endforeach 
@endsection
