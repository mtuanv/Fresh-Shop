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
                                        <input type="email" class="form-control" id="email" name="email"
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
                                                  data-error="Vui lòng nhập nội dung"></textarea>
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
                                <p><i class="fas fa-map-marker-alt"></i>Địa chỉ: Tòa Nhà Detech <br>
                                    Số 8 Tôn Thất Thuyết, Dịch Vọng Hậu, <br>Cầu Giấy, Hà Nội</p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Điện thoại: <a href="tel:+84962257510">+84
                                        962257510</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Gmail: <a href="mailto:manchestervn1996@gmail.com">freshshop@gmail.com</a>
                                </p>
                            </li>
                        </ul>

                    </div>
                    <div id="map" style="width:100%;height:100%;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1862.048715515155!2d105.78073315817622!3d21.028787200075428!2m3
                        !1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b32ecb92db%3A0x3964e6238a3bd088!2zOCBUw7RuIFRo4bqldCBUaHV54bq_dCwgTeG7uSDE
                        kMOsbmgsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1606718651317!5m2!1svi!2s"
                                width="100%" height="50%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
                        const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                          confirmButton: 'btn btn-success',
                          cancelButton: 'btn btn-danger mr-3'
                        },
                        buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire(
                          'Gửi thành công!',
                          'Email đã được gửi đi',
                          'success'
                        )
                    },
                    error: function (response) {
                      const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger mr-3'
                      },
                      buttonsStyling: false
                      })
                      swalWithBootstrapButtons.fire(
                        'Gửi thất bại!',
                        'Mời bạn nhập lại',
                        'error'
                      )
                    }
                });
            });
        });
    </script>

@endsection
