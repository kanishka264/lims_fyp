<!-- Mobile-header-top Start -->
<div class="mobile-header-top d-block d-md-none">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- header-search-mobile start -->
				<div class="header-search-mobile">
					<div class="table">
						<div class="table-cell">
							<ul>
								<li><a class="search-open" href="#"><i class="zmdi zmdi-search"></i></a></li>
								<li><a href="login"><i class="zmdi zmdi-lock"></i></a></li>
								<li><a href="my-account"><i class="zmdi zmdi-account"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- header-search-mobile start -->
			</div>
		</div>
	</div>
</div>
<!-- Mobile-header-top End -->
<!-- HEADER-AREA START -->
<header id="sticky-menu" class="header">
	<div class="header-area">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 offset-md-4 col-7">
					<div class="logo text-md-center">
						<a href="{{ url('/') }}"><img src="{{ asset('website/assets/img/logo/logo.png')}} " alt="" /></a>
					</div>
				</div>
				<div class="col-md-4 col-5">
					<div class="mini-cart text-end">
						<ul>
							<li>
								<a class="cart-icon" href="{{url('cart')}}">
									<i class="zmdi zmdi-shopping-cart"></i>
									<span id="cartCount"> {{ count(Session::get('cart_item')) }}</span>
								</a>
								
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- MAIN-MENU START -->
	<div class="menu-toggle hamburger hamburger--emphatic d-none d-md-block">
		<div class="hamburger-box">
			<div class="hamburger-inner"></div>
		</div>
	</div>
	<div class="main-menu  d-none d-md-block">
		<nav>
			<ul>
				<li><a href="{{ url('/') }}">home</a>

				</li>

				<li><a href="">All Testing</a>
					<div class="sub-menu menu-scroll">
						<ul>
							<li class="menu-title">All Testing</li>
							<li><a href="">Testng 1</a></li>

						</ul>
					</div>
				</li>
				<li><a href="">Navigation</a></li>

			</ul>
		</nav>
	</div>
	<!-- MAIN-MENU END -->
</header>
<!-- HEADER-AREA END -->
<!-- Mobile-menu start -->
<div class="mobile-menu-area">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 d-block d-md-none">
				<div class="mobile-menu">
					<nav id="dropdown">
						<ul>
							<li><a href="{{ url('/') }}">home</a>

							</li>
							<li><a href="">All Testing</a>

								<ul>
									<li><a href="">Testng 1</a></li>

								</ul>
							</li>
							<li><a href="">Navigation</a></li>
							
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Mobile-menu end -->