<div class="table-main table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Giảm giá</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        @if(Session::has("Cart") != null)
            @php
              $totaldiscount = 0;
              $grandtotal = 0;
            @endphp
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
                                        data-id="{{$item['productInfo']->id}}" value="{{$item['quantity']}}" min="1" max="{{$item['productInfo']->quantity}}" step="1"
                                                    class="c-input-text qty text"></td>
                    <td class="discount-pr">
                        <p>@if($item['productInfo']->discount != null)
                          {{$item['productInfo']->discount}}%
                          @endif
                          </p>
                    </td>
                    <td class="total-pr">
                      @php
                        $totaldiscount += $item['price'] * $item['productInfo']->discount / 100;
                        $iprice =  $item['price'] - $item['price'] * $item['productInfo']->discount / 100;
                        $grandtotal += $iprice;
                      @endphp
                        <p>{{number_format($iprice)}}đ</p>
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
            <input class="edit-all" value="Cập nhật giỏ hàng" type="submit">
        </div>
    </div>
</div>

<div class="row my-5">
    <div class="col-lg-8 col-sm-12"></div>
    <div class="col-lg-4 col-sm-12">
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
            <hr class="my-1">
            <div class="d-flex gr-total">
                <h5>Thành tiền</h5>
                <div class="ml-auto h5">{{number_format($grandtotal)}}đ</div>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-12 d-flex shopping-box"><a href="{{url('/Check-out')}}"
                                               class="ml-auto btn hvr-hover">Thanh toán</a></div>
    @endif
</div>
