<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;   

class AdminController extends Controller
{

    public function dashboard()
    {   
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalCourses = Course::count();
        $totalQuizzes = Quiz::count();
        $template = 'backend.admin.dashboard.index';
        return view('backend.admin.master', compact(
            'template',
            'totalStudents',
            'totalTeachers',
            'totalCourses',
            'totalQuizzes'
        ));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form')->with('success', 'Đăng xuất thành công');
    }
}