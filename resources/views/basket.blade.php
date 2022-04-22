@extends('layouts.base')
@section('title', 'Корзина')
@section('page-title', 'Корзина')
@section('content')
    @if($order)
        <div class="custom_basket">
            <div class="basket-items">
                @foreach ($order->products as $product)
                    <div class="basket-item">
                        <div class="image">
                            <img src="/{{$product->image}}" alt="{{$product->name}}">
                        </div>
                        <div class="name">
                            <a href="{{route('product',[$product->category->code, $product->id])}}">{{$product->name}}</a>
                        </div>
                        <div class="price">
                            {{$product->price}} тг
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
                        <div class="total_price">
                            {{$product->priceForCount()}} тг
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="total-price">Общая сумма заказа: {{$order->totalPrice()}}</div>
            <a class="purchase_btn custom-btn btn" href="{{ route('basket-place') }}">Оформить заказ</a>
        </div>

    @else
        В корзине не товаров<br>
        <a class="btn btn-secondary" href="{{route('categories')}}">Перейти в каталог</a>
    @endif
  {{--  @if($order)
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Стоимость</th>
            <th>Кол-во</th>
        </tr>
        </thead>

        @foreach($order->products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="display: flex; justify-content: center"><img src="{{$product->image}}" alt=""></td>
                <td>
                    <a href="{{route('product',[$product->category->code, $product->id])}}">{{ $product->name }}</a>
                </td>
                <td>{{ number_format($product->price, 2, '.', '') }}</td>
                <td class="count-info" style="display: flex; justify-content: center">
                    <form class="minus-btn" method="post" action="{{route('basket-remove', [$product->id])}}">
                        @csrf
                        <button class="btn" type="submit">-</button>
                    </form>
                    <span class="count">{{ $product->pivot->count }}</span>
                    <form class="plus-btn" method="post" action="{{route('basket-add', [$product->id])}}">
                        @csrf
                        <button class="btn" type="submit">+</button>
                    </form>
                </td>
                <td>{{ number_format($product->priceForCount(), 2, '.', '') }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4" class="text-right">Итого</th>
            <th>{{ number_format($order->totalPrice(), 2, '.', '') }}</th>
        </tr>
    </table>
    <a class="purchase_btn custom-btn btn" href="{{ route('basket-place') }}">Оформить заказ</a>
    @else
        Корзина пустая<br>
        <a href="{{route('categories')}}">Перейти в каталог</a>
    @endif--}}




@endsection
