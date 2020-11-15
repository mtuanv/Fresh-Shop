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
        @if(Auth::user()->role_name == 'ADMIN')
        <a class="au-btn au-btn-icon au-btn&#45;&#45;blue" href="#newacc">
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
                        <th>ID</th>
                        <th>Tên</th>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <th>Username</th>
                        @endif
                        <th>Chức danh</th>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <th>Quản lý</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($lsUser as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <td>{{$user->username}}</td>
                        @endif
                        <td>{{$user->role_name == 'ADMIN' ? 'Quản lý' : 'Nhân viên'}}</td>
                        @if(Auth::user()->role_name == 'ADMIN')
                        <td>
                          <form method="post" action="{{route('edituser')}}" name="getif">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}"/>
                            <input type="hidden" name="name" value="{{$user->name}}"/>
                            <input type="hidden" name="username" value="{{$user->username}}"/>
                            <button type="submit" class="btn btn-warning" style="float:left;margin-right: 5px; color: white">Sửa</button>
                          </form>
                          <!-- <a href="#update" class="btn btn-warning" style="float:left;margin-right: 5px">Sửa</a> -->
                          <a href="{{route('deleteuser', $user->id)}}" class="btn btn-danger" onclick="return confirm('Sure?')">Xoá</a>
                        </td>
                        @endif
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if(Auth::user()->role_name == 'ADMIN')
<div class="row">
  <div class="col-lg-6">
    <div class="card">
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
                  <input type="text" name="name" placeholder="Enter Full Name..." class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <!-- <div class="row form-group">
              <div class="col col-md-3">
                  <label for="avatar" class=" form-control-label">Avatar</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="file" name="avatar" class="form-control-file">
              </div>
          </div> -->
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
  <div class="col-lg-6">
    <div class="card">
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
<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2020 .</p>
        </div>
    </div>
</div>

@endsection
