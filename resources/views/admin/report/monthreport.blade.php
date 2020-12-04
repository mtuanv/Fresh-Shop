@extends("layouts.adminlayout")
@section("title")
  Tổng hợp bán hàng theo tháng
@endsection
@section("content")
<div class="row">
    <div class="col-lg-12">
        <h3 class="title-2 m-b-25 text-center">TỔNG HỢP BÁN HÀNG THEO THÁNG</h3>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <style type="text/css">
      .month-year-input {
        width: 60px;
        margin-right: 2px;
        }

      </style>
        <form action="{{route('dayreport')}}" method="get">
          Từ tháng &nbsp;
          <input id="StartTime" name="StartTime" style="width: 150px">
          Đến tháng &nbsp;
          <input id="EndTime" name="EndTime" style="width: 150px">&nbsp;&nbsp;
          <button type="submit" class="btn btn-primary" style="border-radius:0">Lấy dữ liệu</button>&nbsp;
          <button type="submit" class="btn btn-info" style="border-radius:0"><img src="{{ asset('admin/images/icon/excel.png') }}" width="20"/> &nbsp;Xuất Excel</button>
        </form>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered" width="100%">
          <thead class="thead-light">
            <tr>
              <th rowspan="2" class="align-middle text-center">Ngày</th>
              <th colspan="3" class="text-center">Doanh thu</th>
            </tr>
            <tr>
              <th class="text-center">Tổng</th>
              <th class="text-center">Tiền hàng</th>
              <th class="text-center">Khuyến mãi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">

    $('#EndTime').datetimepicker({
          i18n:{
        de:{
        months:[
        'Januar','Februar','März','April',
        'Mai','Juni','Juli','August',
        'September','Oktober','November','Dezember',
        ],
        }
        },
        timepicker:false,
        format:'m/Y',
        value: Date.now(),
    });
    date1 = new Date();
    date1.setDate(1);
    $('#StartTime').datetimepicker({
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
 format:'m/Y',
 value: date1.getDate() + "." + (date1.getUTCMonth()+1) + "." + date1.getUTCFullYear()
    });
</script>
<script type="text/javascript">
  $("div").remove(".xdsoft_calendar");

</script>
@endsection
