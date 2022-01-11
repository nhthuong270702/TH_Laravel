@extends('admin.masterlayout.masteradmin')

@section('title', 'Đổi mật khẩu người dùng')


@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding-top: 20px;" class="text-center">Đổi Mật Khẩu Người Dùng
                </h1>

                <header class="header">
                    <nav class="navbar navbar-expand-lg navbar-light py-3">
                        <div class="container">
                            <!-- Navbar Brand -->
                            <a href="#" class="navbar-brand">
                            </a>
                        </div>
                    </nav>
                </header>
                <div class="container">
                    <div class="row py-5 mt-4 align-items-center">
                        <!-- For Demo Purpose -->
                        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                            <img src="https://lifeveda.com.my/wp-content/themes/lifeveda-theme/static/img/edit-user.png"
                                width="300px" alt="" class="img-fluid mb-3 d-none d-md-block">
                        </div>

                        <!-- Registeration Form -->
                        <div class="col-md-7 col-lg-6 ml-auto">
                            <div class="row">
                                @if (session('tb'))
                                    <div class="alert alert-success">
                                        {{ session('tb') }}
                                    </div>
                                @endif
                                @if (session('loi'))
                                    <div class="alert alert-danger">
                                        {{ session('loi') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <form action="{{ route('user.doi-mat-khau', $user->id) }}" method="post">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control bg-white border-left-0 border-md mb-4"
                                                placeholder="Mật khẩu hiện tại" value="" name="password" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control bg-white border-left-0 border-md mb-4"
                                                placeholder="Mật khẩu mới" value="" name="newpassword" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control bg-white border-left-0 border-md mb-4"
                                                placeholder="Xác nhận mật khẩu mới" value="" name="confirm_newpassword" />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left: auto; margin-right:auto">
                                        <a class="btn btn-outline-info"
                                            style="float: left; width: 150px; display: block; margin-right: 30px"
                                            href="{{ route('user.update', $user->id) }}">Trở Lại</a>
                                        <button type="submit" class="btn btn-primary">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
