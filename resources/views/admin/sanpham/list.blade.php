@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí sản phẩm')

@section('content')
    <style>
        th a {
            text-decoration: none;
            color: black;
        }

    </style>
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h1 style="text-align: center">Quản Lí Sản Phẩm</h1>
            <div class="card-header">
                <div class="add">
                    <div class="row">
                        <div class="col-9">
                            <a href="{{ route('sanpham.create') }}"><button class="btn btn-success"><i
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
                @if (session('tb_xoa'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('tb_xoa') }}
                    </div>
                @endif
            </div>
            @if ($sanphams->isEmpty())
                <div class="col-12 text-center mt-5">
                    {{ 'Bạn chưa đăng sản phẩm nào hoặc đã xóa. Vui lòng kiểm tra trong thùng rác!' }}
                </div>
            @else
                <table class="table table-striped table-bordered" style="background-color: white">
                    <thead>
                        <tr style="text-align: center;">
                            <th><input type="checkbox" id="check_all"></th>
                            <th style="width: 80px;">#</th>
                            <th style="width: 150px">@sortablelink('ten', 'Tên SP')</th>
                            <th style="width: 330px;">Mô Tả</th>
                            <th style="width: 100px">@sortablelink('gia', 'Giá Bán')</th>
                            <th style="width: 150px;">@sortablelink('soluongban', 'Số Lượng')</th>
                            <th style="width: 140px">@sortablelink('ngaydang', 'Ngày Đăng')</th>
                            <th style="width: 130px;">Ảnh</th>
                            <th colspan="3">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @if ($sanphams->count())
                            @foreach ($sanphams as $sanpham)
                                <tr id="tr_{{ $sanpham->id }}" style="text-align: justify">
                                    <td><input type="checkbox" class="checkbox" data-id="{{ $sanpham->id }}">
                                    </td>
                                    </td>
                                    <td style="text-align: center">{{ $i++ }}</td>
                                    <td>{{ $sanpham->ten }}</td>
                                    <td>{!! html_entity_decode($sanpham->mota) !!}</td>
                                    <td style="text-align: center">{{ $sanpham->gia }}</td>
                                    <td style="text-align: center">{{ $sanpham->soluongban }}</td>
                                    <td>{{ $sanpham->ngaydang }}</td>
                                    <td style="text-align: center"><img src="{{ asset('sanpham_anh/' . $sanpham->anh) }}"
                                            style="width:110px; height: 95px;" alt=""></td>
                                    <td>
                                        <a class="btn btn-outline-info"
                                            href="{{ route('sanpham.show', $sanpham->id) }}"><i
                                                class="far fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-warning"
                                            href="{{ route('sanpham.edit', $sanpham->id) }}"><i
                                                class="far fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('sanpham.destroy', $sanpham->id) }}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit"
                                                class="btn btn-xs btn-outline-danger btn-flat show_confirm"
                                                data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div style="float: left;" class="phantrang">
                    {!! $sanphams->links() !!}
                </div>
            @endif
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
                    title: `Bạn có muốn xóa sản phẩm này không?`,
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
