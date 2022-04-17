
<!-- product -->
<div class="col-md-4 col-xs-6">
    <div class="product">
        <div class="product-img">
            <img src="/{{$product->image}}" alt="">
{{--            <div class="product-label">--}}
{{--                <span class="sale">-30%</span>--}}
{{--                <span class="new">NEW</span>--}}
{{--            </div>--}}
        </div>
        <div class="product-body">
            <p class="product-category">{{$product->category->name}}</p>
            <h3 class="product-name"><a href="{{route('product', [$product->category->code, $product->id])}}">{{$product->name}}</a></h3>
            <h4 class="product-price">{{$product->price}} тг
{{--                <del class="product-old-price">$990.00</del>--}}
            </h4>
            <div class="product-rating">
                @for ($i = 0; $i < 5; $i++)
                    @if($i < $product->rating())
                        <i class="fa fa-star"></i>
                    @else
                        <i class="fa fa-star-o"></i>
                    @endif
                @endfor
            </div>
<!--            <div class="product-btns">
                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
            </div>-->
        </div>
        <div class="add-to-cart">
            <form method="post" action="{{route('basket-add', $product->id)}}">
                @csrf
                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>в корзину</button>
            </form>

        </div>
    </div>
</div>
<!-- /product -->
