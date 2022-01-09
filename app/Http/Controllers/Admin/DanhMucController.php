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
        $danhmucs = DanhMuc::paginate(10);
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
}