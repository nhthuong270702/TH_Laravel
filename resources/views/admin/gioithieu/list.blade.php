@extends('admin.masterlayout.masteradmin')

@section('content')
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="margin-top: 30px; text-align: center">Quản Lí Thông Tin Giới Thiệu</h2>
            <div class="row mb-3">
                <div class="add">
                    <a style="float: left; padding-left: 10px;" href="{{ route('gioithieu.create') }}"><button
                            class="btn btn-primary">Thêm Giới Thiệu</button></a>
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
                            <th>Tiêu Đề</th>
                            <th>Nội Dung</th>
                            <th>Ảnh</th>
                            <th>Tiêu Chí 1</th>
                            <th>Tiêu Chí 2</th>
                            <th>Tiêu Chí 3</th>
                            <th colspan="3">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody style="text-align: justify">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($abouts as $about)
                            <tr>
                                <td>
                                    {{ $i++ }}
                                </td>
                                <td>{{ $about->tieude }}</td>
                                <td>{!! html_entity_decode($about->noidung) !!}</td>
                                <td><img src="{{ asset('images/abouts/' . $about->anh) }}"
                                        style="width:90px; height: 80px;" alt=""></td>
                                <td>{{ $about->tieuchi1 }}</td>
                                <td>{{ $about->tieuchi2 }}</td>
                                <td>{{ $about->tieuchi3 }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('gioithieu.show', $about->id) }}"><i
                                            class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('gioithieu.edit', $about->id) }}"><i
                                            class="far fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('gioithieu.destroy', $about->id) }}" method="post">
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
                    {!! $abouts->links() !!}
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
