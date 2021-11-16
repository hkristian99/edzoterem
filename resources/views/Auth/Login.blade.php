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
                    <div class="col-lg-6 leave-comment">
                        <h2 class="text-white">Bejelentkezés</h2><br>
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
                        <form id="i_recaptcha" name="login" action="{{route('loginAttempt')}}" method="POST">
                            @csrf
                            <input type="hidden" id="reCaptchaToken" name="reCaptchaToken" value="">
                            <input class="input" name="email" value="{{old("email")}}" type="email" placeholder="E-mail cím"><br>
                            <input class="input" name="password"type="password" placeholder="Jelszó"><br>
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <button type="submit" class="primary-btn g-recaptcha" data-sitekey="{{ env("G_RECAPTCHA_SITE_KEY") }}" data-callback='onSubmit'>Bejelentkezés</button>
                                </div>
                                <div class="col-lg-7 text-right">
                                    <a href="{{route("regist")}}" class="primary-btn btn-normal appoinment-btn reg ">Regisztráció</a>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <hr>
                                <div class="col text-right" style="margin-top:2%;" >
                                    <a href="{{route('lostPassword')}}"  >Elfelejtett jelszó</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <!-- Contact Section End -->
    @endsection