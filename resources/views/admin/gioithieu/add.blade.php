@extends('admin.masterlayout.masteradmin')

@section('title', 'Thêm thông tin')

@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 class="text-center">Thêm Thông Tin Giới Thiệu
                </h1>
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
                    <div class="row py-5 mt-4 align-items-center">
                        <!-- Registeration Form -->
                        <div class="col-12">
                            <form action="{{ route('gioithieu.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label"><b>Tiêu Đề</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="tieude"
                                                value="{{ old('tieude') }}" placeholder="Tiêu Đề"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label"><b>Tiêu Chí 1</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="tieuchi1"
                                                value="{{ old('tieuchi1') }}" placeholder="Tiêu Chí 1"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label"><b>Ảnh</b></label>
                                        <div class="input-group col-lg-12 mb-4">
                                            <input style="border-radius: 10px;" type="file" name="anh"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label"><b>Tiêu Chí 2</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="tieuchi2"
                                                value="{{ old('tieuchi2') }}" placeholder="Tiêu Chí 2"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label"><b>Nội Dung</b></label>
                                        <div class="form-group">
                                            <textarea name="noidung" id="editor" value="{{ old('noidung') }}"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <label class="control-label"><b>Tiêu Chí 3</b></label>
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="tieuchi3"
                                                value="{{ old('tieuchi3') }}" placeholder="Tiêu Chí 3"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" style="width: 150px; margin-top: 10px">Thêm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
    </div>
@endsection
