@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>GIỎ HÀNG</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('menu')}}">Shop</a></li>
                        <li class="breadcrumb-item active">Giỏ hàng</li>
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
                <div class="col-lg-12" id="list-cart">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(Session::has("Cart") != null)
                                @foreach(Session::get('Cart')->products as $item)
                                    <tr>
                                        <td class="name-pr">
                                            <h3>
                                                {{$item['productInfo']->name}}
                                            </h3>
                                        </td>
                                        <td class="price-pr">
                                            <p>{{number_format($item['productInfo']->price)}}đ</p>
                                        </td>
                                        <td class="quantity-box"><input type="number" size="4"
                                                                        value="{{$item['quantity']}}" min="0" step="1"
                                                                        class="c-input-text qty text"></td>
                                        <td class="total-pr">
                                            <p>{{number_format($item['price'])}}đ</p>
                                        </td>
                                        <td class="remove-pr">
                                            <a style="cursor:pointer"
                                               onclick="DeleteItemListCart({{$item['productInfo']->id}});">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row my-5">
                      @if(Session::has("Cart") != null)
                        <div class="col-lg-6 col-sm-6">
                            <div class="coupon-box">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" placeholder="Nhập mã giảm giá" aria-label="Coupon code"
                                           type="text">
                                    <div class="input-group-append">
                                        <button class="btn btn-theme" type="button">Áp dụng mã</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="update-box">
                                <input value="Cập nhật giỏ hàng" type="submit">
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col-lg-8 col-sm-12"></div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="order-box">
                                <h3>Order summary</h3>
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold">{{Session::get('Cart')->totalPrice}}đ</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ 40</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Coupon Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ 10</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold"> $ 2</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold"> Free</div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5">{{Session::get('Cart')->totalPrice}}đ</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"><a href="checkout.html"
                                                                   class="ml-auto btn hvr-hover">Checkout</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    <script>
        function DeleteItemListCart(id) {
            $.ajax({
                url: 'Delete-Item-List-Cart/' + id,
                type: 'GET',
            }).done(function (response) {
                RenderListCart(response);
                // alertify.success('Thêm giỏ hàng thành công');
            });
        }

        function RenderListCart(response) {
            $("#list-cart").empty();
            $("#list-cart").html(response);
        }
    </script>
@endsection
