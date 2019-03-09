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

@section('breadcrumbs')
	@include('partials.breadcrumbs', ['name' => 'Product', 'type' => 'catalog'])
@endsection

@section('content')
	<div class="row">
		<div class="col-24 col-xl-5 order-xl-last">
			<link rel="stylesheet" href="{{ mix('/css/product-jumps.css') }}">
			<div class="c-product-jumps">
				<div class="row">
					<div class="col-24 col-lg-12 col-xl-24">
						<div class="c-product-jumps__group">
							<h5>Jump to a Product Group</h5>

							{{-- LOOP OVER PRODUCT GROUP NAMES HERE --}}
							<ul class="c-product-jumps__list">
								<li class="c-product-jumps__item">
									<a href="#product-group-1" class="c-product-jumps__link">Example Product Group Name 1</a>
								</li>
								<li class="c-product-jumps__item">
									<a href="#product-group-1" class="c-product-jumps__link">Example Product Group Name 1</a>
								</li>
								<li class="c-product-jumps__item">
									<a href="#product-group-1" class="c-product-jumps__link">Example Product Group Name 1</a>
								</li>
								<li class="c-product-jumps__item">
									<a href="#product-group-1" class="c-product-jumps__link">Example Product Group Name 1</a>
								</li>
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

            {{-- LOOP OVER PRODUCT GROUPS HERE --}}
			<div id="product-group-1" class="c-product-group">
				<div class="c-product-group__title">
					<h3>Example Product Group Name 1</h3>
				</div>
				<div class="c-product-group__section">
					<div class="c-product-group__description">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis lacus purus. Quisque iaculis eleifend mi. Proin ultricies lectus sit amet erat scelerisque efficitur. Aliquam mattis vehicula sodales. Cras eu ante facilisis, consequat quam id, sagittis lacus. Aliquam porttitor enim tellus, quis fringilla tortor fringilla eget.
						</p>
						<p>
							Standard pin material is Tool Steel.
						</p>
					</div>
				</div>

				<div class="c-product-group__section">
					<h5>Images</h5>
					<div class="row">

						{{-- LOOP OVER PRODUCT GROUP IMAGES HERE --}}
						<div class="col-24 col-md-12">
							<div class="c-product-group__img">
								<a href="https://via.placeholder.com/600x400" target="_blank" rel="noopener">
									<div>
										<img src="https://via.placeholder.com/600x400" alt="Image">
									</div>
									<span>Click to enlarge&nbsp;&nbsp;<i class="fas fa-search-plus"></i></span>
								</a>
							</div>
						</div>
						<div class="col-24 col-md-12">
							<div class="c-product-group__img">
								<a href="https://via.placeholder.com/300x600" target="_blank" rel="noopener">
									<div>
										<img src="https://via.placeholder.com/300x600" alt="Image">
									</div>
									<span>Click to enlarge&nbsp;&nbsp;<i class="fas fa-search-plus"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="c-product-group__section">
					<h5>Products</h5>

					{{-- CREATE PRODUCT TABLES HERE --}}
					<div class="c-product-table c-product-table--desktop d-none d-md-block">
						<table>
							<thead>
								<tr>
									<th scope="col" ><span class="d-none">Product Image</span></th>
									<th scope="col" data-sort="" class="js-product-table-sortable-column">Attribute</th>
									<th scope="col" data-sort="" class="js-product-table-sortable-column">Attribute</th>
									<th scope="col" data-sort="" class="js-product-table-sortable-column">Attribute</th>
									<th scope="col"><span class="d-none">Email Us About This Product</span></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="c-product-table__img">
											<a href="https://via.placeholder.com/600x600" target="_blank" rel="noopener">
												<img src="https://via.placeholder.com/600x600" alt="Image">
											</a>
										</div>
									</td>
									<td>data C</td>
									<td>data</td>
									<td>data</td>
									<td>
										<div class="c-product-table__email">
											<a href="mailto:#">
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
								<tr>
									<td>
										<div class="c-product-table__img">
											<a href="https://via.placeholder.com/600x600" target="_blank" rel="noopener">
												<img src="https://via.placeholder.com/600x600" alt="Image">
											</a>
										</div>
									</td>
									<td>data A</td>
									<td>data</td>
									<td>data</td>
									<td>
										<div class="c-product-table__email">
											<a href="mailto:#">
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
								<tr>
									<td>
										<div class="c-product-table__img">
											<a href="https://via.placeholder.com/600x600" target="_blank" rel="noopener">
												<img src="https://via.placeholder.com/600x600" alt="Image">
											</a>
										</div>
									</td>
									<td>data D</td>
									<td>data</td>
									<td>data</td>
									<td>
										<div class="c-product-table__email">
											<a href="mailto:#">
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
								<tr>
									<td>
										<div class="c-product-table__img">
											<a href="https://via.placeholder.com/600x600" target="_blank" rel="noopener">
												<img src="https://via.placeholder.com/600x600" alt="Image">
											</a>
										</div>
									</td>
									<td>data B</td>
									<td>data</td>
									<td>data</td>
									<td>
										<div class="c-product-table__email">
											<a href="mailto:#">
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
							</tbody>
						</table>
					</div>

					<div class="c-product-table c-product-table--mobile d-md-none">
						<table>
							<tbody>
								<tr>
									<th scope="row"></th>
									<td>
										<div class="c-product-table__img">
											<a href="https://via.placeholder.com/600x600" target="_blank" rel="noopener">
												<img src="https://via.placeholder.com/600x600" alt="Image">
											</a>
										</div>
									</td>
									<td>
										<div class="c-product-table__img">
											<a href="https://via.placeholder.com/600x600" target="_blank" rel="noopener">
												<img src="https://via.placeholder.com/600x600" alt="Image">
											</a>
										</div>
									</td>
									<td>
										<div class="c-product-table__img">
											<a href="https://via.placeholder.com/600x600" target="_blank" rel="noopener">
												<img src="https://via.placeholder.com/600x600" alt="Image">
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<th scope="row">Attribute</th>
									<td>data</td>
									<td>data</td>
									<td>data</td>
								</tr>
								<tr>
									<th scope="row">Attribute</th>
									<td>data</td>
									<td>data</td>
									<td>data</td>
								</tr>
								<tr>
									<th scope="row">Attribute</th>
									<td>data</td>
									<td>data</td>
									<td>data</td>
								</tr>
								<tr>
									<th scope="row"></th>
									<td><a href="mailto:#">Email Us</a></td>
									<td><a href="mailto:#">Email Us</a></td>
									<td><a href="mailto:#">Email Us</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="c-product-group__back-to-top text-center">
					<a href="#back-to-top">Back to top&nbsp;&nbsp;<i class="fas fa-long-arrow-alt-up"></i></a>
				</div>
			</div>
		</div>
	</div>
@endsection
