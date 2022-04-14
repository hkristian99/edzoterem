@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Köszönjük a vásárlást</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <a href="{{route("cart")}}">Kosár</a>
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
            <div class="row">
                <div class="col text-center">
                    <h4>A megrendelést rögízettük, részleteiről e-mail-t küldtünk Önnek a(z) "{{$email}}" címre!</h4> <br>
                    <div>
                        <ul style="list-style: none;">
                            <li><p class="col text-center">Rendelési azonosító: {{$order->id}} </p></li>
                            <li><p class="col text-center">Rendelési státusza: {{$order->getOrderStatus($order->order_status_id)}}</p></li>
                            <li><p class="col text-center">Rendelés dátuma: {{$order->created_at}}</p></li>
                        </ul>
                    </div>
                    <br><br><h4>+36 20 366 7894</h4><br>
                    <p class="col text-center" >Az alábbi telefonszámon tud érdeklődni rendelése felől.</p><br>
                </div>
                
            </div>
            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-orange"><i class="fa fa-angle-left"></i>Vissza a főoldal</a>
            </div>
        </div>
    </section>
    <!-- All Section End -->
@endsection
@section('scripts')
    <script>
    </script>
@endsection