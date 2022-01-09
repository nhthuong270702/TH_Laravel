<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;
            if ($role == 1) {
                return redirect()->route('adminpage');
            } else {
                return redirect('/');
            }
        } else {
            return back()->withInput(
                $request->only('email')
            )->with('thongbao', 'Email hoặc mật khẩu không đúng');
        }
    }
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 0;
        $usersave = $user->save();
        if ($usersave) {
            return redirect("dangnhap")->with('thongbao1', 'Đăng kí thành công');
        } else {
            return back()->withInput(
                $request->only('email', 'name')
            );
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('dangnhap');
    }
}