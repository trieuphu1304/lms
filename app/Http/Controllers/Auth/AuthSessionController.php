<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class AuthSessionController extends Controller
{
    public function showAdminLogin()
    {
        return view('backend.admin.login');
    }

    public function showTeacherLogin()
    {
        return view('backend.teacher.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                case 1:
                    return redirect()->route('admin.dashboard');
                case 'teacher':
                case 2:
                    return redirect()->route('teacher.dashboard');
                default:
                    Auth::logout();
                    return redirect()->back()->withErrors(['email' => 'Tài khoản không hợp lệ']);
            }
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Sai thông tin đăng nhập']);
    }

    // Logout dành riêng cho admin
    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.form')->with('success', 'Đăng xuất thành công (Admin)');
    }

    // Logout dành riêng cho teacher
    public function teacherLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('teacher.login.form')->with('success', 'Đăng xuất thành công (Teacher)');
    }
}