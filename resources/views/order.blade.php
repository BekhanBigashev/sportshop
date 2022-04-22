@extends('layouts.base')
@section('title', 'Оформление заказа')

@section('content')
    <form action="{{route('basket-confirm')}}" method="POST">
        @csrf
    <div class="col-md-7">



        <!-- Billing Details -->
        <div class="billing-details">
            <div class="section-title">
                <h3 class="title">Оформление заказа</h3>
            </div>
            @if ($errors->any())
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <input @auth value="{{Auth::user()->name}}" @endauth required class="input" type="text" name="name" placeholder="Имя и Фамилия">
            </div>
<!--            <div class="form-group">
                <input class="input" type="text" name="last-name" placeholder="Last Name">
            </div>-->
            <div class="form-group">
                <input @auth value="{{Auth::user()->email}}" @endauth required class="input" type="email" name="email" placeholder="Email">
            </div>
<!--            <div class="form-group">
                <input class="input" type="text" name="address" placeholder="Address">
            </div>-->
<!--            <div class="form-group">
                <input class="input" type="text" name="city" placeholder="City">
            </div>-->
<!--            <div class="form-group">
                <input class="input" type="text" name="country" placeholder="Country">
            </div>-->
<!--            <div class="form-group">
                <input class="input" type="text" name="zip-code" placeholder="ZIP Code">
            </div>-->
            <div class="form-group">
                <input @auth value="{{Auth::user()->phone}}" @endauth required class="input" type="tel" name="phone" placeholder="Телефон">
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
                <select name="delivery_point_id" class="input">
                    <option value="">Не выбрано</option>
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
                <input type="text" name="adress" class="input">
            </div>

        </div>
        <!-- /Billing Details -->


        <!-- Order notes -->
        <div class="order-notes">
            <textarea name="comment" class="input" placeholder="Комментарий к заказу"></textarea>
        </div>
        <!-- /Order notes -->
    </div>

    <!-- Order Details -->
    <div class="col-md-5 order-details">
        <div class="section-title text-center">
            <h3 class="title">Ваш заказ</h3>
        </div>
        <div class="order-summary">
            <div class="order-col">
                <div><strong>Товар</strong></div>
                <div><strong>Сумма</strong></div>
            </div>
            <div class="order-products">
                @foreach ($order->products as $product)
                <div class="order-col">
                    <div>{{$product->pivot->count}} x {{$product->name}}</div>
                    <div>{{$product->price}} тг</div>
                </div>
                @endforeach
            </div>

            <div class="order-col">
                <div><strong>ВСЕГО</strong></div>
                <div><strong class="order-total">{{ $order->totalPrice() }} тенге</strong></div>
            </div>
        </div>

        <button type="submit" class="primary-btn order-submit">Оформить</button>

    </div>
    <!-- /Order Details -->
    </form>

    <!-- /row -->
@endsection
