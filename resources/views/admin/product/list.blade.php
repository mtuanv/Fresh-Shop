@extends("layouts.adminlayout")
@section("title")
  Danh sách sản phẩm
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
        <h2 class="title-1 m-b-25">Danh sách sản phẩm</h2>
        <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" href="{{route('products.create')}}">
            <i class="zmdi zmdi-plus"></i>Thêm sản phẩm mới
        </a>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3>Tìm kiếm</h5>
          <form action="{{route('products.index')}}" method="get" name="search">
            @csrf
            <div class="form-group">
              <label for="title"><b>Tên Sản Phẩm</b></label>
              <input type="text" class="form-control" name="name" value="{{$name}}">
            </div>
            <div class="form-group">
              <label for="title"><b>Giá Sản Phẩm</b></label>
              <input type="text" class="form-control" name="price" value="{{$price}}">
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
            <div class="form-group">
              <label for="status"><b>Trạng thái</b></label>
              <select name="status" class="form-control">
                <option value="-">Tất cả</option>
                <option value="1" {{$status == '1' ? 'selected' : ''}}>Hết hàng</option>
                <option value="2" {{$status == '2' ? 'selected' : ''}}>Còn hàng</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sort"><b>Sắp xếp</b></label>
              <select name="sort" class="form-control">
                <option value="-">Không</option>
                <option value="0" {{$sort == '0' ? 'selected' : ''}}>Giá: Thấp đến Cao</option>
                <option value="1" {{$sort == '1' ? 'selected' : ''}}>Giá: Cao đến Thấp</option>
                <option value="2" {{$sort == '2' ? 'selected' : ''}}>Tên: A đến Z</option>
                <option value="3" {{$sort == '3' ? 'selected' : ''}}>Tên: Z đến A</option>
                <option value="4" {{$sort == '4' ? 'selected' : ''}}>Số lượng: Thấp đến Cao</option>
                <option value="5" {{$sort == '5' ? 'selected' : ''}}>Số lượng: Cao đến Thấp</option>
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
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Tag</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lsProduct as $product)
                  <tr>
                      <td>{{$product->name}}</td>
                      <td>{{$product->price}}</td>
                      <td>@if($product->quantity < 0)

                      @else
                        {{$product->quantity}}
                      @endif</td>
                      <td>@if($product->status == 2)
                        Còn hàng
                      @else
                        Hết hàng
                      @endif</td>
                      <td class="text-right">
                        @foreach($product->tags as $pt)
                          <span class="badge badge-primary">{{($pt->name)}}</span>
                        @endforeach
                      </td>
                      <td class="text-right">
                        @foreach($product->images as $image)
                         <img src="{{asset($image->link)}}" alt="">
                        @endforeach
                      </td>

                      <td>
                        {!! substr($product->description, 0, 50) !!}...
                      </td>
                      <td class="text-right">
                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning" style="margin-right:5px; float:left">Sửa</a>
                        <form action="{{route('products.destroy', $product->id)}}" method="post">
                          @csrf
                          @method('Delete')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Sure?')">Xoá</button>
                        </form>
                        <span style="clear:left"></span>
                      </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="8">{{ $lsProduct->appends(['name' => $name, 'price' => $price, 'status' => $status, 'tag' => $tag, 'sort' => $sort])->links("pagination::bootstrap-4") }}</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function rs(){
      document.search.name.value = "";
      document.search.price.value = "";
      document.search.tag.selectedIndex = 0;
      document.search.status.selectedIndex = 0;
      document.search.sort.selectedIndex = 0;
    }
</script>
@endsection
