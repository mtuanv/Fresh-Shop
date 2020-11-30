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
                        <li><a href="tel:+84 962257510"><i class="fas fa-headset" ></i> Hotline : +84 962257510</a></li>
                        <li><a href="https://goo.gl/maps/MWuTcUDBLL2CNo429"><i class="fas fa-location-arrow "></i> Tòa Nhà Detech - Số 8 Tôn Thất Thuyết,
                                Dịch Vọng Hậu, Cầu Giấy, Hà Nội</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker" style="float: right">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT30
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
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
                        <a href="#">
                            <i class="fa fa-shopping-bag"></i>
                            {{--dùng js lấy thông tin số lượng sản phẩm khách hàng đã thêm vào giỏ hàng--}}
                            <span class="badge">3</span>
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
            <li class="cart-box">
                <ul class="cart-list">
                    <li>
                        <a href="#" class="photo"><img src="{{asset('shop/images/img-pro-01.jpg')}}" class="cart-thumb"
                                                       alt=""/></a>
                        <h6><a href="#">Delica omtantur </a></h6>
                        <p>1x - <span class="price">$80.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{asset('shop/images/img-pro-02.jpg')}}" class="cart-thumb"
                                                       alt=""/></a>
                        <h6><a href="#">Omnes ocurreret</a></h6>
                        <p>1x - <span class="price">$60.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{asset('shop/images/img-pro-03.jpg')}}" class="cart-thumb"
                                                       alt=""/></a>
                        <h6><a href="#">Agam facilisis</a></h6>
                        <p>1x - <span class="price">$40.00</span></p>
                    </li>
                    <li class="total">
                        <a href="cart" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right"><strong>Total</strong>: $180.00</span>
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
                <input type="text" class="form-control" placeholder="Search here..." name="search">
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
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-facebook-messenger" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">

            </div>
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


</body>

</html>
