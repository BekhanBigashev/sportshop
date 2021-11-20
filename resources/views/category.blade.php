@extends('layouts/base')
@section('title', 'Категории')

@section('content')

{{$category->name}}

<div class="row">
    @foreach ($category->products as $product)
        @include('includes/product_card')
    @endforeach
</div>
@endsection
