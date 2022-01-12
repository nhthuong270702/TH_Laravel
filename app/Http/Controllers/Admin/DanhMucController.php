<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatDanhMucRequest;
use App\Http\Requests\ThemDanhMucRequest;
use App\Models\DanhMuc;

class DanhMucController extends Controller
{

    public function index()
    {
        $danhmucs = DanhMuc::sortable()->simplePaginate(5);
        return view('admin.danhmuc.list', compact('danhmucs'));
    }

    public function create()
    {
        return view('admin.danhmuc.add');
    }

    public function store(ThemDanhMucRequest $request)
    {
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('images/danhmuc', $new_image);
            $data['anh'] = $new_image;
            $added = DanhMuc::create($data);
            if ($added) {
                return redirect()->route('danhmuc.index')->with('thongbao', 'Thêm Thành Công');
            } else {
                return back()->withInput();
            }
        }
    }

    public function show($id)
    {
        $data['danhmuc'] = DanhMuc::find($id);
        $data['sanphams'] = $data['danhmuc']->sanphams;
        return view('admin.danhmuc.show')->with($data);
    }

    public function edit($id)
    {
        $danhmuc = DanhMuc::find($id);
        return view('admin.danhmuc.update', compact('danhmuc'));
    }

    public function update(CapNhatDanhMucRequest $request, $id)
    {
        $danhmuc = DanhMuc::find($id);
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('images/danhmuc', $new_image);
            $data['anh'] = $new_image;
            $danhmuc->update($data);
            return redirect()->route('danhmuc.index')->with('thongbao', "Cập Nhật Thành Công");
        } else {
            $danhmuc->update($data);
            return redirect()->route('danhmuc.index')->with('thongbao', "Cập Nhật Thành Công");
        }
    }

    public function destroy($id)
    {
        DanhMuc::find($id)->delete();
        return redirect()->route('danhmuc.index')->with('thongbao', 'Xóa thành công');
    }
    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        DanhMuc::whereIn('id', explode(",", $ids))->delete();
        return redirect()->back()->with('tb_xoa', 'Đã chuyển vào thùng rác');
    }
    public function trash()
    {
        $danhmucs_trash = DanhMuc::onlyTrashed()->get();
        return view('admin.danhmuc.trash', compact('danhmucs_trash'));
    }
    public function unTrash($id)
    {
        $danhmuc = DanhMuc::onlyTrashed()->find($id);
        $danhmuc->restore();
        return redirect()->route('danhmuc.trash')->with('thongbao', 'Khôi phục thành công');
    }
    public function forceDelete($id)
    {
        $danhmuc = DanhMuc::onlyTrashed()->find($id);
        $danhmuc->forceDelete();
        return redirect()->route('danhmuc.trash')->with('thongbao', 'Xóa thành công');
    }
    public function forceDeleteAll()
    {
        $danhmuc = DanhMuc::onlyTrashed();
        $danhmuc->forceDelete();
        return redirect()->route('danhmuc.trash')->with('thongbao', 'Xóa thành công');
    }
    public function restore()
    {
        $sanpham = DanhMuc::onlyTrashed();
        $sanpham->restore();
        return redirect()->route('danhmuc.trash')->with('thongbao', 'Khôi Phục Thành Công');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $danhmucs = DanhMuc::where('ten', 'like', '%' . $request->search . '%')->get();
            $i = 1;
            foreach ($danhmucs as $al) {
                $output .= '<tr id="tr_{{ $al->id }}">
                                <td><input type="checkbox" class="checkbox" data-id="{{ ' . $al->id . ' }}">
                            <td>' . $i++ . '</td>
                            <td>' . $al->ten . '</td>
                             <td><img src="../images/danhmuc/' .  $al->anh  . '"
                                        style="width:125px; height: 120px;" alt=""></td>
                                        
                            <td><a href="/admin/danhmuc/show/' . $al->id . '"><button class="btn btn-info"><i class="fas fa-eye"></i></button></a></td>
                            <td><a href="/admin/danhmuc/edit/' . $al->id . '"><button class="btn btn-warning"><i
                                            class="far fa-edit"></i></button></a></td>
                            <td>
                                    <form action="/admin/danhmuc/delete/' . $al->id . '" method="post">
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