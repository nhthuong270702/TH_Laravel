@extends('admin.masterlayout.masteradmin')

@section('content')
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="margin-top: 30px; text-align: center">Quản Lí Danh Mục Sản Phẩm</h2>
            <div class="row mb-3">
                <div class="add">
                    <a style="float: left; padding-left: 10px;" href="{{ route('danhmuc.create') }}"><button
                            class="btn btn-primary">Thêm Danh Mục</button></a>
                </div>
            </div>
            <div class="row">
                @if (session('thongbao'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('thongbao') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <table class="table table-striped table-bordered text-center" style="background-color: white">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Danh Mục</th>
                            <th>Ảnh</th>
                            <th colspan="3">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($danhmucs as $danhmuc)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $danhmuc->ten }}</td>
                                <td><img src="{{ asset('images/danhmuc/' . $danhmuc->anh) }}"
                                        style="width:90px; height: 80px;" alt=""></td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('danhmuc.show', $danhmuc->id) }}"><i
                                            class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('danhmuc.edit', $danhmuc->id) }}"><i
                                            class="far fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('danhmuc.destroy', $danhmuc->id) }}" method="post">
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
                <div style="float: right;" class="phantrang">
                    {!! $danhmucs->links() !!}
                </div>
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
        </main>
    </div>
@endsection
