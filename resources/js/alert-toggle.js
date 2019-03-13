// Toggle mobile menu

if (document.getElementById('js-alert')) {
	const alertEl = document.getElementById('js-alert');

	document.getElementById('js-alert-close').addEventListener('click', function () {
		alertEl.classList.add('is-closed');
	});
}
