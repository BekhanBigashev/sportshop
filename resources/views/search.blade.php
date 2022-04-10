@extends('layouts/base')
@section('title', 'Поиск')

@section('content')

    <h1>Результаты поиска</h1>
    <div class="products">

            @foreach($products as $product)
                @include('includes/catalog-item')
            @endforeach

    </div>
    <div class="pagination-container">
        {{$products->links()}}
    </div>
@endsection
