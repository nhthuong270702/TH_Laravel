<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatSanPhamRequest;
use App\Http\Requests\ThemSanPhamRequest;
use App\Models\DanhMuc;
use App\Models\SanPham;

class SanPhamController extends Controller
{

    public function index()
    {
        $sanphams = SanPham::paginate(10);
        return view('admin.sanpham.list', compact('sanphams'));
    }

    public function create()
    {
        $danhmucs = DanhMuc::all();
        return view('admin.sanpham.add', compact('danhmucs'));
    }

    public function store(ThemSanPhamRequest $request)
    {
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('images/sanpham', $new_image);
            $data['anh'] = $new_image;
            $added = SanPham::create($data);
            if ($added) {
                return redirect()->route('sanpham.index')->with('thongbao', 'Thêm Thành Công');
            } else {
                return back()->withInput();
            }
        }
    }

    public function show($id)
    {
        $data['sanpham'] = SanPham::find($id);
        $data['danhmuc'] = $data['sanpham']->danhmuc;
        return view('admin.sanpham.chitietsanpham')->with($data);
    }
    public function danhmuc($id)
    {
        $danhmucs = SanPham::find($id);
        $danhmucs->danhmuc();
        return view('admin.product.create', compact('danhmucs'));
    }

    public function edit($id)
    {
        $data['sanpham'] = SanPham::find($id);
        $data['danhmucs'] = DanhMuc::all();
        return view('admin.sanpham.update')->with($data);
    }

    public function update(CapNhatSanPhamRequest $request, $id)
    {
        $sanpham = SanPham::find($id);
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('images/sanpham', $new_image);
            $data['anh'] = $new_image;
            $sanpham->update($data);
            return redirect()->route('sanpham.index')->with('thongbao', "Cập Nhật Thành Công");
        } else {
            $sanpham->update($data);
            return redirect()->route('sanpham.index')->with('thongbao', "Cập Nhật Thành Công");
        }
    }

    public function destroy($id)
    {
        SanPham::find($id)->delete();
        return redirect()->route('sanpham.index')->with('thongbao', 'Đã Thêm Vào Thùng Rác');
    }
    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        SanPham::whereIn('id', explode(",", $ids))->delete();
        return redirect()->back()->with('tb_xoa', 'Đã chuyển vào thùng rác');
    }
    public function trash()
    {
        $sanphams_trash = SanPham::onlyTrashed()->get();
        return view('admin.sanpham.trash', compact('sanphams_trash'));
    }
    public function unTrash($id)
    {
        $sanpham = SanPham::onlyTrashed()->find($id);
        $sanpham->restore();
        return redirect()->route('sanpham.trash')->with('thongbao', 'Khôi phục thành công');
    }
    public function forceDelete($id)
    {
        $sanpham = SanPham::onlyTrashed()->find($id);
        $sanpham->forceDelete();
        return redirect()->route('sanpham.trash')->with('thongbao', 'Xóa thành công');
    }
    public function forceDeleteAll()
    {
        $sanpham = SanPham::onlyTrashed();
        $sanpham->forceDelete();
        return redirect()->route('sanpham.trash')->with('thongbao', 'Xóa thành công');
    }
    public function restore()
    {
        $sanpham = SanPham::onlyTrashed();
        $sanpham->restore();
        return redirect()->route('sanpham.trash')->with('thongbao', 'Khôi Phục Thành Công');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $users = SanPham::where('ten', 'like', '%' . $request->search . '%')
                ->orwhere('gia', 'like', '%' . $request->search . '%')->get();
            $i = 1;
            foreach ($users as $al) {
                $output .= '<tr>
                            <td><input type="checkbox" name="ids" class="checkBoxClass" value=""></td>
                            <td>' . $i++ . '</td>
                            <td>' . $al->ten . '</td>
                            <td style="text-align: justify">' . $al->mota . '</td>
                            <td>' . $al->gia . '</td>
                            <td>' . $al->soluongban . '</td>
                            <td>' . $al->ngaydang . '</td>
                            <td style="text-align: center"><img src="{{ asset(' . 'images/sanpham/' . ' . $al->anh) }}"
                                        style="width:90px; height: 80px;" alt=""></td>
                                <td>
                            <td><a href="/admin/sanpham/show/' . $al->id . '"><button class="btn btn-info"><i class="fas fa-eye"></i></button></a></td>
                            <td><a href="/admin/sanpham/edit' . $al->id . '"><button class="btn btn-warning"><i
                                            class="far fa-edit"></i></button></a></td>
                            <td>
                                    <form action="/admin/sanpham/delete/' . $al->id . '" method="post">
                                    ' . csrf_field() . '
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                               </td>
                            </tr>';
            }
        }
        return Response($output);
    }
}