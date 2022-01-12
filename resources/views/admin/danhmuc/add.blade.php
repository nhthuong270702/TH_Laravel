@extends('admin.masterlayout.masteradmin')

@section('title', 'Thêm danh mục')

@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding-top: 20px;" class="text-center">Thêm Danh Mục Sản Phẩm
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
                            <form action="{{ route('danhmuc.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group col-lg-6 mb-4">
                                            <input style="border-radius: 10px;" type="text" name="ten"
                                                value="{{ old('ten') }}" placeholder="Tên Danh Mục"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group col-lg-12 mb-4">
                                            <input style="border-radius: 10px;" type="file" name="anh"
                                                class="form-control bg-white border-left-0 border-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-4" style="display: flex; justify-content: center;">
                                        <a class="btn btn-warning" href="/admin/danhmuc">
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
