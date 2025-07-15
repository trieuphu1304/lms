<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Hiển thị danh sách khóa học của giáo viên đang đăng nhập
    public function index()
    {
        $teacherId = Auth::id();
        $courses = Course::where('teacher_id', $teacherId)->get();
        $courses = Course::with(['teacher', 'category'])->latest()->get();

        $template = 'backend.teacher.course.index';
        return view('backend.teacher.master', compact('template', 'courses'));
    }

    // Form tạo khóa học
    public function create()
    {
        $template = 'backend.teacher.course.create';
        $categories = Category::all();
        return view('backend.teacher.master', compact('template','categories'));
    }

    // Lưu khóa học mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->teacher_id = Auth::id(); 
        $course->category_id = $request->input('category_id');
        $course->save();

        return redirect()->route('teacher.course')->with('success', 'Khóa học đã được thêm thành công!');
    }

    // Form chỉnh sửa khóa học
    public function edit($id)
    {
        $course = Course::where('id', $id)
                        ->where('teacher_id', Auth::id())
                        ->firstOrFail(); // đảm bảo giáo viên chỉ sửa khóa học của họ
        $categories = Category::all();
        $template = 'backend.teacher.course.edit';
        return view('backend.teacher.master', compact('template', 'course','categories'));
    }

    // Cập nhật khóa học
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $course = Course::where('id', $id)
                        ->where('teacher_id', Auth::id())
                        ->firstOrFail();

        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->category_id = $request->input('category_id');
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