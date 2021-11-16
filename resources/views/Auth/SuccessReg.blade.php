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
                    <div class="col-lg-6 leave-comment text-center text-white">
                        <h2>Sikeres regisztráció!</h2><br>
                        <h4 id="countDown"></h4><br>
                        <h3>múlva átirányítunk a <a class="successLogin" href="{{route('login')}}">bejelentkezés</a> lapra!</h3><br>
                    </div>
                </div>
            </div>
    </section>
    <!-- Contact Section End -->
    @endsection

    @section('scripts')
    <script>
        //ÁTIRÁNYÍTÁS
       function redirect(){
            window.location.href= "../bejelentkezes";
       }
       setTimeout(redirect, 5000);
   
       //VISSZASZÁMLÁLÓ 5s
        $( document ).ready(function() {
            setInterval(countdown, 1000);
            var dt = new Date(); 
            var hStart = dt.getHours();
            var mStart = dt.getMinutes();
            var sStart = dt.getSeconds();
            var secondTotalStart = (hStart * 3600) + (mStart * 60) + sStart;
            var secondTotalFinish = secondTotalStart + 3600;

            function countdown() {
                var cdt = new Date();
                var hRunning = cdt.getHours();
                var mRunning = cdt.getMinutes();
                var sRunning = cdt.getSeconds();
                var secondTotalRunning = (hRunning * 3600) + (mRunning * 60) + sRunning;
                var duration = secondTotalFinish - secondTotalRunning -3595;
                var s = Math.floor(duration % 3600) % 60;
                $("#countDown").html(s + " mp");
            }
        });
    </script>
    @endsection