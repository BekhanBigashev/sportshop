@extends('layouts.base')
@section('title', 'Личный кабинет')
@section('content')

<div class="container">
    <div class="cabinet row">
        <div class="col-md-4 profile">
            <h3>Профиль</h3>
            <div class="card">
                <form onsubmit="updateUserData(event, this)">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="form-group"><label for="">Имя</label><input name="name" type="text" class="input" value="{{$user->name}}"></div>
                    <div class="form-group"><label for="">Телефон</label><input name="phone" type="text" class="input" value="{{$user->phone}}"></div>
                    <div class="form-group"><label for="">E-mail</label><input name="email" type="text" class="input" value="{{$user->email}}"></div>
                    <button type="submit">Обновить</button>
                </form>
<!--                <div class="info">Имя: <b></b></div>
                <div class="info">Телефон: <b></b></div>
                <div class="info">E-mail: <b></b></div>-->
            </div>
            <a style="margin-top: 20px" class="custom-btn btn logout" href="{{route('logout')}}">Выйти</a>
        </div>
        <div class="col-md-8">
            <div class="orders-title">
                <h3>Заказы</h3>
            </div>

            <div class="orders">
                @if(count($user->orders))

                @foreach($user->orders as $order)
                    <div data-order-id="{{$order->id}}" class="item {{$order->status == 0 ? 'uncheckout' : ''}}">

                        <div class="head">
                            <div class="order-number">
                                {{$order->status == 0 ? 'Неоформленный ' : ''}}Заказ №{{$order->id}}
                            </div>
                            @if ($order->status == 0)
                                <a onclick="continueCheckout({{$order->id}})" class="continue-checkout">Продолжить оформление</a>
                            @else
                                <a onclick="deleteOrder({{$order->id}})" class="delete-order">Удалить</a>
                            @endif
                             </div>
                        <div class="body row">

                            <div class="col-md-6">
                                <div class="delivery-type">
                                    @if($order->delivery == 'pickup')
                                        <b>Адрес пункта приема: </b>{{$order->getDeliveryPoint()->getFullName()}}
                                    @else
                                        <b>Адрес доставки: </b>{{$order->adress}}
                                    @endif
                                </div>
                                <div class="total">
                                    <b>Сумма: {{$order->totalPrice()}} тг</b>

                                </div>
                                <div class="comment"><b>Коментарий:</b><br>
                                    {{$order->comment}}
                                </div>
                            </div>
                            <div class="col-md-6">


                                <div class="order-products">
                                    <b>Состава заказа:</b>
                                    @foreach($order->products as $product)
                                        <div class="order-product">
                                            <a href="{{route('product', [$product->category->code, $product->id])}}">{{$product->name}}</a> X {{$product->pivot->count}} : <b>{{$product->priceForCount()}} тг</b>
                                        </div>

                                    @endforeach
                                </div>
                                <br>

                            </div>
                        </div>


                    </div>

                @endforeach
                @else
                    <div class="orders-not-found">
                        Заказов нет
                    </div>

                @endif
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
