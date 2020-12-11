@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{$blog->title}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('blog')}}">Tin tức</a></li>
                        <li class="breadcrumb-item active">Bài viết</li>
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
                            <!-- Title -->
                            <h1 class="mt-4">{{$blog->title}}</h1>
                            <hr>
                            <!-- Date/Time -->
                            <p>Posted on {{date('d/m/Y', strtotime($blog->created_at))}}</p>
                            <hr>
                            <!-- Preview Image -->
                            <img class="img-fluid" src="{{asset($blog->cover)}}" alt="">
                            <hr>
                            <!-- Post Content -->
                            <p class="lead"> {!!$blog->content!!}</p>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12">
                            <!-- Search Widget -->
                            <div class="search-product">
                                <form action="{{route('blog')}}" method="get" name="search">
                                    @csrf
                                    <input type="hidden" name="category" value="{{$cate}}">
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
                                        <input type="hidden" name="category" value="{{$search}}">
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
    </div>
    <!-- End Blog  -->
@endsection
