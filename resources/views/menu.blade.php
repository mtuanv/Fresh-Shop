@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>SHOP</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Menu Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <span>Sắp xếp </span>
                                    <select id="sort" class="selectpicker show-tick form-control" name="sort">
                                        <option value="-">Mặc định</option>
                                        <option value="1"> Giá cao →
                                            Giá
                                            thấp
                                        </option>
                                        <option value="2"> Giá thấp → Giá
                                            cao
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i
                                                class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i
                                                class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @foreach($lsProduct as $product)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        @foreach($product->images as $image)
                                                            <img src="{{asset($image->link)}}" class="img-fluid"
                                                                 alt="Image">
                                                        @endforeach
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="detail/{{$product->id}}"
                                                                       data-toggle="tooltip"
                                                                       data-placement="right"
                                                                       title="View"><i class="fas fa-eye"></i></a></li>
                                                            </ul>
                                                            <a class="cart" href="#">Thêm vào giỏ</a>
                                                        </div>
                                                    </div>
                                                    <div class="why-text">
                                                        <h4>{{$product->name}}</h4>
                                                        <h5> {{$product->price}} VND</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{$lsProduct->links("pagination::bootstrap-4")}}
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    @foreach($lsPr as $product)
                                        <div class="list-view-box">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                    <div class="products-single fix">
                                                        <div class="box-img-hover">
                                                            @foreach($product->images as $image)
                                                                <img src="{{asset($image->link)}}" class="img-fluid"
                                                                     alt="Image">
                                                            @endforeach
                                                            <div class="mask-icon">
                                                                <ul>
                                                                    <li><a href="#" data-toggle="tooltip"
                                                                           data-placement="right" title="View"><i
                                                                                class="fas fa-eye"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                    <div class="why-text full-width">
                                                        <h4>{{$product->name}}</h4>
                                                        <h5> {{$product->price}} VND</h5>
                                                        <p>{!! $product->description !!}</p>
                                                        <a class="btn hvr-hover" href="#">Thêm vào giỏ</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{$lsPr->links("pagination::bootstrap-4")}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="{{route('menu')}}" method="get" name="search">
                                @csrf
                                <input class="form-control" placeholder="Search here..." type="text" name="name">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Danh Mục</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree"
                                 id="list-group-men" data-children=".sub-men">

                                @foreach($lsTag as $tag)
                                    <a href="#" class="list-group-item list-group-item-action"
                                       data-filter=".{{$tag->id}}"> {{$tag->name}} <small
                                            class="text-muted">hashcode</small></a>
                                @endforeach

                            </div>
                        </div>
                        <div class="filter-price-left">
                            <div class="title-left">
                                <h3>Giá</h3>
                            </div>
                            <div class="price-box-slider">
                                <div id="slider-range"></div>
                                <p>
                                    <input type="text" id="amount" readonly
                                           style="border:0; color:#fbb714; font-weight:bold;">
                                    <button class="btn hvr-hover" type="submit">Khoảng giá</button>
                                </p>
                                {{--sửa slider trong file custom.js --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Menu Page -->
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection

