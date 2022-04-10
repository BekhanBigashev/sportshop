@extends('layouts.base')
@section('title', 'Оформление заказа')

@section('content')

    <h2>Оформление заказа</h2>
        <div class="row justify-content-center">

            <form action="{{ route('basket-confirm') }}" method="POST" class="col-lg-4">
                        <div class="form-group">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label for="name" class="control-label">Имя: </label>
                            <div class="">
                                <input type="text" name="name" id="name" @auth value="{{Auth::user()->name}}" @endauth class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label for="phone" class="control-label">Телефон: </label>
                            <div class="">
                                <input type="text" name="phone" id="phone" @auth value="{{Auth::user()->phone}}" @endauth class="form-control">
                            </div>
                        </div>

                            <div class="form-group">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <label for="name" class="control-label">E-mail: </label>
                                <div class="">
                                    <input type="text" name="email" id="email" @auth value="{{Auth::user()->email}}" @endauth class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="control-label">Способ оплаты: </label>
                                <div class="">
                                    <select name="payMethod" id="payMethod"  class="form-control" >
                                        <option value="">Наличными</option>
                                        <option value="">Kaspi</option>
                                        <option value="">CloudPayments</option>
                                    </select>

                                </div>
                            </div>
                    @csrf
                    <input type="submit" class="btn custom-btn" value="Подтвердить заказ">
            </form>
            <div class="order-data col-lg-8">
                <h4>Данные:</h4>
                <div class="products">
                    @foreach ($order->products as $product)
                        <div class="item">
                             <a href="{{route('product', [$product->category->code, $product->code])}}">{{$loop->iteration}}. {{$product->name}}</a> : <p class="product-count">{{$product->pivot->count}} шт</p>
                        </div>

                    @endforeach
                </div>
                <br>
                <p class="total">Общая сумма: {{ $order->totalPrice() }} тенге</p>
            </div>
            <iframe frameborder="0" style="border:none;width:NaNpx;height:70px;" width="NaN" height="70" src="https://music.yandex.kz/iframe/#track/47444193/6443928">Слушайте <a href='https://music.yandex.kz/album/6443928/track/47444193'>Сен келерсің</a> — <a href='https://music.yandex.kz/artist/6687186'>МузАрт</a> на Яндекс.Музыке</iframe>
    </div>
@endsection
