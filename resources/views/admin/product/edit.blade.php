@extends("layouts.adminlayout")
@section("title")
  Sửa sản phẩm
@endsection
@section("content")
<div class="row">
  <div class="col-lg-12">
    <div class="card" id="newacc">
      <form method="POST" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="card-header">
          <h3><strong>Sửa thông tin sản phẩm</strong></h3>
      </div>
      <div class="card-body card-block">
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="name" class=" form-control-label">Tên sản phẩm</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="name" name="name" placeholder="Enter Product Name..." class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}" required autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="price" class=" form-control-label">Giá tiền</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="name" name="price" placeholder="Enter Price..." class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}" required autocomplete="price">
                  @error('price')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="quantity" class=" form-control-label">Số lượng</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="quantity" name="quantity" placeholder="Enter Quantity..." class="form-control @error('quantity') is-invalid @enderror" value="{{$product->quantity}}" required autocomplete="quantity">
                  @error('quantity')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="description" class=" form-control-label">Mô tả</label>
              </div>
              <div class="col-12 col-md-9">
                  <textarea name="description" id="description" rows="9" placeholder="Enter Description...  " class="form-control ckeditor @error('description') is-invalid @enderror">{{$product->description}}</textarea>
                  @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="status" class=" form-control-label">Trạng thái</label>
              </div>
              <div class="col-12 col-md-9">
                  <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                      <option value="0">Please select</option>
                      <option value="1" {{$product->status == 1 ? 'selected' : ''}}>Hết hàng</option>
                      <option value="2" {{$product->status == 2 ? 'selected' : ''}}>Còn hàng</option>
                  </select>
                  @error('status')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
                <label for="tag" class=" form-control-label">Chọn tag</label>
            </div>
            <div class="col col-md-9">
                <select name="tags[]" id="multiple-select" multiple="" class="form-control @error('tags') is-invalid @enderror">
                  @foreach($lsTag as $tag)
                  <option value="{{$tag->id}}" @foreach($lsProductTag as $pt)@if($tag->id == $pt->tag_id && $product->id == $pt->product_id) selected @endif @endforeach>{{$tag->name}}</option>
                  @endforeach
                </select>
                @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="file-multiple-input" class=" form-control-label">Chọn ảnh</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="file" id="file-multiple-input" name="images[]" multiple class="form-control-file @error('images') is-invalid @enderror">
                @foreach($product->images as $image)
                 <img src="{{asset($image->link)}}" alt="" style="height: 100px">
                @endforeach
                @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa fa-dot-circle-o"></i> Submit
          </button>
          <button type="reset" class="btn btn-danger btn-sm">
              <i class="fa fa-ban"></i> Reset
          </button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection
