@extends('layouts/base')
@section('title', 'Главная')

@section('content')
{{--            <div class="category-slider">--}}
{{--                @foreach($categories as $category)--}}

{{--                <div class="slider-item ">--}}
{{--                    <a href="">--}}
{{--                        <div class="left">--}}
{{--                            <div class="title">--}}
{{--                                {{$category->name}}--}}
{{--                            </div>--}}
{{--                            <div class="description">--}}
{{--                                {{$category->description}}--}}
{{--                            </div>--}}
{{--                            <a class="btn btn-primary" href="{{route('catalog', $category->code)}}">Посмотреть</a>--}}
{{--                        </div>--}}
{{--                        <div class="right">--}}
{{--                            <img src="{{$category->image}}" alt="">--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Новинки</h3>
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
