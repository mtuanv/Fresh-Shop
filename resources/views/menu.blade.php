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
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <span>Sắp xếp</span>
                                    @if($sort == 0)
                                        <form action="{{route('menu')}}" method="get">
                                            @csrf
                                            <input type="hidden" name="sort" value="1">
                                            <button class="btn menu-sort-btn" type="submit"
                                                    title="Danh mục sản phẩm"><b>Mặc định</b>
                                            </button>
                                        </form>
                                    @endif
                                    @if($sort == 1)
                                        <form action="{{route('menu')}}" method="get">
                                            @csrf
                                            <input type="hidden" name="sort" value="2">
                                            <button class="btn menu-sort-btn" type="submit"
                                                    title="Giá từ cao đến thấp"><b>Giá cao → Giá
                                                    thấp</b></button>
                                        </form>
                                    @endif
                                    @if($sort == 2)
                                        <form action="{{route('menu')}}" method="get">
                                            @csrf
                                            <input type="hidden" name="sort" value="0">
                                            <button class="btn menu-sort-btn" type="submit"
                                                    title="Giá từ thấp đến cao"><b>Giá thấp → Giá
                                                    cao</b></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <p style="float:right">Hiển thị {{$lsProduct->count()}} kết quả</p>
                        </div>
                        <div class="product-categorie-box">
                            <div class="row">
                                @if($lsProduct!=null)
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
                                                            <li><a href="{{route('detail', $product->id)}}"
                                                                   data-toggle="tooltip"
                                                                   data-placement="right"
                                                                   title="Xem"><i class="fas fa-eye"></i></a>
                                                            </li>
                                                        </ul>
                                                        <a class="cart" onclick="AddCart({{$product->id}})"
                                                           href="javascript:">Thêm vào giỏ</a>
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4><a href="{{route('detail', $product->id)}}"
                                                           style="color: black; line-height: 1.8rem; height: 1.8rem; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1"
                                                           title="{{$product->name}}">{{$product->name}}</a></h4>
                                                    <h5> {{number_format($product->price)}} VNĐ</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div style="width: 100%">
                                        <div class="row">
                                            <div style="margin: auto">
                                                {{$lsProduct->appends(['search' => $search,'sort' => $sort, 'category' => $cate, 'minPrice'=> $min, 'maxPrice'=> $max])->links("pagination::bootstrap-4")}}
                                            </div>
                                        </div>
                                    </div>
                                @elseif($lsProduct==null)
                                    <p>Không có sản phẩm nào trong danh mục này. Vui lòng nhập từ khóa khác.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="{{route('menu')}}" method="get">
                                @csrf
                                <input class="form-control" placeholder="Tìm kiếm..." type="text"
                                       name="search"
                                       value="{{$search}}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Danh Mục</h3>
                            </div>
                            <div class="category-menu">
                                <form action="{{route('menu')}}" method="get">
                                    <div class="cate-name" style="width: 100%">
                                        <input type="submit" name="category" value="0" id="0">
                                        <label for="0">Tất cả sản phẩm</label>
                                    </div>
                                    @foreach($lsTag as $tag)
                                        <div class="cate-name" style="width: 100%">
                                            <input type="submit" name="category" value="{{$tag->id}}"
                                                   id="{{$tag->id}}">
                                            <label for="{{$tag->id}}">{{$tag->name}}</label>
                                            <small class="text-muted"> ({{$tag->products()->count()}})</small></button>
                                        </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <div class="filter-price-left">
                            <div class="title-left">
                                <h3>Giá</h3>
                            </div>
                            <div class="price-box-slider">
                                <div id="slider-range"></div>
                                <form action="{{route('menu')}}" method="get">
                                    @csrf
                                    <input type="text" id="amount" readonly
                                           style="border:0; color:#fbb714; font-weight:bold; margin-top: 25px; width: 70%">
                                    <input type="hidden" id="minPrice" name="minPrice">
                                    <input type="hidden" id="maxPrice" name="maxPrice">
                                    <button style="float: right; color: white;margin-top: 15px"
                                            class="btn hvr-hover"
                                            type="submit"
                                            onclick="filter()">
                                        Lọc
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Menu Page -->
    <script>
        var active
    </script>

    <script type="text/javascript">
        /* ..............................................
       Slider Range
       ................................................. */
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 300000,
                values: [0, 300000],
                slide: function (event, ui) {
                    $("#amount").val(ui.values[0] + " VND" + " - " + ui.values[1] + " VND");
                }
            });
            $("#amount").val($("#slider-range").slider("values", 0) + " VND" + " - " + $("#slider-range").slider("values", 1) + " VND");
        });

        function filter() {
            $("#minPrice").val($("#slider-range").slider("values", 0));
            $("#maxPrice").val($("#slider-range").slider("values", 1));
        }
    </script>

    <!---Them gio hang --->
    <script type="text/javascript">
        function AddCart(id) {
            $.ajax({
                url: 'Add-Cart/' + id,
                type: 'GET',
            }).done(function (response) {
                RenderCart(response);
                alertify.success('Thêm giỏ hàng thành công');
            });
        }

        function RenderCart(response) {
            $("#cart-item-change").empty();
            $("#cart-item-change").html(response);
            $("#total-quantity-show").text($("#total-quantity-cart").val());
        }
    </script>
@endsection
