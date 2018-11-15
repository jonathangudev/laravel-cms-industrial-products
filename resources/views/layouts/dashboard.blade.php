<!doctype html>
<html lang="{{ app()->getLocale() }}">

	<head>
		@include('partials.head')
	</head>

	<body>
		
		@include('partials.header-logged-in')

		<main class="o-main">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="o-dashboard">
							<div class="o-dashboard__menu">
								@include('partials.category-menu')
							</div>
							<div class="o-dashboard__content">
								@yield('content')
								<div class="o-dashboard__disclaimer">One or more of the above items are protected by U.S. and/or foreign patents, patent applications, trademarks, trade secrets, and/or secrecy agreements with JMP that are owned by JMP Industries, Inc.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

		@include('partials.footer')
		
		{{-- End of Body Scripts --}}
		@stack('body-scripts')

	</body>

</html>