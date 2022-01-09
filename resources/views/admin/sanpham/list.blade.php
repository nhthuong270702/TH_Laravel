@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí sản phẩm')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="margin-top: 20px 0px; text-align: center">Quản Lí Sản Phẩm</h2>
            <div class="card-header mt-5">
                <div class="add">
                    <div class="row">
                        <div class="col-9">
                            <a href="{{ route('sanpham.create') }}"><button class="btn btn-success">Thêm Sản
                                    Phẩm</button></a>
                            <button class="btn btn-danger delete-all" data-url="">Xóa Các Hàng Đã Chọn</button>
                            <button class="btn btn-primary"><a style="color: white;text-decoration: none;"
                                    href="{{ route('sanpham.trash') }}">Thùng
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
            <div style="overflow-x:auto;">
                <table class="table table-striped table-bordered" style="background-color: white">
                    <thead>
                        <tr style="text-align: center">
                            <th><input type="checkbox" id="check_all"></th>
                            <th style="width: 50px">STT</th>
                            <th style="width: 150px">Tên SP</th>
                            <th style="width: 350px">Mô Tả</th>
                            <th style="width: 100px">Giá Bán</th>
                            <th style="width: 100px">Số Lượng</th>
                            <th style="width: 110px">Ngày Đăng</th>
                            <th style="width: 150px">Ảnh</th>
                            <th colspan="3">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($sanphams as $sanpham)
                            <tr id="tr_{{ $sanpham->id }}" style="text-align: justify">
                                <td><input type="checkbox" class="checkbox" data-id="{{ $sanpham->id }}">
                                </td>
                                </td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $sanpham->ten }}</td>
                                <td>{!! html_entity_decode($sanpham->mota) !!}</td>
                                <td style="text-align: center">{{ $sanpham->gia }}</td>
                                <td style="text-align: center">{{ $sanpham->soluongban }}</td>
                                <td>{{ $sanpham->ngaydang }}</td>
                                <td style="text-align: center"><img src="{{ asset('images/sanpham/' . $sanpham->anh) }}"
                                        style="width:90px; height: 80px;" alt=""></td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('sanpham.show', $sanpham->id) }}"><i
                                            class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('sanpham.edit', $sanpham->id) }}"><i
                                            class="far fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('sanpham.destroy', $sanpham->id) }}" method="post">
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
                    {!! $sanphams->links() !!}
                </div>
            </div>
        </main>
    </div>
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
                            url: "{{ route('sanpham.destroyAll') }}",
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
    <!-- tìm kiếm ajax -->
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/admin/sanpham/search',
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
