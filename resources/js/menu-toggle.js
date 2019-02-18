// Toggle mobile menu

const headerEl = document.getElementById('js-header');
const bodyEl = document.getElementsByTagName('body')[0];

document.getElementById('js-header-menu-btn-open').addEventListener('click', function () {
	headerEl.classList.add('is-open');
	bodyEl.style.overflow = 'hidden';
});

document.getElementById('js-header-menu-btn-close').addEventListener('click', function () {
	headerEl.classList.remove('is-open');
	bodyEl.style.overflow = 'initial';
});