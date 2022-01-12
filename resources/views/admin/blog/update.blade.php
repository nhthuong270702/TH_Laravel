@extends('admin.masterlayout.masteradmin')

@section('title', 'Cập nhật blog')

@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding-top: 20px;" class="text-center">Cập Nhật Blog</h1>
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
                            <form action="{{ route('blog.update', $blog->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                {{ method_field('put') }}
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label"><b>Tiêu Đề</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="tieude"
                                                value="{{ $blog->tieude }}" placeholder="Tiêu Đề"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <label class="control-label"><b>Ảnh</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="file" name="anh"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label"><b>Ngày Đăng</b></label>
                                        <div class="input-group col-lg-12 mb-4">
                                            <input style="border-radius: 10px;" type="date" name="ngaydang"
                                                value="{{ $blog->ngaydang }}" placeholder="Ngày Đăng"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <label class="control-label"><b>Số Bình Luận</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="number" name="sobinhluan"
                                                value="{{ $blog->sobinhluan }}" placeholder="Số Bình Luận"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                        <input style="border-radius: 10px;" type="hidden" name="user_id"
                                            value="{{ Auth::user()->id }}"
                                            class="form-control bg-white border-left-0 border-md">
                                    </div>
                                    <div class="col-12">
                                        <label class="control-label"><b>Nội Dung</b></label>
                                        <div class="form-group">
                                            <textarea name="noidung" id="editor">{!! html_entity_decode($blog->noidung) !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3" style="display: flex; justify-content: center;">
                                        <a class="btn btn-secondary" style="width: 100px; margin-right: 20px"
                                            href="{{ route('blog.index') }}">Trở
                                            Lại</a>
                                        <button class="btn btn-primary" style="width: 150px">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
    </div>
@endsection
