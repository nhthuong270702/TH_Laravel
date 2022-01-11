@extends('admin.masterlayout.masteradmin')

@section('title', 'Danh sách danh mục')

@section('content')
    <style>
        th a {
            text-decoration: none;
            color: black;
        }

    </style>
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h1 style="margin-top: 30px; text-align: center">Quản Lí Danh Mục Sản Phẩm</h1>
            <div class="card-header row mb-3 mt-5">
                <div class="col-9">
                    <div class="add">
                        <a style="float: left; margin-right: 10px" href="{{ route('danhmuc.create') }}"><button
                                class="btn btn-success"><i class="fas fa-plus"></i></button></a>
                        <button class="btn btn-danger delete-all" data-url="">Xóa Các Hàng Đã Chọn</button>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group">
                        <input class="form-control mr-sm-2" type="search" name="search" id="search"
                            placeholder="Từ khóa tìm kiếm..." style="width: 100px">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (session('thongbao'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('thongbao') }}
                    </div>
                @endif
            </div>
            @if ($danhmucs->isEmpty())
                <div class="col-12 text-center mt-5">
                    {{ 'Bạn chưa đăng danh mục nào hoặc đã xóa. Vui lòng kiểm tra trong thùng rác!' }}
                </div>
            @else
                <div class="row">
                    <table class="table table-striped table-bordered text-center" style="background-color: white">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check_all"></th>
                                <th>STT</th>
                                <th>@sortablelink('ten', 'Tên Danh Mục')</th>
                                <th>Ảnh</th>
                                <th>Số Lượng SP</th>
                                <th colspan="3">Hành Động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($danhmucs as $danhmuc)
                                <tr id="tr_{{ $danhmuc->id }}">
                                    <td><input type="checkbox" class="checkbox" data-id="{{ $danhmuc->id }}">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $danhmuc->ten }}</td>
                                    <td><img src="{{ asset('images/danhmuc/' . $danhmuc->anh) }}"
                                            style="width:125px; height: 120px;" alt=""></td>
                                    <td>{{ $danhmuc->sanphams->count() }}</td>
                                    <td>
                                        <a class="btn btn-outline-info"
                                            href="{{ route('danhmuc.show', $danhmuc->id) }}"><i
                                                class="far fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-warning"
                                            href="{{ route('danhmuc.edit', $danhmuc->id) }}"><i
                                                class="far fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('danhmuc.destroy', $danhmuc->id) }}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit"
                                                class="btn btn-xs btn-outline-danger btn-flat show_confirm"
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
                    title: `Bạn có muốn xóa danh mục này không?`,
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
                            url: "{{ route('danhmuc.destroyAll') }}",
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
                url: '/admin/danhmuc/search',
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
