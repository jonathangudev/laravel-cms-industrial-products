const elems = document.getElementsByClassName('js-category-menu-icon');
for (var i = 0; i < elems.length; i++) {

	// Give active item an iniital height so that it animates properly on the first collapse
	if (elems[i].parentElement.parentElement.classList.contains('is-active')) {
		const subList = elems[i].parentElement.nextElementSibling;
		subList.style.height = subList.scrollHeight + 'px';
	}

	// Attach event listeners for expanding/collapsing menu items
	elems[i].addEventListener('click', (event) => {
		const parentItem = event.currentTarget.parentElement.parentElement;
		const subList = event.currentTarget.parentElement.nextElementSibling;			

		if (parentItem.classList.contains('is-open')) {
			parentItem.classList.remove('is-open');
			subList.style.height = 0;
		} else {
			parentItem.classList.add('is-open');
			subList.style.height = subList.scrollHeight + 'px';
		}
	});
}