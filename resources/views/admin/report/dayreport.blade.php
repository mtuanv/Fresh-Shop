@extends("layouts.adminlayout")
@section("title")
  Tổng hợp bán hàng theo ngày
@endsection
@section("content")
<div class="row">
    <div class="col-lg-12">
        <h3 class="title-2 m-b-25 text-center">TỔNG HỢP BÁN HÀNG THEO NGÀY</h3>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
  <div class="card">
    <div class="card-header">
        <form action="{{route('dayreport')}}" method="get">
          Từ ngày &nbsp;
          <input id="StartTime" name="StartTime" style="width: 150px">
          Đến ngày &nbsp;
          <input id="EndTime" name="EndTime" style="width: 150px">&nbsp;&nbsp;
          <button type="submit" class="btn btn-primary" style="border-radius:0">Lấy dữ liệu</button>&nbsp;
          <button type="button" class="btn btn-info" style="border-radius:0"><img src="{{ asset('admin/images/icon/excel.png') }}" width="20"/> &nbsp;Xuất Excel</button>
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
              <th class="text-center">
                Tổng
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="sort" value="1">
                  <button class="btn btn-secondary" type="submit" style="border-radius: 0;float:right;margin-left:5px" title="Từ thấp đến cao"><i class="fas fa-less-than-equal"></i></button>
                </form>
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="sort" value="2">
                  <button class="btn btn-secondary" type="submit" style="border-radius: 0;float:right;margin-left:5px" title="Từ cao đến thấp"><i class="fas fa-greater-than-equal"></i></button>
                </form>
              </th>
              <th class="text-center">
                Tiền hàng
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="sort" value="3">
                  <button class="btn btn-secondary" type="submit" style="border-radius: 0;float:right;margin-left:5px" title="Từ thấp đến cao"><i class="fas fa-less-than-equal"></i></button>
                </form>
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="sort" value="4">
                  <button class="btn btn-secondary" type="submit" style="border-radius: 0;float:right;margin-left:5px" title="Từ cao đến thấp"><i class="fas fa-greater-than-equal"></i></button>
                </form>
              </th>
              <th class="text-center">
                Khuyến mãi
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="sort" value="5">
                  <button class="btn btn-secondary" type="submit" style="border-radius: 0;float:right;margin-left:5px" title="Từ thấp đến cao"><i class="fas fa-less-than-equal"></i></button>
                </form>
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="sort" value="6">
                  <button class="btn btn-secondary" type="submit" style="border-radius: 0;float:right;margin-left:5px" title="Từ cao đến thấp"><i class="fas fa-greater-than-equal"></i></button>
                </form>
              </th>
            </tr>
          </thead>
          <tbody>
            @for($i = 0; $i < count($datetotal); $i++)
            <tr class="text-center">
              <td>{{date('d/m/Y', strtotime($datetotal[$i]->date))}}</td>
              <td>{{number_format($datetotal[$i]->stotal)}}</td>
              <td>{{number_format($price[$i]->sprice)}}</td>
              <td>{{number_format($discount[$i])}}</td>
            </tr>
            @endfor

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
        dayOfWeek:[
        "So.", "Mo", "Di", "Mi",
        "Do", "Fr", "Sa.",
        ]
        }
        },
        timepicker:false,
        format:'d/m/Y',
        value: Date.now()
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
 format:'d/m/Y',
 value: date1.getDate() + "." + (date1.getUTCMonth()+1) + "." + date1.getUTCFullYear()
    });
</script>
@endsection
