@extends("layouts.adminlayout")
@section("title")
    Thêm mới sự kiện
@endsection
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="newacc">
                <form method="POST" action="{{route('promotions.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3><strong>Thêm sự kiện mới</strong></h3>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="title" class=" form-control-label">Tên sự kiện</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="title" name="title" placeholder="Enter Event Title..."
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="cover" class=" form-control-label">Chọn ảnh</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="cover" name="cover"
                                       class="form-control-file @error('cover') is-invalid @enderror">
                                @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="content" class=" form-control-label">Mô tả</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="content" id="content" rows="9" placeholder="Enter Content...  "
                                          class="form-control ckeditor @error('content') is-invalid @enderror"></textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="status" class=" form-control-label">Trạng thái</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                    <option value="-">Please select</option>
                                    <option value="1">Public</option>
                                    <option value="0">Draft</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="StartTime">Start Time</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input class="form-control" id="StartTime" name="StartTime">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="Endtime">End Time</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input class="form-control" id="EndTime" name="EndTime">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="tag" class=" form-control-label">Chọn tag</label>
                            </div>
                            <div class="col col-md-9">
                                <select name="tags[]" id="multiple-select" multiple=""
                                        class="form-control @error('tags') is-invalid @enderror">
                                    @foreach($lsTag as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm"  data-click="swal-submit">
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
                    title: 'Thêm tin tức',
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
                        'Tin tức chưa được thêm',
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
    <script type="text/javascript">
        $('#StartTime').datetimepicker({value:Date.now()});
        $('#EndTime').datetimepicker({value:Date.now()});
    </script>
@endsection
