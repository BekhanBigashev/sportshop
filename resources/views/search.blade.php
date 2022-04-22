@extends('layouts/base')
@section('title', 'Поиск')
@section('page-title', 'Результаты поиска')
@section('content')

    <div class="products">

            @foreach($products as $product)
            <div class="col-md-3 col-xs-6">
                @include('includes/catalog-item')
            </div>
            @endforeach

    </div>
    <div class="pagination-container">
        {{$products->links()}}
    </div>
@endsection
