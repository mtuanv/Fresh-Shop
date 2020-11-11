@extends("layouts.adminlayout")
@section("title")
  Cập nhật tag
@endsection
@section("content")
@if ($errors->any())
  <div class="alert alert-danger">
      <ul style="list-style:none">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<div class="row">
  <div class="col-lg-12">
    <div class="card" id="newacc">
      <form method="POST" action="{{route('tags.update', $tag->id)}}">
        @csrf
        @method('PUT')
      <div class="card-header">
          <h3><strong>Sửa tag</strong></h3>
      </div>
      <div class="card-body card-block">
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="name" class=" form-control-label">Tag Name</label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="name" name="name" placeholder="Enter Tag Name..." class="form-control @error('name') is-invalid @enderror" value="{{$tag->name}}" required autocomplete="name" autofocus>
                  @error('tag')
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
@endsection
