<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
          media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
          media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- CKEditor -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!-- datetimepicker -->
    <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.min.css') }}"/>
    <!-- Styles -->
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

</head>
<body class="animsition">
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="index.html">
                        <img src="{{ asset('admin/images/icon/logo.png') }}" alt="CoolAdmin"/>
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="has-sub">
                        <a class="js-arrow" href="{{route('dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-copy"></i>Báo cáo</a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="login.html">Ngày</a>
                            </li>
                            <li>
                                <a href="register.html">Tuần</a>
                            </li>
                            <li>
                                <a href="forget-pass.html">Tháng</a>
                            </li>
                        </ul>
                    </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Quản lý trang web</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                              @if(Auth::user()->role_name == 'ADMIN')
                                <li>
                                    <a href="{{ route('tags.index')}}">Tag</a>
                                </li>
                                <li>
                                    <a href="{{ route('products.index')}}">Sản phẩm</a>
                                </li>
                                @endif
                                <li>
                                    <a href="">Đơn hàng</a>
                                </li>
                                @if(Auth::user()->role_name == 'ADMIN')
                                <li>
                                    <a href="{{route('promotions.index')}}">Tin tức</a>
                                </li>
                                <li>
                                    <a href="tab.html">Khách hàng</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#">
                <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin"/>
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="active has-sub">
                        <a class="js-arrow" href="{{ route('dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-copy"></i>Báo cáo</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="login.html">Ngày</a>
                            </li>
                            <li>
                                <a href="register.html">Tuần</a>
                            </li>
                            <li>
                                <a href="forget-pass.html">Tháng</a>
                            </li>
                        </ul>
                    </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Quản lý trang web</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                              @if(Auth::user()->role_name == 'ADMIN')
                                <li>
                                    <a href="{{ route('tags.index')}}">Tag</a>
                                </li>
                                <li>
                                    <a href="{{ route('products.index')}}">Sản phẩm</a>
                                </li>
                                @endif
                                <li>
                                    <a href="">Đơn hàng</a>
                                </li>
                                @if(Auth::user()->role_name == 'ADMIN')
                                <li>
                                    <a href="{{route('promotions.index')}}">Tin tức</a>
                                </li>
                                <li>
                                    <a href="tab.html">Khách hàng</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-9 col-xs-9 col-md-9 col-sm-8 col-3"></div>
                        <div class="header-wrap col-lg-3 col-xs-3 col-md-3 col-sm-4 col-9">
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                      <div class="image">
                                        <img src="{{asset(Auth::user()->avatar)}}" alt="{{ Auth::user()->name }} avatar">
                                      </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                          <div class="info clearfix">
                                            <div class="image">
                                              <img src="{{asset(Auth::user()->avatar)}}" alt="{{ Auth::user()->name }} avatar">
                                            </div>
                                            <div class="content">
                                              <h5 class="name">{{ Auth::user()->name }}</h5>
                                              <span class="email">t1911e@fpt.edu.vn</span>
                                              </div>
                                          </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>
<!-- Jquery JS-->
<script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}vendor/bootstrap-4.1/popper.min.js"></script>
<script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('admin/vendor/slick/slick.min.js') }}">
</script>
<script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
</script>
<script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}">
</script>
<script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/select2/select2.min.js') }}">
</script>

<!-- Main JS-->
<script src="{{ asset('admin/js/main.js') }}"></script>

</body>

</html>
<!-- end document-->
