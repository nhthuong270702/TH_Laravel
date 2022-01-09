<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('assets/login/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/login/css/style.css')}}">

</head>

<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{asset('assets/login/images/signin-image.jpg')}}" alt="sing up image"></figure>
                        <a href="/dangky" class="signup-image-link">Đăng kí tài khoản mới</a>
                    </div>

                    <div class="signin-form">
                        <h2 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" class="form-title">Đăng Nhập</h2>
                        @if (session('thongbao1'))
                        <div class="alert">
                            <p style="color: green;">{{session('thongbao1')}}</p>
                        </div>
                        @endif
                        @if (session('ms'))
                        <div class="alert">
                            <p style="color: rgb(219, 10, 10);">{{session('ms')}}</p>
                        </div>
                        @endif
                        @if (session('ms3'))
                        <div class="alert">
                            <p style="color: green;">{{session('ms3')}}</p>
                        </div>
                        @endif
                        @if (session('thongbao'))
                        <div class="alert">
                            <p style="color: red;">{{session('thongbao')}}</p>
                        </div>
                        @endif
                        <form method="POST" action="dangnhap" class="register-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" placeholder="Email"
                                 required
                                @if (!Cookie::get('email'))
                                value="{{old('email')}}"
                                @else
                                value="{{ Cookie::get('email') }}"
                                @endif
                                />
                            </div>
                            <div class="form-group">
                                <label><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" placeholder="Mật Khẩu"
                                @if (!Cookie::get('password'))
                                value="{{old('password')}}"
                                @else
                                value="{{ Cookie::get('password') }}"
                                @endif
                                required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="rememberme" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term" style="font-family: Arial, sans-serif;"><span><span></span></span>Ghi nhớ đăng nhập</label>
                                <br> <br>
                                <a href="/quen-mat-khau" style="font-family: Arial, sans-serif;">Quên mật khẩu</a>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label" style="font-family: Arial, sans-serif;">Hoặc đăng nhập với</span>
                            <ul class="socials">
                                <li><a href=" {{ url('/auth/facebook') }}"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href=" {{ url('/auth/google') }}"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('assets/login/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/login/js/main.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
