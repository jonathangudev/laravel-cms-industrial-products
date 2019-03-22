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
	<div class="row">
		<div class="col-24 col-xl-5 order-xl-last">
			<link rel="stylesheet" href="{{ mix('/css/product-jumps.css') }}">
			<div class="c-product-jumps">
				<div class="row">
					<div class="col-24 col-lg-12 col-xl-24">
						<div class="c-product-jumps__group">
							<h5>Jump to a Product Group</h5>

							<ul class="c-product-jumps__list">
								@foreach ($categories as $category)
									<li class="c-product-jumps__item">
										<a href="#product-group-{{ $loop->iteration }}" class="c-product-jumps__link">{{ $category->name }}</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="col-24 col-lg-12 col-xl-24">
						<div class="c-product-jumps__group">
							<h5>Once you find your products...</h5>
							<p>Give us a call at <strong>(216) 749-6030</strong> or <a href="{{ route('contact') }}">contact us here</a>.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-24 col-xl-19">
			<link rel="stylesheet" href="{{ mix('/css/product-group.css') }}">
			<link rel="stylesheet" href="{{ mix('/css/product-table.css') }}">

			@foreach ($categories as $category)
				<div id="product-group-{{ $loop->iteration }}" class="c-product-group">
					<div class="c-product-group__title">
						<h3>{{ $category->name }}</h3>
					</div>
					<div class="c-product-group__section">
						<div class="c-product-group__description">
							{!! $category->content !!}
						</div>
					</div>

					@if ($category->hasMedia('category-gallery'))
						<div class="c-product-group__section">
							<h5>Images</h5>
							<div class="row">

								@foreach ($category->getMedia('category-gallery') as $image)
									<div class="col-24 col-md-12">
										<div class="c-product-group__img">
											<a href="{{ $image->getUrl() }}" target="_blank" rel="noopener">
												<div>
													<img src="{{ $image->getUrl('medium') }}" alt="{{ $category->name }} Image {{ $loop->iteration }}">
												</div>
												<span>Click to enlarge&nbsp;&nbsp;<i class="fas fa-search-plus"></i></span>
											</a>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					@endif

					@if ($category->products->count() > 0)
						<div class="c-product-group__section">
							<h5>Products</h5>

							<div class="c-product-table c-product-table--desktop d-none d-md-block">
								<table>
									<thead>
										<tr>
											<th scope="col"><span class="d-none">Product Image</span></th>

											@foreach ($category->products->getAttributeNames() as $attributeName)
												<th scope="col" data-sort="" class="js-product-table-sortable-column">{{ $attributeName->name }}</th>
											@endforeach

											<th scope="col"><span class="d-none">Email Us About This Product</span></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($category->products as $product)
											<tr>
												<td>
													<div class="c-product-table__img">
														{{$product->name}}
													</div>
												</td>

												@foreach ($product->attributes as $attribute)
													@if ($attribute->value)
														<td>{{ $attribute->value }}</td>
													@else
														<td>-</td>
													@endif
												@endforeach

												<td>
													<div class="c-product-table__email">
														<a href="mailto:support@jmpind.com?subject={{ urlencode('JMP Industries Inc. - ' . Auth::user()->company->name . ' is interested in ' . $product->name) }}&body={{ urlencode('Company: ' . Auth::user()->company->name) }}%0A{{ urlencode('Product: ' . $product->name) }}">
															<div class="c-product-table__email-text">
																<span>Email us about this product&nbsp;&nbsp;</span><i class="far fa-envelope"></i>
															</div>
															<div class="c-product-table__email-icon">
																<i class="far fa-envelope"></i>
															</div>
														</a>
													</div>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>

							<div class="c-product-table c-product-table--mobile d-md-none">
								<table>
									<tbody>
										<tr>
											<th scope="row"></th>

											@foreach ($category->products as $product)
												<td>
													<div class="c-product-table__img">
														@if ($product->hasMedia('product-thumbnail'))
															<a href="{{ $product->getFirstMediaUrl('product-thumbnail') }}" target="_blank" rel="noopener">
																<img src="{{ $product->getFirstMediaUrl('product-thumbnail', 'thumb') }}" alt="{{ $product->name }} Image">
															</a>
														@else
															<img src="{{ asset('images/placeholder.png') }}" alt="{{ $product->name }} Image">
														@endif
													</div>
												</td>
											@endforeach
										</tr>

										@foreach ($category->products->getAttributeNames() as $attributeName)
												<tr>
													<th scope="row">{{ $attributeName->name }}</th>

													@foreach ($category->products as $product)
														@php
																$value = $product->attributes->slice($loop->parent->index, 1)->first();//->value;
														@endphp

														@if ($value)
															<td>{{ $value }}</td>
														@else
															<td>-</td>
														@endif
													@endforeach

												</tr>
										@endforeach

										<tr>
											<th scope="row"></th>

											@foreach ($category->products as $product)
												<td>
													<a href="mailto:support@jmpind.com?subject={{ urlencode('JMP Industries Inc. - ' . Auth::user()->company->name . ' is interested in ' . $product->name) }}&body={{ urlencode('Company: ' . Auth::user()->company->name) }}%0A{{ urlencode('Product: ' . $product->name) }}">
														Email Us
													</a>
												</td>
											@endforeach
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					@endif

					<div class="c-product-group__back-to-top text-center">
						<a href="#back-to-top">Back to top&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-up"></i></a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection
