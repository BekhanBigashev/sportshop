<!-- Cart -->
<div class="header-basket dropdown">
    <a href="{{ route('basket') }}" >
        <i class="fa fa-shopping-cart"></i>

        @if ($order)
            <span>{{$order->totalPrice()}} тг</span>
        @else
            <span>Корзина</span>
        @endif

        @if($order)
            <div id="basket-count">{{$order->TotalCountOfProducts()}}</div>
        @endif

    </a>
</div>
<!-- /Cart -->
