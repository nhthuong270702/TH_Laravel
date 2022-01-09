<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThemBlogRequest;
use App\Models\Blog;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('admin.Blog.list', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.add');
    }

    public function store(ThemBlogRequest $request)
    {
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('images/blogs', $new_image);
            $data['anh'] = $new_image;
            $added = BLog::create($data);
            if ($added) {
                return redirect()->route('blog.index')->with('thongbao', 'Thêm Thành Công');
            } else {
                return back()->withInput();
            }
        }
    }

    public function show($id)
    {
        $data['Blog'] = Blog::find($id);
        $data['sanphams'] = $data['Blog']->sanphams;
        return view('admin.Blog.show')->with($data);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.update', compact('blog'));
    }

    public function update(ThemBlogRequest $request, $id)
    {
        $blog = Blog::find($id);
        $data = $request->validated();
        $get_image = $request->file('anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('images/blogs', $new_image);
            $data['anh'] = $new_image;
            $blog->update($data);
            return redirect()->route('blog.index')->with('thongbao', 'Cập Nhật Thành Công');
        } else {
            Blog::find($id)->update($data);
            return redirect()->route('blog.index')->with('thongbao', 'Cập Nhật Thành Công');
        }
    }

    public function destroy($id)
    {
        Blog::find($id)->delete();
        return redirect()->route('blog.index')->with('thongbao', 'Xóa thành công');
    }
}