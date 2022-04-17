<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>@yield('title')</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="/css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="/css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="/css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="/css/font-awesome.min.css">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="/css/style.css"/>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <link href="/css/toast.min.css" rel="stylesheet">
        <script src="/js/toast.min.js"></script>

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone phone"></i>8 707 382 64 25</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> sportshop@info.kz</a></li>
						<li><a href="#"><i class="fa fa-map-marker map-marker"></i> Abay 1/2</a></li>
					</ul>
					<ul class="header-links pull-right">

                        @guest
                            <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i>Регистрация</a></li>
                            <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i>Войти</a></li>
                        @endguest
                        @auth
                                <li><a href="{{ route('home') }}"><i class="fa fa-user-o"></i>{{ $user->name  }}</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-user-o"></i> Выйти</a></li>
                        @endauth

					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{route('index')}}" class="logo">
									SPORTSHOP
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{route('search')}}" method="get">
									<input value="{{request('query')}}" id="search-input" name="query" class="input" placeholder="">
									<button type="submit" class="search-btn">Поиск</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">

								@include('includes/header-basket')

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
        @if(session()->has('success'))
            <div class="header-alerts message-success">
                <div class="container">
                    {{session()->get('success')}}
                </div>
            </div>

        @endif
        @if(session()->has('warning'))
            <div class="header-alerts message-warning">
                <div class="container">
                    {{session()->get('warning')}}
                </div>
            </div>
        @endif
        @if(session()->has('notice'))
            <div class="header-alerts message-notice">
                <div class="container">
                    {{session()->get('notice')}}
                </div>
            </div>
        @endif
		<!-- NAVIGATION -->
        <nav id="navigation">

			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
                    <li><a href="{{route('index')}}">Главная</a></li>
                    <li><a href="{{route('categories')}}">Каталог</a></li>
                     @foreach ($categories as $category)
                    <li><a href="{{route('catalog', $category->code)}}">{{$category->name}}</a>
                    </li>
                    @endforeach

					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
		<div class="section">
			<div class="container">
			<div class="row">
			@yield('content')
			</div></div></div>
        <!-- NEWSLETTER -->
        <div id="newsletter" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="newsletter">
                            <p>Подпишитесь на <strong>Рассылку</strong></p>
                            <form>
                                <input class="input" type="email" placeholder="Введите E-mail">
                                <button class="newsletter-btn"><i class="fa fa-envelope"></i> Подписаться</button>
                            </form>
                            <ul class="newsletter-follow">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /NEWSLETTER -->
    <footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-9 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">О нас </h3>
								<p>Интернет магазин спортивной одежды</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>Qostanay Abay avenue</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>87777777777</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->

		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/slick.min.js"></script>
		<script src="/js/nouislider.min.js"></script>
		<script src="/js/jquery.zoom.min.js"></script>
		<script src="/js/main.js"></script>

	</body>
</html>


