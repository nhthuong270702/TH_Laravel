<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>

                <a class="nav-link" href="/admin">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Home
                </a>
                <div class="sb-sidenav-menu-heading">Menu</div>

                <a class="nav-link collapsed" href="/admin/user">

                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></i></div>
                    Người Dùng
                </a>
                <a class="nav-link collapsed" href="/admin/danhmuc">
                    <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                    Danh Mục
                </a>
                <a class="nav-link collapsed" href="/admin/sanpham">
                    <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                    Sản Phẩm
                </a>
                <a class="nav-link collapsed" href="/admin/blog">
                    <div class="sb-nav-link-icon"><i class="fas fa-blog"></i></div>
                    Blog
                </a>
                <a class="nav-link collapsed" href="/admin/gioithieu">
                    <div class="sb-nav-link-icon"><i class="fas fa-id-card-alt"></i></div>
                    Giới Thiệu
                </a>
                <div class="dropdown nav-link collapsed">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false"
                        style="width: 100%; background-color: #212529; color: white; text-align: left; padding: 0">
                        <i class="far fa-trash-alt"></i> Thùng Rác
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('user.trash') }}">Người Dùng</a></li>
                        <li><a class="dropdown-item" href="{{ route('danhmuc.trash') }}">Danh Mục</a></li>
                        <li><a class="dropdown-item" href="{{ route('sanpham.trash') }}">Sản Phẩm</a></li>
                        <li><a class="dropdown-item" href="{{ route('blog.trash') }}">Blogs</a></li>
                    </ul>
                </div>
            </div>
    </nav>
</div>
<script>
    $(function() {
        $('nav a[href^="/admin/' + location.pathname.split("/admin/")[1] + '"]').addClass('btn-primary active');
    });
</script>
