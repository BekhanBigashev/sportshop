<!-- Cart -->
<div class="header-basket dropdown">
    <a href="{{ route('basket') }}" >
        <i class="fa fa-shopping-cart"></i>
        <span>Корзина</span>
        @if($order)
            <div id="basket-count">{{$order->TotalCountOfProducts()}}</div>
        @endif

    </a>
</div>
<!-- /Cart -->
