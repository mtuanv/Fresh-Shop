@extends("layouts.adminlayout")
@section("title")
  Danh sách đơn hàng
@endsection
@section("content")
@if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif
<div class="row">
    <div class="col-lg-12">
      <div class="overview-wrap">
        <h2 class="title-1 m-b-25">Danh sách đơn hàng</h2>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3>Tìm kiếm</h5>
          <form action="" method="get">
            @csrf
            <div class="form-group">
              <label for="title"><b>Tên Khách Hàng</b></label>
              <input type="text" class="form-control" name="name">
            </div>
            <button type="submit" class="btn btn-info" style="color: #fff">Tìm</button>
          </form>
        </div>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lsOrder as $order)
                  <tr>
                      <td>{{$order->id}}</td>
                      <td>{{$order->name}}</td>
                      <td>
                        @if($order->status == 0)
                        Chưa xác nhận
                        @elseif($order->status == 1)
                        Đã xác nhận
                        @else
                        Đã huỷ
                        @endif
                      </td>
                      <td class="text-right">
                          @if($order->status == 0)
                          <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:left; margin-right: 5px">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                          </form>
                          <form action="{{route('changesttorder', $order->id)}}" method="post"  style="float:left; margin-right: 5px">
                            @csrf
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-danger">Huỷ</button>
                          </form>
                          @elseif($order->status == 1)
                          <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:left; margin-right: 5px">
                            @csrf
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-danger">Huỷ</button>
                          </form>
                          @else
                          <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:left; margin-right: 5px">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                          </form>
                          @endif
                          <a href="{{route('orders.show', $order->id)}}" class="btn btn-primary" style="float:left; margin-right: 5px">Chi tiết</a>
                          <span style="clear:both"></span>
                      </td>
                      <td>{{$order->total}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="5">{{ $lsOrder->links("pagination::bootstrap-4") }}</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
