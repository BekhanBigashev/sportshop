@extends('layouts/base')
@section('title', 'Главная')

@section('content')

<!-- HOT DEAL SECTION -->
<!--<div id="hot-deal" class="section">

    &lt;!&ndash; container &ndash;&gt;
    <div class="container">
        &lt;!&ndash; row &ndash;&gt;
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 50% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
                </div>
            </div>
        </div>
        &lt;!&ndash; /row &ndash;&gt;
    </div>
    &lt;!&ndash; /container &ndash;&gt;
</div>-->
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->

<div class="section">
    <!-- container -->
    <div class="container">
        @if($recs)
            <div class="after_checkout">
                <h3>Вам также могут понравиться</h3>
                <div class="recommendations row">
                    @foreach($recs as $product)
                        <div class="col-md-3">
                            @include('includes/catalog-item')
                        </div>
                    @endforeach
                </div>
            </div>
    @endif
    <div class="category-slider">
                @foreach($categories as $category)

        <div class="slider-item ">
            <a href="">
                <div class="left">
                    <div class="title">
{{$category->name}}
            </div>
            <div class="description">
{{$category->description}}
            </div>
            <a class="btn btn-primary" href="{{route('catalog', $category->code)}}">Посмотреть</a>
                        </div>
                        <div class="right">
                            <img src="{{$category->image}}" alt="">
                        </div>
                    </a>
                </div>
                @endforeach
        </div>
        <h3>Новые товары на сайте</h3>
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
<!--                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                            <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                            <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                            <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                        </ul>
                    </div>-->
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <!-- product -->
                                @foreach ($newProducts as $product)
                                    @include('includes/catalog-item')
                                @endforeach
                                <!-- product -->
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
@endsection
