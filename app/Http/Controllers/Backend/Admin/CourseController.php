<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

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
        // Lấy danh sách giáo viên để chọn
        $teachers = \App\Models\User::where('role', 'teacher')->get();
        return view('backend.admin.master', compact('template', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'teacher_id' => 'required',
        ]);
        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->teacher_id = $request->input('teacher_id');
        $course->save();

        return redirect()->route('admin.course')->with('success', 'Khóa học đã được thêm thành công!');
    }

    public function edit($id)
    {
        $course = Course::find($id);
        // Lấy danh sách giáo viên để chọn
        $teachers = \App\Models\User::where('role', 'teacher')->get();

        $template = 'backend.admin.course.edit';
        return view('backend.admin.master', compact('template', 'course', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'teacher_id' => 'required',
        ]);
        $course = Course::find($id);
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->level = $request->input('level');
        $course->teacher_id = $request->input('teacher_id');
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