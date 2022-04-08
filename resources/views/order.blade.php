@extends('layouts.base')
@section('title', 'Оформление заказа')

@section('content')
    <h1>Оформление заказа</h1>
    <div class="container">
        <div class="row justify-content-center">

            <form action="{{ route('basket-confirm') }}" method="POST">
                <div>

                    <div class="order-data">
                        <p>Данные:</p>
                        <div class="products">
                            @foreach ($order->products as $product)
                                <div class="item">
                                    {{$product->name}} : {{$product->pivot->count}} шт
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <p>Общая сумма: {{ $order->totalPrice() }}</p>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" @auth disabled value="{{Auth::user()->name}}" @endauth class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Телефон: </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" @auth disabled value="{{Auth::user()->phone}}" @endauth class="form-control">
                            </div>
                        </div>


                            <br>
                            <br>
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">E-mail: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="email" id="email" @auth disabled value="{{Auth::user()->email}}" @endauth class="form-control">
                                </div>
                            </div>

                        <br>
                        <br>
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">Способ оплаты: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="payMethod" id="payMethod" value="" class="form-control">
                                </div>
                            </div>
                    </div>
                    <br>
                    @csrf
                    <input type="submit" class="btn btn-success" value="Подтвердить заказ">
                </div>
            </form>
        </div>
    </div>
@endsection
