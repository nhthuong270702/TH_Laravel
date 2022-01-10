<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatBlogRequest;
use App\Http\Requests\ThemBlogRequest;
use App\Models\Blog;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::sortable()->paginate(10);
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
        $data['blog'] = Blog::find($id);
        return view('admin.blog.show')->with($data);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.update', compact('blog'));
    }

    public function update(CapNhatBlogRequest $request, $id)
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
    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        Blog::whereIn('id', explode(",", $ids))->delete();
        return redirect()->back()->with('tb_xoa', 'Đã chuyển vào thùng rác');
    }
    public function trash()
    {
        $blogs_trash = Blog::onlyTrashed()->get();
        return view('admin.blog.trash', compact('blogs_trash'));
    }
    public function unTrash($id)
    {
        $blog = Blog::onlyTrashed()->find($id);
        $blog->restore();
        return redirect()->route('blog.trash')->with('thongbao', 'Khôi phục thành công');
    }
    public function forceDelete($id)
    {
        $blog = Blog::onlyTrashed()->find($id);
        $blog->forceDelete();
        return redirect()->route('blog.trash')->with('thongbao', 'Xóa thành công');
    }
    public function forceDeleteAll()
    {
        $blog = Blog::onlyTrashed();
        $blog->forceDelete();
        return redirect()->route('blog.trash')->with('thongbao', 'Xóa thành công');
    }
    public function restore()
    {
        $blog = Blog::onlyTrashed();
        $blog->restore();
        return redirect()->route('blog.trash')->with('thongbao', 'Khôi Phục Thành Công');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $blogs = Blog::where('tieude', 'like', '%' . $request->search . '%')->get();
            $i = 1;
            foreach ($blogs as $al) {
                $output .= '<tr id="tr_{{ $blog->id }}">
                                <td><input type="checkbox" class="checkbox" data-id="{{ $al->id }}">
                            <td style="text-align: center">' . $i++ . '</td>
                            <td>' . $al->tieude . '</td>
                            <td>' . $al->noidung . '</td>
                            <td style="text-align: center">' . $al->ngaydang . '</td>
                            <td style="text-align: center">' . $al->sobinhluan . '</td>
                           <td style="text-align: center"><img src="../images/blogs/' .  $al->anh  . '"
                                        style="width:150px; height: 120px;" alt=""></td>
                            <td><a href="/admin/blog/show/' . $al->id . '"><button class="btn btn-info"><i class="fas fa-eye"></i></button></a></td>
                            <td><a href="/admin/blog/edit/' . $al->id . '"><button class="btn btn-warning"><i
                                            class="far fa-edit"></i></button></a></td>
                            <td>
                                    <form action="/admin/blog/delete/' . $al->id . '" method="post">
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