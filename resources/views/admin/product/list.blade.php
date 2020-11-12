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
          <form action="{{route('products.index')}}" method="get">
            @csrf
            <div class="form-group">
              <label for="title"><b>Tên Sản Phẩm</b></label>
              <input type="text" class="form-control" name="name" value="">
            </div>
            <div class="form-group">
              <label for="title"><b>Giá Sản Phẩm</b></label>
              <input type="text" class="form-control" name="price" value="">
            </div>
            <div class="form-group">
              <label for="lstag"><b>Tag</b></label>
              <select name="lstag[]" class="form-control" multiple>
                @foreach($lsTag as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="status"><b>Trạng thái</b></label>
              <select name="status" class="form-control">
                <option value="-">Tất cả</option>                
                <option value="1"  >Hết hàng</option>
                <option value="2"  >Còn hàng</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sort"><b>Sắp xếp</b></label>
              <select name="sort" class="form-control">
                <option value="-">Không</option>
                <option value="0" {{$lsRequest['sort'] == '0' ? 'selected' : ''}}>Giá: Thấp đến Cao</option>
                <option value="1" {{$lsRequest['sort'] == '1' ? 'selected' : ''}}>Giá: Cao đến Thấp</option>
                <option value="2" {{$lsRequest['sort'] == '2' ? 'selected' : ''}}>Tên: A đến Z</option>
                <option value="3" {{$lsRequest['sort'] == '3' ? 'selected' : ''}}>Tên: Z đến A</option>
                <option value="4" {{$lsRequest['sort'] == '4' ? 'selected' : ''}}>Số lượng: Thấp đến Cao</option>
                <option value="5" {{$lsRequest['sort'] == '5' ? 'selected' : ''}}>Số lượng: Cao đến Thấp</option>
              </select>
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
                        @foreach($product->tags as $tag)
                          <span class="badge badge-primary">{{($tag->name)}}</span>
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
                    <td colspan="8">{{ $lsProduct->links("pagination::bootstrap-4") }}</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
