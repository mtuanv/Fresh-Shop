@extends("layouts.adminlayout")
@section("title")
  Dashboard
@endsection
@section("content")
<div class="back" onclick="closse1()">
</div>
@if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Thống kê tháng</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                    <div class="text">
                        <h2>{{$order}}</h2>
                        <span>đơn hàng được đặt</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                    <div class="text">
                        <h2>{{$corder}}</h2>
                        <span>đơn hàng hoàn thành</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-money"></i>
                    </div>
                    <div class="text">
                        <h2>{{number_format($money)}} <span style="font-size:10px;color:white">VNĐ</span>  </h2>
                        <span>tổng doanh số tháng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="col-sm-6 col-lg-3">
          <div class="overview-item overview-item--c2">
              <div class="overview__inner">
                  <div class="overview-box clearfix">
                      <div class="icon">
                          <i class="zmdi zmdi-shopping-cart"></i>
                      </div>
                      <div class="text">
                          <h2>{{$sumsale}}</h2>
                          <span>sản phẩm được bán</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="overview-wrap">
        <h2 class="title-1 m-b-25">Danh sách nhân viên</h2>
        @if(Auth::user()->role_name == 'ADMIN')
        <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" onclick="popup1()" style="color:white">
            <i class="zmdi zmdi-plus"></i>Thêm tài khoản
        </a>
        @endif
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Tên</th>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <th class="text-center">Username</th>
                        @endif
                        <th class="text-center">Chức danh</th>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <th class="text-center">Xoá</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($lsUser as $user)
                    <tr>
                        <td class="text-center">{{$user->id}}</td>
                        <td class="text-center">{{$user->name}}</td>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <td class="text-center">{{$user->username}}</td>
                        @endif
                        <td class="text-center">{{$user->role_name == 'ADMIN' ? 'Quản lý' : 'Nhân viên'}}</td>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <td class="text-center">
                          <div style="display:inline-block">
                            <form method="post" action="{{route('editpw').'#changepw'}}"  class="form-inline">
                              @csrf
                              <input type="hidden" name="id" value="{{$user->id}}"/>
                              <input type="hidden" name="name" value="{{$user->name}}"/>
                              <input type="hidden" name="username" value="{{$user->username}}"/>
                              <button type="submit" class="btn btn-info mb-2" style="color: white" title="Đổi mật khẩu"><i class="fas fa-key"></i></button>
                            </form>
                          </div>
                          <div style="display:inline-block">
                            <form method="post" action="{{route('edituser').'#edit'}}"  class="form-inline">
                              @csrf
                              <input type="hidden" name="id" value="{{$user->id}}"/>
                              <input type="hidden" name="name" value="{{$user->name}}"/>
                              <input type="hidden" name="username" value="{{$user->username}}"/>
                              <button type="submit" class="btn btn-warning mb-2" style="color: white" title="Sửa tài khoản"><i class="fas fa-toolbox"></i></button>
                            </form>
                          </div>
                          @if($user->role_name == 'ADMIN')
                          @else
                          <div style="display:inline-block">
                            <form method="get" action="{{route('deleteuser', $user->id)}}"  class="form-inline">
                              @csrf
                              <button type="button" title="Xoá tài khoản" class="btn btn-danger" data-click="swal-danger"><i class="fas fa-times-circle"></i></button>
                            </form>
                          </div>
                          @endif
                        </td>
                        @endif
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style type="text/css">
.popup1{
  position: fixed;
  top: 30%;
  right:24%;
  display: none;
  z-index: 5;
  width: 50%;
}
.back{
    background-color: #000000;
    opacity: 0.8;
    position: fixed;
    top:0;
    left:0;
    width: 100%;
    height: 100%;
    display: none;
    z-index: 4;
}
.show{
    display: block;
}
.close_popup1{
  float: right;
  color: black;
}
.close_popup1:hover{
  color: red;
}
.blurdt{
  display: none;
}
</style>
      <!-- Swal.fire(form.submit()) -->
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
                title: 'Xoá tài khoản',
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
                    'Tài khoản đã bị xoá',
                    'success'
                  )
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Huỷ thành công!',
                    'Tài khoản còn nguyên vẹn',
                    'error'
                  )
                }
})

      });
});
</script>
@if(Auth::user()->role_name == 'ADMIN')


<script type="text/javascript">
function popup1() {
      var x = document.getElementsByClassName('popup1');
      x[0].classList.add('show');
      var y = document.getElementsByClassName('back');
      y[0].classList.add('show');
      var z = document.getElementsByClassName('header-desktop');
      z[0].classList.add('blurdt');
  }
  function closse1() {
      var x = document.getElementsByClassName('popup1');
      x[0].classList.remove('show');
      var y = document.getElementsByClassName('back');
      y[0].classList.remove('show');
      var z = document.getElementsByClassName('header-desktop');
      z[0].classList.remove('blurdt');
  }
</script>
<div class="popup1">
    <div class="card">
      <form method="POST" action="{{ route('register') }}">
        @csrf
      <div class="card-header">
          <strong>Tạo tài khoản mới</strong>
          <a href="javascript:void(1);" class="close_popup1" onclick="closse1()"><i class="fas fa-times-circle fa-2x"></i></a>
      </div>
      <div class="card-body card-block">
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="name" class=" form-control-label">Full Name</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" name="name" placeholder="Enter Full Name..." class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="username" class=" form-control-label">User Name</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" name="username" placeholder="Enter User Name..." class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username">
                  @error('username')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="password" class=" form-control-label">Password</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" required autocomplete="new-password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="password-confirm" class=" form-control-label">Confirm Password</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
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
@if(strpos(url()->current(), '/admin/dashboard/user_edit'))
<div class="row">
  <div class="col-lg-12">
    <div class="card" id="edit">
      <form action="{{ route('updateuser') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $eid }}">
      <div class="card-header">
          <strong>Sửa tài khoản</strong>
      </div>
      <div class="card-body card-block">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="name" class=" form-control-label">Full Name</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="name" placeholder="Enter Full Name..." class="form-control @error('name') is-invalid @enderror" value="{{ $ename }}" required autocomplete="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="avatar" class=" form-control-label">New Avatar</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="file" name="avatar" class="form-control-file">
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="name" class=" form-control-label">UserName</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="username" placeholder="User Name..." class="form-control" value="{{ $eun }}" disabled autocomplete="username">
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
@endif
@if(strpos(url()->current(), '/admin/dashboard/change_password'))
<div class="row">
  <div class="col-lg-12">
    <div class="card" id="changepw">
      <form action="{{ route('savechangepw') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $eid }}">
      <div class="card-header">
          <strong>Sửa tài khoản</strong>
      </div>
      <div class="card-body card-block">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="name" class=" form-control-label">Full Name</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $ename }}" disabled autocomplete="name">
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="password" class=" form-control-label">Password</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="password-confirm" class=" form-control-label">Confirm Password</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
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
@endif
@endif
<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2020 FreshShop</p>
        </div>
    </div>
</div>

@endsection
