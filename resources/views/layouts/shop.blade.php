<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Freshshop</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('shop/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('shop/images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('shop/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('shop/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('shop/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('shop/css/custom.css')}}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{--Jquery--}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="{{asset('owl-carousel/assets/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('owl-carousel/assets/owl.theme.default.min.css')}}"/>


</head>

<body>
<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="our-link">
                    <ul>
                        <li><a href="#">Mở Cửa : 8 am - 10 pm</a></li>
                        <li><a href="tel:+84 962257510"><i class="fas fa-headset"></i> Hotline : +84 962257510</a></li>
                        <li><a href="https://goo.gl/maps/MWuTcUDBLL2CNo429"><i class="fas fa-location-arrow "></i> Tòa
                                Nhà Detech - Số 8 Tôn Thất Thuyết,
                                Dịch Vọng Hậu, Cầu Giấy, Hà Nội</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker" style="float: right">
                        <ul class="offer-box">
                            @foreach($lsBlog as $blog)
                                <li>
                                    <a href="{{route('blogDetail', $blog->id)}}" style="color: white"><i
                                            class="fab fa-opencart"></i>{{$blog->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                        aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/"><img src="{{asset('shop/images/logo.png')}}" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="/">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('aboutus')}}">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('menu')}}">SHOP</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('blog')}}">Tin Tức</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contactus')}}">Liên hệ</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu">
                        <a href="javascript:">
                            <i class="fa fa-shopping-bag"></i>
                            {{--dùng js lấy thông tin số lượng sản phẩm khách hàng đã thêm vào giỏ hàng--}}

                            @if(Session::has("Cart") != null)
                                <span id="total-quantity-show"
                                      class="badge">{{Session::get("Cart")->totalQuantity}}</span>
                            @else
                                <span id="total-quantity-show" class="badge"></span>
                            @endif
                            <p>Giỏ hàng</p>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Mini Cart Menu -->
        {{--Hash code giỏ hàng, lấy thông tin sản phẩm khách hàng chọn bằng ajax rồi thêm vào đây--}}
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box" id="cart-item-change">
                @if(Session::has("Cart") != null)
                    <ul class="cart-list">
                        @php
                            $grandtotal = 0;
                        @endphp
                        @foreach(Session::get('Cart')->products as $item)
                            <li>
                                <h6>{{$item['productInfo']->name}}</h6>
                                <p>x {{$item['quantity']}} - <span class="price">{{number_format($item['productInfo']->price)}}đ</span>
                                    @if($item['productInfo']->discount != null)
                                        (Sale : {{$item['productInfo']->discount}}%)
                                    @endif
                                </p>
                            </li>
                            @php
                                $iprice =  $item['price'] - $item['price'] * $item['productInfo']->discount / 100;
                                $grandtotal += $iprice;
                            @endphp
                        @endforeach
                        <li>
                            <span class="float-right"><strong>Tổng</strong>: {{number_format($grandtotal)}} đ</span>
                            <input hidden id="total-quantity-cart" type="number"
                                   value="{{Session::get('Cart')->totalQuantity}}">
                        </li>
                    </ul>
                @endif
                <ul class="cart-list">
                    <li class="total">
                        <a href="{{route('cart')}}" class="btn btn-default hvr-hover btn-cart">GIỎ HÀNG</a>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Mini Cart Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group ">
            <form action="{{route('searchHeader')}}" method="get" name="search" class="input-group">
                @csrf
                <input type="text" class="form-control" placeholder="Tìm kiếm..." name="search">
                <button type="submit"
                        style="background: black; color: white; border: none; cursor: pointer; margin-right: 30px">
                    <i class="fa fa-search"></i>
                </button>
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </form>
        </div>
    </div>
</div>
<!-- End Top Search -->

<!-- Start #main -->
<main id="main">
    @yield('content')
</main>
<!-- End #main -->

<!-- Start Footer  -->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>GIỜ MỞ CỬA</h3>
                        <ul class="list-time">
                            <li>THỨ HAI - THỨ BẢY : 08.00 am to 10.00 pm</li>
                            <li>CHỦ NHẬT : 08.00 am to 08.00 pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>LIÊN HỆ HỢP TÁC</h3>
                        <p>Sẵn sàng phục vụ các bạn gần xa <br>cùng với việc hợp tác sâu rộng!</p>
                        <a href="{{route('contactus')}}" class="newsletter-box">
                            <button class="btn hvr-hover" type="submit">Đi tới liên hệ</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>MẠNG XÃ HỘI</h3>
                        <p>Theo dõi chúng tôi trên các nền tảng mạng xã hội <br> để nhận được thông tin ưu đãi sớm nhất.
                        </p>
                        <ul>
                            <li><a href="https://www.facebook.com/Fresh-Shop-T19011e-105462151432872" target="_blank">
                                    <i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-facebook-messenger" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</footer>
<!-- End Footer  -->

<a href="#" id="back-to-top" title="Back to top" style="display:none">&uarr;</a>

<!-- ALL JS FILES -->
<script src="{{asset('shop/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('shop/js/popper.min.js')}}"></script>
<script src="{{asset('shop/js/bootstrap.min.js')}}"></script>
<!-- ALL PLUGINS -->
<script src="{{asset('shop/js/jquery.superslides.min.js')}}"></script>
<script src="{{asset('shop/js/bootstrap-select.js')}}"></script>
<script src="{{asset('shop/js/inewsticker.js')}}"></script>
<script src="{{asset('shop/js/bootsnav.js')}}"></script>
<script src="{{asset('shop/js/images-loded.min.js')}}"></script>
<script src="{{asset('shop/js/isotope.min.js')}}"></script>
<script src="{{asset('shop/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('shop/js/baguetteBox.min.js')}}"></script>
<script src="{{asset('shop/js/form-validator.min.js')}}"></script>
<script src="{{asset('shop/js/contact-form-script.js')}}"></script>
<script src="{{asset('shop/js/custom.js')}}"></script>
<script src="{{asset('shop/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('shop/js/jquery-ui.js')}}"></script>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v9.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="105462151432872"
     theme_color="#0A7CFF"
     logged_in_greeting="Fresh Shop xin kính chào quý khách ! "
     logged_out_greeting="Fresh Shop xin kính chào quý khách ! ">
</div>
</body>

</html>
