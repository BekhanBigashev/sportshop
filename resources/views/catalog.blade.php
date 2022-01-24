@extends('layouts/base')
@section('title', 'Главная')

@section('content')
    <div class="container">
        <div class="row catalog">
            <div class="col-md-3">
                <div class="categories-and-filter">
                    <div class="categories">
                        <ul>
                        @foreach($categories as $category)
                                <li><a class="category-link" href="{{route('category', $category->code)}}/">{{$category->name}}</a></li>
                                @if($category->childrens)
                                    @foreach($category->childrens as $children)
                                        <li><a class="children_category_link" href="{{route('category', $children->code)}}/">{{$children->name}}</a></li>
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
                    @foreach($products as $product)
                        <div class="item ">
                            <img src="{{$product->image}}" alt="">
                            <hr>
                            <p class="item-name"><a href="">{{$product->name}}</a></p>
                            <p class="item-price">{{$product->price}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
