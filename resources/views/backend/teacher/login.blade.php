<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Đăng nhập - Giáo viên</title>

    <link rel="shortcut icon" href="{{ asset('backend/teacher/assets/img/favicon.png') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/teacher/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/teacher/assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/teacher/assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/teacher/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/teacher/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/teacher/assets/css/style.css') }}">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('backend/teacher/assets/img/login.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Chào mừng bạn</h1>
                            <h2>Đăng nhập</h2>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ old('email') }}" required>
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Mật khẩu <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" name="password" required>
                                    <span class="profile-views feather-eye toggle-password"></span>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="forgotpass">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
                                            Ghi nhớ đăng nhập
                                            <input type="checkbox" name="remember">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <a href="#">Quên mật khẩu ?</a> {{-- Cập nhật route forgot password nếu có --}}
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Đăng nhập</button>
                                </div>
                            </form>


                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">hoặc</span>
                            </div>

                            <div class="social-login">
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/teacher/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/teacher/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/teacher/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('backend/teacher/assets/js/script.js') }}"></script>
</body>

</html>
