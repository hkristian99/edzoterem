@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Termékeink</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <span>Webshop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- All Section Begin -->
    <section class="pricing-section service-pricing spad" id="webshop">
        <div class="container" style="max-width: 1771px;">
            <div class="row">
                <div class="col text-right search">
                    <form class="login" action="">
                        <label style="color:#fff;">Keresés: </label>
                        <input type="text" id="search" class="input" name="search">
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row" style="padding-bottom: 28px;">
                <div class="col-lg-2 col-xs-12 text-center">
                    <h2 style="color:#fff; margin-bottom:20px;">Kategóriák</h2>
                </div>
                <div class="col-lg-6 col-xs-12 text-left text-sm-center breadcrumb-text breadcrumb-textV2">
                    <div class="bt-option">
                        @if($categoryId != "")
                        <a style="font-size: 13px; !important" href="{{route("products")}}">Kategóriák</a>
                        @if( !empty($parent) )
                            <a style="font-size: 13px; !important" href="{{route("products")}}/kategoriak/{{$parent->id}}">{{$parent->name}}</a>
                        @endif
                        <span style="font-size: 13px;" id="activeCategory" name="{{$cat->id}}">{{$cat->name}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 text-right">
                    {!! $products->links("/vendor/pagination/gym") !!}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 hidden-xs text-left">
                    <div class="product_sidebar">
                        <ul class="categories">
                        @foreach ($categories as $category)
                            <li class="category-item parent" id="category_{{ $category["id"] }}" onclick="window.location.href = '/termekek/kategoriak/{{$category['id']}}';">
                               -- {{ $category["name"] }} --
                            </li>
                            @if ( count($category["childs"])>0 )
                                @foreach ($category["childs"] as $child)
                                    <li class="category-item" id="category_{{$child->id}}" onclick="window.location.href = '/termekek/kategoriak/{{$child->id}}';">
                                        {{ $child->name }}
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12 hidden-xs mt-4 mt-lg-0">
                    <div class="row list">
                        @foreach ($products as $product)
                            <div class="col-lg-3">
                                <div class="ps-itemV2 product"  style="cursor:pointer;" onclick="document.location.href='{{ route('productDetails', $product->id) }}';">
                                    <img src="{{ $product->getFirstImage($product->id) }}">
                                    <h5>{{$product->name}}</h5>
                                    <div class="priceDIV">
                                        @if ($product->discount_price)
                                        <div class="row" style="justify-content: center;">
                                            <p class="productListPriceIfDiscount">{{number_format($product->list_price, 0, ',', ' ' )}} Ft</p>
                                        </div>
                                        <div class="row" style="justify-content: center;">
                                            <p class="listPrice">{{number_format($product->discount_price, 0, ',', ' ' )}} Ft /db</p>
                                        </div>
                                    @else
                                        <div class="row" style="margin-top: 65px; justify-content: center;">
                                            <p class="listPrice">{{number_format($product->list_price, 0, ',', ' ' )}} Ft /db</p>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col text-right">
                    {!! $products->links("/vendor/pagination/gym") !!}
                </div>
            </div>
        </div>
    </section>
    <!-- All Section End -->
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase().trim();
            var v = value.split("%");
            $(".list div").each(function(j,k) {
                var s = true;
                $.each(v, function(i, x) {
                if (s) {
                    s = $(k).text().toLowerCase().indexOf(x) > -1;
                }
                });
                $(this).toggle(s);
            });
        });
        $( document ).ready(function() {
            var $id = $("#activeCategory").attr('name');
            $("#category_" + $id).addClass("activeCategory");
        });

    </script>
@endsection