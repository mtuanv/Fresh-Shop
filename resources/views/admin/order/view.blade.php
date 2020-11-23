@extends("layouts.adminlayout")
@section("title")
  Chi tiết đơn hàng
@endsection
@section("content")
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
          <h3 align="center"><strong>Chi tiết đơn hàng</strong></h3>
      </div>
      <div class="card-body card-block">
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="name" class="font-weight-bold form-control-label">Tên khách hàng: </label>
              </div>
              <div class="col-12 col-md-9">
                  {{$order->name}}
              </div>
              <div class="col col-md-3">
                  <label for="phone" class="font-weight-bold form-control-label">Số điện thoại: </label>
              </div>
              <div class="col-12 col-md-9">
                  {{$order->phone}}
              </div>
              <div class="col col-md-3">
                  <label for="phone" class="font-weight-bold form-control-label">Địa chỉ: </label>
              </div>
              <div class="col-12 col-md-9">
                  {{$order->address}}
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive table--no-card m-b-40">
                      <table class="table table-borderless table-striped table-earning">
                          <thead>
                              <tr>
                                  <th>STT</th>
                                  <th>Tên sản phẩm</th>
                                  <th>Số lượng</th>
                                  <th>Đơn giá</th>
                                  <th>Giảm giá</th>
                                  <th>Thành tiền</th>
                              </tr>
                          </thead>
                          <tbody>
                              @php
                                $stt = 1;
                                $total = 0;
                              @endphp
                              @foreach($order->order_products as $op)
                              <tr>
                                  <td>
                                    {{$stt}}
                                  </td>
                                  <td>
                                    @foreach($order->products as $p)
                                      @if($p->id == $op->product_id)
                                        {{$p->name}}
                                      @endif
                                    @endforeach
                                  </td>
                                  <td>
                                    {{$op->quantity}}
                                  </td>
                                  <td>
                                    @foreach($order->products as $p)
                                      @if($p->id == $op->product_id)
                                        {{$p->price}}
                                        @php
                                        $total += $p->price
                                        @endphp
                                      @endif
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach($order->products as $p)
                                      @if($p->id == $op->product_id)
                                        {{$p->discount}} %
                                      @endif
                                    @endforeach
                                  </td>
                                  <td>{{$op->price}}
                                  </td>
                                  @php
                                    $stt++
                                  @endphp
                              @endforeach
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-10" style="text-align: right">
                  <label for="name" class="font-weight-bold form-control-label">Tổng tiền: </label>
              </div>
              <div class="col-12 col-md-2" style="text-align: right">
                  {{$total}} VNĐ
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-10" style="text-align: right">
                  <label for="name" class="font-weight-bold form-control-label">Giảm giá: </label>
              </div>
              <div class="col-12 col-md-2" style="text-align: right">
                  {{$total - $order->total}} VNĐ
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-10" style="text-align: right">
                  <label for="name" class="font-weight-bold form-control-label">Tổng thanh toán: </label>
              </div>
              <div class="col-12 col-md-2" style="text-align: right">
                  {{$order->total}} VNĐ
              </div>
          </div>
      </div>
      <div class="card-footer">
        @if($order->status == 0)
        <form action="{{route('changesttorder', $order->id)}}" method="post"  style="float:right; margin-left: 5px">
          @csrf
          <input type="hidden" name="status" value="2">
          <button type="submit" class="btn btn-danger">Huỷ đơn</button>
        </form>
        <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:right; margin-left: 5px">
          @csrf
          <input type="hidden" name="status" value="1">
          <button type="submit" class="btn btn-success">Xác nhận</button>
        </form>
        @elseif($order->status == 1)
        <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:right; margin-left: 5px">
          @csrf
          <input type="hidden" name="status" value="2">
          <button type="submit" class="btn btn-danger">Huỷ đơn</button>
        </form>
        @else
        <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:right; margin-left: 5px">
          @csrf
          <input type="hidden" name="status" value="1">
          <button type="submit" class="btn btn-success">Xác nhận</button>
        </form>
        @endif
          <span style="clear:both"></span>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
