@extends("layouts.adminlayout")
@section("title")
  Danh sách tag
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
        'Tag đã được thêm',
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
        'Tag đã được sửa',
        'success'
      )
    </script>
@endif
<div class="row">
    <div class="col-lg-12">
      <div class="overview-wrap">
        <h2 class="title-1 m-b-25">Danh sách tag
          <a class="btn btn-info searchbtn" onclick="showsearch()" style="color:white">
            <i class="fas fa-search"></i>
          </a></h2>
        <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" href="{{route('tags.create')}}">
            <i class="zmdi zmdi-plus"></i>Thêm tag mới
        </a>
      </div>
    </div>
</div>
<div class="row search">
    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="card mb-3">
          <div class="card-header">Tìm kiếm <a href="javascript:void(1);" onclick="closesearch()" style="float:right;color:black"><i class="fas fa-times-circle fa-2x"></i></a></div>
          <form action="{{route('tags.index')}}" method="get" name="search">
            @csrf
          <div class="card-body ">
              <div class="form-group">
                <label for="title"><b>Tên Tag</b></label>
                <input type="text" class="form-control" name="name" value="{{$name}}">
              </div>
          </div>
           <div class="card-footer">  <button type="submit" class="btn btn-primary" style="color: #fff">Tìm</button>
           <button type="button" class="btn btn-danger" onclick="rs()">Nhập lại</button></div>
           </form>
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
                        <div style="display:inline-block">
                          <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-warning" style="color:white" title="Sửa tag"><i class="fas fa-toolbox"></i></a>
                        </div>
                        <div style="display:inline-block">
                          <form action="{{route('tags.destroy', $tag->id)}}" method="post">
                            @csrf
                            @method('Delete')
                            <button type="submit" class="btn btn-danger" title="Xoá tag" data-click="swal-danger"><i class="fas fa-times-circle"></i></button>
                          </form>
                        </div>

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
                title: 'Xoá tag',
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
                    'Tag đã bị xoá',
                    'success'
                  )
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Huỷ thành công!',
                    'Tag còn nguyên vẹn',
                    'error'
                  )
                }
})

      });
});
    function rs(){
      document.search.name.value = "";
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
