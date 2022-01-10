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
                        <form class="form-inline" action="{{ route('user.search') }}" method="get">
                            <input type="search" name="search" id="">
                            <button class="btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="card-header">
                        @if (session('thongbao'))
                            <div class="alert alert-success hide">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                    </div>
                    <div style="overflow-x:auto;" class="card-body">
                        <table class="table table-bordered border border-info" id="datatablesSiple">
                            <thead>
                                <tr class="bg-info">
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Xem Bài Đăng</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($user as $al)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $al->name }}</td>
                                        <td>{{ $al->email }}</td>
                                        @if ($al->role == 1)
                                            <td>Admin</td>
                                        @endif
                                        @if ($al->role == 2)
                                            <td>Nhà tuyển dụng</td>
                                        @endif
                                        @if ($al->role == 3)
                                            <td>Người tìm việc</td>
                                        @endif
                                        <td><a href=""><button class="btn btn-primary"><i
                                                        class="fas fa-eye"></i></button></a></td>
                                        <td><a href="{{ route('user.edit', [$al->id]) }}"><button class="btn btn-primary"><i
                                                        class="fas fa-user-edit"></i></button></a></td>
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
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
@endsection
