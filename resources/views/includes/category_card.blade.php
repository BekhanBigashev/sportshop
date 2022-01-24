<!-- shop -->
<div class="col-md-4 col-xs-6">
    <div class="shop">
        <div class="shop-img">
            <img src="/{{ $category->image}}" alt="">
        </div>
        <div class="shop-body">
            <h3>{{ $category->name}}</h3>
            <a href="{{route('category', $category->code)}}" class="cta-btn">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /shop -->
