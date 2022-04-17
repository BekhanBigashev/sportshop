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
                <input required class="input" type="text" name="name" placeholder="Имя и Фамилия">
            </div>
<!--            <div class="form-group">
                <input class="input" type="text" name="last-name" placeholder="Last Name">
            </div>-->
            <div class="form-group">
                <input required class="input" type="email" name="email" placeholder="Email">
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
                <input required class="input" type="tel" name="phone" placeholder="Телефон">
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
                <select name="delivery_point_id" class="input" >
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
                <input type="text" name="adress" class="input" >
            </div>
<!--            <div class="form-group">
                <div class="input-checkbox">
                    <input type="checkbox" id="create-account">
                    <label for="create-account">
                        <span></span>
                        Create Account?
                    </label>
                    <div class="caption">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                        <input class="input" type="password" name="password" placeholder="Enter Your Password">
                    </div>
                </div>
            </div>-->
        </div>
        <!-- /Billing Details -->

        <!-- Shiping Details -->
<!--        <div class="shiping-details">
            <div class="section-title">
                <h3 class="title">Shiping address</h3>
            </div>
            <div class="input-checkbox">
                <input type="checkbox" id="shiping-address">
                <label for="shiping-address">
                    <span></span>
                    Ship to a diffrent address?
                </label>
                <div class="caption">
                    <div class="form-group">
                        <input class="input" type="text" name="first-name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="last-name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input class="input" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="address" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="city" placeholder="City">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="country" placeholder="Country">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="zip-code" placeholder="ZIP Code">
                    </div>
                    <div class="form-group">
                        <input class="input" type="tel" name="tel" placeholder="Telephone">
                    </div>
                </div>
            </div>
        </div>-->
        <!-- /Shiping Details -->

        <!-- Order notes -->
        <div class="order-notes">
            <textarea class="input" placeholder="Комментарий к заказу"></textarea>
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
<!--        <div class="payment-method">
            <div class="input-radio">
                <input type="radio" name="payment" id="payment-1">
                <label for="payment-1">
                    <span></span>
                    Direct Bank Transfer
                </label>
                <div class="caption">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="input-radio">
                <input type="radio" name="payment" id="payment-2">
                <label for="payment-2">
                    <span></span>
                    Cheque Payment
                </label>
                <div class="caption">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="input-radio">
                <input type="radio" name="payment" id="payment-3">
                <label for="payment-3">
                    <span></span>
                    Paypal System
                </label>
                <div class="caption">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>-->
        <div class="input-checkbox">
            <input required type="checkbox" id="terms">
{{--            <label for="terms">--}}
{{--                <span></span>--}}
{{--                I've read and accept the <a href="#">terms & conditions</a>--}}
{{--            </label>--}}
        </div>
        <button type="submit" class="primary-btn order-submit">Оформить</button>
{{--        <a href="#" >Оформить</a>--}}
    </div>
    <!-- /Order Details -->
    </form>
    </div>
    <!-- /row -->
@endsection
