// Toggle category menu

const menuEl = document.getElementById('js-category-menu');
const bodyEl = document.getElementsByTagName('body')[0];

document.getElementById('js-header-menu-btn-open').addEventListener('click', function () {
	menuEl.classList.add('is-open');
	bodyEl.style.overflow = 'hidden';
});

document.getElementById('js-category-menu-btn-close').addEventListener('click', function () {
	menuEl.classList.remove('is-open');
	bodyEl.style.overflow = 'initial';
});

document.getElementById('js-category-menu-background').addEventListener('click', function () {
	menuEl.classList.remove('is-open');
	bodyEl.style.overflow = 'initial';
});