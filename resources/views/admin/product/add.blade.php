@extends("layouts.adminlayout")
@section("title")
  Thêm mới sản phẩm
@endsection
@section("content")
<div class="row">
  <div class="col-lg-12">
    <div class="card" id="newacc">
      <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf
      <div class="card-header">
          <h3><strong>Thêm sản phẩm mới</strong></h3>
      </div>
      <div class="card-body card-block">
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="name" class=" form-control-label">Tên sản phẩm</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="name" name="name" placeholder="Enter Product Name..." class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                  <input type="text" id="name" name="price" placeholder="Enter Price..." class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required autocomplete="price">
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
                  <input type="text" id="quantity" name="quantity" placeholder="Enter Quantity..." class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required autocomplete="quantity">
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
                  <textarea name="description" id="description" rows="9" placeholder="Enter Description...  " class="form-control ckeditor @error('description') is-invalid @enderror"></textarea>
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
                      <option value="1">Hết hàng</option>
                      <option value="2">Còn hàng</option>
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
                  <option value="{{$tag->id}}">{{$tag->name}}</option>
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
                @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="discount" class=" form-control-label">Giảm giá</label>
            </div>
            <div class="col-12 col-md-9">
                <select name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror">
                    <option value="0">Please select</option>
                    <option value="0">0%</option>
                    <option value="5">5%</option>
                    <option value="10">10%</option>
                    <option value="15">15%</option>
                    <option value="20">20%</option>
                    <option value="25">25%</option>
                    <option value="30">30%</option>
                    <option value="35">35%</option>
                    <option value="40">40%</option>
                    <option value="45">45%</option>
                    <option value="50">50%</option>
                </select>
                @error('discount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm" data-click="swal-submit">
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
$(document).ready(function() {
    $('[data-click="swal-submit"]').click(function(e) {
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
                title: 'Thêm sản phẩm',
                text: "Bạn có chắc chắn muốn thêm?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  form.submit()
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancel thành công!',
                    'Sản phẩm chưa được thêm',
                    'error'
                  )
                }
})

      });
});
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection
