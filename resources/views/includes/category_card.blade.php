<!-- shop -->
<div class="col-md-4 col-xs-6">
    <div class="shop">
        <a href="{{route('catalog', $category->code)}}">
        <div class="shop-img">
            <img src="/{{ $category->image}}" alt="">
        </div>
        </a>
        <div class="shop-body">
            <a href="{{route('catalog', $category->code)}}"><h3>{{ $category->name}}</h3></a>
            <a href="{{route('catalog', $category->code)}}" class="cta-btn">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /shop -->
