@extends('layouts/base')
@section('title', 'Главная')

@section('content')

        <div class="d-flex catalog justify-content-between">
            <div class="col-md-3">
                <div class="categories-and-filter">
                    <div class="categories">
                        <ul>
                        @foreach($categories as $category)
                                <li class="parent-category">{{$category->name}}</li>
                                @if($category->childrens)
                                    @foreach($category->childrens as $children)
                                        <li><a class="children_category_link" href="?category={{$children->id}}">{{$children->name}}</a></li>
                                    @endforeach
                                @endif
                        @endforeach
                        </ul>
                    </div>
                    <div id="catalog-submit-button">
                        Применить
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products">
                    @if($products)
                        @foreach($products as $product)
                            <div class="item ">
                                <img src="{{$product->image}}" alt="">
                                <p class="item-name"><a href="{{route('product', [$product->category->code, $product->code ])}}/">{{$product->name}}</a></p>
                                <p class="item-price">{{$product->price}} тг</p>
                                <form style="display: flex;
                                    justify-content: center;" action="{{route('basket-add', $product)}}" method="post">
                                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> В корзину</button>
                                    @csrf
                                </form>
                            </div>
                        @endforeach
                    @else
                        @include('includes/products_not_found')
                    @endif
                </div>
            </div>
        </div>

@endsection
