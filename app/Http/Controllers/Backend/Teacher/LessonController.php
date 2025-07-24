<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;

class LessonController extends Controller
{
    public function index($courseId)
    {
        $teacherId = Auth::id();

        // Chỉ lấy các bài giảng thuộc khóa học của giáo viên hiện tại
        $course = Course::where('id', $courseId)
                        ->where('teacher_id', $teacherId)
                        ->firstOrFail();

        $lessons = Lesson::where('course_id', $course->id)->with('course')->get();

        $lessons = $course->lessons()->with('section')->get();

        $template = 'backend.teacher.lesson.index';
        return view('backend.teacher.master', compact('template', 'lessons', 'course'));
    }


    public function create(Request $request)
    {
        $courseId = $request->get('course_id');

        $course = Course::with('sections')->findOrFail($courseId);
        $sections = $course->sections;

        $template = 'backend.teacher.lesson.create';
        return view('backend.teacher.master', compact('template', 'course', 'sections'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'document_url' => 'nullable|url',
        ]);

        Lesson::create([
            'course_id' => $request->course_id,
            'section_id' => $request->section_id,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'document_url' => $request->document_url,
        ]);


        return redirect()->route('teacher.lesson', $request->course_id)->with('success', 'Đã thêm bài giảng!');
    }


    public function edit($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);

        // Kiểm tra quyền
        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài giảng này.');
        }
        $courses = Course::where('teacher_id', Auth::id())->get();
        $sections = $lesson->course->sections; 

        $template = 'backend.teacher.lesson.edit';
        return view('backend.teacher.master', compact('template', 'lesson', 'courses', 'sections'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'document_url' => 'nullable|url',
        ]);

        // Truy vấn bài giảng và kiểm tra quyền
        $lesson = Lesson::with('course')->findOrFail($id);

        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền cập nhật bài giảng này.');
        }

        // Cập nhật bài giảng
        $lesson->update([
            'course_id' => $request->course_id,
            'section_id' => $request->section_id,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'document_url' => $request->document_url,
        ]);

        return redirect()->route('teacher.lesson', $lesson->course_id)->with('success', 'Cập nhật bài giảng thành công!');
    }



    public function delete($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);

        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền xóa bài giảng này.');
        }

        $lesson->delete();

        return redirect()->route('teacher.lesson', $lesson->course_id)->with('success', 'Xóa bài giảng thành công!');
    }
}