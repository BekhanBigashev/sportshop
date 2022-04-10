<div class="catalog-item">
    <a href="{{route('product', [$product->category->code, $product->id])}}"><img src="/{{$product->image}}" alt=""></a>
    <p class="item-name"><a href="{{route('product', [$product->category->code, $product->id ])}}/">{{$product->name}}</a></p>
    <p class="item-price">{{$product->price}} тг</p>
    <div class="product-rating">
        @for ($i = 0; $i < 5; $i++)
            @if($i < $product->rating())
                <i class="fa fa-star"></i>
            @else
                <i class="fa fa-star-o"></i>
            @endif
        @endfor
    </div>
</div>
