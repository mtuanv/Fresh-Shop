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
              <div class="col col-md-3">
                  <label for="phone" class="font-weight-bold form-control-label">Ghi chú: </label>
              </div>
              <div class="col-12 col-md-9">
                  {{$order->note}}
              </div>
              @if($order->status == 1 || $order->status == 2 || $order->status == 10)
              <div class="col col-md-3">
                  <label for="user" class="font-weight-bold form-control-label">Người xử lý đơn: </label>
              </div>
              <div class="col-12 col-md-9">
                  {{$order->user->name}}
              </div>
              @endif
              <div class="col col-md-3">
                  <label for="status" class="font-weight-bold form-control-label">Trạng thái: </label>
              </div>
              <div class="col-12 col-md-9">
                @if($order->status == 1)
                Đã xác nhận
                @elseif($order->status == 10)
                Hoàn thành
                @elseif($order->status == 2)
                Đã huỷ
                @else
                Đang chờ
                @endif
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
                                        {{number_format($p->price)}}
                                        @php
                                        $total += $p->price * $op->quantity
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
                                  <td>{{number_format($op->price)}}
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
                  {{number_format($total)}} VNĐ
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-10" style="text-align: right">
                  <label for="name" class="font-weight-bold form-control-label">Giảm giá: </label>
              </div>
              <div class="col-12 col-md-2" style="text-align: right">
                  {{number_format($total - $order->total)}} VNĐ
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-10" style="text-align: right">
                  <label for="name" class="font-weight-bold form-control-label">Tổng thanh toán: </label>
              </div>
              <div class="col-12 col-md-2" style="text-align: right">
                  {{number_format($order->total)}} VNĐ
              </div>
          </div>
      </div>
      <div class="card-footer text-right">
        @if($order->status == 1)
        <div  style="display:inline-block">
          <form action="{{route('changesttorder', $order->id)}}" method="post">
            @csrf
            <input type="hidden" name="status" value="10">
            <button type="submit" class="btn btn-success" data-click="swal-done">Hoàn thành</button>
          </form>
        </div>
        <div  style="display:inline-block">
          <form action="{{route('changesttorder', $order->id)}}" method="post">
            @csrf
            <input type="hidden" name="status" value="2">
            <button type="submit" class="btn btn-danger" data-click="swal-danger">Huỷ đơn</button>
          </form>
        </div>

        @elseif($order->status == 2)

        @elseif($order->status == 10)
          @else
          <form action="{{route('changesttorder', $order->id)}}" method="post"  style="float:right; margin-right: 5px">
            @csrf
            <input type="hidden" name="status" value="2">
            <button type="submit" class="btn btn-danger" data-click="swal-danger">Huỷ đơn</button>
          </form>
          <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:right; margin-right: 5px">
            @csrf
            <input type="hidden" name="status" value="1">
            <button type="submit" class="btn btn-primary" data-click="swal-check">Xác nhận</button>
          </form>


          @endif
          <span style="clear:both"></span>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('[data-click="swal-danger"]').click(function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
                })

              swalWithBootstrapButtons.fire({
                title: 'Huỷ đơn hàng',
                text: "Bạn có chắc chắn muốn huỷ đơn hàng này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  swal.fire(form.submit())
                  swalWithBootstrapButtons.fire(
                    'Huỷ thành công!',
                    'Đơn hàng đã bị huỷ',
                    'success'
                  )
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancel thành công!',
                    'Đơn hàng còn nguyên vẹn',
                    'error'
                  )
                }
})

      });
});

$(document).ready(function() {
    $('[data-click="swal-done"]').click(function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
                })

              swalWithBootstrapButtons.fire({
                title: 'Hoàn thành đơn hàng',
                text: "Đơn hàng đã hoàn thành?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  swal.fire(form.submit())
                  swalWithBootstrapButtons.fire(
                    'Hoàn thành!',
                    'Đơn hàng thành công',
                    'success'
                  )
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancel thành công!',
                    'Đơn hàng chưa hoàn thành',
                    'error'
                  )
                }
})

      });
});

$(document).ready(function() {
    $('[data-click="swal-check"]').click(function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
                })

              swalWithBootstrapButtons.fire({
                title: 'Xác nhận đơn hàng',
                text: "Xác nhận đơn hàng này?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  swal.fire(form.submit())
                  swalWithBootstrapButtons.fire(
                    'Xác nhận!',
                    'Xác nhận đơn hàng thành công',
                    'success'
                  )
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancel thành công!',
                    'Đơn hàng trong trạng thái chờ',
                    'error'
                  )
                }
})

      });
});
</script>
@endsection
