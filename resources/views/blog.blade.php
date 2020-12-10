@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>TIN TỨC</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Tin tức</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Blog  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12">
                            @if($lsPromotion != null)
                                @foreach($lsPromotion as $promotion)
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="{{$promotion->cover}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h2 class="card-title">{{$promotion->title}}</h2>
                                            <p class="card-text">{{strip_tags(substr($promotion->content, 0,100))}}</p>
                                            <a href="{{route('blogDetail', $promotion->id)}}" class="btn hvr-hover"
                                               style="background-color: #b0b435; color: white">Xem thêm
                                                &rarr;</a>
                                            <div class="card-footer text-muted">
                                                Posted on {{date('d/m/Y H:i:s', strtotime($promotion->created_at))}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div style="margin: auto">
                                        {{$lsPromotion->appends(['search' => $search,'category' => $cate])->links("pagination::bootstrap-4")}}
                                    </div>
                                </div>
                            @else
                                <p>Không có bài viết nào trong danh mục này. Vui lòng nhập từ khóa khác.</p>
                            @endif
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12">
                            <!-- Search Widget -->
                            <div class="search-product">
                                <form action="{{route('blog')}}" method="get" name="search">
                                    @csrf
                                    <input class="form-control" placeholder="Tìm kiếm..." type="text"
                                           name="search"
                                           value="{{$search}}">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>

                            <!-- Categories Widget -->
                            <div class="filter-sidebar-left">
                                <div class="title-left">
                                    <h3>Danh Mục</h3>
                                </div>
                                <div class="category-menu">
                                    <form action="{{route('blog')}}" method="get">
                                        <div class="cate-name" style="width: 100%">
                                            <input type="submit" name="category" value="0" id="0">
                                            <label for="0">Tất cả bài viết</label>
                                        </div>
                                        @foreach($lsTag as $tag)
                                            <div class="cate-name" style="width: 100%">
                                                <input type="submit" name="category" value="{{$tag->id}}"
                                                       id="{{$tag->id}}">
                                                <label for="{{$tag->id}}">{{$tag->name}}</label>
                                                <small class="text-muted"> ({{$tag->promotions()->count()}})
                                                </small></button>
                                            </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog  -->
@endsection
