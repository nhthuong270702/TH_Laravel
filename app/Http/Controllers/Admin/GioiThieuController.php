<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatGioiThieuRequest;
use App\Http\Requests\ThemGioiThieuRequest;
use App\Models\GioiThieu;

class GioiThieuController extends Controller
{

    public function index()
    {
        $abouts = GioiThieu::paginate(10);
        return view('admin.gioithieu.list', compact('abouts'));
    }

    public function create()
    {
        return view('admin.gioithieu.add');
    }

    public function store(ThemGioiThieuRequest $request)
    {
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('abouts_anh', $new_image);
            $data['anh'] = $new_image;
            $added = GioiThieu::create($data);
            if ($added) {
                return redirect()->route('gioithieu.index')->with('thongbao', 'Thêm Thành Công');
            } else {
                return back()->withInput();
            }
        }
    }

    public function show($id)
    {
        $data['about'] = GioiThieu::find($id);
        return view('admin.gioithieu.show')->with($data);
    }

    public function edit($id)
    {
        $about = GioiThieu::find($id);
        return view('admin.gioithieu.update', compact('about'));
    }

    public function update(CapNhatGioiThieuRequest $request, $id)
    {
        $about = GioiThieu::find($id);
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('abouts_anh', $new_image);
            $data['anh'] = $new_image;
            $about->update($data);
            return redirect()->route('gioithieu.index')->with('thongbao', "Cập Nhật Thành Công");
        } else {
            $about->update($data);
            return redirect()->route('gioithieu.index')->with('thongbao', "Cập Nhật Thành Công");
        }
    }

    public function destroy($id)
    {
        GioiThieu::find($id)->delete();
        return redirect()->route('gioithieu.index')->with('thongbao', 'Xóa thành công');
    }
}