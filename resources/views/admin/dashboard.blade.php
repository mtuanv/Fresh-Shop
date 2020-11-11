@extends("layouts.adminlayout")
@section("title")
  Dashboard
@endsection
@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Thống kê</h2>
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
                        <h2>10368</h2>
                        <span>members online</span>
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
                        <h2>388,688</h2>
                        <span>items solid</span>
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
                        <h2>1,086</h2>
                        <span>members online</span>
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
                        <h2>$1,060,386</h2>
                        <span>total earnings</span>
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
        <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" href="#newacc">
            <i class="zmdi zmdi-plus"></i>Thêm tài khoản
        </a>
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
                        <th>Username</th>
                        <th>Chức danh</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lsUser as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->role_name == 'ADMIN' ? 'Quản lý' : 'Nhân viên'}}</td>
                        <td>
                          <a href="#update" class="btn btn-warning" style="float:left;margin-right: 5px">Sửa</a>
                          <a href="{{route('deleteuser', $user->id)}}" class="btn btn-danger" onclick="return confirm('Sure?')">Xoá</a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="card" id="newacc">
      <form method="POST" action="{{ route('register') }}">
        @csrf
      <div class="card-header">
          <strong>Tạo tài khoản mới</strong>
      </div>
      <div class="card-body card-block">
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="name" class=" form-control-label">Full Name</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="name" name="name" placeholder="Enter Full Name..." class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                  <input type="text" id="username" name="username" placeholder="Enter User Name..." class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username">
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
                  <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" required autocomplete="new-password">
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
                  <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required autocomplete="new-password">
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
  <div class="col-lg-6">
    <div class="card" id="update">
      <form action="{{ route('updateuser') }}" method="post">
        @csrf
      <div class="card-header">
          <strong>Sửa tài khoản</strong>
      </div>
      <div class="card-body card-block">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="id" class=" form-control-label">ID</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" id="id" name="id" placeholder="Enter ID..." class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}" required autocomplete="id" autofocus>
                @error('id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="name" class=" form-control-label">Full Name</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" id="name" name="name" placeholder="Enter Full Name..." class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name">
                @error('name')
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
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" required autocomplete="new-password">
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
                <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required autocomplete="new-password">
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
<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2020 .</p>
        </div>
    </div>
</div>
@endsection
