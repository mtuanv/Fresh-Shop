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
                    <form action="{{route('promotions.index')}}" method="get" name="search">
                        @csrf
                        <div class="form-group">
                            <label for="title"><b>Tên Sự kiện</b></label>
                            <input type="text" class="form-control" name="title" value="{{$title}}">
                        </div>
                        <div class="form-group">
                          <label for="status"><b>Status</b></label>
                          <select name="status" class="form-control">
                            <option value="-">Tất cả</option>
                            <option value="1" {{$status == '1' ? 'selected' : ''}}>Public</option>
                            <option value="0" {{$status == '0' ? 'selected' : ''}}>Draft</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tag"><b>Tag</b></label>
                          <select name="tag" class="form-control">
                            <option value="-">Tất cả</option>
                            @foreach($lsTag as $t)
                            <option value="{{$t->id}}" {{$tag == $t->id ? 'selected' : ''}}>{{$t->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-info" style="color: #fff">Tìm</button>
                        <button type="button" class="btn btn-danger" onclick="rs()">Nhập lại</button>
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
                        <th>Tag</th>
                        <th>Trạng thái</th>
                        <th>Mô tả</th>
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
                            <td class="text-right">
                              @foreach($promotion->tags as $pt)
                                <span class="badge badge-primary">{{($pt->name)}}</span>
                              @endforeach
                            </td>
                            <td>
                              <form action="{{route('changestt', $promotion->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="
                                @if($promotion->status == 0)
                                  1
                                @else
                                  0
                                @endif
                                ">
                                @if($promotion->status == 0)
                                <button type="submit" class="btn btn-danger">Draft</button>
                                @else
                                <button type="submit" class="btn btn-success">Public</button>
                                @endif

                            </form>
                            </td>
                            <td>
                                {{ strip_tags(substr($promotion->content, 0, 50)) }}...
                            </td>                
                            <td>{{$promotion->StartTime}}</td>
                            <td>{{$promotion->EndTime}}</td>
                            <td class="text-right">
                                <a href="{{route('promotions.edit', $promotion->id)}}" class="btn btn-warning"
                                   style="margin-right:5px; float:left;color: white">Sửa</a>
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
                        <td colspan="7">{{ $lsPromotion->appends(['title' => $title, 'status' => $status, 'tag' => $tag])->links("pagination::bootstrap-4") }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function rs(){
          document.search.title.value = "";
          document.search.tag.selectedIndex = 0;
          document.search.status.selectedIndex = 0;
        }
    </script>
@endsection
