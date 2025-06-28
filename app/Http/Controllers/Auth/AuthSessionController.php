<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class AuthSessionController extends Controller
{
    public function __construct()
    {
       
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role) {
                switch ($user->role) {
                    case 1:
                        return redirect()->route('admin.dashboard');
                    case 2:
                        return redirect()->route('teacher.dashboard');
                    case 3:
                        return redirect()->route('student.dashboard');
                    default:
                        return redirect()->route('login')->withErrors(['email' => 'Tài khoản không hợp lệ']);
                }
            } else {
                // Nếu không có role, đăng xuất và chuyển hướng về trang đăng nhập
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Tài khoản không hợp lệ']);
            }
        }
        return view('backend.admin.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'teacher':
                    return redirect()->route('teacher.dashboard');
                case 'student':
                    return redirect()->route('student.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['email' => 'Tài khoản không hợp lệ']);
            }
        }

        // Nếu đăng nhập không thành công, trả về trang đăng nhập với thông báo lỗi
        return redirect()->route('login')->withInput()->withErrors(['email' => 'Sai thông tin đăng nhập']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
}