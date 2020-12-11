@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>TÌM KIẾM</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Tìm kiếm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Search Results  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="product-item-filter">
                        <div class="col-12 col-sm-8 text-center text-sm-left">
                            <div class="toolbar-sorter-right">
                                <div class="search-product">
                                    <form action="{{route('searchHeader')}}" method="get" name="search">
                                        @csrf
                                        <input class="form-control" placeholder="Tìm kiếm..." type="text"
                                               name="search" style="margin-bottom: 0px" value="{{$search}}">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if($search==null)
                            <p> Bạn chưa nhập từ khóa tìm kiếm. Vui lòng nhập từ khóa tìm kiếm hoặc quay lại <a
                                    href="{{route('menu')}}">SHOP</a> để xem tất cả sản phẩm</p>
                        @elseif($lsProduct!=null)
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
                                                           title="Xem"><i class="fas fa-eye"></i></a></li>
                                                </ul>
                                                <a class="cart" onclick="AddCart({{$product->id}})"
                                                   href="javascript:">Thêm vào giỏ</a>
                                            </div>
                                        </div>
                                        <div class="why-text">
                                            <h4>{{$product->name}}</h4>
                                            <h5> {{number_format($product->price)}} VNĐ</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div style="width: 100%">
                                <div class="row">
                                    <div style="margin: 0 auto">
                                        {{$lsProduct->appends(['search' => $search])->links("pagination::bootstrap-4")}}
                                    </div>
                                </div>
                            </div>
                        @elseif($lsProduct==null)
                            <p>Không có sản phẩm nào trong danh mục này. Vui lòng nhập từ khóa khác hoặc quay lại <a
                                    href="{{route('menu')}}">SHOP</a> để xem tất cả sản phẩm</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Search Results -->

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
