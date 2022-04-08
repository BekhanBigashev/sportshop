@extends('layouts/base')
@section('title', $product->name)

@section('content')
    <h1>{{$product->name}}</h1>
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
                        <h3 class="product-price">{{$product->price}} KZT
{{--                            <del class="product-old-price">$990.00</del>--}}
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
                            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>В корзину</button>
                        </form>

                    </div>

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> В желаемое</a></li>
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
                        <li class="active"><a data-toggle="tab" href="#tab1">Описание</a></li>

                        <li><a data-toggle="tab" href="#tab3">Отзывы ({{$product->reviewsCount()}})</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->

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
<!--                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum">3</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <span class="sum">2</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                        </ul>-->
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
{{--                                            <li>--}}
{{--                                                <div class="review-heading">--}}
{{--                                                    <h5 class="name">John</h5>--}}
{{--                                                    <p class="date">27 DEC 2018, 8:0 PM</p>--}}
{{--                                                    <div class="review-rating">--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star-o empty"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="review-body">--}}
{{--                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <div class="review-heading">--}}
{{--                                                    <h5 class="name">John</h5>--}}
{{--                                                    <p class="date">27 DEC 2018, 8:0 PM</p>--}}
{{--                                                    <div class="review-rating">--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                        <i class="fa fa-star-o empty"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="review-body">--}}
{{--                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
                                        </ul>
<!--                                        <ul class="reviews-pagination">
                                            <li class="active">1</li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>-->
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <form method="post" action="{{route('review.add', $product->id)}}" class="review-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">


                                            <input @auth value="{{$user->name}}"@endauth name="name" class="input" type="text" placeholder="Ваше имя">
                                            @guest

                                            <input name="email" class="input" type="email" placeholder="Ваш E-mail">
                                            @endguest
                                            <textarea name="text" class="input" placeholder="Ваш отзыв"></textarea>
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
