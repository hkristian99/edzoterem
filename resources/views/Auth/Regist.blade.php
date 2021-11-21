@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section regist set-bg set-bglogin" data-setbg="/assets/frontend/img/about-us.jpg">
        <div class="container">
            <div class="row loginForm">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <div class="row registformDiv" style=@if($errors->any()) {{"margin-bottom:120px !important"}} @else {{"margin-bottom: 250px;"}} @endif>
                            <div class="col-lg-5" style="padding;">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <h2 class="text-white text-center regist" style="margin-top: 148px;">Regisztráció</h2><br>
                                        <p class="text-white">Add meg a regisztáció*-hoz szükséges adataidat**.</p>
                                    </div>
                                    <div class="col-lg-1 vlRegist"></div>
                                </div>
                            </div>
                            <div class="col-lg-7 leave-comment">
                                @if ($errors->any() )
                                    <div class="alert alert-danger">   
                                        @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                        @endforeach 
                                    </div>
                                @endif
                                <form   id="i_recaptcha" name="regist" class="login"action="{{route('sendregist')}}" method="POST">
                                    @csrf
                                    <input type="hidden" id="reCaptchaToken" name="reCaptchaToken" value="">
                                    <input class="input" name="firstname" value="{{old("firstname")}}"type="text" placeholder="Vezetéknév"><br>
                                    <input class="input" name="lastname" value="{{old("lastname")}}"type="text" placeholder="Keresztnév"><br>
                                    <input class="input" name="email" value="{{old("email")}}"type="email" placeholder="E-mail cím"><br>
                                    <input class="input" name="password" type="password" placeholder="Jelszó"><br>
                                    <input class="input" name="password_confirmation" type="password" placeholder="Jelszó mégegyszer"><br>
                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <button type="submit" class="primary-btn registBtn g-recaptcha" data-sitekey="{{ env("G_RECAPTCHA_SITE_KEY") }}" data-callback='onSubmit'>Regisztráció</button>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <hr>
                                        <div class="col text-right" style="margin-top:2%;" >
                                            <a class="lostpw" href="{{route("login")}}">Van már profilod?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 text-right text-white" style="margin:40px 0 -30px 0;">
                                <small>
                                    *A regisztációval hozzájárulsz adataid kezeléshez és elfogadod az <a class="successLogin" href="">ÁSZF-t.</a><br>
                                    **Kezeléséről az <a  class="successLogin" href="#">Adatkezelési tájékoztató</a>-ban olvashatsz.<br>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-textlogin text-center">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>| Minden jog fenntartva<br><a href="#">Adatkezelési tájékoztató</a></p>
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