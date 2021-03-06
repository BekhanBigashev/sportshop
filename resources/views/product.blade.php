@extends('layouts/base')
@section('title', $product->name)
@section('page-title', $product->name)
@section('content')

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-7">
                <div id="product-main-img" class="">
                    <img src="/{{$product->image}}" alt="" width=400px" style="border: 1px solid gray">
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{$product->name}}</h2>
                    <div>
{{--                        <a class="review-link" href="#">{{$product->reviewsCount()}} отзывов) | Оставить свой отзыв</a>--}}
                    </div>
                    <div>
                        <h3 class="product-price">{{$product->getPrice()}} тг
                            @if ($product->sale)
                            <del class="product-old-price">{{$product->price}} тг</del>
                                @endif
                        </h3>
{{--                        <span class="product-available">In Stock</span>--}}
                    </div>
                    <p>{{$product->description}}</p>

                    <div class="product-options">
{{--                        <label>--}}
{{--                            Размер--}}
{{--                            <select class="input-select">--}}
{{--                                <option value="0">X</option>--}}
{{--                            </select>--}}
{{--                        </label>--}}

                    </div>

                    <div class="add-to-cart">
<!--                        <div class="qty-label">
                            Кол-во
                            <div class="input-number">
                                <input type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>-->
                        <form method="post" action="{{route('basket-add', $product->id)}}">
                            @csrf
                            @if($product->existInBasket()) @else @endif
                            <button data-href="{{route('basket.ajax.add', $product->id)}}" type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>@if($product->existInBasket()) Добавить еще @else В корзину @endif</button>
                        </form>

                    </div>

                    <ul class="product-btns">
<!--                        <li><a href="#"><i class="fa fa-heart-o"></i> В желаемое</a></li>-->
                        {{--<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>--}}
                    </ul>

                    <ul class="product-links">
                        <li>Категория:</li>
                        <li><a href="/categories/{{$product->category->code}}/">{{$product->category->name}}</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Поделиться:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Похожие</a></li>
                        <li><a data-toggle="tab" href="#tab3">Отзывы ({{$product->reviewsCount()}})</a></li>

                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach(\App\Models\Product::getCollectionByIds($product->related()) as $related)
                                        <div class="col-md-3">
                                            @include('includes/catalog-item', ['product' => $related])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->


                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>{{$product->rating()}}</span>
                                            <div class="rating-stars">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if($i < $product->rating())
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            @foreach ($product->reviews as $review)
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">{{$review->name}}</h5>
                                                    <p class="date">{{$review->created_at}}</p>
                                                    <div class="review-rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if($i < $review->score)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o empty"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>{{$review->text}}</p>
                                                </div>
                                            </li>
                                            @endforeach

                                        </ul>

                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <form method="post" action="{{route('review.add', $product->id)}}" class="review-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">


                                            <input @auth value="{{$user->name}}" @endauth name="name" class="input" type="text" placeholder="Ваше имя">
{{--                                            @guest--}}

{{--                                            <input required name="email" class="input" type="email" placeholder="Ваш E-mail">--}}
{{--                                            @endguest--}}
                                            <textarea required name="text" class="input" placeholder="Ваш отзыв"></textarea>
                                            <div class="input-rating">
                                                <span>Ваша оценка: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="score" value="3">
                                            <button type="submit" class="primary-btn">Отправить</button>
                                        </form>
{{--                                        {{$product->countOfOrders()}}--}}
                                    </div>
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@endsection
