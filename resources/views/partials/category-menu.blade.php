<div class="c-category-menu">
	<div class="c-category-menu__title">
		<div class="c-section">
			<h4>Navigate By Category</h4>
		</div>
	</div>
	<nav class="c-category-menu__nav">
		<ul class="c-category-menu__list">
			<li class="c-category-menu__item js-category-menu-item">
				<div class="c-category-menu__main js-category-menu-main">
					<a href="#" class="c-category-menu__link">Category Name</a>
					<span class="c-category-menu__icon c-category-menu__icon--expand"><i class="fas fa-plus"></i></span>
					<span class="c-category-menu__icon c-category-menu__icon--collapse"><i class="fas fa-minus"></i></span>
				</div>
				<ul class="c-category-menu__sublist js-category-menu-sublist">
					<li class="c-category-menu__subitem">
						<a href="#" class="c-category-menu__sublink">Subcatgory</a>
					</li>
				</ul>
			</li>
			<li class="c-category-menu__item js-category-menu-item">
				<div class="c-category-menu__main js-category-menu-main">
					<a href="#" class="c-category-menu__link">Category Name</a>
					<span class="c-category-menu__icon c-category-menu__icon--expand"><i class="fas fa-plus"></i></span>
					<span class="c-category-menu__icon c-category-menu__icon--collapse"><i class="fas fa-minus"></i></span>
				</div>
				<ul class="c-category-menu__sublist js-category-menu-sublist">
					<li class="c-category-menu__subitem">
						<a href="#" class="c-category-menu__sublink">Subcatgory</a>
					</li>
					<li class="c-category-menu__subitem is-active">
						<a href="#" class="c-category-menu__sublink">Subcatgory</a>
					</li>
					<li class="c-category-menu__subitem">
						<a href="#" class="c-category-menu__sublink">Subcatgory</a>
					</li>
				</ul>
			</li>
			<li class="c-category-menu__item js-category-menu-item">
					<div class="c-category-menu__main js-category-menu-main">
						<a href="#" class="c-category-menu__link">Category Name</a>
						<span class="c-category-menu__icon c-category-menu__icon--expand"><i class="fas fa-plus"></i></span>
						<span class="c-category-menu__icon c-category-menu__icon--collapse"><i class="fas fa-minus"></i></span>
					</div>
					<ul class="c-category-menu__sublist js-category-menu-sublist">
						<li class="c-category-menu__subitem">
							<a href="#" class="c-category-menu__sublink">Subcatgory</a>
						</li>
					</ul>
				</li>
		</ul>
	</nav>
</div>

<script>
	const elems = document.getElementsByClassName('js-category-menu-main');
	for (var i = 0; i < elems.length; i++) {
		elems[i].addEventListener('click', (event) => {
			const parentItem = event.currentTarget.parentElement;
			const sublist = event.currentTarget.nextElementSibling;			

			if (parentItem.classList.contains('is-open')) {
				parentItem.classList.remove('is-open');
				sublist.style.height = 0;
			} else {
				parentItem.classList.add('is-open');
				sublist.style.height = sublist.scrollHeight + 'px';
			}
		});
	}
</script>