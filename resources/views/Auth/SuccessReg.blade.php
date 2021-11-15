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

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 leave-comment text-center">
                        <h2 style="color:#fff;">Sikeres regisztráció!</h2><br>
                        <h3 style="color:#fff;">5<p>mp</p></h3>
                        <h3 style="color:#fff;">múlva átirányítunk a <a href="{{route('login')}}">bejelentkezés</a> lapra!</h3><br>
                    </div>
                </div>
            </div>
    </section>
    <!-- Contact Section End -->
    @endsection