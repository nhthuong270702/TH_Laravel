@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí người dùng')


@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;background-color: rgb(237, 241, 245);">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding: 20px 0px;" class="text-center"><i class="fas fa-tasks"></i> Quản Lí Người Dùng</h1>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Người Dùng
                        <form class="form-inline" action="" method="get">
                            <input type="search" name="search" id="search">
                            <button class="btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            @if (session('thongbao'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('thongbao') }}
                                </div>
                            @endif
                        </div>
                        <div class="add">
                            <a style="float: right; padding-left: 10px;" href="{{ route('user.create') }}"><button
                                    class="btn btn-primary"><i class="fas fa-user-plus"></i>Thêm Người Dùng</button></a>
                        </div>
                        <button style="float: right; margin-left: 10px;" type="input" class="btn btn-danger" id="deleteall"
                            value="">Xóa các hàng đã chọn</button>
                        <button style="float: right;" class="btn btn-primary"><a style="color: white;text-decoration: none;"
                                href="">Thùng rác</a></button>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="table table-bordered border border-info text-center">
                            <thead>
                                <tr class="bg-info">
                                    <th><input type="checkbox" id="chkCheckAll" /></th>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th colspan="3" scope="col">Hoạt Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($users as $al)
                                    <tr id="sid{{ $al->id }}">
                                        <td><input type="checkbox" name="ids" class="checkBoxClass"
                                                value="{{ $al->id }}"></td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $al->name }}</td>
                                        <td>{{ $al->email }}</td>
                                        @if ($al->role == 1)
                                            <td>Người quản trị</td>
                                        @elseif($al->role==0)
                                            <td>Người dùng</td>
                                        @endif
                                        <td><a href=""><button class="btn btn-primary"><i
                                                        class="fas fa-eye"></i></button></a></td>
                                        <td><a href="{{ route('user.edit', [$al->id]) }}"><button
                                                    class="btn btn-primary"><i class="fas fa-user-edit"></i></button></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('user.destroy', [$al->id]) }}" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm"
                                                    data-toggle="tooltip" title='Delete'><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="float: right;" class="phantrang">
                            {!! $users->links() !!}
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
                </div>
            </div>
        </main>
    </div>
@endsection
