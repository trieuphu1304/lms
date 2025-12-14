<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Notification;
use App\Models\User;
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

        // Lấy giáo viên của khóa học
        $teacherId = $course->teacher_id;

        // Tạo thông báo cho giáo viên
        Notification::create([
            'user_id' => $course->teacher_id, // giáo viên nhận thông báo
            'actor_name' => Auth::user()->name, // học viên tạo thông báo
            'actor_id'  => $user->id,
            'title' => 'vừa đăng ký khóa học "' . $course->title . '"',
            'message' => '', 
            'is_read' => false,
        ]);

        // Tạo thông báo cho tất cả admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'actor_name' => Auth::user()->name,
                'actor_id' => $user->id,
                'title' => 'Học viên ' . Auth::user()->name . ' vừa đăng ký khóa học "' . $course->title . '"',
                'message' => '',
                'is_read' => false,
            ]);
        }

        return redirect()->route('course.detail', ['id' => $course->id])->with('success', 'Đăng ký khóa học thành công!');

    }
}