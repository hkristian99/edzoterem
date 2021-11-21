@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section login set-bg set-bglogin" data-setbg="/assets/frontend/img/about-us.jpg">
        <div class="container">
            <div class="row loginForm">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <div class="row loginformDiv">
                            <div class="col-lg-5" style="padding;">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <h2 class="text-white text-center login" style="margin-top: 82px; margin-bottom:-16px;">Belépés</h2><br>
                                        <p class="text-white text-center" style="margin:0;">Add meg a bejelentkezéshez szükséges adataidat.</p>
                                    </div>
                                    <div class="col-lg-1 vl"></div>
                                </div>
                            </div>
                            <div class="col-lg-7 leave-comment" style=@if($errors->any()) {{"padding-top:0px !important"}} @else {{"padding-top: 50px;"}} @endif>
                                @if ($errors->any() )
                                    <div class="alert alert-danger">   
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach 
                                    </div>
                                @endif
                                @if( Session::has('success') )
                                    <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    </div>
                                @endif
                                <form id="i_recaptcha" name="login" class="login" action="{{route('loginAttempt')}}" method="POST">
                                    @csrf
                                    <input type="hidden" id="reCaptchaToken" name="reCaptchaToken" value="">
                                    <input class="input" name="email" value="{{old("email")}}" type="email" placeholder="E-mail cím"><br>
                                    <input class="input" name="password"type="password" placeholder="Jelszó"><br>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-5">
                                            <button type="submit" class="primary-btn g-recaptcha" data-sitekey="{{ env("G_RECAPTCHA_SITE_KEY") }}" data-callback='onSubmit'>Bejelentkezés</button>
                                        </div>
                                        <div class="col-lg-7 text-right">
                                            <a href="{{route("regist")}}" class="primary-btn btn-normal appoinment-btn reg">Regisztráció</a>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <hr>
                                        <div class="col text-right" style="margin-top:2%;">
                                            <a class="lostpw" href="{{route('lostPassword')}}">Elfelejtett jelszó</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-textlogin text-center">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>| Minden jog fenntartva <br> <a href="#">Adatkezelési tájékoztató</a></p>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div id="g-badge-newlocation"></div>
    @endsection
    @section("scripts")
    <script>
       jQuery(function($) {
            console.log("itt");
            var checkTimer = setInterval(function() {
                if($('.grecaptcha-badge').length > 0) {
                    $('.grecaptcha-badge').appendTo("#g-badge-newlocation");
                    clearInterval(checkTimer);
                }
            }, 50);
        });
    </script>
    <style>
        .gettouch-section{
            display:none;
        }
        .footer-section{
            display:none;
        }
    </style>
    @endsection