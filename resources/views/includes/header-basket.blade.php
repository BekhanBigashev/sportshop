<!-- Cart -->
<div class="dropdown">
    <a href="{{ route('basket') }}" > <!--class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"-->
        <i class="fa fa-shopping-cart"></i>
        <span>Корзина</span>
        @if($order)
            <div id="basket-count">{{$order->TotalCountOfProducts()}}</div>
        @endif

    </a>
<!--    <div class="cart-dropdown">
        @if($order)
            <div class="cart-list">


                @foreach($order->products as $product)
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="/{{$product->image}}" alt="{{$product->name}}">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a href="{{route('product',[$product->category->code, $product->id])}}">{{$product->name}}</a></h3>
                            <h4 class="product-price"><span class="qty">{{$product->pivot->count}}</span>x {{$product->price}} KZT</h4>
                        </div>
                        <button onclick="removeCartItem(this, {{$product->id}})" class="delete"><i class="fa fa-close"></i></button>
                    </div>
                @endforeach



            </div>
            <div class="cart-summary">
                <h5>SUBTOTAL: {{$order->totalPrice()}} KZT</h5>
            </div>
            <div class="cart-btns">
                <a href="{{ route('basket') }}">В корзину</a>
                <a href="{{ route('basket-place') }}">Оформить <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        @else
            <div class="cart-summary">
                <h5>Корзина пустая</h5>
            </div>
        @endif

    </div>-->
</div>
<!-- /Cart -->
