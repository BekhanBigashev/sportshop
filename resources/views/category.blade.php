@extends('layouts/base')
@section('title', 'Категории')

@section('content')

<h1>{{$category->name}}</h1>
    @if($category->parent_id != 0)
    <div class="row">
        @foreach ($category->products as $product)
            @include('includes/product_card')
        @endforeach
    </div>
    @else
        <div class="row">
            @foreach ($category->childrens as $category)
                @include('includes/category_card')
            @endforeach
        </div>
    @endif

    @endsection
