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
        <h2 class="title-1 m-b-25">Danh sách đơn hàng
          <a class="btn btn-info searchbtn" onclick="showsearch()" style="color:white">
          <i class="fas fa-search"></i>
        </a></h2>
      </div>
    </div>
</div>
<div class="row search">
    <div class="col-lg-12">
      <div class="card md-3">
        <form action="{{route('orders.index')}}" method="get" name="search">
          @csrf
        <div class="card-header">Tìm kiếm <a href="javascript:void(1);" onclick="closesearch()" style="float:right;color:black"><i class="fas fa-times-circle fa-2x"></i></a></div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="madh"><b>Mã đơn</b></label>
                  <input type="text" class="form-control" name="ma" value="{{$ma}}">
                </div>
                <div class="form-group">
                  <label for="title"><b>Tên khách hàng</b></label>
                  <input type="text" class="form-control" name="name" value="{{$name}}">
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
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="from"><b>Từ ngày</b></label>
                  <input type="text" class="form-control" name="from" id="from" value="{{$from}}">
                </div>
                <div class="form-group">
                  <label for="to"><b>Đến ngày</b></label>
                  <input type="text" class="form-control" name="to" id="to" value="{{$to}}">
                </div>

            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" style="color: #fff">Tìm</button>
          <button type="button" class="btn btn-danger" onclick="rs()">Nhập lại</button>
        </div>
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
                        <th class="text-center">Mã ĐH</th>
                        <th class="text-center">Tên khách hàng</th>
                        <th class="text-center">Thời gian</th>
                        <th class="text-center">Trạng thái</th>

                        <th class="text-center">Quản lý</th>
                        <th class="text-center">Chi tiết</th>
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
                      <td>
                        @if($order->status == 1)
                        <div style="display:inline-block">
                          <form action="{{route('changesttorder', $order->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-danger" title="Huỷ đơn" data-click="swal-danger"><i class="fas fa-times-circle"></i></button>
                          </form>
                        </div>
                        <div style="display:inline-block">
                          <form action="{{route('changesttorder', $order->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="status" value="10">
                            <button type="submit" class="btn btn-success" title="Hoàn thành đơn hàng" data-click="swal-done"><i class="fas fa-clipboard-check"></i></button>
                          </form>
                        </div>
                        @elseif($order->status == 2)
                          @elseif($order->status == 10)
                          @else
                          <div style="display:inline-block">
                            <form action="{{route('changesttorder', $order->id)}}" method="post">
                              @csrf
                              <input type="hidden" name="status" value="1">
                              <button type="submit" class="btn btn-primary" title="Xác nhận" data-click="swal-check"><i class="fas fa-check-circle"></i></button>
                            </form>
                          </div>
                          <div style="display:inline-block">
                            <form action="{{route('changesttorder', $order->id)}}" method="post">
                              @csrf
                              <input type="hidden" name="status" value="2">
                              <button type="submit" class="btn btn-danger" title="Huỷ đơn" data-click="swal-danger"><i class="fas fa-times-circle"></i></button>
                            </form>
                          </div>
                          @endif
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
$('#from').datetimepicker({
      i18n:{
    de:{
    months:[
    'Januar','Februar','März','April',
    'Mai','Juni','Juli','August',
    'September','Oktober','November','Dezember',
    ],
    dayOfWeek:[
    "So.", "Mo", "Di", "Mi",
    "Do", "Fr", "Sa.",
    ]
    }
    },
    timepicker:false,
    format:'d/m/Y',
});
$('#to').datetimepicker({
  i18n:{
de:{
months:[
'Januar','Februar','März','April',
'Mai','Juni','Juli','August',
'September','Oktober','November','Dezember',
],
dayOfWeek:[
"So.", "Mo", "Di", "Mi",
"Do", "Fr", "Sa.",
]
}
},
timepicker:false,
format:'d/m/Y',
});
</script>
<style type="text/css">
  .search{
    display: none;
  }
  .show{
    display: block;
  }
  .hidd{
    display: none;
  }
</style>
<script type="text/javascript">
    function rs(){
      document.search.ma.value = "";
      document.search.name.value = "";
      document.search.status.selectedIndex = 0;
      document.search.from.selectedIndex = "";
      document.search.to.selectedIndex = "";
    }
    function showsearch() {
          var x = document.getElementsByClassName('search');
          x[0].classList.add('show');
          var y = document.getElementsByClassName('searchbtn');
          y[0].classList.add('hidd');
      }
    function closesearch() {
      var x = document.getElementsByClassName('search');
      x[0].classList.remove('show');
      var y = document.getElementsByClassName('searchbtn');
      y[0].classList.remove('hidd');
    }
</script>
@endsection
