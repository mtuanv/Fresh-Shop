@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{$product->name}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('menu')}}">Shop</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    @foreach($product->images as $image)
                        <img src="{{asset($image->link)}}" class="img-fluid" alt="Image">
                    @endforeach
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{$product->name}}</h2>
                        <h5>
                            {{$product->price}} VND
                        </h5>
                        <p class="available-stock"><span> Có sẵn hơn {{$product->quantity}} sản phẩm</span>
                        <p>
                        <h4>Mô tả:</h4>
                        <p>{!! $product->description !!}</p>
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Số lượng</label>
                                    <input class="form-control" value="1" min="1" max="{{$product->quantity}}"
                                           type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a class="btn hvr-hover" data-fancybox-close="" onclick="AddCart({{$product->id}})"
                                   href="javascript:">Thêm vào giỏ</a>
                            </div>
                        </div>

                        <div class="add-to-btn">
                            <div class="share-bar">
                                <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-instagram"
                                                                     aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{--                show rate--}}
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">
                            <h2>Đánh giá</h2>
                        </div>
                        <div class="card-body">
                            @if($lsFb->count()==0)
                                <p style="font-size: 20px">Chưa có đánh giá nào</p>
                                <p style="font-size: 20px; color: #b0b435">Hãy Là Người Đầu Tiên Nhận Xét
                                    “{{$product->name}}”</p>
                                <p>Email (số điện thoại) của bạn sẽ không được hiển thị công khai.
                                    Các trường bắt buộc được đánh dấu *</p>
                            @else
                                @foreach($lsFb as $fb)
                                    <div class="media mb-3">
                                        <div class="mr-2">
                                            <img class="rounded-circle border p-1"
                                                 src="{{asset('shop/images/ava.jpg')}}"
                                                 alt="Generic placeholder image" style="max-height: 64px">
                                        </div>
                                        <div class="media-body">
                                            <p>{{$fb->content}}</p>
                                            <small class="text-muted">Posted by {{$fb->name}}
                                                on {{date('d/m/Y', strtotime($fb->created_at))}}</small>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @endif
                        </div>
                        <div
                            style="margin: auto; margin-top: -1.25rem; margin-bottom: 1.25rem">{{$lsFb->links("pagination::bootstrap-4")}}</div>

                    </div>
                </div>
                {{--                end show rate--}}
                {{--                send rate--}}
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">
                            <h2>Gửi đánh giá</h2>
                        </div>
                        <div class="card-body">
                            <form id="contactForm">
                                @csrf
                                <input type="hidden" id="product_id" value="{{$product->id}}">
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom: 10px">
                                        <div class="form-group">
                                            <input class="form-control" id="fbname" name="fbname" type="text"
                                                   placeholder="Tên*" required data-error="Vui lòng nhập tên">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 10px">
                                        <div class="form-group">
                                            <input class="form-control" id="fbcontact" name="fbcontact" type="text"
                                                   placeholder="Email hoặc số điện thoại*" required
                                                   data-error="Vui lòng nhập email hoặc số điện thoại">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 10px">
                                        <div class="form-group">
                                            <p>Đánh giá của bạn</p>
                                            <div class="rating">
                                                <input type="radio" class="star" name="rating" value="5" id="5"><label
                                                    for="5">☆</label>
                                                <input type="radio" class="star" name="rating" value="4" id="4"><label
                                                    for="4">☆</label>
                                                <input type="radio" class="star" name="rating" value="3" id="3"><label
                                                    for="3">☆</label>
                                                <input type="radio" class="star" name="rating" value="2" id="2"><label
                                                    for="2">☆</label>
                                                <input type="radio" class="star" name="rating" value="1" id="1"><label
                                                    for="1">☆</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 10px">
                                        <div class="form-group">
                                            <textarea class="form-control" id="fbmessage"
                                                      placeholder="Nhận xét của bạn*" rows="4"
                                                      data-error="Vui lòng nhập nội dung" required></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="submit-button text-center">
                                            <button class="btn hvr-hover" id="send_feedback" type="button">Gửi đi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--                end send rate--}}
            </div>


            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Sản phẩm tương tự</h1>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        @foreach($product->tags as $tag)
                            @foreach($tag->products()->orderBy('created_at', 'desc')->take(5)->get() as $product)
                                <div class="item">
                                    <div class="products-single fix">
                                        <div class="box-img-hover">
                                            @foreach($product->images as $image)
                                                <img src="{{asset($image->link)}}" class="img-fluid" alt="Image">
                                            @endforeach
                                            <div class="mask-icon">
                                                <ul>
                                                    <li><a href="{{route('detail', $product->id)}}"
                                                           data-toggle="tooltip" data-placement="right"
                                                           title="View"><i
                                                                class="fas fa-eye"></i></a></li>
                                                </ul>
                                                <a class="cart" onclick="AddCart({{$product->id}})"
                                                   href="javascript:">Thêm vào giỏ</a>
                                            </div>
                                        </div>
                                        <div class="why-text">
                                            <h4>{{$product->name}}</h4>
                                            <h5> {{$product->price}} VND</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Detail -->

    {{--Send Email--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $("#send_feedback").click(function () {
                var data = {
                    "name": $("#fbname").val(),
                    "_token": "{{ csrf_token() }}",
                    "rating": $('input[name="rating"]:checked').val(),
                    "contact": $("#fbcontact").val(),
                    "content": $("#fbmessage").val(),
                    "product_id": $("#product_id").val()
                };
                $.ajax({
                    type: "GET",
                    url: "../api/feedback",
                    data: data,
                    success: function (response) {
                        alert("Gửi đánh giá thành công ! Cảm ơn sự quan tâm của quý khách");
                    },
                    error: function (r) {
                        alert("Gửi đánh giá thất bại . . . Mời điền lại mẫu đánh giá");
                    }
                });
            });
        });
    </script>

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
