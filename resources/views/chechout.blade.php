@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>THANH TOÁN</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('cart')}}">Giỏ hàng</a></li>
                        <li class="breadcrumb-item active">Thanh Toán</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Địa chỉ thanh toán</h3>
                        </div>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Họ *</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value=""
                                           required>
                                    <div class="invalid-feedback"> Valid first name is required.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Tên *</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" value=""
                                           required>
                                    <div class="invalid-feedback"> Valid last name is required.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Số điện thoại *</label>
                                <input type="email" class="form-control" id="email" placeholder="">
                                <div class="invalid-feedback"> Please enter a valid email address for shipping
                                    updates.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Địa chỉ *</label>
                                <input type="text" class="form-control" id="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address.</div>
                            </div>
                            <hr class="mb-4">
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Giỏ hàng</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"><a href="detail.html"> Lorem ipsum dolor sit amet</a>
                                            <div class="small text-muted">Price: $80.00 <span class="mx-2">|</span> Qty:
                                                1 <span class="mx-2">|</span> Subtotal: $80.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Đơn hàng</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Sản phẩm</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Tạm tính</h4>
                                    <div class="ml-auto font-weight-bold"> $ 440</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Giảm giá</h4>
                                    <div class="ml-auto font-weight-bold"> $ 40</div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Thành tiền</h5>
                                    <div class="ml-auto h5"> $ 388</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Đặt
                                hàng</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection
