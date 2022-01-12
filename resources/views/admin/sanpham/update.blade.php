@extends('admin.masterlayout.masteradmin')

@section('title', 'Cập nhật sản phẩm')

@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding-top: 20px;" class="text-center"><i class="fas fa-tasks"></i> Cập Nhật Sản Phẩm</h1>
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
                            <form action="{{ route('sanpham.update', $sanpham->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                {{ method_field('put') }}
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label"><b>Tên Sản Phẩm</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="ten"
                                                value="{{ $sanpham->ten }}"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <label class="control-label"><b>Giá</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="gia"
                                                value="{{ $sanpham->gia }}"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <label class="control-label"><b>Thuộc Loại</b></label>
                                        <div class="input-group col-lg-12 mb-4">
                                            <select name="id_danh_muc" class="form-control browser-default custom-select">
                                                <option value="{{ $sanpham->danhmuc->id }}" selected>
                                                    {{ $sanpham->danhmuc->ten }}</option>
                                                @foreach ($danhmucs as $danhmuc)
                                                    <option value="{{ $danhmuc->id }}">{{ $danhmuc->ten }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label"><b>Số Lượng</b></label>
                                        <div class="input-group col-lg-12 mb-4">
                                            <input style="border-radius: 10px;" type="number" name="soluongban"
                                                value="{{ $sanpham->soluongban }}"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <label class="control-label"><b>Ngày Đăng</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="date" name="ngaydang"
                                                value="{{ $sanpham->ngaydang }}"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <label class="control-label"><b>Ảnh</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="file" name="anh"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="control-label"><b>Mô Tả</b></label>
                                        <div class="form-group">
                                            <textarea name="mota" id="editor">
                                                                                                                                                {{ $sanpham->mota }}
                                                                                                                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4" style="display: flex; justify-content: center;">
                                        <a class="btn btn-warning" href="/admin/sanpham">
                                            << Trở Lại</a>
                                                <button class="btn btn-primary"
                                                    style="width: 150px; margin-left: 10px">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
    </div>
@endsection
