<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-item">
                <div class="card-body">
                    <h3 class="fs-24 font-weight-semi-bold pb-2">Đăng kí ngay</h3>
                    <div class="divider"><span></span></div>
                    <form method="post" action="{{ route('student.register.store') }}">
                        @csrf
                        <div class="input-box">
                            <label class="label-text">Tên</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="name"
                                    placeholder="Tên của bạn" required>
                                <span class="la la-user input-icon"></span>
                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box">
                            <label class="label-text">Email</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="email" name="email"
                                    placeholder="Địa chỉ email" required>
                                <span class="la la-envelope input-icon"></span>
                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box">
                            <label class="label-text">Mật khẩu</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="password" name="password"
                                    placeholder="Mật khẩu của bạn" required>
                                <span class="la la-lock input-icon"></span>
                            </div>
                        </div><!-- end input-box -->

                        <div class="btn-box pt-2">
                            <button class="btn theme-btn" type="submit">Đăng kí ngay <i
                                    class="la la-arrow-right icon ml-1"></i></button>
                        </div><!-- end btn-box -->
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-5 -->
        <div class="col-lg-6 ml-auto">
            <div class="register-content">
                <div class="section-heading">
                    <h5 class="ribbon ribbon-lg mb-2">Đăng kí</h5>
                    <h2 class="section__title">Tiến xa hơn với Lộ trình học tập. Luôn sẵn sàng bứt phá.</h2>
                    <span class="section-divider"></span>
                    <p class="section__desc">
                        Giáo dục là quá trình tiếp thu kiến thức và kỹ năng cần thiết trong xã hội. Một nền giáo dục
                        tốt không chỉ truyền đạt thông tin mà còn phát triển tư duy phản biện. Tại Aduca, chúng tôi
                        cam kết mang đến hành trình học tập chất lượng, giúp bạn tự tin làm chủ tương lai.
                    </p>

                </div><!-- end section-heading -->
                <div class="btn-box pt-35px">
                    <a href="sign-up.html" class="btn theme-btn"><i class="la la-user mr-1"></i>Bắt đầu</a>
                </div>
            </div><!-- end register-content -->
        </div><!-- end col-lg-6 -->
    </div><!-- end row -->
</div>
