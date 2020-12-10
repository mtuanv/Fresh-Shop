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
        <form action="{{route('dayreport')}}" method="get" style="float: left; margin-right: 5px">
          @csrf
          Từ ngày &nbsp;
          <input id="StartTime" name="StartTime" value="{{$stime}}" style="width: 150px">
          Đến ngày &nbsp;
          <input id="EndTime" name="EndTime"  value="{{$etime}}" style="width: 150px">&nbsp;&nbsp;
          <button type="submit" class="btn btn-primary" style="border-radius:0">Lấy dữ liệu</button>&nbsp;

        </form>
        <form action="{{route('exportday')}}" method="get">
          @csrf
          <input type="hidden" name="fromt" value="{{$stime}}">
          <input type="hidden" name="tot" value="{{$etime}}">
          <button type="submit" class="btn btn-info" style="border-radius:0"><img src="{{ asset('admin/images/icon/excel.png') }}" width="20"/> &nbsp;Xuất Excel</button>
        </form>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered" width="100%">
          <thead class="thead-light">
            <tr>
              <th rowspan="2" class="align-middle text-center">
                @if($sort !=7 && $sort != 8)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="8">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Ngày</b></button>
                </form>
                @endif
                @if($sort == 7)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="8">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Ngày</b> <i class="fas fa-caret-up"></i></button>
                </form>
                @endif
                @if($sort == 8)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="7">
                  <button class="btn" type="submit" title="Từ cao đến thấp"><b>Ngày</b> <i class="fas fa-caret-down"></i></button>
                </form>
                @endif
              </th>
              <th colspan="3" class="text-center">Doanh thu</th>
            </tr>
            <tr>
              <th class="text-center">
                @if($sort !=3 && $sort != 4)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="4">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Tiền hàng</b></button>
                </form>
                @endif
                @if($sort == 3)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="4">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Tiền hàng</b> <i class="fas fa-caret-up"></i></button>
                </form>
                @endif
                @if($sort == 4)

                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="3">
                  <button class="btn" type="submit" title="Từ cao đến thấp"><b>Tiền hàng</b> <i class="fas fa-caret-down"></i></button>
                </form>
                @endif
              </th>
              <th class="text-center">
                @if($sort !=5 && $sort != 6)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="6">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Khuyến mãi</b></button>
                </form>
                @endif
                @if($sort == 5)

                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="6">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Khuyến mãi</b> <i class="fas fa-caret-up"></i></button>
                </form>
                @endif
                @if($sort == 6)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="5">
                  <button class="btn" type="submit" title="Từ cao đến thấp"><b>Khuyến mãi</b> <i class="fas fa-caret-down"></i></button>
                </form>
                @endif
              </th>
              <th class="text-center">
                @if($sort !=1 && $sort != 2)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="2">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Tổng thu</b></button>
                </form>
                @endif
                @if($sort == 1)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="2">
                  <button class="btn" type="submit" title="Từ thấp đến cao"><b>Tổng thu</b> <i class="fas fa-caret-up"></i></button>
                </form>
                @endif
                @if($sort == 2)
                <form action="{{route('dayreport')}}" method="get">
                  @csrf
                  <input type="hidden" name="StartTime" value="{{$stime}}">
                  <input type="hidden" name="EndTime" value="{{$etime}}">
                  <input type="hidden" name="sort" value="1">
                  <button class="btn" type="submit" title="Từ cao đến thấp"><b>Tổng thu</b> <i class="fas fa-caret-down"></i></button>
                </form>
                @endif
              </th>
            </tr>
          </thead>
          <tbody>
            @php
              $sumtotal = 0;
              $sumprice = 0;
              $sumdc = 0;
            @endphp
            @foreach($lsReport as $report)
            <tr class="text-center">
              <td>{{date('d/m/Y', strtotime($report->date))}}</td>
              <td>{{number_format($report->sprice)}}</td>
              <td>{{number_format($report->sprice - $report->stotal)}}</td>
              <td>{{number_format($report->stotal)}}</td>
            </tr>
            @php
              $sumtotal += $report->stotal;
              $sumprice += $report->sprice;
              $sumdc += $report->sprice - $report->stotal;
            @endphp
            @endforeach
            <tr class="text-center">
              <td> <b>Tổng : </b> </td>
              <td> <b>{{number_format($sumprice)}}</b> </td>
              <td> <b>{{number_format($sumdc)}}</b> </td>
              <td> <b>{{number_format($sumtotal)}}</b> </td>
            </tr>
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
    });
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
    });
</script>
@endsection
