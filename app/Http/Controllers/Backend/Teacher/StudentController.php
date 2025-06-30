<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        // Lấy các khóa học mà giáo viên đang dạy
        $courses = Course::where('teacher_id', Auth::id())->with('students')->get();

        $template = 'backend.teacher.student.index';
        return view('backend.teacher.master', compact('template', 'courses'));
    }
}