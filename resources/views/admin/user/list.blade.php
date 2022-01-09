@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí người dùng')


@section('content')
    <div id="layoutSidenav_content">
        <main style="padding: 25px;">
            <div style="background-color:rgb(255, 255, 255);" class="container-fluid px-4 ">
                <h1 style="padding: 20px 0px;" class="text-center"><i class="fas fa-tasks"></i> Quản Lí Người Dùng</h1>

                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            @if (session('thongbao'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('thongbao') }}
                                </div>
                            @endif
                            @if (session('tb_xoa'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('tb_xoa') }}
                                </div>
                            @endif
                        </div>
                        <div class="add">
                            <div class="row">
                                <div class="col-9">
                                    <a href="{{ route('user.create') }}"><button class="btn btn-success"><i
                                                class="fas fa-user-plus"></i>Thêm Người
                                            Dùng</button></a>
                                    <button class="btn btn-danger delete-all" data-url="">Xóa Các Hàng Đã Chọn</button>
                                    <button class="btn btn-primary"><a style="color: white;text-decoration: none;"
                                            href="{{ route('user.trash') }}">Thùng
                                            rác</a></button>
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        <input class="form-control mr-sm-2" type="search" name="search" id="search"
                                            placeholder="Từ khóa tìm kiếm...">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered" style="background-color: white">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check_all"></th>
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
                                    <tr id="tr_{{ $al->id }}">
                                        <td><input type="checkbox" class="checkbox" data-id="{{ $al->id }}">
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $al->name }}</td>
                                        <td>{{ $al->email }}</td>
                                        @if ($al->role == 1)
                                            <td>Người quản trị</td>
                                        @elseif($al->role == 0)
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
                    </div>
                </div>
            </div>
        </main>
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
    {{-- xoa nhieu --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#check_all').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".checkbox").prop('checked', true);
                } else {
                    $(".checkbox").prop('checked', false);
                }
            });
            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#check_all').prop('checked', true);
                } else {
                    $('#check_all').prop('checked', false);
                }
            });
            $('.delete-all').on('click', function(e) {
                e.preventDefault();
                var idsArr = [];
                $(".checkbox:checked").each(function() {
                    idsArr.push($(this).attr('data-id'));
                });
                if (idsArr.length <= 0) {
                    alert("Vui lòng chọn ít nhất 1 hàng để xóa.");
                } else {
                    if (confirm("Bạn có muốn xóa các hàng đã chọn không?")) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "{{ route('user.destroyAll') }}",
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + strIds,
                            success: function(data) {
                                if (data['status'] == true) {
                                    $(".checkbox:checked").each(function() {
                                        $(this).parents("tr_").remove();
                                    });
                                    alert(data['message']);
                                } else {
                                    location.reload();
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function(event, element) {
                    element.closest('form').submit();
                }
            });
        });
    </script>
    <!-- tìm kiếm ajax -->
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/admin/user/search',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection
