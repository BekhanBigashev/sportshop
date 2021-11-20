@extends('layouts/base')
@section('title', 'Категории')

@section('content')
<div class="section">
    <!-- container -->
    <div class="container">

    <div class="content">
<div class="row">
    @foreach ($categories as $category)
    <!-- shop -->
    <div class="col-md-4 col-xs-6">
        <div class="shop">
            <div class="shop-img">
                <img src="{{ $category->image}}" alt="">
            </div>
            <div class="shop-body">
                <h3>{{ $category->name}}</h3>
                <a href="{{route('category', $category->code)}}" class="cta-btn">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- /shop -->
    @endforeach
</div>
</div>
</div>
</div>
@endsection