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
                title: 'Sửa tag',
                text: "Bạn có chắc chắn muốn sửa?",
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
                    'Tag chưa bị sửa',
                    'error'
                  )
                }
})

      });
});
</script>
@endsection
