@extends("layouts.shop")
@section("content")

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="{{asset('shop/images/banner-01.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Chào mừng bạn tới <br> Freshshop</strong></h1>
                            <p class="m-b-40">Bạn yêu thích ăn uống, thích săn lùng những món ăn ngon? <br> Vậy thì bạn
                                đã đến đúng nơi rồi đó.</p>
                            <p><a class="btn hvr-hover" href="{{route('menu')}}">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{asset('shop/images/banner-02.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Chào mừng bạn tới <br> Freshshop</strong></h1>
                            <p class="m-b-40">Bạn yêu thích ăn uống, thích săn lùng những món ăn ngon?<br> Vậy thì bạn
                                đã đến đúng nơi rồi đó.</p>
                            <p><a class="btn hvr-hover" href="{{route('menu')}}">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{asset('shop/images/banner-03.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Chào mừng bạn tới <br> Freshshop</strong></h1>
                            <p class="m-b-40">Bạn yêu thích ăn uống, thích săn lùng những món ăn ngon?<br> Vậy thì bạn
                                đã đến đúng nơi rồi đó.</p>
                            <p><a class="btn hvr-hover" href="{{route('menu')}}">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Gallery  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>MENU</h1>
                        <p>Mua càng nhiều giá càng rẻ</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*" style="margin-top: 3px">All</button>
                            @foreach($lsTag as $tag)
                                <button data-filter=".{{$tag->id}}" style="margin-top: 3px">{{$tag->name}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                @foreach($lsProduct as $product)
                    @php
                        $tagname = "";
                        foreach($product->tags as $t) {
                            $tagname .= $t->id." ";
                        }
                    @endphp
                    <div class="col-lg-3 col-md-6 special-grid {{$tagname}}">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                @foreach($product->images as $image)
                                    <img src="{{asset($image->link)}}" class="img-fluid" alt="Image">
                                @endforeach
                                <div class="mask-icon">
                                    <p style="text-align: center; font-size: 30px; color: white; text-transform: uppercase">{{$product->name}}</p>
                                    <ul>
                                        <li><a href="{{route('detail', $product->id)}}" data-toggle="tooltip"
                                               data-placement="right" title="View"><i
                                                    class="fas fa-eye"></i></a></li>
                                    </ul>
                                    <a class="cart" onclick="AddCart({{$product->id}})"
                                       href="javascript:">Thêm vào giỏ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- End Gallery  -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1 style="text-transform: uppercase">Tin tức mới nhất</h1>
                        <p>Combo sự kiện mở liên tục, chúng tôi tự tin có thể làm bạn thỏa mãn mọi lúc</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="featured-products-box owl-carousel owl-theme">
                    @foreach($lsBlog as $blog)
                        <div class="blog-box">
                            <div class="blog-img">
                                <img class="img-fluid" style="height: 164px; overflow: hidden"
                                     src="{{asset($blog->cover)}}" alt=""/>
                            </div>
                            <div class="blog-content">
                                <div class="title-blog">
                                    <h3 style="color: black; line-height: 20px; height: 20px; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1">{{$blog->title}}</h3>
                                    <p style="color: black; line-height: 20px; height: 20px; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3">{{strip_tags(substr($blog->content, 0,100))}}</p>
                                </div>
                                <ul class="option-blog">
                                    <li><a href="{{route('blogDetail', $blog->id)}}"><i
                                                class="far fa-heart"></i></a>
                                    </li>
                                    <li><a href="{{route('blogDetail', $blog->id)}}"><i class="fas fa-eye"></i></a>
                                    </li>
                                    <li><a href="{{route('blogDetail', $blog->id)}}"><i
                                                class="far fa-comments"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Blog  -->
    {{--Start Instagram Feed--}}
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            @foreach($lsProduct as $product)
                @foreach($product->images as $image)
                    <div class="ins-inner-box">
                        <img src="{{asset($image->link)}}" class="img-fluid" alt="Image">
                        <div class="hov-in">
                            <a href="{{route('detail', $product->id)}}"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
    {{--End Instagram Feed--}}

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
