@extends('layouts.base')
@section('title', 'Корзина')

@section('content')
    @if($order)
@foreach ($order->products as $product)
<div class="row">
    <div class="col-lg-3 col-sm-3 col-xs-12" style="height: 100px; line-height: 100px;">
    <img  src="{{$product->image}}" style="width: 116px; height: 80px;  " />
    </div>
    <div  class="col-lg-3 col-sm-3 col-xs-12 mob-fix" style="height: 100px; line-height: 100px;">
        {{$product->name}}
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 mob-fix" style="height: 100px; line-height: 100px;">
        {{$product->price}}
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 mob-fix" style="height: 100px; line-height: 100px;">
        {{$product->priceForCount($product->pivot->count)}}
    </div>
    <div class="col-lg-1 col-sm-2 col-xs-12 mob-fix" style="height: 100px; line-height: 100px;">
        {{$product->pivot->count}}
    </div>
    <form method="post" action="{{route('basket-add', [$product->id])}}">
        <button class="btn btn-add" type="submit">Добавить</button>
        @csrf
    </form>
    <form method="post" action="{{route('basket-remove', [$product->id])}}">
        <button class="btn btn-delete" type="submit">Удалить</button>
        @csrf
    </form>
  </div>
    <div class="btn btn-add begin_purchase">
        <a href="{{ route('basket-place') }}">Оформить заказ</a>
    </div>
  @endforeach

<div class="total-price">{{$order->totalPrice()}}</div>
    @else
        Корзина пустая
    @endif
@endsection
