<!DOCTYPE html>
<html lang="en">
<head>
<title>Little Shop</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Little Shop">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('front/styles/bootstrap-4.1.2/bootstrap.min.css') }}">
<link href="{{ URL::asset('front/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('front/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('front/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('front/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('front/styles/responsive.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('front/styles/category.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('front/styles/category_responsive.css') }}"> --}}
</head>
<body>

<!-- Menu -->

<div class="menu">

	<!-- Search -->
	<div class="menu_search">
		<form action="#" id="menu_search_form" class="menu_search_form">
			<input type="text" class="search_input" placeholder="Search Item" required="required">
			<button class="menu_search_button"><img src="{{ URL::asset('front/images/search.png') }}" alt=""></button>
		</form>
	</div>
	<!-- Navigation -->
	<div class="menu_nav">
		<ul>
            @foreach(App\Category::all() as $item)
			    <li><a href="/category/{{ $item->id }}">{{ $item->label }}</a></li>
            @endforeach
		</ul>
	</div>
	<!-- Contact Info -->
	<div class="menu_contact">
		<div class="menu_phone d-flex flex-row align-items-center justify-content-start">
			<div><div><img src="{{ URL::asset('front/images/phone.svg') }}" alt="https://www.flaticon.com/authors/freepik"></div></div>
			<div>+234 7050000000</div>
		</div>
	</div>
</div>

<div class="super_container">

	<!-- Header -->
        @include('includes.user.header')
    <!-- End Header -->


	<div class="super_container_inner">
        <div class="super_overlay"></div>

        @include('includes.admin.messages')

        @yield('content')


		<!-- Footer -->
        @include('includes.user.footer')
		<!-- End Footer -->
	</div>

</div>

<script src="{{ URL::asset('front/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ URL::asset('front/styles/bootstrap-4.1.2/popper.js') }}"></script>
<script src="{{ URL::asset('front/styles/bootstrap-4.1.2/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('front/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ URL::asset('front/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ URL::asset('front/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ URL::asset('front/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ URL::asset('front/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ URL::asset('front/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ URL::asset('front/plugins/easing/easing.js') }}"></script>
<script src="{{ URL::asset('front/plugins/progressbar/progressbar.min.js') }}"></script>
<script src="{{ URL::asset('front/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ URL::asset('front/js/custom.js') }}"></script>
</body>
</html>
