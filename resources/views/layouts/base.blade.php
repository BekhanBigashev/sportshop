<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="/css/style.css"/>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i>8 707 382 64 25</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> sportshop@info.kz</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Abay 1/2</a></li>
					</ul>
					<ul class="header-links pull-right">

                        @guest
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
								<form>
									<select class="input-select">
										<option value="0"><a href=" {{ route('categories')}} ">Категории</a> </option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="">
									<button class="search-btn">Поиск</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">

								<!-- Cart -->
								<div class="dropdown">
									<a  class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Корзина</span>
                                        @if($order)
										<div class="qty">{{$order->TotalCountOfProducts()}}</div>
                                        @endif

									</a>
									<div class="cart-dropdown">
                                        @if($order)
										<div class="cart-list">


                                                @foreach($order->products as $product)
                                                    <div class="product-widget">
                                                        <div class="product-img">
                                                            <img src="/{{$product->image}}" alt="{{$product->name}}">
                                                        </div>
                                                        <div class="product-body">
                                                            <h3 class="product-name"><a href="{{route('product',[$product->category->code, $product->code])}}">{{$product->name}}</a></h3>
                                                            <h4 class="product-price"><span class="qty">{{$product->pivot->count}}x</span>{{$product->price}} KZT</h4>
                                                        </div>
                                                    </div>
                                                @endforeach



										</div>
										<div class="cart-summary">
											<h5>SUBTOTAL: {{$order->totalPrice()}} KZT</h5>
										</div>
                                        @else
                                            <div class="cart-summary">
                                                <h5>Корзина пуста</h5>
                                            </div>
                                        @endif
										<div class="cart-btns">
											<a href="{{ route('basket') }}">В корзину</a>
											<a href="{{ route('basket-place') }}">Оформить <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

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
                    <li><a href="{{route('category', $category->code)}}">{{$category->name}}</a>
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
			<div class="content">
			@yield('content')
			</div></div></div>
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


