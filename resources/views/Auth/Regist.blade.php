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
                        <h2 style="color:#fff;">Regisztráció</h2><br>
                        <form name="regist" action="#">
                            <input class="input" name="name" type="text" placeholder="Név"><br>
                            <input class="input" name="email" type="email" placeholder="E-mail cím"><br>
                            <input class="input" name="password" type="password" placeholder="Jelszó"><br>
                            <input class="input" name="confim_password" type="password" placeholder="Jelszó mégegyszer"><br>
                            <div class="row justify-content-center">
                                <div class="col">
                                    <button type="submit" class= "primary-btn">Regisztráció</button>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <hr>
                                <div class="col text-right" style="margin-top:2%;" >
                                    <a href="{{route("login")}}">Van már profilod?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <!-- Contact Section End -->
    @endsection