@extends('admin.masterlayout.masteradmin')

@section('title', 'Thêm sản phẩm')

@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding-top: 20px;" class="text-center"><i class="fas fa-tasks"></i> Thêm Sản Phẩm</h1>
                <!-- Navbar-->
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
                    <div class="row">
                        @if (session('errors'))
                            <ul class="alert text-danger">
                                @foreach ($errors->all() as $error)
                                    <li style="color: red;font-family:monospace">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="row py-5 align-items-center">
                        <!-- Registeration Form -->
                        <div class="col-12">
                            <form action="{{ route('sanpham.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="ten"
                                                value="{{ old('ten') }}" placeholder="Tên Sản Phẩm"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="gia"
                                                value="{{ old('gia') }}" placeholder="Giá Bán"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <div class="input-group col-lg-12 mb-4">
                                            <select name="id_danh_muc" class="form-control browser-default custom-select">
                                                <option class="hidden" selected disabled>Thuộc Loại</option>
                                                @foreach ($danhmucs as $danhmuc)
                                                    <option value="{{ $danhmuc->id }}">{{ $danhmuc->ten }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group col-lg-12 mb-4">
                                            <input style="border-radius: 10px;" type="number" name="soluongban"
                                                value="{{ old('soluongban') }}" placeholder="Số Lượng Bán"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="date" name="ngaydang"
                                                value="{{ old('ngaydang') }}" placeholder="Ngày Đăng"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="file" name="anh"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="mota" id="editor"
                                                value="{{ old('mota') }}">{{ old('mota') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4" style="display: flex; justify-content: center;">
                                        <a class="btn btn-warning" href="/admin/sanpham">
                                            << Trở Lại</a>
                                                <button class="btn btn-primary"
                                                    style="width: 150px; margin-left: 10px">Thêm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
    </div>
@endsection
