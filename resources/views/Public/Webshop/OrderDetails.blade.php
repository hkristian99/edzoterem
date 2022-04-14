@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Rendelés részletei</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <a href="{{route("cart")}}">Kosár</a>
                            <a href="{{route("personalInfo")}}">Személyes adatok</a>
                            <span>Rendelés részletei</span>
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
            @if ($errors->any() )
                <div class="alert alert-danger">   
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach 
                </div>
            @endif
            <div class="row">
                <div class="col text-center">
                    <h4>Köszönjük a vásárlást. A megrendelést az alábbi részletekkel rögízettük.</h4>
                </div>
            </div>
            <br><br><br><br>
            <div class="row">
                <div class="col-12">
                    <table id="cart" class="table cartTable">
                        <tbody>
                            <tr class="text-center caption">
                                <th colspan="2"style="width:35%">Terméklista:</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <ul class="products">
                                        @foreach($order_items as $order_item)
                                        <li>
                                            <div class="row">
                                                <div class="col-sm-3 hidden-xs">
                                                    <img src="{{ $order_item->getFirstImage($order_item->product_id) }}" width="50" height="50" class="img-responsive productImageCart"/>
                                                </div>
                                                <div class="col-sm-9">
                                                    {{$order_item->product->name }}
                                                    <div class="productData">
                                                        <p >{{ number_format($order_item->price, 0, ',', ' ' ) }} Ft
                                                        x {{ $order_item->quantity }} = {{ number_format( $order_item->amount, 0, ',', ' ' ) }} Ft
                                                        </p> 
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr class="text-center caption" >
                                <th colspan="2"> <h4>Összesen: {{ number_format($order->grandtotal, 0, ',', ' ' ) }} Ft</h4></th>
                            </tr>
                            <tr class="text-center caption">
                                <th style="width:32.5%">Szállítási adatok:</th>
                                <th style="width:32.5%">Számlázási adatok:</th>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="shippingDATA products">
                                        <li> Név: 
                                            <p>{{$shippingData["name"]}}</p>
                                        </li>
                                        <li> Cím: 
                                            <p>{{$shippingData["postcode"]}} {{$shippingData["city"]}}, {{$shippingData["street"]}}</p>
                                        <li> Telefonszám: 
                                            <p>{{$shippingData["phone"]}} </p>
                                        </li>
                                        @if ($shippingData["note"] )
                                        <li> Megjegyzés: 
                                            <p>{{$shippingData["note"]}}</p> 
                                        </li>
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    <ul class="billingDATA products">
                                        @if ($shippingData["tax_number"] != null)
                                            <li> Számlatípus: 
                                                <p>Cég</p>
                                            </li>
                                            <li> Adószám: {{$shippingData["tax_number"]}}</li>
                                        @else
                                            <li> Számlatípus: 
                                                <p>Magánszemély</p>
                                            </li>
                                        @endif
                                        <li> Név: 
                                            <p>{{$billingData["name"]}}</p>
                                        </li>
                                        <li> Cím: 
                                            <p>{{$shippingData["country_id"]}}</p>
                                            <p>{{$shippingData["postcode"]}} {{$shippingData["city"]}}, {{$shippingData["street"]}}</p>
                                        </li>
                                        @if ($order->tranzaction_id)
                                            <li> SimplePay tranzakciós azonosító: 
                                                <p>{{$order->tranzaction_id}}</p>
                                            </li>
                                        @endif
                                        
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="text-right">
                @if ( !Auth::check() )
                    <a href="{{ route('myOrders') }}" class="btn btn-orange"><i class="fa fa-angle-left"></i> Eddigi rendeléseim</a>
                @endif
                <a href="/" class="btn btn-white">Főoldal</a>
            </div>
        </div>
    </section>
    <!-- All Section End -->
@endsection
@section('scripts')
    <script>

    </script>
@endsection