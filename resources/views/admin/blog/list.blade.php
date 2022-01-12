@extends('admin.masterlayout.masteradmin')

@section('title', 'Danh sách blog')

@section('content')
    <style>
        th a {
            text-decoration: none;
            color: black;
        }

    </style>
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h1 style="text-align: center">Quản Lí Blog</h1>
            <div class="card-header">
                <div class="add">
                    <div class="row">
                        <div class="col-9">
                            <a href="{{ route('blog.create') }}"><button class="btn btn-success"><i
                                        class="fas fa-plus"></i></button></a>
                            <button class="btn btn-danger delete-all" data-url="">Xóa Các Hàng Đã Chọn</button>
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
            <div class="row">
                @if (session('thongbao'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('thongbao') }}
                    </div>
                @endif
            </div>
            @if ($blogs->isEmpty())
                <div class="col-12 text-center mt-5">
                    {{ 'Bạn chưa đăng blogs nào hoặc đã xóa. Vui lòng kiểm tra trong thùng rác!' }}
                </div>
            @else
                <table class="table table-striped table-bordered text-center" style="background-color: white">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check_all"></th>
                            <th>STT</th>
                            <th style="width: 160px">@sortablelink('tieude', 'Tiêu Đề')</th>
                            <th style="width: 350px;">Nội Dung</th>
                            <th>@sortablelink('ngaydang', 'Ngày Đăng')</th>
                            <th>Số Bình Luận</th>
                            <th>Ảnh</th>
                            <th colspan="3">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody style="text-align: justify">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($blogs as $blog)
                            <tr id="tr_{{ $blog->id }}">
                                <td><input type="checkbox" class="checkbox" data-id="{{ $blog->id }}">
                                <td style="text-align: center">{{ $i++ }}</td>
                                <td>{{ $blog->tieude }}</td>
                                <td style="text-align:justify">
                                    {!! html_entity_decode($blog->noidung) !!}
                                </td>
                                <td style="text-align: center">{{ $blog->ngaydang }}</td>
                                <td style="text-align: center">{{ $blog->sobinhluan }}</td>
                                <td style="text-align: center"><img src="{{ asset('images/blogs/' . $blog->anh) }}"
                                        style="width:150px; height: 120px;" alt=""></td>
                                <td>
                                    <a class="btn btn-outline-info" href="#"><i class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-warning" href="{{ route('blog.edit', $blog->id) }}"><i
                                            class="far fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('blog.destroy', $blog->id) }}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-xs btn-outline-danger btn-flat show_confirm"
                                            data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="float: left;" class="phantrang">
                    {!! $blogs->links() !!}
                </div>
            @endif
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
                    title: `Bạn có muốn xóa blog này không?`,
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
                            url: "{{ route('blog.destroyAll') }}",
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
                url: '/admin/blog/search',
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
