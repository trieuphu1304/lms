<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Hiển thị danh sách khóa học của giáo viên đang đăng nhập
    public function index()
    {
        $teacherId = Auth::id();
        $courses = Course::where('teacher_id', $teacherId)->get();

        $template = 'backend.teacher.course.index';
        return view('backend.teacher.master', compact('template', 'courses'));
    }

    // Form tạo khóa học
    public function create()
    {
        $template = 'backend.teacher.course.create';
        return view('backend.teacher.master', compact('template'));
    }

    // Lưu khóa học mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
        ]);

        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->teacher_id = Auth::id(); // Không lấy từ form
        $course->save();

        return redirect()->route('teacher.course')->with('success', 'Khóa học đã được thêm thành công!');
    }

    // Form chỉnh sửa khóa học
    public function edit($id)
    {
        $course = Course::where('id', $id)
                        ->where('teacher_id', Auth::id())
                        ->firstOrFail(); // đảm bảo giáo viên chỉ sửa khóa học của họ

        $template = 'backend.teacher.course.edit';
        return view('backend.teacher.master', compact('template', 'course'));
    }

    // Cập nhật khóa học
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
        ]);

        $course = Course::where('id', $id)
                        ->where('teacher_id', Auth::id())
                        ->firstOrFail();

        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->save();

        return redirect()->route('teacher.course')->with('success', 'Khóa học đã được cập nhật thành công!');
    }

    // Xóa khóa học
    public function delete($id)
    {
        $course = Course::where('id', $id)
                        ->where('teacher_id', Auth::id())
                        ->first();

        if ($course) {
            $course->delete();
            return redirect()->route('teacher.course')->with('success', 'Khóa học đã được xóa!');
        }

        return redirect()->route('teacher.course')->with('error', 'Không tìm thấy khóa học!');
    }
}