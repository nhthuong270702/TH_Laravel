@extends('admin.masterlayout.masteradmin')

@section('title', 'Quản lí sản phẩm đã xóa')

@section('content')
    <div class="container-fluid" id="layoutSidenav_content">
        <main style="padding: 25px;width: 100%">
            <h2 style="text-align: center">Quản Lí Sản Phẩm Đã Xóa</h2>
            <div class="row mb-3">
            </div>
            @if ($sanphams_trash->isEmpty())
                <div class="col-12 text-center">
                    @if (session('thongbao'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    {{ 'Không có gì trong thùng rác!' }}<br><br><br>
                    <a href="/admin/sanpham">
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
                        <a class="btn btn-outline-light text-dark" href="/admin/sanpham" style="margin-right: 10px">
                            << Trở lại</a>
                                <button class="btn btn-outline-danger delete-all" data-url="">Xóa Các Hàng Đã Chọn</button>
                                <a class="btn btn-outline-primary" href="{{ route('sanpham.restore') }}"
                                    style="margin-left: 10px">Khôi Phục Tất
                                    Cả</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <table class="table table-striped table-bordered text-center"
                        style="background-color: white; text-align: justify">
                        <thead>
                            <th><input type="checkbox" id="check_all"></th>
                            <th>STT</th>
                            <th>Tên SP</th>
                            <th>Mô Tả</th>
                            <th>Giá Bán</th>
                            <th>Số Lượng</th>
                            <th>Ngày Đăng</th>
                            <th>Ảnh</th>
                            <th colspan="3">Hành Động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($sanphams_trash as $sanpham)
                                <tr id="tr_{{ $sanpham->id }}">
                                    <td><input type="checkbox" class="checkbox" data-id="{{ $sanpham->id }}">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $sanpham->ten }}</td>
                                    <td>{!! html_entity_decode($sanpham->mota) !!}</td>
                                    <td>{{ $sanpham->gia }}</td>
                                    <td>{{ $sanpham->soluongban }}</td>
                                    <td>{{ $sanpham->ngaydang }}</td>
                                    <td><img src="{{ asset('images/sanpham/' . $sanpham->anh) }}"
                                            style="width:90px; height: 80px;" alt=""></td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('sanpham.unTrash', $sanpham->id) }}"><i
                                                class="fas fa-trash-restore"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('sanpham.forceDelete', $sanpham->id) }}" method="post">
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
                    title: `Bạn có muốn xóa vĩnh viễn sản phẩm này không?`,
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
                            url: "{{ route('sanpham.forceDeleteAll') }}",
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
