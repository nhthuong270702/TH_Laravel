@extends('admin.masterlayout.masteradmin')

@section('title', 'Chi tiết danh mục')

@section('content')
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="margin-top: 30px; text-align: center">Quản Lí Các Sản Phẩm Thuộc Danh Mục <br> {{ $danhmuc->ten }}
            </h2>
            <div class="row">
                <a class="btn btn-secondary btn-sm" style="float: left; width: 100px"
                    href="{{ route('danhmuc.index') }}">Trở
                    Lại</a>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered text-center" style="background-color: white">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên SP</th>
                            <th>Địa Chỉ</th>
                            <th>Giá Bán</th>
                            <th>Số Lượng</th>
                            <th>Ngày Đăng</th>
                            <th>Ảnh</th>
                            <th colspan="3">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($sanphams as $sanpham)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $sanpham->ten }}</td>
                                <td>{{ $sanpham->diachi }}</td>
                                <td>{{ $sanpham->gia }}</td>
                                <td>{{ $sanpham->soluongban }}</td>
                                <td>{{ $sanpham->ngaydang }}</td>
                                <td><img src="{{ asset('sanpham_anh/' . $sanpham->anh) }}"
                                        style="width:90px; height: 80px;" alt=""></td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('sanpham.show', $sanpham->id) }}"><i
                                            class="far fa-eye"></i></a>
                                </td>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

@endsection
