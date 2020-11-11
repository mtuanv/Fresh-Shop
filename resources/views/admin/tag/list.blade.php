@extends("layouts.adminlayout")
@section("title")
  Danh sách tag
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
        <h2 class="title-1 m-b-25">Danh sách tag</h2>
        <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" href="{{route('tags.create')}}">
            <i class="zmdi zmdi-plus"></i>Thêm tag mới
        </a>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3>Tìm kiếm</h5>
          <form action="{{route('tags.index')}}" method="get">
            @csrf
            <div class="form-group">
              <label for="title"><b>Tên Tag</b></label>
              <input type="text" class="form-control" name="name" value="{{$name}}">
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
                        <th>Tên</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lsTag as $tag)
                  <tr>
                      <td>{{$tag->id}}</td>
                      <td>{{$tag->name}}</td>
                      <td>
                        <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-warning" style="float:left;margin-right: 5px">Sửa</a>
                        <form action="{{route('tags.destroy', $tag->id)}}" method="post">
                          @csrf
                          @method('Delete')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Sure?')">Delete</button>
                        </form>
                      </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="3">{{ $lsTag->appends(['name' => $name])->links("pagination::bootstrap-4") }}</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
