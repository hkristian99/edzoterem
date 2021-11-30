
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Force Gym</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/style.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/custom.css" type="text/css">
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="canvas-search search-switch">
            <i class="fa fa-search"></i>
        </div>
        <nav class="canvas-menu mobile-menu">
            <ul>
                <li><a href="{{route('home')}}">Kezdőlap</a></li>
                <li><a href="{{route('prices')}}">Rólunk</a></li>
                <li><a href="{{route('prices')}}">Szolgáltatásaink</a></li>
                <li><a href="{{route('prices')}}">Csapatunk</a></li>
                <li><a href="#">További oldalak</a>
                    <ul class="dropdown">
                        <li><a href="{{route('prices')}}">About us</a></li>
                        <li><a href="{{route('prices')}}">Classes timetable</a></li>
                        <li><a href="{{route('prices')}}">Bmi calculate</a></li>
                        <li><a href="{{route('prices')}}">Our team</a></li>
                        <li><a href="{{route('prices')}}">About us</a></li>
                    </ul>
                </li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        
    </div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section examHeader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="/assets/frontend/img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="nav-menu stroke">
                    <ul>
                        <li class="{{Request::is('szolgaltatasok') ? 'active stroke' : '' }}"><a href="{{route('service')}}">Szolgáltatásaink</a></li>
                        <li class="{{Request::is('rolunk') ? 'active stroke' : '' }}"><a href="{{route('prices')}}">Áraink</a>
                            <ul class="dropdown">
                                <li><a href="{{route('prices')}}/#berletek">Bérletek</a></li>
                                <li><a href="{{route('prices')}}/#webshop">Web Shop</a></li>
                            </ul>
                        </li>
                        <li class="{{Request::is('csapatunk') ? 'active stroke' : '' }}"><a href="{{route('contact')}}">Kapcsolat</a></li>
                        <li class="{{Request::is('orarendek') ? 'active stroke' : '' }}"><a href="{{route('timetable')}}">Órarendek</a></li>
                        <li class="{{Request::is('tobb') ? 'active stroke' : '' }}"><a href="#">Tudástár</a>
                            <ul class="dropdown">
                                <li><a href="{{route('bmi')}}">BMI kalkulátor</a></li>
                                <li><a href="{{route('gallery')}}">Galéria</a></li>
                                <li><a href="{{route('blog')}}">Blog</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="top-option" style="padding:0px;">
                    <div class="to-social">
                            <nav class="nav-menu stroke">
                                <ul>
                                    <li>
                                        @if (Auth::check())
                                        <a href="#" ><i class="fa fa-user" style="font-size:25px;"></i></a>
                                            <ul class="dropdown profilMenu">
                                                <!--<p class="p">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p><hr class="hr">-->
                                                <li><a class="profilMenuItem" href="{{route('profile')}}">Profilom</a></li>
                                                <li><a class="profilMenuItem" href="{{route('profile')}}">Rendeléseim</a></li>
                                                @if (1 > 0)
                                                <li><a class="profilMenuItem" href="{{route('admin')}}">Adminisztráció</a></li>
                                                @endif
                                                <li><a class="profilMenuItem" href="{{route('logout')}}">Kijelentkezés</a></li>
                                            </ul>
                                        @else
                                        <a href="{{route("login")}}">Bejelentkezés</a>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="canvas-open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header End -->
@yield('content')
    
<!-- Footer Section Begin -->
<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="fs-about">
                    <div class="fa-logo">
                        <a href="{{route('home')}}"><img src="/assets/frontend/img/logo.png" alt=""></a>
                    </div>
                    <div class="fa-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa  fa-envelope-o"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-3 col-sm-7 ">
                <div class="gt-text">
                        <div class="col-12">
                            <i class="fa fa-map-marker"></i>
                            <p>333 Middle Winchendon Rd, Rindge, NH 03461</p>
                        </div>
                        <div class="col-12">
                            <i class="fa fa-mobile"></i>
                            <ul>
                                <li>125-711-811</li>
                                <li>125-668-886</li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <i class="fa fa-envelope"></i>
                            <p>info@forcegym.com</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="copyright-text">
                    <p>Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> 
                        All rights reserved | This template is made with 
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        by 
                        <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer Section End -->
    
<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">X</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Keresés">
        </form>
    </div>
</div>
<!-- Search model end -->
<!-- Js Plugins -->
<script src="/assets/frontend/js/jquery-3.3.1.min.js"></script>
<script src="/assets/frontend/js/bootstrap.min.js"></script>
<script src="/assets/frontend/js/jquery.magnific-popup.min.js"></script>
<script src="/assets/frontend/js/masonry.pkgd.min.js"></script>
<script src="/assets/frontend/js/jquery.barfiller.js"></script>
<script src="/assets/frontend/js/jquery.slicknav.js"></script>
<script src="/assets/frontend/js/owl.carousel.min.js"></script>
<script src="/assets/frontend/js/main.js"></script>
<script src="/assets/frontend/js/inputmask.min.js"></script>
<script src="/assets/frontend/js/custom.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@yield("scripts")
</body>
</html>
