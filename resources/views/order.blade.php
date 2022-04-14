@extends('layouts.base')
@section('title', 'Оформление заказа')

@section('content')

    <h2>Оформление заказа</h2>
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('basket-confirm') }}" method="POST" class="col-lg-4  was-validated">
                        <div class="form-group">
<!--                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror-->
                            <label for="name" class="control-label">Имя: </label>
                            <div class="">
                                <input required  type="text" name="name" id="name" @auth value="{{Auth::user()->name}}" @endauth class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                      {{--      @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror--}}
                            <label for="phone" class="control-label">Телефон: </label>
                            <div class="">
                                <input required  type="text" name="phone" id="phone" @auth value="{{Auth::user()->phone}}" @endauth class="form-control">
                            </div>
                        </div>

                            <div class="form-group">
                               {{-- @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror--}}
                                <label for="name" class="control-label">E-mail: </label>
                                <div class="">
                                    <input required  type="text" name="email" id="email" @auth value="{{Auth::user()->email}}" @endauth class="form-control">
                                </div>
                            </div>
                            <div class="" style="display: flex; margin-bottom: 10px;">
                                <div class="form-check">
                                 {{--   @error('delivery')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror--}}
                                    <input required class="form-check-input" type="radio" name="delivery" value="delivery">
                                    <label class="control-label">Доставка </label>
                                </div>
                                <div style="margin-left: 10px;" class="form-check">
                                  {{--  @error('delivery')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror--}}
                                    <input required class="form-check-input" type="radio" name="delivery" value="pickup">
                                    <label class="control-label">Сымовывоз </label>
                                </div>
                            </div>


                            <div class="display-none form-group" id="deliveryPointSelect">

                                <label class="control-label">Точка доставки: </label>
                                @error('delivery_point_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <select name="delivery_point_id" class="form-control" >
                                    <option disabled value="">---</option>
                                    @foreach($deliveryPoints as $point)
                                    <option value="{{$point->id}}">{{$point->getFullName()}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="display-none form-group" id="adressInput">
                                @error('adress')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <label class="control-label">Адрес: </label>
                                <input type="text" name="adress" class="form-control" >
                            </div>
{{--                <div class="form-group">--}}
{{--                    <label class="control-label">Способ оплаты: </label>--}}
{{--                    <select required name="payMethod" id="payMethod"  class="form-control" >--}}
{{--                        <option value="">--</option>--}}
{{--                        <option value="1">Наличными</option>--}}
{{--                        <option value="2">Kaspi</option>--}}
{{--                        <option value="3">CloudPayments</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
                    @csrf
                    <input type="submit" class="btn custom-btn" value="Подтвердить заказ">
            </form>
            <div class="order-data col-lg-8">
                <div style="display: flex"><h4 style="margin-right: 5px;">Состав заказа</h4><a href="{{route('basket')}}" class="back_to_basket">Назад в корзину</a></div>

                <div class="products">
                    @foreach ($order->products as $product)
                        <div class="item">
                             <a href="{{route('product', [$product->category->code, $product->id])}}">{{$loop->iteration}}. {{$product->name}}</a> : <p class="product-count">{{$product->pivot->count}} шт</p>
                        </div>
                    @endforeach
                </div>

                <p class="total">Общая сумма: {{ $order->totalPrice() }} тенге</p>
            </div>
    </div>
@endsection
