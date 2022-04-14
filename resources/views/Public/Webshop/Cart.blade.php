@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Kosár</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <span>Kosár</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- All Section Begin -->
    <section class="pricing-section spad" id="webshop">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div> 
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div> 
            @endif
            @if (session('cart'))
                <div class="text-right" style="padding-right:10px; margin-bottom:10px;">
                    <a href="{{route("cartToEmpty")}}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Kosár kiürítése</a>
                </div>
                <form id="modifyProductQuantity" action="{{route("update_cart")}}" method="get">
                    <input type="hidden" id="productID" name="productID" value="">
                    <input type="hidden" id="productQuantity" name="productQuantity" value="">
                </form>
                <table id="cart" class="table cartTable table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th style="width:55%">Termék</th>
                            <th style="width:10%">Ár</th>
                            <th style="width:8%">Mennyiség</th>
                            <th style="width:22%" class="text-center">Részösszeg</th>
                            <th style="width:5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $details)
                            @if ($details["discount_price"] > 0)
                                <input type="hidden" name="total" value="{{$total += $details['discount_price'] * $details['quantity']}}">
                            @else
                                <input type="hidden" name="total" value="{{$total += $details['list_price'] * $details['quantity']}}">
                            @endif
                            <tr data-id="{{$id}}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 d-none d-md-block"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive productImageCart"/></div>
                                        <div class="col-sm-9 productName">
                                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                @if ($details["discount_price"] > 0)
                                    <td data-th="Price" style="min-width:100px;">
                                        <p class="productListPriceIfDiscount">{{ number_format($details['list_price'], 0, ',', ' ' ) }} Ft</p> 
                                        {{ number_format($details['discount_price'], 0, ',', ' ' ) }} Ft
                                    </td>
                                @else
                                    <td data-th="Price">{{ number_format($details['list_price'], 0, ',', ' ' ) }} Ft</td>
                                @endif
                                <td data-th="Quantity">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantityJS update-cart" />
                                </td>
                                @if ($details["discount_price"] > 0)
                                    <td data-th="Subtotal" class="text-center">{{ number_format( $details['discount_price'] * $details['quantity'], 0, ',', ' ' )}} Ft</td>
                                @else
                                    <td data-th="Subtotal" class="text-center">{{ number_format( $details['list_price'] * $details['quantity'], 0, ',', ' ' )}} Ft</td>
                                @endif
                                <td class="actions" data-th="">
                                    <a href="{{route("removeFromCart", $id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cartTable text-right">
                    <h3><strong>Összesen: {{ number_format($total, 0, ',', ' ' ) }} Ft</strong></h3>
                </div>
                <br>
                <div class="cartTable text-right">
                    <a href="{{ route('products') }}" class="btn btn-orange" style="margin-right: 0px;"><i class="fa fa-angle-left"></i> Vásárlás folytatása</a>
                    <a href="{{ route('personalInfo') }}" class="btn btn-white mt-2 mt-sm-0">Személyes adatok és fizetés</a>
                </div>
            @else
                <div class="emptyCart text-center">
                    <h5>A kosár üres!</h5>
                    <a href="{{ route('products') }}" class="btn btn-orange">Vásárlás folytatása</a>
                </div>
            @endif
        </div>
    </section>
    <!-- All Section End -->
@endsection
@section('scripts')
    <script>
     $(".update-cart").change(function (e) {
         let id = $(this).parents("tr").attr("data-id");
         let quantity = $(this).parents("tr").find(".quantityJS").val();

         $("#productID").val(id);
         $("#productQuantity").val(quantity);
         console.log(id, quantity);

        $("#modifyProductQuantity").submit();
    });
    </script>
@endsection