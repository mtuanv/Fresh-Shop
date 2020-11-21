@extends("layouts.shop")
@section("content")
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>LIÊN HỆ</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Liên hệ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
                        <span>Fresh Shop chuyên cung cấp thực phẩm ngon trong và ngoài nước với chất lượng đảm bảo và giá thành hợp lý.</span>
                        <br>
                        <span>Sẵn sàng phục vụ các bạn gần xa cùng với việc hợp tác sâu rộng!</span>
                        <form id="contactForm" action="send-email" method="POST" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Tên*" required data-error="Vui lòng nhập tên">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" name="email"
                                               placeholder="Email*" required data-error="Vui lòng nhập email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subject" name="subject"
                                               placeholder="Tiêu đề *" required data-error="Vui lòng nhập tiêu đề">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Nội dung*" rows="4"
                                                  data-error="Vui lòng nhập nội dung" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="send-gmail" type="button">Gửi đi</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>CHI TIẾT LIÊN LẠC</h2>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>ĐỊa chỉ: Tòa Nhà Detech <br>
                                    Số 8 Tôn Thất Thuyết, Dịch Vọng Hậu, <br>Cầu Giấy, Hà Nội</p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+84962257510">+84
                                        962257510</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:manchestervn1996@gmail.com">freshshop@gmail.com</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Us -->

    <script type="text/javascript">
        $(document).ready(function () {
            $("#send-gmail").click(function () {
                var data = {
                    "name": $("#name").val(),
                    "_token": "{{csrf_token()}}",
                    "email": $("#email").val(),
                    "subject": $("#subject").val(),
                    "message": $("#message").val()
                };
                $.ajax({
                    type: "POST",
                    url: "api/send-email",
                    data: data,
                    success: function (response) {
                        alert("Gửi mail thành công ! Cảm ơn sự quan tâm của quý khách");
                    },
                    error: function (response) {
                        alert("Gửi mail thất bại . . . Mời điền lại");
                    }
                });
            });
        });
    </script>

@endsection
