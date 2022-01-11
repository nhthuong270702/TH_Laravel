    <!-- header -->
    <header id="header" class="container">
        <nav class="navbar navbar-expand-lg" id="top">
            <div class="left">
                <a class="navbar-brand" href="/" style="float: left;">
                    <b><span style="color: #ff4367ed;"><i class="fas fa-list-ul"></i> Classi</span><span
                            style="color: rgb(14, 119, 218);">Fied</span></b>
                </a>
            </div>
            <div class="right">
                <button class="navbar-toggler btn-header" type="button" data-toggle="collapse"
                    data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars" style="float: right;"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown" style="float: right;">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">TRANG CHỦ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                DANH MỤC
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">SẢN PHẨM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BLOG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">LIÊN HỆ</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    TÀI KHOẢN
                                </a>
                                <div class="dropdown-menu text-center" aria-labelledby="navbarDropdownMenuLink"
                                    style="padding: 7px">
                                    Xin Chào
                                    <h6><b>{{ Auth::user()->name }}</b></h6>
                                    <hr>
                                    @if (Auth::user()->role == 1)
                                        <a class="dropdown-item" href="/admin">ADMIN</a>
                                    @endif
                                    <a class="dropdown-item" href="#">Cập Nhật TK</a>
                                    <a class="dropdown-item" href="/dangxuat">Đăng Xuất</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="/dangnhap" class="nav-link"
                                    style="background-color: #ff4367; border-radius: 5px; border: none; color: white; width: 100%;">Đăng
                                    Nhập</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- end header -->
