@extends('layouts/base')
@section('title', 'Каталог - ' .$category->name)

@section('content')

        <div class="d-flex catalog justify-content-between">
            <div class="col-md-3">
                <div class="categories-and-filter">
                        <form method="GET">
                            <label>Сортировать по</label>
                            <label for=""></label>
                            <select class="form-control d-inline w-25 mr-4" name="sort" id="catalog-sort-select">
                                <option value="0">Выберите</option>
                                <option value="price">цене</option>
                                <option value="name">Названию</option>
                            </select>
                            <label>Порядок</label>
                            <select class="form-control d-inline w-25 mr-4" name="order" id="catalog-order-select">
                                <option>Выберите</option>
                                <option value="asc">по возрастанию</option>
                                <option value="desc">По убыванию</option>
                            </select>
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
                <div class="products">
                    @if($products)
                        @foreach($products as $product)
                            @include('includes/catalog-item')
                        @endforeach
                    @else
                        @include('includes/products_not_found')
                    @endif
                </div>
                <div class="pagination-container">
                    {{$products->links()}}
                </div>

            </div>
        </div>

@endsection
