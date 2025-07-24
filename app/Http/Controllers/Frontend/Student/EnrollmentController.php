<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        $user = Auth::user();

        // Kiểm tra nếu user đã đăng ký rồi
        if ($course->students->contains($user->id)) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký khóa học này rồi.');
        }

        // Thêm user vào bảng course_student
        $course->students()->attach($user->id);

        return redirect()->back()->with('success', 'Đăng ký khóa học thành công!');
    }
}