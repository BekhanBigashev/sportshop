<!-- NAVIGATION -->
<nav id="navigation">

    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">

                    <li class="dropdown" id="catalog"><a style="color:white" class="dropbtn">Каталог</a>
                        <div class="dropdown-content">

                                @foreach ($categories as $category)
                                <div class="dropdown-category">
                                    <div class="category-title"><a href="{{route('catalog', $category->code)}}"><b>{{$category->name}}</b></a></div>
                                    <ul>
                                        @foreach ($category->childrens as $children)
                                            <li class=""><a href="{{route('catalog', $children->code)}}">{{$children->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach


                        </div></li>



                @foreach ($categories as $category)
                    <li><a href="{{route('catalog', $category->code)}}">{{$category->name}}</a>
                    </li>
                @endforeach

            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
