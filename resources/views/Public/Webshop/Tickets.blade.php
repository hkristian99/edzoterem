@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Bérletek</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <a href="{{route("products")}}">Webshop</a>
                            <span>Bérletek</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Pricing Section Begin -->
    <section class="pricing-section service-pricing spad" id="berletek" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Bérletek és napijegyek</span>
                        <h2>Válassz az elérhetők jegyek közül</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($tickets as $ticket)
                <div class="col-lg-3">
                    <div class="ps-itemV2">
                        <h3>{{$ticket["name"]}}</h3>
                        <div class="pi-price">
                            <h2>{{number_format($ticket["list_price"], 0, ',', ' ' )}} Ft</h2>
                            <span>{{ $ticket["title"] }}</span>
                        </div>
                        <ul>
                            {!! $ticket["description"] !!}
                        </ul>
                        <a href="{{route("personalInfoTicket",$ticket["id"])}}" class="primary-btn pricing-btn">Megveszem</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Pricing Section End -->
@endsection