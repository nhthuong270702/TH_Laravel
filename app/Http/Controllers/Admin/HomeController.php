<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $data['users'] = User::count();
        $data['danhmucs'] = DanhMuc::count();
        $data['sanphams'] = SanPham::count();
        $data['blogs'] = Blog::count();

        return view('admin.index')->with($data);
    }
}