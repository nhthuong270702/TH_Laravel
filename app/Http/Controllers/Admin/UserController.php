<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\DoiMatKhauRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $users = User::simplePaginate(5);
        return view('admin.user.list', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $adduser = $user->save();
        if ($adduser) {
            return redirect()->route('user.index')->with('thongbao', 'Thêm Thành Công');
        } else {
            return back()->with($request->only('name,email'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();
        $user->update($data);
        return redirect()->route('user.index')->with('thongbao', 'Cập Nhật Thành Công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')->with('thongbao', 'Xóa thành công');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $users = User::where('name', 'like', '%' . $request->search . '%')
                ->orwhere('email', 'like', '%' . $request->search . '%')->get();
            $i = 1;
            foreach ($users as $al) {
                $output .= '<tr>
                            <td><input type="checkbox" name="ids" class="checkBoxClass" value=""></td>
                            <td>' . $i++ . '</td>
                            <td>' . $al->name . '</td>
                            <td>' . $al->email . '</td>
                            <td>' . $al->role . '</td>
                            <td><a href="#"><button class="btn btn-primary"><i class="fas fa-eye"></i></button></a></td>
                            <td><a href="/admin/user/edit/' . $al->id . '"><button class="btn btn-primary"><i class="fas fa-user-edit"></i></button></a></td>
                            <td>
                                    <form action="/admin/user/delete/' . $al->id . '" method="post">
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

    public function doi_mat_khau_form($id)
    {
        $user = User::find($id);
        return view('admin.user.password', compact('user'));
    }
    public function doi_mat_khau(DoiMatKhauRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);

        if (!Hash::check($request->password, $user->password)) {

            return back()->with('loi', 'Mật khẩu hiện tại không đúng');
        } else {

            $user->password = bcrypt($request->newpassword);

            $user->save();

            return back()->with('tb', 'Đổi mật khẩu thành công');
        }
    }
    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', explode(",", $ids))->delete();
        return redirect()->back()->with('tb_xoa', 'Đã chuyển vào thùng rác');
    }
    public function trash()
    {
        $users_trash = User::onlyTrashed()->get();
        return view('admin.user.trash', compact('users_trash'));
    }
    public function unTrash($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect()->route('user.trash')->with('thongbao', 'Khôi phục thành công');
    }
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return redirect()->route('user.trash')->with('thongbao', 'Xóa thành công');
    }
    public function forceDeleteAll()
    {
        $user = User::onlyTrashed();
        $user->forceDelete();
        return redirect()->route('user.trash')->with('thongbao', 'Xóa thành công');
    }
    public function restore()
    {
        $user = User::onlyTrashed();
        $user->restore();
        return redirect()->route('user.trash')->with('thongbao', 'Khôi Phục Thành Công');
    }
}