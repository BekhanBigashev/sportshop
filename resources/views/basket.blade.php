@extends('layouts.base')
@section('title', 'Корзина')

@section('content')
    @if($order)

        <div class="custom_basket">
            <div class="basket-items">
                @foreach ($order->products as $product)
                    <div class="basket-item">
                        <div class="image">
                            <img src="{{$product->image}}" alt="{{$product->name}}">
                        </div>
                        <div class="name">
                            {{$product->name}}
                        </div>
                        <div class="price">
                            {{$product->price}}
                        </div>
                        <div class="total_price">
                            {{$order->totalPrice()}}
                        </div>
                        <div class="count">
                            <div class="detach">-</div>
                            <form method="post" action="{{route('basket-remove', [$product->id])}}">
                                <button  class="remove" type="submit">-</button>
                                @csrf
                            </form>
                            <div class="value">{{$product->pivot->count}}</div>
                            <form method="post" action="{{route('basket-add', [$product->id])}}">
                                <button class="add" type="submit">+</button>
                                @csrf
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
            <a href="{{ route('basket-place') }}">Оформить заказ</a>
        </div>
    @else
        Корзина пустая
    @endif




@endsection
