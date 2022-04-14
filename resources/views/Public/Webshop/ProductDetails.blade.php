@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- ChoseUs Section Begin -->
    <section class="choseus-section spad">
        <div class="container">
            @if(session()->has('success'))
                <div class="cartSuccess alert alert-success ">
                    {{ session()->get('success') }}
                </div> 
            @endif
            <div class="row" style="margin-bottom:50px;">
                <div class="breadcrumb-text breadcrumb-textV2 ml-3">
                    <div class="bt-option">
                        @foreach (array_reverse($product->getProductCategory($product->category_id) ) as $parent)
                            <a style="font-size: 13px; !important" href="{{route("products")}}/kategoriak/{{$parent['id']}}">{{$parent["name"]}}</a>
                        @endforeach
                        <span style="font-size: 13px;">{{$product->name}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($product->getProductImages($product->id) as $image)
                                @if ($image->sorrend == 1 )
                                    <li data-target="#carouselExampleIndicators" class="active" data-slide-to="0"></li>
                                @else
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$image->sorrend - 1}}"></li>
                                @endif
                            @endforeach
                        </ol>
                        <div class="carousel-inner ">
                          @foreach ($product->getProductImages($product->id) as $image)
                            @if ($image->sorrend == 1 )
                                <div class="carousel-item active">
                            @else
                                <div class="carousel-item">
                            @endif
                                    <img class="d-block w-100 productImage" src="{{ $image->image }}" alt="{{$image->sorrend}}. kép">
                                </div>
                          @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Előző</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Követekező</span>
                        </a>
                      </div>
                </div>
                <div class="col-lg-7 productInfo">
                    <h5>{{$product->name}}</h5>
                    <div class="productDescription">
                        <p>{{$product->description}}</p>
                    </div><br>
                    <div class="price">
                        <div class="row">
                            <div class="col-12 col-md-6 text-left">
                                @if ($product->discount_price)
                                    <p class="productListPriceIfDiscount">Teljes ár: {{number_format($product->list_price, 0, ',', ' ' )}} Ft</p>
                                    <h5 class="productListPrice">Akciós ár: &nbsp;{{number_format($product->discount_price, 0, ',', ' ' )}} Ft</h5>
                                @else
                                    <h5>{{number_format($product->list_price, 0, ',', ' ' )}} Ft</h5>
                                @endif
                            </div>
                            <div class="col-12 col-md-6 text-right">
                                <div class="text-left">
                                    @if ($product->quantity > 0)
                                        <p class="text-right" style="color:green;">Készleten</p>
                                    @else
                                        <p class="text-right" style="color:red;">Nincs készleten</p>
                                    @endif
                                    <p class="text-right" style="font-size: 12px;">Szállítási költség 790 Ft-tól*<br>
                                    </p>
                                    <p class="text-right" style="font-size: 10px;">*15 000 Ft feletti rendelelés esetén INGYENES a kiszállítás!</p>
                                </div>
                                <form action="{{ route('addToCart') }}" method="get">
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <label for ="quantity" style="color: #fff; margin-right: 5px; top: 20px;">Mennyiség:</label>
                                    <input type ="number" class="quantity" name="quantity"  value="1" min=1>
                                    @if ($product->quantity > 0)
                                        <button type="submit" class="btn add_to_cart-btn text-center" title="Hozzáadás a kosárhoz">
                                            <i class="fa fa-cart-plus" style="font-size:25px;"> </i> KOSÁRBA
                                        </button>
                                    @else
                                        <button type="submit" class="btn add_to_cart-btn text-center" title="Hozzáadás a kosárhoz" disabled>
                                            <i class="fa fa-cart-plus" style="font-size:25px;"> </i> KOSÁRBA
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->
@endsection
@section('scripts')
    <script>
        $( document ).ready(function() {
            $('.carousel').carousel('pause');
        });
    </script>
@endsection