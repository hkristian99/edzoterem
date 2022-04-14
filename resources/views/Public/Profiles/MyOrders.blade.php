@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Rendeléseim</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <a href="{{route("profile")}}">Profil</a>
                            <span>Rendeléseim</span>
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
            <div class="row text-center">
                <div col="col-5">
                    <ul>
                        @foreach ($orders as $order)
                            <li><a href="{{route("orderDetails",$order->id)}}">{{ \Date::parse($order->created_at)->format("Y. F j") }} - {{ number_format($order->grandtotal, 0, ',', ' ' ) }} Ft   /{{$order->getOrderStatus($order->order_status_id)}}/</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- All Section End -->
@endsection
@section('scripts')
    <script>
    </script>
@endsection