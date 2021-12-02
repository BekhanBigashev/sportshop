<!-- product -->
<div class="col-md-4 col-xs-2">
    <div class="product">
        <div class="product-img">
            <img src="{{$product->image}}" alt="">
            <div class="product-label">
                <span class="sale">-30%</span>
                <span class="new">NEW</span>
            </div>
        </div>
        <div class="product-body">
            <p class="product-category">{{$product->category->name}}</p>
            <h3 class="product-name"><a href="{{route('product', [$product->category->code, $product->code ])}}/">{{$product->name}}</a></h3>
            <h4 class="product-price">{{$product->price}} <del class="product-old-price"></del></h4>
            <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>

        </div>
        <div class="add-to-cart">
            <form action="{{route('basket-add', $product)}}" method="post">
                <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> В корзину</button>
                @csrf
            </form>

        </div>
    </div>
</div>
<!-- /product -->
