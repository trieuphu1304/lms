<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $courses = Course::with(['teacher', 'category'])->latest()->get();

        // Lấy danh sách giáo viên và số lượng khóa học mỗi giáo viên phụ trách
        $teachers = \App\Models\User::where('role', 'teacher')->withCount('courses')->get();
        $teacherNames = $teachers->pluck('name');
        $courseCounts = $teachers->pluck('courses_count');

        $template = 'backend.admin.course.index';
        return view('backend.admin.master', compact('template', 'courses', 'teacherNames', 'courseCounts'));
    }

    public function create()
    {
        $template = 'backend.admin.course.create';
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('backend.admin.master', compact('template', 'teachers', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'teacher_id' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->teacher_id = $request->input('teacher_id');
        $course->category_id = $request->input('category_id');
        $course->save();

        return redirect()->route('admin.course')->with('success', 'Khóa học đã được thêm thành công!');
    }

    public function edit($id)
    {
        $course = Course::find($id);
        // Lấy danh sách giáo viên để chọn
        $teachers = \App\Models\User::where('role', 'teacher')->get();
        $categories = Category::all();

        $template = 'backend.admin.course.edit';
        return view('backend.admin.master', compact('template', 'course', 'teachers','categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'teacher_id' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $course = Course::find($id);
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->teacher_id = $request->input('teacher_id');
        $course->category_id = $request->input('category_id');
        $course->save();

        return redirect()->route('admin.course')->with('success', 'Khóa học đã được cập nhật thành công!');
    }

    public function delete($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return redirect()->route('admin.course')->with('success', 'Khóa học đã được xóa!');
        }
        return redirect()->route('admin.course')->with('error', 'Không tìm thấy khóa học!');
    }
}