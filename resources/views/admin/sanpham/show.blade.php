@extends('admin.masterlayout.masteradmin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="margin-top: 30px; text-align: center">Thông Tin Sản Phẩm <br> {{ $sanpham->ten }}</h2>
            <div class="row">
                <a class="btn btn-secondary btn-sm" style="float: left; width: 100px"
                    href="{{ route('sanpham.index') }}">Trở
                    Lại</a>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered text-center mt-5">
                    <thead>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Mô Tả</th>
                            <th>Giá Bán</th>
                            <th>Số Lượng</th>
                            <th>Ngày Đăng</th>
                            <th>Thuộc Loại</th>
                            <th colspan="2">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $sanpham->ten }}</td>
                            <td>{{ $sanpham->mota }}</td>
                            <td>{{ $sanpham->gia }}</td>
                            <td>{{ $sanpham->soluongban }}</td>
                            <td>{{ $sanpham->ngaydang }}</td>
                            <td>{{ $danhmuc->ten }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('sanpham.edit', $sanpham->id) }}"><i
                                        class="far fa-edit"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('sanpham.destroy', $sanpham->id) }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm"
                                        data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

@endsection
