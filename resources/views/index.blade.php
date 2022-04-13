@extends('layouts/base')
@section('title', 'Главная')

@section('content')
            <div class="category-slider">
                @foreach($categories as $category)

                <div class="slider-item ">
                    <a href="">
                        <div class="left">
                            <div class="title">
                                {{$category->name}}
                            </div>
                            <div class="description">
                                {{$category->description}}
                            </div>
                            <a class="btn btn-primary" href="{{route('catalog', $category->code)}}">Посмотреть</a>
                        </div>
                        <div class="right">
                            <img src="{{$category->image}}" alt="">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
@endsection
