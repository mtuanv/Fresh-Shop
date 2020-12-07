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
          <form class="needs-validation" action="{{route('saveorder')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Thông tin thanh toán</h3>
                        </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Họ *</label>
                                    <input type="text" class="form-control" name="fname" placeholder="" value=""
                                           required>
                                    <div class="invalid-feedback"> Valid first name is required.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Tên *</label>
                                    <input type="text" class="form-control" name="lname" placeholder="" value=""
                                           required>
                                    <div class="invalid-feedback"> Valid last name is required.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Số điện thoại *</label>
                                <input type="phone" class="form-control" name="phone" placeholder="">
                                <div class="invalid-feedback"> Please enter a valid phone number for shipping
                                    updates.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Địa chỉ *</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address.</div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Ghi chú</label>
                                <textarea class="form-control" rows="6" name="note"></textarea>
                                <div class="invalid-feedback"> Please enter your shipping address.</div>
                            </div>
                            <hr class="mb-4">


                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Giỏ hàng</h3>
                                </div>
                                @if(Session::has("Cart") != null)
                                @php
                                  $totaldiscount = 0;
                                  $grandtotal = 0;
                                  $stt = 0;
                                @endphp
                                @foreach(Session::get('Cart')->products as $item)
                                <div class="rounded p-2 bg-light">
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"><a href="{{route('detail', $item['productInfo']->id)}}">{{$item['productInfo']->name}}</a>
                                            <div class="small text-muted">Giá: {{number_format($item['productInfo']->price)}}đ <span class="mx-2">|</span> Số lượng:
                                                {{$item['quantity']}} <span class="mx-2">|</span>
                                                @if($item['productInfo']->discount != null)
                                                  Sale: {{$item['productInfo']->discount}}%  <span class="mx-2">|</span>
                                                @endif
                                                @php
                                                  $totaldiscount += $item['price'] * $item['productInfo']->discount / 100;
                                                  $iprice =  $item['price'] - $item['price'] * $item['productInfo']->discount / 100;
                                                  $grandtotal += $iprice;
                                                  $stt ++;
                                                @endphp
                                                Tổng: {{number_format($iprice)}}đ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="productid[{{$stt}}]" value="{{$item['productInfo']->id}}">
                                <input type="hidden" name="productprice[{{$stt}}]" value="{{$item['productInfo']->price}}">
                                <input type="hidden" name="productqtt[{{$stt}}]" value="{{$item['quantity']}}">
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Đơn hàng</h3>
                                </div>
                                <div class="d-flex">
                                    <h4>Tổng tiền</h4>
                                    <div class="ml-auto font-weight-bold">{{number_format(Session::get('Cart')->totalPrice)}}đ</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Khuyến mãi</h4>
                                    <div class="ml-auto font-weight-bold">{{number_format($totaldiscount)}}đ</div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Thành tiền</h5>
                                    <div class="ml-auto h5">{{number_format($grandtotal)}}đ</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        @endif
                        <input type="hidden" name="total" value="{{$grandtotal}}">
                        <div class="col-12 d-flex shopping-box"><button type="submit" class="ml-auto btn hvr-hover">Đặt
                                hàng</button></div>
                    </div>
                </div>
            </div>

          </form>
        </div>
    </div>
    <!-- End Cart -->
@endsection
