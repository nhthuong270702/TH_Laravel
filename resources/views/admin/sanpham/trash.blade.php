@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí sản phẩm đã xóa')

@section('content')
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="margin-top: 30px; text-align: center">Quản Lí Sản Phẩm Đã Xóa</h2>
            <div class="row mb-3">
            </div>
            @if ($sanphams_trash->isEmpty())
                <div class="col-12 text-center">
                    @if (session('thongbao'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    {{ 'Không có gì trong thùng rác!' }}<br><br><br>
                    <a href="/admin/sanpham">
                        << Trở lại</a>
                </div>
            @else
                <div class="row">
                    @if (session('thongbao'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    <div class="add" style="display: flex; justify-content: center;">
                        <a class="btn btn-warning" href="/admin/sanpham">
                            << Trở lại</a>
                                <a class="btn btn-primary" href="{{ route('sanpham.restore') }}"
                                    style="margin-left: 10px">Khôi Phục Tất
                                    Cả</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <table class="table table-striped table-bordered text-center"
                        style="background-color: white; text-align: justify">
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
                            @foreach ($sanphams_trash as $sanpham)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $sanpham->ten }}</td>
                                    <td>{{ $sanpham->diachi }}</td>
                                    <td>{{ $sanpham->gia }}</td>
                                    <td>{{ $sanpham->soluongban }}</td>
                                    <td>{{ $sanpham->ngaydang }}</td>
                                    <td><img src="{{ asset('images/sanpham/' . $sanpham->anh) }}"
                                            style="width:90px; height: 80px;" alt=""></td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('sanpham.unTrash', $sanpham->id) }}"><i
                                                class="fas fa-trash-restore"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('sanpham.forceDelete', $sanpham->id) }}" method="post">
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
                    {{-- xoa 1 --}}
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
                    <script type="text/javascript">
                        $('.show_confirm').click(function(event) {
                            var form = $(this).closest("form");
                            var name = $(this).data("name");
                            event.preventDefault();
                            swal({
                                    title: `Bạn có muốn xóa người dùng này không?`,
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        form.submit();
                                    }
                                });
                        });
                    </script>
                </div>
            @endif
        </main>
    </div>
@endsection
