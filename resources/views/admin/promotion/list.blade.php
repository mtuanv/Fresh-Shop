@extends("layouts.adminlayout")
@section("title")
    Danh sách sự kiện
@endsection
@section("content")
@if(session('success1'))
    <script type="text/javascript">
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-3'
      },
      buttonsStyling: false
      })
      swalWithBootstrapButtons.fire(
        'Thành công',
        'Tin đã được thêm',
        'success'
      )
    </script>
@endif
@if(session('success2'))
    <script type="text/javascript">
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-3'
      },
      buttonsStyling: false
      })
      swalWithBootstrapButtons.fire(
        'Thành công',
        'Tin đã được sửa',
        'success'
      )
    </script>
@endif
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1 m-b-25">Danh sách sự kiện
                  <a class="btn btn-info searchbtn" onclick="showsearch()" style="color:white">
                  <i class="fas fa-search"></i>
                </a>
                </h2>
                <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" href="{{route('promotions.create')}}">
                    <i class="zmdi zmdi-plus"></i>Thêm sự kiện mới
                </a>
            </div>
        </div>
    </div>
    <div class="row search">
        <div class="col-lg-12">
            <div class="card md-3">
              <form action="{{route('promotions.index')}}" method="get" name="search">
                  @csrf
                <div class="card-header">Tìm kiếm <a href="javascript:void(1);" onclick="closesearch()" style="float:right;color:black"><i class="fas fa-times-circle fa-2x"></i></a></div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
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
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="tag"><b>Tag</b></label>
                        <select name="tag" class="form-control">
                          <option value="-">Tất cả</option>
                          @foreach($lsTag as $t)
                          <option value="{{$t->id}}" {{$tag == $t->id ? 'selected' : ''}}>{{$t->name}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                </div>
              </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="color: #fff">Tìm</button>
                    <button type="button" class="btn btn-danger" onclick="rs()">Nhập lại</button>
                  </div>

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
                                <button type="submit" class="btn btn-danger"  data-click="swal-submit">Draft</button>
                                @else
                                <button type="submit" class="btn btn-success" data-click="swal-submit">Public</button>
                                @endif

                            </form>
                            </td>
                            <td>
                                {{ strip_tags(substr($promotion->content, 0, 50)) }}...
                            </td>
                            <td>{{$promotion->StartTime}}</td>
                            <td>{{$promotion->EndTime}}</td>
                            <td>
                              <div style="display:inline-block">
                                <a href="{{route('promotions.edit', $promotion->id)}}" class="btn btn-warning"
                                   style="color: white" title="Sửa tag"><i class="fas fa-toolbox"></i></a>
                              </div>
                              <div style="display:inline-block">
                                <form action="{{route('promotions.destroy', $promotion->id)}}" method="post">
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-danger" title="Xoá tin tức" data-click="swal-danger"><i class="fas fa-times-circle"></i></button>
                                </form>
                              </div>
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
<style type="text/css">
  .search{
    display: none;
  }
  .show{
    display: block;
  }
  .hidd{
    display: none;
  }
</style>
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
                title: 'Đổi trạng thái',
                text: "Bạn có chắc chắn muốn đổi?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  swal.fire(form.submit())
                  swalWithBootstrapButtons.fire(
                    'Đổi thành công!',
                    'Tin tức đã thay đổi trang thái',
                    'success'
                  )
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancel thành công!',
                    'Tin tức chưa đổi trạng thái',
                    'error'
                  )
                }
})

      });
});
$(document).ready(function() {
    $('[data-click="swal-danger"]').click(function(e) {
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
                title: 'Xoá tin tức',
                text: "Bạn có chắc chắn muốn xoá?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  swal.fire(form.submit())
                  swalWithBootstrapButtons.fire(
                    'Xoá thành công!',
                    'Tin tức đã bị xoá',
                    'success'
                  )
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Huỷ thành công!',
                    'Tin tức còn nguyên vẹn',
                    'error'
                  )
                }
})

      });
});
  function rs(){
    document.search.title.value = "";
    document.search.tag.selectedIndex = 0;
    document.search.status.selectedIndex = 0;
  }
  function showsearch() {
        var x = document.getElementsByClassName('search');
        x[0].classList.add('show');
        var y = document.getElementsByClassName('searchbtn');
        y[0].classList.add('hidd');
    }
  function closesearch() {
    var x = document.getElementsByClassName('search');
    x[0].classList.remove('show');
    var y = document.getElementsByClassName('searchbtn');
    y[0].classList.remove('hidd');
  }
</script>
@endsection
