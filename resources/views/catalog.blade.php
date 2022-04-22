@extends('layouts/base')
@section('title', 'Каталог - ' .$category->name)
@section('page-title', $category->name)
@section('content')

        <div class="catalog ">
            <div class="col-md-3">
                <div class="categories-and-filter">
                        <form method="GET">
                            <label>Сортировать по</label>
                            <label for=""></label>
                            <select class="form-control d-inline w-25 mr-4" name="sort" id="catalog-sort-select">
                                <option value="">Выберите</option>
                                <option value="price">цене</option>
                                <option value="name">Названию</option>
                            </select>
                            <label>Порядок</label>
                            <select class="form-control d-inline w-25 mr-4" name="order" id="catalog-order-select">
                                <option value="">Выберите</option>
                                <option value="asc">по возрастанию</option>
                                <option value="desc">По убыванию</option>
                            </select>
                            <br>
                            <input autocomplete="false" class="input" type="text" name="key" placeholder="Поиск по названию">
                            <button style="margin-top: 34px; " class="btn btn-primary" type="submit">Применить</button>
                            <button id="catalog-filter-clean"  style="margin-top: 34px; " class="btn" >Очистить</button>
                        </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tools">
                    <div class="sort">

                    </div>
                </div>
                <div class="row">
                    @if($products)
                        @foreach($products as $product)
                            <div class="col-md-3 col-xs-6">
                            @include('includes/catalog-item')
                            </div>
                        @endforeach
                    @else
                        @include('includes/products_not_found')
                    @endif
                </div>
                <!-- store bottom filter -->
                <div class="store-filter clearfix">
{{--                    <span class="store-qty">Showing 20-100 products</span>--}}
{{--                    <ul class="store-pagination">--}}
<!--                        <li class="active">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>-->

                            {{$products->links()}}

{{--                    </ul>--}}
                </div>
                <!-- /store bottom filter -->


            </div>
        </div>

@endsection
