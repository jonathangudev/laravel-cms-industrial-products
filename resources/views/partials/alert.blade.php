<link rel="stylesheet" href="{{ mix('/css/alert.css') }}">
<div id="js-alert" class="c-alert c-alert--{{ $type }}" role="alert">
	<div class="c-alert__title">
		@if ($type === 'danger')
			<h5><i class="fas fa-exclamation-circle c-alert__icon"></i>&nbsp;&nbsp;<strong>Error</strong></h5>
		@elseif ($type === 'warning')
			<h5><i class="fas fa-exclamation-triangle c-alert__icon"></i>&nbsp;&nbsp;<strong>Warning</strong></h5>
		@elseif ($type === 'success')
			<h5><i class="fas fa-check-circle c-alert__icon"></i>&nbsp;&nbsp;<strong>Success</strong></h5>
		@else
			<h5><i class="fas fa-info-circle c-alert__icon"></i>&nbsp;&nbsp;<strong>Information</strong></h5>
		@endif
		<button type="button" id="js-alert-close" class="c-btn" aria-label="Close Alert"><i class="fas fa-times"></i></button>
	</div>
	<p>{{ $slot }}</p>
</div>
