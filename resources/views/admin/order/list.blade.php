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
          <form action="{{route('orders.index')}}" method="get">
            @csrf
            <div class="form-group">
              <label for="madh"><b>Mã đơn</b></label>
              <input type="text" class="form-control" name="ma" value="{{$ma}}">
            </div>
            <div class="form-group">
              <label for="title"><b>Tên khách hàng</b></label>
              <input type="text" class="form-control" name="name" value="{{$name}}">
            </div>
            <div class="form-group">
              <label for="from"><b>Từ ngày</b></label>
              <input type="text" class="form-control" name="from" id="from" value="{{$from}}">
            </div>
            <div class="form-group">
              <label for="to"><b>Đến ngày</b></label>
              <input type="text" class="form-control" name="to" id="to" value="{{$to}}">
            </div>
            <div class="form-group">
              <label for="status"><b>Trạng thái</b></label>
              <select name="status" class="form-control">
                <option value="">Tất cả</option>
                <option value="0" {{$status == '0' ? 'selected' : ''}}>Đang chờ</option>
                <option value="1" {{$status == '1' ? 'selected' : ''}}>Đã xác nhận</option>
                <option value="2" {{$status == '2' ? 'selected' : ''}}>Đã huỷ</option>
                <option value="10" {{$status == '10' ? 'selected' : ''}}>Hoàn thành</option>
              </select>
            </div>
            <button type="submit" class="btn btn-info" style="color: #fff">Tìm</button>
          </form>
        </div>
      </div>
    </div>
</div>
<div class="row" id="success">
    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Tên khách hàng</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>

                        <th>Quản lý</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lsOrder as $order)

                  <tr>

                      <td>DH0000{{$order->id}}</td>
                      <td>{{$order->name}}</td>
                      <td>{{$order->created_at->format('d/m/Y H:m:i')}}</td>
                      <td>
                        @if($order->status == 1)
                        Đã xác nhận
                        @elseif($order->status == 10)
                        Hoàn thành
                        @elseif($order->status == 2)
                        Đã huỷ
                        @else
                        Đang chờ
                        @endif
                      </td>

                      <td style="padding: 12px 0">
                        @if($order->status == 1)
                        <form action="{{route('changesttorder', $order->id)}}" method="post"  style="float:left; margin-right: 5px">
                          @csrf
                          <input type="hidden" name="status" value="2">
                          <button type="submit" class="btn btn-danger" title="Huỷ đơn"><i class="fas fa-times-circle"></i></button>
                        </form>
                        <form action="{{route('changesttorder', $order->id)}}" method="post">
                          @csrf
                          <input type="hidden" name="status" value="10">
                          <button type="submit" class="btn btn-success" title="Hoàn thành đơn hàng"><i class="fas fa-clipboard-check"></i></button>
                        </form>
                        @elseif($order->status == 2)

                          @elseif($order->status == 10)
                          @else
                          <form action="{{route('changesttorder', $order->id)}}" method="post" style="float:left; margin-right: 5px">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-primary" title="Xác nhận"><i class="fas fa-check-circle"></i></button>
                          </form>
                          <form action="{{route('changesttorder', $order->id)}}" method="post"  style="float:left; margin-right: 5px">
                            @csrf
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-danger" title="Huỷ đơn"><i class="fas fa-times-circle"></i></button>
                          </form>
                          @endif
                          <p  style="float:left; margin-right: 5px"> </p>
                          <span style="clear:left"></span>
                      </td>
                      <td><a href="{{route('orders.show', $order->id)}}" class="btn btn-info">Xem</a></td>
                  </tr>

                  @endforeach
                  <tr>
                    <td colspan="6">{{ $lsOrder->appends(['ma' => $ma, 'name' => $name, 'from' => $from, 'to' => $to, 'status' => $status])->links("pagination::bootstrap-4") }}</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#from').datetimepicker();
    $('#to').datetimepicker();
</script>
@endsection
