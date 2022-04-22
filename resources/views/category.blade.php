@extends('layouts/base')
@section('title', 'Категорииs')
@section('page-title', $category->name)
@section('content')


    @if($category->parent_id != 0)
    <div class="row">
        @foreach ($category->products as $product)
            @include('includes/catalog_item')
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
