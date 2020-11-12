@extends("layouts.adminlayout")
@section("title")
    Danh sách sự kiện
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
                <h2 class="title-1 m-b-25">Danh sách sự kiện</h2>
                <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" href="{{route('promotions.create')}}">
                    <i class="zmdi zmdi-plus"></i>Thêm sự kiện mới
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Tìm kiếm</h3>
                    <form action="{{route('promotions.index')}}" method="get">
                        @csrf
                        <div class="form-group">
                            <label for="title"><b>Tên Sự kiện</b></label>
                            <input type="text" class="form-control" name="name" value="">
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
                        <th>Tên sự kiện</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Quản lý</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsPromotion as $promotion)
                        <tr>
                            <td>{{$promotion->title}}</td>
                            <td><img src="{{asset($promotion->cover)}}"></td>
                            <td>
                                {{ strip_tags(substr($promotion->content, 0, 50)) }}...
                            </td>
                            <td>
                                @if($promotion->status == 0)
                                    <span style="color: red">Draft</span>
                                @else
                                    <span style="color: blue">public</span>
                                @endif
                            </td>
                            <td>{{$promotion->StartTime}}</td>
                            <td>{{$promotion->EndTime}}</td>
                            <td class="text-right">
                                <a href="{{route('promotions.show', $promotion->id)}}" class="btn btn-primary"
                                   style="margin-right:5px; float:left">Xem</a>
                                <a href="{{route('promotions.edit', $promotion->id)}}" class="btn btn-warning"
                                   style="margin-right:5px; float:left">Sửa</a>
                                <form action="{{route('promotions.destroy', $promotion->id)}}" method="post">
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">{{ $lsPromotion->links("pagination::bootstrap-4") }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
