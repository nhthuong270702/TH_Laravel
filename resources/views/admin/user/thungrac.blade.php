@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí người dùng đã xóa')


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
                        @if (session('thongbao'))
                            <div class="alert alert-success hide">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                        <div class="add">
                            <a style="float: right;" href="{{ route('user.create') }}"><button class="btn btn-primary"><i
                                        class="fas fa-user-plus"></i>Thêm Người Dùng</button></a>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="table table-bordered border border-info">
                            <thead>
                                <tr class="bg-info">
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Khôi phục</th>
                                    <th scope="col">Xóa vĩnh viễn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($userrci->isEmpty())
                                    <h5 class="text-center" style="color: red;">Thùng rác trống</h5>
                                @else
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($userrci as $al)
                                        <tr id="sid{{ $al->id }}">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $al->name }}</td>
                                            <td>{{ $al->email }}</td>
                                            @if ($al->role == 1)
                                                <td>Người quản trị</td>
                                            @elseif($al->role == 0)
                                                <td>Người dùng</td>
                                            @endif
                                            <td><a href="{{ route('user.restore', [$al->id]) }}"><button
                                                        class="btn btn-primary"><i
                                                            class="fas fa-trash-restore"></i></button></a></td>
                                            <td>
                                                <form method="POST" action="{{ route('user.xoavinhvien', [$al->id]) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit"
                                                        class="btn btn-xs btn-danger btn-flat show_confirm"
                                                        data-toggle="tooltip" title='Delete'><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
