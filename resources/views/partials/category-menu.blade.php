<div id="js-category-menu" class="c-category-menu">
	<div class="c-category-menu__wrapper">
		<div class="c-category-menu__top-bar d-lg-none">
			<p><i class="fas fa-phone"></i>&nbsp;&nbsp;(216 749-6030)</p>
			<button id="js-category-menu-btn-close" type="button" class="c-btn c-category-menu__btn"><i class="fas fa-fw fa-times"></i></button>
		</div>
		<div class="c-category-menu__mobile-header d-lg-none">
			<nav class="c-category-menu__header-nav">
				<ul class="c-category-menu__header-list">
					<li class="c-category-menu__header-item">
						<a href="{{ route('home') }}" class="c-category-menu__header-link">Home</a>
					</li>
					<li class="c-category-menu__header-item">
						<a href="{{ route('contact') }}" class="c-category-menu__header-link">Contact Us</a>
					</li>
					<li class="c-category-menu__header-item">
						<a href="{{ route('logout') }}" class="c-category-menu__header-link c-category-menu__header-link--log-out"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Log Out</a>
					</li>
				</ul>
			</nav>
			<form action="/" class="c-category-menu__search o-form">
				@csrf
				<div class="o-form__search">
					<label for="jmp-menu-search">Search Products</label>
					<input type="search" id="jmp-menu-search" placeholder="Search products..." aria-label="Search Products">
					<button type="submit" class="c-btn" aria-label="Search"><i class="fas fa-search"></i></button>
				</div>
			</form>
		</div>
	
		<div class="c-category-menu__title">
			<div class="c-section">
				<h4>Navigate By Category</h4>
			</div>
		</div>
	
		<nav class="c-category-menu__nav">
			<ul class="c-category-menu__list">
				<li class="c-category-menu__item">
					<div class="c-category-menu__main">
						<a href="#" class="c-category-menu__link">Category Name</a>
						<span class="c-category-menu__icon c-category-menu__icon--expand js-category-menu-icon"><i class="fas fa-plus"></i></span>
						<span class="c-category-menu__icon c-category-menu__icon--collapse js-category-menu-icon"><i class="fas fa-minus"></i></span>
					</div>
					<ul class="c-category-menu__sublist">
						<li class="c-category-menu__subitem">
							<a href="#" class="c-category-menu__sublink">Subcategory</a>
						</li>
					</ul>
				</li>
				<li class="c-category-menu__item is-active is-open">
					<div class="c-category-menu__main">
						<a href="#" class="c-category-menu__link">Category Name</a>
						<span class="c-category-menu__icon c-category-menu__icon--expand js-category-menu-icon"><i class="fas fa-plus"></i></span>
						<span class="c-category-menu__icon c-category-menu__icon--collapse js-category-menu-icon"><i class="fas fa-minus"></i></span>
					</div>
					<ul class="c-category-menu__sublist">
						<li class="c-category-menu__subitem">
							<a href="#" class="c-category-menu__sublink">Subcategory</a>
						</li>
						<li class="c-category-menu__subitem is-active">
							<a href="#" class="c-category-menu__sublink">Subcategory</a>
						</li>
						<li class="c-category-menu__subitem">
							<a href="#" class="c-category-menu__sublink">Subcategory</a>
						</li>
					</ul>
				</li>
				<li class="c-category-menu__item">
					<div class="c-category-menu__main">
						<a href="#" class="c-category-menu__link">Category Name</a>
					</div>
				</li>
				<li class="c-category-menu__item">
					<div class="c-category-menu__main">
						<a href="#" class="c-category-menu__link">Category Name</a>
						<span class="c-category-menu__icon c-category-menu__icon--expand js-category-menu-icon"><i class="fas fa-plus"></i></span>
						<span class="c-category-menu__icon c-category-menu__icon--collapse js-category-menu-icon"><i class="fas fa-minus"></i></span>
					</div>
					<ul class="c-category-menu__sublist">
						<li class="c-category-menu__subitem">
							<a href="#" class="c-category-menu__sublink">Subcategory</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>


	<div id="js-category-menu-background" class="c-category-menu__background"></div>
</div>
