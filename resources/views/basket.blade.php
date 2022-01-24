@extends('layouts.base')
@section('title', 'Корзина')

@section('content')
    @if($order)
        <h1>Корзина</h1>
        <div class="custom_basket">
            <div class="basket-items">
                @foreach ($order->products as $product)
                    <div class="basket-item">
                        <div class="image">
                            <img src="{{$product->image}}" alt="{{$product->name}}">
                        </div>
                        <div class="name">
                            <a href="/{{$product->category->code}}/{{$product->code}}/">{{$product->name}}</a>
                        </div>
                        <div class="price">
                            {{$product->price}}
                        </div>
                        <div class="total_price">
                            {{$product->priceForCount()}}
                        </div>
                        <div class="count">
                            <form method="post" action="{{route('basket-remove', [$product->id])}}">
                                <button class="remove btn" type="submit">-</button>
                                @csrf
                            </form>
                            <div class="value">{{$product->pivot->count}}</div>
                            <form method="post" action="{{route('basket-add', [$product->id])}}">
                                <button class="add btn" type="submit">+</button>
                                @csrf
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="total-price">Общая сумма заказа: {{$order->totalPrice()}}</div>
        </div>
        <a class="purchase_btn custom-btn btn" href="{{ route('basket-place') }}">Оформить заказ</a>
    @else
        Корзина пустая
    @endif




@endsection
