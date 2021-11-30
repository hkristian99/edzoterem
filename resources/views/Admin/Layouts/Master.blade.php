<!DOCTYPE html>
<html lang="hu">
  <head>
    @yield('custom1')
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="/gentelella-master/production/images/favicon.ico" type="image/ico"/>

    <title>Force Gym | Admin</title>

    <!-- Bootstrap -->
    <link href="/assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/assets/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/assets/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/assets/admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="/assets/admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/assets/admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/assets/admin/css/custom.min.css" rel="stylesheet">
    <link href="/assets/admin/css/customAdmin.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route("admin")}}" class="site_title"><span>Force Gym | Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix text-center">
                <h2>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h2>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include("Admin.Layouts.Menu");
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Kijelentkezés" href="{{route("logout")}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    KAPCSOLAT | <small>Vészhelyzet esetén értesítendő</small>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right text-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="#"> Hatóságok</a>
                    <a class="dropdown-item"  href="#">Vezetés</a>
                    <a class="dropdown-item"  href="#">Adminsztrátor</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        @yield('content')
        
        <!-- footer content -->
        <footer>
            <div class="pull-right">
              <small>Force Gym Admin Felület - Minden jog fentartva</small>
            </div>
            <div class="clearfix"></div>
          </footer>
          <!-- /footer content -->
        </div>
      </div>
  
      <!-- jQuery -->
      <script src="/assets/admin/vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="/assets/admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="/assets/admin/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="/assets/admin/vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="/assets/admin/vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="/assets/admin/vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="/assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="/assets/admin/vendors/iCheck/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="/assets/admin/vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="/assets/admin/vendors/Flot/jquery.flot.js"></script>
      <script src="/assets/admin/vendors/Flot/jquery.flot.pie.js"></script>
      <script src="/assets/admin/vendors/Flot/jquery.flot.time.js"></script>
      <script src="/assets/admin/vendors/Flot/jquery.flot.stack.js"></script>
      <script src="/assets/admin/vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="/assets/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="/assets/admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="/assets/admin/vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="/assets/admin/vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="/assets/admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="/assets/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="/assets/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="/assets/admin/vendors/moment/min/moment.min.js"></script>
      <script src="/assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  
      <!-- Custom Theme Scripts -->
      <script src="/assets/admin/js/custom.min.js"></script>
      <script src="/assets/frontend/js/inputmask.min.js"></script>
      @yield('custom2')
    </body>
  </html>
 
  @yield('scripts')