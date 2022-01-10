@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí người dùng đã xóa')

@section('content')
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="margin-top: 30px; text-align: center">Quản Lí Người Dùng Đã Xóa</h2>
            <div class="row mb-3">
            </div>
            @if ($users_trash->isEmpty())
                <div class="col-12 text-center">
                    @if (session('thongbao'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    {{ 'Không có gì trong thùng rác!' }}<br><br><br>
                    <a href="/admin/user">
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
                        <a class="btn btn-warning" href="/admin/user" style="margin-right: 10px">
                            << Trở lại</a>
                                <button class="btn btn-danger delete-all" data-url="">Xóa Các Hàng Đã Chọn</button>
                                <a class="btn btn-primary" href="{{ route('user.restore') }}"
                                    style="margin-left: 10px">Khôi Phục Tất
                                    Cả</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <table class="table table-striped table-bordered text-center"
                        style="background-color: white; text-align: justify">
                        <thead>
                            <tr class="bg-info">
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
                            @foreach ($users_trash as $user)
                                <tr id="tr_{{ $user->id }}">
                                    <td><input type="checkbox" class="checkbox" data-id="{{ $user->id }}">
                                    </td>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if ($user->role == 1)
                                        <td>Người quản trị</td>
                                    @elseif($user->role == 0)
                                        <td>Người dùng</td>
                                    @endif
                                    <td>
                                        <a class="btn btn-success" href="{{ route('user.unTrash', $user->id) }}"><i
                                                class="fas fa-trash-restore"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('user.forceDelete', $user->id) }}" method="post">
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
            @endif
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
                    title: `Bạn có muốn xóa vĩnh viễn người dùng này không?`,
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
                            url: "{{ route('user.forceDeleteAll') }}",
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
@endsection
