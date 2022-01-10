@extends('admin.masterlayout.masteradmin')

@section('title', 'AMIN | Trang Chủ')


@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 class="mt-4">Thống Kê</h1>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Người Dùng</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <h3 class="small text-white stretched-link" href="#">{{ $users }}</h3>
                                <div class="small text-white"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Blog</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <h3 class="small text-white stretched-link" href="#">{{ $blogs }}</h3>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Danh Mục</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <h3 class="small text-white stretched-link" href="#">{{ $danhmucs }}</h3>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Sản Phẩm</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <h3 class="small text-white stretched-link" href="#">{{ $sanphams }}</h3>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
